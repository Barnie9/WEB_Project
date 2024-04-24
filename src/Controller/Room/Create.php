<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();
        if(!isset($data['name'])) {
            return $this->jsonResponse($response, 'error', 'Invalid data', 400);
        }

        $room = $this->getRoomService()->createRoom($data);
        return $this->jsonResponse($response, 'success', $room->toJson(), 201);
    }
}
