<?php

use App\Service\UserService;
use App\Service\MatterService;

$container['user_service'] = function ($container): UserService {
    return new UserService($container);
};

$container['matter_service'] = function ($container): MatterService {
    return new MatterService($container);
};