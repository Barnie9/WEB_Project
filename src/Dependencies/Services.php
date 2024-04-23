<?php

use App\Service\User\UserService;

$container['user_service'] = function ($container): UserService {
    return new UserService($container);
};