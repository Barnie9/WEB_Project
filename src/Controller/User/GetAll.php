<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Retrieve one user by email or all users",
 *     description="Returns a single user if email is provided or all users if no email is provided.",
 *     @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="The email of the user to retrieve",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             format="email"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     type="array",
 *                     description="List of all users",
 *                     @OA\Items(ref="#/components/schemas/User")
 *                 ),
 *                 @OA\Schema(
 *                     type="object",
 *                     description="Single user",
 *                     ref="#/components/schemas/User"
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="code", type="integer", example="404"),
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="User not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
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