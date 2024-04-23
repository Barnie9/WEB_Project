<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetById extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $event = $this->getEventService()->getEventById($id);

        if ($event === null) {
            return $this->jsonResponse($response, 'error', 'Event not found', 404);
        }

        return $this->jsonResponse($response, 'success', $event->toJson(), 200);
    }
}