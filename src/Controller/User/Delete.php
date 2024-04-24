<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Delete a user by ID",
 *     description="Deletes a user by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="User deleted successfully"
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

final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getUserService()->deleteUser($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'User not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'User deleted', 204);
    }
}