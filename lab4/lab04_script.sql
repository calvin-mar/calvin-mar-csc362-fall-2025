DROP DATABASE IF EXISTS flying_carpets;
CREATE DATABASE flying_carpets;
USE flying_carpets;

CREATE TABLE rugs(
    rug_number INT NOT NULL AUTO_INCREMENT,
    rug_origin CHAR(50),
    rug_type CHAR(50),
    rug_material CHAR(50),
    rug_width INT,
    rug_length INT,
    rug_purchase_price DECIMAL(11,2),
    rug_date_acquired DATETIME,
    rug_markup DECIMAL(5,3),
    rug_list_price DECIMAL(11,2),
    PRIMARY KEY(rug_number)
);

CREATE TABLE customers(
    customer_id INT NOT NULL AUTO_INCREMENT,
    customer_first_name CHAR(50),
    customer_last_name CHAR(50),
    customer_address CHAR(50),
    customer_city CHAR(50),
    customer_state CHAR(2),
    customer_zip_code CHAR(5),
    customer_phone CHAR(14),
    PRIMARY KEY(customer_id)
);

CREATE TABLE rug_trials(
    rug_number INT NOT NULL,
    customer_id INT NOT NULL,
    rug_trial_date DATETIME NOT NULL,
    rug_trial_expected_return DATETIME,
    rug_trial_actual_return DATETIME,
    rug_trial_purchased BOOL,
    FOREIGN KEY(rug_number) REFERENCES rugs(rug_number) ON DELETE RESTRICT,
    FOREIGN KEY(customer_id) REFERENCES customers(customer_id) ON DELETE SET DEFAULT,
    PRIMARY KEY(rug_number, customer_id, rug_trial_date) 
);

DELIMITER //
CREATE TRIGGER constrain_max_trials
BEFORE INSERT ON rug_trials
FOR EACH ROW
BEGIN
    DECLARE current_trial_count INT;
    SELECT COUNT(*) INTO current_trial_count
    FROM rug_trials
    WHERE customer_id = NEW.customer_id AND rug_number = NEW.rug_number AND rug_trial_actual_return IS NOT NULL AND rug_trial_purchased <> TRUE;

    IF current_trial_count >= 4 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A customer may not have more than 4 active trials';
    END IF;
END//

DELIMITER ;

CREATE TABLE rug_sales(
    rug_number INT NOT NULL,
    customer_id INT NOT NULL,
    rug_sale_date_time DATETIME NOT NULL,
    rug_sale_price DECIMAL(11,2) NOT NULL,
    rug_net_on_sale DECIMAL(11,2) NOT NULL,
    rug_return_date DATETIME,
    FOREIGN KEY(rug_number) REFERENCES rugs(rug_number) ON DELETE RESTRICT,
    FOREIGN KEY(customer_id) REFERENCES customers(customer_id) ON DELETE SET DEFAULT,
    PRIMARY KEY(rug_number, customer_id, rug_sale_date_time)
);

DELIMITER //
CREATE TRIGGER update_sale
BEFORE INSERT ON rug_sales
FOR EACH ROW
BEGIN  
    DECLARE current_trial_exists INT;
    SELECT COUNT(*) INTO current_trial_exists
    FROM rug_trials
    WHERE customer_id = NEW.customer_id AND rug_number = NEW.rug_number AND rug_trial_actual_return IS NOT NULL AND rug_trial_date < NEW.rug_sale_date_time;

    IF current_trial_exists > 0 THEN
        UPDATE rug_trials
        SET rug_trial_purchased = TRUE
        WHERE customer_id = NEW.customer_id AND rug_number = NEW.rug_number AND rug_trial_actual_return IS NOT NULL AND rug_trial_date < NEW.rug_sale_date_time;
    END IF;
END//

DELIMITER ;

ALTER TABLE rug_sale
ADD CONSTRAINT return_after_purchase_sale
CHECK (rug_return_date IS NULL OR rug_return_date > rug_sale_date_time);

ALTER TABLE rug_trials
ADD CONSTRAINT actual_return_after_purchase_trial
CHECK (rug_trial_actual_return IS NULL OR rug_trial_actual_return > rug_trial_date);

ALTER TABLE rug_trials
ADD CONSTRAINT expected_return_after_purchase_trial
CHECK (rug_trial_expected_return IS NULL OR rug_trial_expected_return > rug_trial_date);