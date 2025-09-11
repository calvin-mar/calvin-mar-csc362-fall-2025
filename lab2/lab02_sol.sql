/*
Calvin Mar
This script is intended to create the movie ratings database, 
with movies, genres, movie_genres, ratings and consumers tables
*/

-- Set up Database
DROP DATABASE IF EXISTS movie_ratings;
CREATE DATABASE movie_ratings;
USE movie_ratings;

--Create and show movies table
CREATE TABLE movies(
    movie_id INT NOT NULL AUTO_INCREMENT,
    movie_title CHAR(200) NOT NULL,
    movie_release_date DATETIME,
    PRIMARY KEY(movie_id)
);
SHOW CREATE TABLE movies;

-- Create and show genres table
CREATE TABLE genres(
    genre_id INT NOT NULL AUTO_INCREMENT,
    genre_name CHAR(50) NOT NULL,
    PRIMARY KEY(genre_id)
);
SHOW CREATE TABLE genres;

-- Create and show linking table for movies and genres
CREATE TABLE movie_genres(
    movie_id INT NOT NULL,
    genre_id INT NOT NULL,
    FOREIGN KEY(movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY(genre_id) REFERENCES genres(genre_id),
    PRIMARY KEY(movie_id, genre_id)
);
SHOW CREATE TABLE movie_genres;

-- Create and show consumers table
CREATE TABLE consumers(
    consumer_id INT NOT NULL AUTO_INCREMENT,
    consumer_first_name CHAR(64) NOT NULL,
    consumer_last_name CHAR(64),
    consumer_address CHAR(128),
    consumer_city CHAR(128),
    consumer_state CHAR(2),
    consumer_zip_code INT,
    PRIMARY KEY(consumer_id)
);
SHOW CREATE TABLE consumers;

-- Create and show ratings table
CREATE TABLE ratings(
    movie_id INT NOT NULL,
    consumer_id INT NOT NULL,
    rating_date DATETIME,
    rating_star_number INT,
    FOREIGN KEY(movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY(consumer_id) REFERENCES consumers(consumer_id),
    PRIMARY KEY(movie_id, consumer_id)
);
SHOW CREATE TABLE ratings;

-- Add values to tables

-- Add to movies
INSERT INTO movies(movie_title, movie_release_date) VALUES
    ("The Hunt for Red October", '1990/03/02'),
    ("Lady Bird", '2017/12/01'),
    ("Inception", '2010/08/16'),
    ("Monty Python and the Holy Grail", '1975/04/03');

-- Add to genres
INSERT INTO genres(genre_name) VALUES
    ("Action"),
    ("Adventure"),
    ("Thriller"),
    ("Comedy"),
    ("Drama"),
    ("Science Fiction");

-- Add links between genres and movies
INSERT INTO movie_genres(movie_id, genre_id) VALUES
    (1,1),
    (1,2),
    (1,3),
    (2,4),
    (2,5),
    (3,1),
    (3,2),
    (3,6),
    (4,4);

-- Add to consumers
INSERT INTO consumers(consumer_first_name, consumer_last_name, consumer_address, consumer_city, consumer_state, consumer_zip_code) VALUES
    ("Toru", "Okada", "800 Glenridge Ave", "Hobart", "IN", 46343),
    ("Kumiko", "Okada", "864 NW Bohemia St", "Vincentown", "NJ", 08088),
    ("Noboru", "Wataya", "342 Joy Ridge St", "Hermitage", "TN", 37076),
    ("May", "Kasahara", "5 Kent Rd", "East Haven", "CT", 06512);

-- Add to ratings
INSERT INTO ratings(movie_id, consumer_id, rating_date, rating_star_number) VALUES
    (1, 1, '2010/09/02 10:54:19', 4),
    (1, 3, '2012/08/05 15:00:01', 3),
    (1, 4, '2016/10/02 23:58:12', 1),
    (2, 3, '2017/03/27 00:12:48', 2),
    (2, 4, '2018/08/02 00:54:42', 4);


-- Display all data in the tables
SELECT * FROM movies;
SELECT * FROM genres;
SELECT * FROM movie_genres;
SELECT * FROM consumers;
SELECT * FROM ratings;

/* Generate a report */
SELECT consumer_first_name, consumer_last_name, movie_title, rating_star_number
    FROM movies
        NATURAL JOIN ratings
        NATURAL JOIN consumers;