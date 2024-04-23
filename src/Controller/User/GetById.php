<?php

namespace App\Controller\User;

use App\Controller\User\Base;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetById extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $user = $this->getUserService()->getUserById($id);

        if ($user->getId() === null) {
            return $this->jsonResponse($response, 'error', 'User not found', 404);
        }

        return $this->jsonResponse($response, 'success', $user->toJson(), 200);
    }
}