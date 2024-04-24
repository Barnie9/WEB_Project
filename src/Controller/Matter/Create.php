<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Post(
 *     path="/matters",
 *     tags={"matters"},
 *     summary="Create a new matter",
 *     description="Creates a new matter.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Matter data to create",
 *         @OA\JsonContent(ref="#/components/schemas/Matter")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="status",
 *                 type="string",
 *                 example="success"
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/Matter"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Bad request")
 *         )
 *     )
 * )
 */


final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $matter = $request->getParsedBody();

        if (!isset($matter['id'], $matter['title'], $matter['type'])) {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $matter = $this->getMatterService()->createMatter($matter);

        if ($matter->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Matter not created', 400);
        }

        return $this->jsonResponse($response, 'success', $matter->toJson(), 201);
    }
}