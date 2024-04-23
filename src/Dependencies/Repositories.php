<?php

use App\Repository\UserRepository;
use App\Repository\EventRepository;

$container['user_repository'] = function ($container): UserRepository {
    return new UserRepository($container->get('db'));
};

$container['event_repository'] = function ($container): EventRepository {
    return new EventRepository($container->get('db'));
};