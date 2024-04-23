<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getGroupsService()->deleteGroup($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'Group not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Group deleted', 204);
    }
}