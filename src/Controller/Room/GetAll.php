<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $rooms = $this->getRoomService()->getAllRooms();

        if (empty($rooms)) {
            return $this->jsonResponse($response, 'error', 'Rooms not found', 404);
        }


        return $this->jsonResponse($response, 'success', $rooms, 200);
    }
}