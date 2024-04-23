<?php

use App\Service\UserService;

$container['user_service'] = function ($container): UserService {
    return new UserService($container);
};