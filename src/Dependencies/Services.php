<?php

use App\Service\UserService;
use App\Service\GroupsService;
use App\Service\RoomService;
$container['user_service'] = function ($container): UserService {
    return new UserService($container);
};

$container['group_service'] = function ($container): GroupsService {
    return new GroupsService($container);
};

$container['room_service'] = function ($container): RoomService {
    return new RoomService($container);
};