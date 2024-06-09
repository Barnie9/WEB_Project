<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     path="/users/{id}/groups",
 *     tags={"Users"},
 *     summary="Get groups for a user by user ID",
 *     description="Retrieves groups associated with a user by the user's ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user to retrieve groups for",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Group")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="User not found")
 *         )
 *     )
 * )
 */

final class GetGroupsById extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $user = $this->getUserService()->getUserById($id);

        if ($user->getId() === null) {
            return $this->jsonResponse($response, 'error', 'User not found', 404);
        }

        $groups = $this->getUserService()->getUserGroups($id);

        return $this->jsonResponse($response, 'success', $groups, 200);
    }
}
