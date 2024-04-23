<?php

use App\Service\UserService;
use App\Service\EventService;

$container['user_service'] = function ($container): UserService {
    return new UserService($container);
};

$container['event_service'] = function ($container): EventService {
    return new EventService($container);
};