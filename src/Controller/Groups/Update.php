<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;


final class Update extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        if(!isset($data['name']) || !isset($data['type'])) {
            return $this->jsonResponse($response, 'error', 'Invalid data', 400);
        }

        $group = $this->getGroupsService()->updateGroup($id, $data);

        if ($group->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Group not found', 404);
        }

        return $this->jsonResponse($response, 'success', $group->toJson(), 200);
    }
}