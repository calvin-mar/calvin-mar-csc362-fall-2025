/*
Calvin Mar
This script is intended to create school database,
add instructor table, 
and populate it with some data.
*/
DROP DATABASE IF EXISTS school;
CREATE DATABASE school;
USE school;
CREATE TABLE instructors(
	instructor_first_name VARCHAR(150),
	instructor_last_name VARCHAR(150),
	instructor_campus_phone VARCHAR(8)
);
INSERT INTO instructors (instructor_first_name, instructor_last_name, instructor_campus_phone) VALUES
	('Kira', 'Bently', '363-9948'),
	('Timothy', 'Ennis', '527-4992'),
	('Shannon', 'Black', '336-5992'),
	('Estela', 'Rosales', '322-6992');
SELECT * FROM instructors;
