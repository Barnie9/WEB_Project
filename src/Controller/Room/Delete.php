<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $room = $this->getRoomService()->deleteRoom($id);

        if ($room === false) {
            return $this->jsonResponse($response, 'error', 'Room not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Room deleted', 204);
    }
}