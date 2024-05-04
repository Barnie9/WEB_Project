<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Post(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Create a new user",
 *     description="Creates a new user.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="User data",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="User created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/User")
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