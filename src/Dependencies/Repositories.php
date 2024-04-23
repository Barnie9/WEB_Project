<?php

use App\Repository\UserRepository;
use App\Repository\GroupsRepository;
use App\Repository\RoomRepository;

$container['user_repository'] = function ($container): UserRepository {
    return new UserRepository($container->get('db'));
};

$container['group_repository'] = function ($container): GroupsRepository {
    return new GroupsRepository($container->get('db'));
};

$container['room_repository'] = function ($container): RoomRepository {
    return new RoomRepository($container->get('db'));
};
