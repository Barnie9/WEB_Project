<?php

use App\Repository\UserRepository;

$container['user_repository'] = function ($container): UserRepository {
    return new UserRepository($container->get('db'));
};