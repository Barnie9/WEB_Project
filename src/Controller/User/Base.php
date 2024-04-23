<?php

namespace App\Controller\User;

use App\Controller\BaseController;

abstract class Base extends BaseController
{
    public function getUserService()
    {
        return $this->container->get('user_service');
    }
}