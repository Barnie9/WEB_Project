<?php

$db = $container->get('db');

$createUsersTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    type ENUM('admin', 'teacher', 'student') NOT NULL
    )";

$createUsersTable ="CREATE TABLE IF NOT EXISTS matters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    type ENUM('mandatory', 'optional', 'elective') NOT NULL
    )";

$db->exec($createUsersTable);
