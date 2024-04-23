<?php

namespace App\Controller;

use Psr\Container\ContainerInterface as Container;
use Slim\Http\Response;

/**
 * @OA\Server(url="http://localhost/web_project/src/")
 * @OA\Info(
 *     title="Calendar App",
 *     version="1.0.3",
 *     description="This API is designed to facilitate the management of a comprehensive calendar application, encompassing a broad range of functionalities including user management, event scheduling, course allocation, group coordination, department organization, and timetable structuring. It aims to provide an integrated platform for educational institutions to efficiently organize and access academic and administrative information."
 * )
 */
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