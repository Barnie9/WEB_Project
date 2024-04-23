<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $event = $request->getParsedBody();

        if (!isset($event['matterId'], $event['teacherId'], $event['groupId'], $event['roomId'], $event['startDate'], $event['startTime'], $event['endTime'], $event['type']))
        {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $event = $this->getEventService()->createEvent($event);

        if ($event === null)
        {
            return $this->jsonResponse($response, 'error', 'Event not created', 400);
        }

        return $this->jsonResponse($response, 'success', $event, 201);
    }
}