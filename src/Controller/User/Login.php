<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Login extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        if (empty($body['email']) || empty($body['password'])) {
            return $this->jsonResponse($response, 'error', 'Email and password are required', 400);
        }

        $user = $this->getUserService()->login($body['email'], $body['password']);

        if ($user === null) {
            return $this->jsonResponse($response, 'error', 'Invalid credentials', 400);
        }

        return $this->jsonResponse($response, 'success', $user->toJson(), 201);
    }
}