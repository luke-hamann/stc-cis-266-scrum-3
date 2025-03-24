START TRANSACTION;

DROP DATABASE IF EXISTS carDealership;
CREATE DATABASE carDealership;
USE carDealership;

-- Create tables

CREATE TABLE Cars (
    id INT PRIMARY KEY AUTO_INCREMENT,
    make VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    year INT(4) NOT NULL,
    color VARCHAR(100) NOT NULL,
    price DECIMAL
);

CREATE TABLE Customers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    phone VARCHAR(100),
    email VARCHAR(200),
    address VARCHAR(1000)
);

CREATE TABLE Salespeople (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    hireDate DATE NOT NULL,
    salary DECIMAL,
    commissionPercent DECIMAL
);

-- Insert data

INSERT INTO Cars (make, model, year, color, price)
VALUES
    ('Ford', 'F-150', 2019, 'red', 21900),
    ('VW', 'Jetta', 2004, 'blue', 15300),
    ('BMW', 'X5', 2022, 'silver', 29900),
    ('Cadillac', 'Super', 1999, 'black', 9900),
    ('Ford', 'E-350', 2015, 'grey', 17800),
    ('Tesla', 'X', 2017, 'white', 40400),
    ('Audi', 'Infinity', 2014, 'black', 6900);

INSERT INTO Customers (firstName, lastName, phone, email, address)
VALUES
    ('Joe', 'Cool', '123-456-6789', 'joe.cool@example.com', '123 Cool Pkwy'),
    ('John', 'Smith', '748-843-0158', 'john.smith@example.gov', '200 Nice Town'),
    ('Mary', 'Sue', '062-239-9175', 'msue@hi.example.org', '960 Another Rd'),
    ('Ann', 'Marie', '165-340-1076', 'ann.marie@example.net', '329 Orange St'),
    ('Mark', 'Davey', '347-239-3744', 'mark.davey@wow.example.org', '4855 Computer Ct'),
    ('Sam', 'Donald', '758-608-2384', 'sam.donald@example.edu', '558 Main St'),
    ('Greg', 'Clark', '478-846-0286', 'gclark@dept.example.co', '19 Hello Rd');

INSERT INTO Salespeople (firstName, lastName, hireDate, salary, commissionPercent)
VALUES
    ('Matthew', 'Robertson', '2000-06-09', 28643, 5),
    ('Gina', 'Smith', '2010-03-14', 34700, 4),
    ('Paul', 'Jones', '2025-01-17', 31636, 10),
    ('Elizabeth', 'Reginald', '1998-10-26', 80843, 2),
    ('Levi', 'Freddy', '2023-11-24', 37597, 6),
    ('George', 'McSwift', '2005-06-18', 10983, 5),
    ('David', 'Teller', '2016-09-18', 68198, 9);

COMMIT;
