<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetById extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $matter = $this->getMatterService()->getMatterById($id);

        if ($matter->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Matter not found', 404);
        }

        return $this->jsonResponse($response, 'success', $matter->toJson(), 200);
    }
}