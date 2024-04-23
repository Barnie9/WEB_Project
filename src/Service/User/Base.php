<?php

namespace App\Service\User;

use App\Service\BaseService;

abstract class Base extends BaseService
{
    public function getUserRepository()
    {
        return $this->container->get('user_repository');
    }
}