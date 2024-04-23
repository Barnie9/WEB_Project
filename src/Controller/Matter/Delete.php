<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getMatterService()->deleteMatter($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'Matter not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Matter deleted', 204);
    }
}