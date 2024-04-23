<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getUserService()->deleteUser($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'User not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'User deleted', 204);
    }
}