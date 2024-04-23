<?php

$container['db'] = function (): PDO {
    $host = 'localhost'; // Host address
    $dbname = 'web_project'; // Database name
    $user = 'root'; // Database username
    $pass = ''; // Database password

    // DSN (Data Source Name)
    $dsn = "mysql:host=$host;dbname=$dbname";

    try {
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    } catch (\PDOException $e) {
        echo $e->getMessage();
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
};
