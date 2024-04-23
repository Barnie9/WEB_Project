<?php

use App\Controller\User;
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

    return $app;
};