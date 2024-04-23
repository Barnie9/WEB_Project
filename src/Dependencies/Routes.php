<?php

use App\Controller\User;

return static function($app)
{
    $app->group('/users', function () use ($app): void {
        $app->get('', User\GetAll::class);
        $app->get('/{id}', User\GetById::class);
        $app->post('', User\Create::class);
        $app->put('/{id}', User\Update::class);
        $app->delete('/{id}', User\Delete::class);
    });

    return $app;
};