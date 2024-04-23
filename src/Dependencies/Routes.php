<?php

use App\Controller\User;
use App\Controller\Matter;
use App\Controller\Event;

return static function($app)
{
    $app->group('/users', function () use ($app): void {
        $app->get('', User\GetAll::class);
        $app->get('/{id}', User\GetById::class);
        $app->post('', User\Create::class);
        $app->put('/{id}', User\Update::class);
        $app->delete('/{id}', User\Delete::class);
    });
    $app->group('/events', function () use ($app): void {
        $app->get('', Event\GetAll::class);
        $app->get('/{id}', Event\GetById::class);
        $app->post('', Event\Create::class);
        $app->put('/{id}', Event\Update::class);
        $app->delete('/{id}', Event\Delete::class);
    });
    $app->group('/matters', function () use ($app): void {
        $app->get('', Matter\GetAll::class);
        $app->get('/{id}', Matter\GetById::class);
        $app->post('', Matter\Create::class);
        $app->put('/{id}', Matter\Update::class);
        $app->delete('/{id}', Matter\Delete::class);
    });
    return $app;
};

