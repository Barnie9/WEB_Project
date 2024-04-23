<?php

use App\Repository\UserRepository;
use App\Repository\MatterRepository;

$container['user_repository'] = function ($container): UserRepository {
    return new UserRepository($container->get('db'));
};

$container['matter_repository'] = function ($container): MatterRepository {
    return new MatterRepository($container->get('db'));
};