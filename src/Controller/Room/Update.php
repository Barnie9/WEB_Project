<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        if(!isset($data['name'])) {
            return $this->jsonResponse($response, 'error', 'Invalid data', 400);
        }



        $room = $this->getRoomService()->updateRoom($id, $data);

        if ($room === false) {
            return $this->jsonResponse($response, 'error', 'Room not found', 404);
        }

        return $this->jsonResponse($response, 'success', $room->toJson(), 200);
    }
}