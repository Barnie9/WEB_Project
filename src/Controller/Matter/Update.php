<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $matter = $request->getParsedBody();


        $matter = $this->getMatterService()->updateMatter($id, $matter);

        if($matter->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Matter not found', 404);
        }

        return $this->jsonResponse($response,'success',$matter->toJson() ,200);
    }
}