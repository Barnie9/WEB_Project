<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $user = $request->getParsedBody();

        if (!isset($user['email'], $user['password'], $user['firstName'], $user['lastName'], $user['type'])) {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $user = $this->getUserService()->createUser($user);

        if ($user === null) {
            return $this->jsonResponse($response, 'error', 'User not created', 400);
        }

        return $this->jsonResponse($response, 'success', $user->toJson(), 201);
    }
}