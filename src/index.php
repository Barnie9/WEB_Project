<?php

require '../vendor/autoload.php';

$app = new \Slim\App(
    [
        'settings' => [
            'displayErrorDetails' => true
        ]
    ]
);

$container = $app->getContainer();

require_once 'Dependencies/Database.php';
require_once 'Dependencies/Repositories.php';
require_once 'Dependencies/Services.php';
(require_once 'Dependencies/Routes.php')($app);

$app->run();