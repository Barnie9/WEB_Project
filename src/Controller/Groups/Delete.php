<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Delete(
 *     path="/groups/{id}",
 *     tags={"Groups"},
 *     summary="Delete a group by ID",
 *     description="Deletes a group by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the group to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="status",
 *                 type="string",
 *                 example="success"
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Group deleted"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Group not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Group not found")
 *         )
 *     )
 * )
 */


final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getGroupsService()->deleteGroup($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'Group not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Group deleted', 204);
    }
}