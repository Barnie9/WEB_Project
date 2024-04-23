<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getEventService()->deleteEvent($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'Event not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Event deleted', 204);
    }
}