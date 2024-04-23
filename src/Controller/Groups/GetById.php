<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;


final class GetById extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $group = $this->getGroupsService()->getGroupById($id);

        if ($group->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Group not found', 404);
        }

        return $this->jsonResponse($response, 'success', $group->toJson(), 200);
    }
}