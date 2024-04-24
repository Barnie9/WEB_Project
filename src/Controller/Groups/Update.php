<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Put(
 *     path="/groups/{id}",
 *     tags={"Groups"},
 *     summary="Update a group by ID",
 *     description="Updates a group by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the group to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Group data to update",
 *         @OA\JsonContent(ref="#/components/schemas/Group")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Group")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Invalid data")
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

final class Update extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        $group = $this->getGroupsService()->updateGroup($id, $data);

        if ($group->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Group not found', 404);
        }

        return $this->jsonResponse($response, 'success', $group->toJson(), 200);
    }
}