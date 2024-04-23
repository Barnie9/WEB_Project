<?php

use App\Repository\UserRepository;
use App\Repository\MatterRepository;
use App\Repository\EventRepository;

$container['user_repository'] = function ($container): UserRepository {
    return new UserRepository($container->get('db'));
};

$container['matter_repository'] = function ($container): MatterRepository {
    return new MatterRepository($container->get('db'));
};

$container['event_repository'] = function ($container): EventRepository {
    return new EventRepository($container->get('db'));
};