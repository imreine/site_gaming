CREATE DATABASE gaming_site;

USE gaming_site;

CREATE TABLE users (
    id INT IDENTITY(1,1) PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    pseudo VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
