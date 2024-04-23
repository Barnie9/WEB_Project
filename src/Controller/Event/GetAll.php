<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $events = $this->getEventService()->getAllEvents();

        return $this->jsonResponse($response, 'success', $events, 200);
    }
}