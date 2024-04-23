<?php

$db = $container->get('db');

$dropEventsTable = "DROP TABLE IF EXISTS events";
$dropRoomsTable = "DROP TABLE IF EXISTS rooms";
$dropMattersTable = "DROP TABLE IF EXISTS matters";
$dropMembershipsTable = "DROP TABLE IF EXISTS memberships";
$dropGroupsTable = "DROP TABLE IF EXISTS groups";
$dropUsersTable = "DROP TABLE IF EXISTS users";

$db->exec($dropEventsTable);
$db->exec($dropRoomsTable);
$db->exec($dropMattersTable);
$db->exec($dropMembershipsTable);
$db->exec($dropGroupsTable);
$db->exec($dropUsersTable);

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
    number INT NOT NULL,
    type ENUM('year', 'group', 'subgroup') NOT NULL
    )";

$createMembershipsTable = "CREATE TABLE IF NOT EXISTS memberships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    group_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (group_id) REFERENCES groups(id)
    )";

$createMattersTable = "CREATE TABLE IF NOT EXISTS matters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    type ENUM('mandatory', 'optional', 'elective') NOT NULL
    )";

$createRoomsTable = "CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
    )";

$createEventsTable = "CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matter_id INT NOT NULL,
    teacher_id INT NOT NULL,
    group_id INT NOT NULL,
    room_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    type ENUM('course', 'seminary', 'laboratory') NOT NULL,
    FOREIGN KEY (matter_id) REFERENCES matters(id),
    FOREIGN KEY (teacher_id) REFERENCES users(id),
    FOREIGN KEY (group_id) REFERENCES groups(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
    )";

$db->exec($createUsersTable);
$db->exec($createGroupsTable);
$db->exec($createMembershipsTable);
$db->exec($createMattersTable);
$db->exec($createRoomsTable);
$db->exec($createEventsTable);

$insertUsers = 'INSERT INTO users (email, password, first_name, last_name, type) VALUES
    ("barnie1@gmail.com", "password1", "Barnie", "Broomfield", "student"),
    ("barnie2@gmail.com", "password2", "Barnie", "Broomfield", "teacher"),
    ("barnie3@gmail.com", "password3", "Barnie", "Broomfield", "student")
    ';

$insertGroups = 'INSERT INTO groups (programme, number, type) VALUES
    ("Computer Science", 1, "year"),
    ("Computer Science", 1, "group"),
    ("Computer Science", 2, "group"),
    ("Computer Science", 3, "group"),
    ("Computer Science", 4, "group"),
    ("Computer Science", 1, "subgroup"),
    ("Computer Science", 2, "subgroup"),
    ("Computer Science", 3, "subgroup"),
    ("Computer Science", 4, "subgroup"),
    ("Computer Science", 5, "subgroup"),
    ("Computer Science", 6, "subgroup"),
    ("Computer Science", 7, "subgroup")
    ';

$insertMemberships = 'INSERT INTO memberships (user_id, group_id) VALUES
    (1, 1),
    (3, 1),
    (1, 2),
    (3, 3),
    (1, 6),
    (3, 8)
    ';

$insertMatters = 'INSERT INTO matters (title, type) VALUES
    ("SO", "mandatory"),
    ("PIII", "mandatory"),
    ("ASD", "mandatory"),
    ("PJCR", "optional"),
    ("PV", "optional"),
    ("PW", "optional"),
    ("PC", "elective")
    ';

$insertRooms = 'INSERT INTO rooms (name) VALUES
    ("AM"),
    ("A02"),
    ("048"),
    ("032"),
    ("033"),
    ("AIM"),
    ("003"),
    ("103"),
    ("104"),
    ("F108")
    ';

$insertEvents = 'INSERT INTO events (matter_id, teacher_id, group_id, room_id, start_time, end_time, type) VALUES
    (1, 2, 1, 1, "2022-01-01 08:00:00", "2022-01-01 10:00:00", "course"),
    (2, 2, 1, 2, "2022-01-01 10:00:00", "2022-01-01 12:00:00", "course"),
    (1, 2, 2, 4, "2022-01-01 14:00:00", "2022-01-01 16:00:00", "seminary"),
    (2, 2, 3, 7, "2022-01-02 08:00:00", "2022-01-02 10:00:00", "seminary"),
    (3, 2, 6, 4, "2022-01-02 10:00:00", "2022-01-02 12:00:00", "laboratory"),
    (4, 2, 8, 5, "2022-01-02 14:00:00", "2022-01-02 16:00:00", "laboratory"),
    (3, 2, 1, 6, "2022-01-03 08:00:00", "2022-01-03 10:00:00", "course"),
    (4, 2, 1, 1, "2022-01-03 10:00:00", "2022-01-03 12:00:00", "course")
    ';

$db->exec($insertUsers);
$db->exec($insertGroups);
$db->exec($insertMemberships);
$db->exec($insertMatters);
$db->exec($insertRooms);
$db->exec($insertEvents);
