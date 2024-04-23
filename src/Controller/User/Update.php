<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $user = $request->getParsedBody();

        if (isset($user['email'])) {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $user = $this->getUserService()->updateUser($id, $user);

        if ($user->getId() === null) {
            return $this->jsonResponse($response, 'error', 'User not found', 404);
        }

        return $this->jsonResponse($response, 'success', $user->toJson(), 200);
    }
}