<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $matter = $request->getParsedBody();

        if (!isset($matter['id'], $matter['title'], $matter['type'])) {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $matter = $this->getMatterService()->createMatter($matter);

        if ($matter->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Matter not created', 400);
        }

        return $this->jsonResponse($response, 'success', $matter->toJson(), 201);
    }
}