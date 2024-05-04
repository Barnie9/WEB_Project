<?php

require '../vendor/autoload.php';

$app = new \Slim\App(
    [
        'settings' => [
            'displayErrorDetails' => true
        ]
    ]
);

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$container = $app->getContainer();

require_once 'Dependencies/Database.php';
require_once 'Dependencies/Repositories.php';
require_once 'Dependencies/Services.php';
(require_once 'Dependencies/Routes.php')($app);

// require_once 'Seed/Seed.php';

$app->run();