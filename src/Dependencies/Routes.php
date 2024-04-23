<?php

use App\Controller\User;
use App\Controller\Groups;
use App\Controller\Room;
return static function($app)
{
    $app->group('/users', function () use ($app): void {
        $app->get('', User\GetAll::class);
        $app->get('/{id}', User\GetById::class);
        $app->post('', User\Create::class);
        $app->put('/{id}', User\Update::class);
        $app->delete('/{id}', User\Delete::class);
    });

    $app->group('/groups', function () use ($app): void {
        $app->get('', Groups\GetAll::class);
        $app->get('/{id}', Groups\GetById::class);
        $app->post('', Groups\Create::class);
        $app->put('/{id}', Groups\Update::class);
        $app->delete('/{id}', Groups\Delete::class);
    });

    $app->group('/rooms', function () use ($app): void {
        $app->get('', Room\GetAll::class);
        $app->get('/{id}', Room\GetById::class);
        $app->post('', Room\Create::class);
        $app->put('/{id}', Room\Update::class);
        $app->delete('/{id}', Room\Delete::class);
    });


    return $app;
};