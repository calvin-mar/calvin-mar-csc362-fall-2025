/*
Calvin Mar
This script is intended to create school database,
add instructor table, 
and populate it with some data.
*/
DROP DATABASE IF EXISTS school; --Ensure that DATABASE school doesn't exist yet
CREATE DATABASE school; --Create school database
USE school; --Switch to using the school database

CREATE TABLE instructors(
	instructor_first_name VARCHAR(150) NOT NULL, --Create field for the instructor's first name
	instructor_last_name VARCHAR(150) NOT NULL, --Create field for the instructor's last name
	instructor_campus_phone VARCHAR(8) NOT NULL --Create field for the instructor's campus phone
);

--Add data into the table
INSERT INTO instructors (instructor_first_name, instructor_last_name, instructor_campus_phone) VALUES
	('Kira', 'Bently', '363-9948'),
	('Timothy', 'Ennis', '527-4992'),
	('Shannon', 'Black', '336-5992'),
	('Estela', 'Rosales', '322-6992');

--Display data from the instructors table
SELECT * FROM instructors;
