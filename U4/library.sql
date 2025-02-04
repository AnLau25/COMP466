CREATE DATABASE library;

USE library;

CREATE TABLE books
(
   ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   Title varchar(60),
   Category varchar(32),
   ISBN varchar(20)
);

CREATE TABLE borrowers
(
   Borrower_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   FirstName varchar(60),
   LastName varchar(32),
   BirthDate date(20)
);