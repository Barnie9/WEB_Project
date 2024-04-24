<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Post(
 *     path="/groups",
 *     tags={"Groups"},
 *     summary="Create a new group",
 *     description="Creates a new group.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Group data to create",
 *         @OA\JsonContent(ref="#/components/schemas/Group")
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
 *                 ref="#/components/schemas/Group"
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
        $group = $request->getParsedBody();

        if (!isset($group['programme'], $group['number'], $group['type'])) {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $group = $this->getGroupsService()->createGroup($group);

        if ($group->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Group not created', 400);
        }

        return $this->jsonResponse($response, 'success', $group->toJson(), 201);
    }
}