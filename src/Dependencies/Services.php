<?php

use App\Service\UserService;
use App\Service\GroupsService;
use App\Service\RoomService;use App\Service\MatterService;
use App\Service\EventService;

$container['user_service'] = function ($container): UserService {
    return new UserService($container);
};

$container['group_service'] = function ($container): GroupsService {
    return new GroupsService($container);
};

$container['room_service'] = function ($container): RoomService {
    return new RoomService($container);
};

$container['matter_service'] = function ($container): MatterService {
    return new MatterService($container);
};

$container['event_service'] = function ($container): EventService {
    return new EventService($container);
};