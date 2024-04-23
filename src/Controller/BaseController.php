<?php

namespace App\Controller;

use Psr\Container\ContainerInterface as Container;
use Slim\Http\Response;

abstract class BaseController
{
    public function __construct(protected Container $container)
    {
    }

    public function getUserService()
    {
        return $this->container->get('user_service');
    }

    public function getEventService()
    {
        return $this->container->get('event_service');
    }

    protected function jsonResponse(
        Response $response,
        string $status,
        $message,
        int $code
    ): Response {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];

        return $response->withJson($result, $code, JSON_PRETTY_PRINT);
    }
}