DROP DATABASE IF EXISTS rinoparking;
CREATE DATABASE rinoparking;
USE rinoparking;
CREATE TABLE user(id INT AUTO_INCREMENT PRIMARY KEY, email varchar(50) not null, name varchar(50) not null, last_name varchar(50) not null, second_last_name varchar(50), control_number varchar(20) not null, password varchar(20) not null, status varchar(30) not null);
CREATE TABLE administrator(id INT AUTO_INCREMENT PRIMARY KEY, control_number varchar(20) not null, password varchar(20) not null);