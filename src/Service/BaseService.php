<?php

namespace App\Service;

use Psr\Container\ContainerInterface as Container;

abstract class BaseService
{
    public function __construct(protected Container $container)
    {
    }
}