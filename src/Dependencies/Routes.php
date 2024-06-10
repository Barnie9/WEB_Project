<?php

use App\Controller\User;
use App\Controller\Groups;
use App\Controller\Room;
use App\Controller\Matter;
use App\Controller\Event;


return static function($app)
{
    $app->post('/login', User\Login::class);

    $app->group('/users', function () use ($app): void {
        $app->get('', User\GetAll::class);
        $app->get('/{id}', User\GetById::class);
        $app->post('', User\Create::class);
        $app->put('/{id}', User\Update::class);
        $app->delete('/{id}', User\Delete::class);
        $app->get('/{id}/groups', User\GetGroupsById::class);
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

    $app->group('/events', function () use ($app): void {
        $app->get('', Event\GetAll::class);
        $app->get('/{id}', Event\GetById::class);
        $app->post('', Event\Create::class);
        $app->post('/filtered', Event\GetByIdFiltered::class);
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

    // $app->post('/filtered', Event\GetByIdFiltered::class);

    return $app;
};

