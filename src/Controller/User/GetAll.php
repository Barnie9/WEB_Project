<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     tags={"Users"},
 *     path="/users",
 *     summary="List all users or filter by email address",
 *     parameters={
 *         @OA\Parameter(ref="#/components/parameters/emailQuery")
 *     }
 *     @OA\Response(
 *         response=200,
 *         description="A list of users",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/User")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="An user with the specified criteria was not found"
 *     )
 * )
 */
final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $queryParams = $request->getQueryParams();

        $email = $queryParams['email'] ?? null;

        if (isset($email)) {
            $user = $this->getUserService()->getUserByEmail($email);

            if ($user === null) {
                return $this->jsonResponse($response, 'error', 'User not found', 404);
            }

            return $this->jsonResponse($response, 'success', $user->toJson(), 200);
        }

        $users = $this->getUserService()->getAllUsers();

        return $this->jsonResponse($response, 'success', $users, 200);
    }
}