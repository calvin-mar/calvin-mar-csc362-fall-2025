DROP DATABASE IF EXISTS pokemon_db;
CREATE DATABASE pokemon_db;

USE pokemon_db;

CREATE TABLE trainers(
    trainer_id INT NOT NULL AUTO_INCREMENT,
    trainer_name VARCHAR(255),
    trainer_hometown VARCHAR(255),
    PRIMARY KEY (trainer_id)
);

CREATE TABLE pokemon(
    pokemon_id INT NOT NULL AUTO_INCREMENT,
    pokemon_species VARCHAR(255),
    pokemon_level INT,
    pokemon_type VARCHAR(255),
    trainer_id INT,
    pokemon_is_in_party BOOLEAN NOT NULL,
    PRIMARY KEY (pokemon_id),
    FOREIGN KEY (trainer_id) REFERENCES trainers(trainer_id)
);

--Creating Triggers
DELIMITER //
CREATE TRIGGER enforce_pokemon_min
BEFORE UPDATE ON pokemon FOR EACH ROW
BEGIN
IF 1 = (SELECT NULLIF(COUNT(pokemon_id), 0) FROM pokemon WHERE pokemon_is_in_party = TRUE AND trainer_id = NEW.trainer_id GROUP BY trainer_id) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Minimum pokemon in party not reached';
END IF;
END//
DELIMITER ;


DELIMITER //
CREATE TRIGGER enforce_pokemon_max
BEFORE UPDATE ON pokemon FOR EACH ROW
BEGIN
IF 6 = (SELECT NULLIF(COUNT(pokemon_id),0) FROM pokemon WHERE pokemon_is_in_party = TRUE AND trainer_id = NEW.trainer_id GROUP BY trainer_id) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Maximum number of pokemon exceeded';
END IF;
END//
DELIMITER ;

-- Creating procedure
DELIMITER //
CREATE PROCEDURE trade_pokemon (trainer1 INT, pokemon1 INT, trainer2 INT, pokemon2 INT)
BEGIN
DECLARE EXIT HANDLER FOR 45000
    BEGIN
    SELECT 'Procedure failed because of reasons!' as Error;
        ROLLBACK;
    END;
START TRANSACTION;

    IF (SELECT pokemon_is_in_party FROM pokemon WHERE pokemon_id = pokemon1) = FALSE THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A pokemon is not in a party and cannot be traded';
    END IF;

    IF (SELECT pokemon_is_in_party FROM pokemon WHERE pokemon_id = pokemon2) = FALSE THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A pokemon is not in a party and cannot be traded';
    END IF;

    IF pokemon1 NOT IN (SELECT pokemon_id FROM pokemon WHERE trainer_id = trainer1) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A trainer must have the pokemon to trade them';
    END IF;

    IF pokemon2 NOT IN (SELECT pokemon_id FROM pokemon WHERE trainer_id = trainer2) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A trainer must have the pokemon to trade them';
    END IF;

    UPDATE pokemon
       SET trainer_id = trainer1
     WHERE pokemon_id = pokemon2;

    UPDATE pokemon
       SET trainer_id = trainer2
     WHERE pokemon_id = pokemon1;
COMMIT;
END//
DELIMITER ;

-- Begin testing data
INSERT INTO trainers (trainer_name) VALUES
    ("Ash"),
    ("Misty"),
    ("Brock"),
    ("Arven");

-- Ash will have 1 pokemon, Misty will have 3 pokemon, Brock will have 6 pokemon, and Arven will have 3 pokemon
INSERT INTO pokemon (pokemon_species, pokemon_level, pokemon_is_in_party, trainer_id) VALUES
    ("Pikachu", 10, TRUE, 1),
    ("Charmander", 5, TRUE, 2),
    ("Jigglypuff", 13, TRUE, 2),
    ("Oddish", 16, TRUE, 2),
    ("Blastoise", 27, TRUE, 3),
    ("Geo Dude", 17, TRUE, 3),
    ("Zapatos", 40, TRUE, 3),
    ("Charizard", 12, TRUE, 3),
    ("Magikarp", 99, TRUE, 3),
    ("Raichu", 9, TRUE, 3),
    ("Weedle", 14, TRUE, 4),
    ("Pidgey", 72, TRUE, 4),
    ("Bulbasaur", 31, TRUE, 4),
    ("Alakazam", 12, FALSE, 3);

--Performing a correct trade Misty trades Oddish to Arven for Pidgey
CALL trade_pokemon(2,3,4,12);

--Perform Invalid Trade Ash trades Oddish to Brock for Magikarp
CALL trade_pokemon(1,4,4,8);

SELECT trainer_id, COUNT(pokemon_id) FROM pokemon WHERE pokemon_is_in_party = TRUE GROUP BY trainer_id;
--Perform Invalid Update by adding Alakazam to Brock's Party
UPDATE pokemon
   SET pokemon_is_in_party = TRUE
 WHERE pokemon_species = "Alakazam";

--Perform Invalid by removing Pikachu from Ash's Party
UPDATE pokemon
   SET pokemon_is_in_party = FALSE
 WHERE pokemon_species = "Pikachu";

SELECT trainer_id, COUNT(pokemon_id) FROM pokemon WHERE pokemon_is_in_party = TRUE GROUP BY trainer_id;