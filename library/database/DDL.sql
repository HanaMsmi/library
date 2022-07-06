DROP DATABASE lib;
CREATE DATABASE lib;

CREATE TABLE users (
id             INT NOT NULL AUTO_INCREMENT,
isadmin        INT NOT NULL,
fname          VARCHAR(255) NOT NULL,
lname          VARCHAR(255) NOT NULL,
password       VARCHAR(255) NOT NULL,
email          VARCHAR(255) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE books (
id             INT NOT NULL AUTO_INCREMENT,
name          VARCHAR(255) NOT NULL,
author          VARCHAR(255) NOT NULL,
publisher      VARCHAR(255) NOT NULL,
type            VARCHAR(255) NOT NULL,
description     TEXT NOT NULL,
image1          VARCHAR(255) NOT NULL,
image2          VARCHAR(255),
image3          VARCHAR(255),
code            INT NOT NULL,
cost            INT NOT NULL,
stock           INT NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE comments (
id                  INT NOT NULL AUTO_INCREMENT,
bookid              INT NOT NULL,
userid              INT NOT NULL,
text                TEXT NOT NULL,
datetime            TIMESTAMP NOT NULL, 
PRIMARY KEY (id)
);

CREATE TABLE favorites (
userid           INT NOT NULL,
bookid         INT NOT NULL
);

CREATE TABLE deposits (
userid         INT NOT NULL,
bookid         INT NOT NULL,
start_date     TIMESTAMP NOT NULL, 
duration       INT NOT NULL
);
