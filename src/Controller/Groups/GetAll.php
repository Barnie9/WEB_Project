<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $groups = $this->getGroupsService()->getAllGroups();

        if (empty($groups)) {
            return $this->jsonResponse($response, 'error', 'Groups not found', 404);
        }

        return $this->jsonResponse($response, 'success', $groups, 200);


    }

}