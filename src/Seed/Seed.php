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
$createGroupsTable = "CREATE TABLE IF NOT EXISTS groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    programme VARCHAR(255) NOT NULL,
    number VARCHAR(255) NOT NULL,
    type ENUM('year','group', 'subgroup') NOT NULL
    )";

$createRoomsTable = "CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
    )";

$db->exec($createRoomsTable);
$db->exec($createUsersTable);
$db->exec($createGroupsTable);
