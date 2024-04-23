<?php

namespace App\Service;

use Psr\Container\ContainerInterface as Container;

abstract class BaseService
{
    public function __construct(protected Container $container)
    {
    }

    public function getUserRepository()
    {
        return $this->container->get('user_repository');
    }

    public function getEventRepository()
    {
        return $this->container->get('event_repository');
    }
}