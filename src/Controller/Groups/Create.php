<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $group = $request->getParsedBody();

        if (!isset($group['programme'], $group['number'], $group['type'])) {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $group = $this->getGroupsService()->createGroup($group);

        if ($group->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Group not created', 400);
        }

        return $this->jsonResponse($response, 'success', $group->toJson(), 201);
    }
}