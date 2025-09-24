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

CREATE TABLE costumers(
    costumer_id INT NOT NULL AUTO_INCREMENT DEFAULT 0,
    customer_first_name CHAR(50),
    customer_last_name CHAR(50),
    customer_address CHAR(50),
    customer_city CHAR(50),
    customer_state CHAR(2),
    customer_zip_code CHAR(5),
    customer_phone CHAR(14)
    PRIMARY KEY(costumer_id)
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

ALTER TABLE rug_trials
ADD CONSTRAINT max_trials 
CHECK(
    NOT EXISTS(
        SELECT rug_number, customer_id
        FROM rug_trials
        GROUP BY rug_number, customer_id 
        HAVING Count(rug_number, customer_id ) > 4
    );
);

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
