<?php

namespace App\Controller\Groups;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     path="/groups",
 *     tags={"Groups"},
 *     summary="Retrieve all groups",
 *     description="Retrieves all groups.",
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
 *         description="Groups not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Groups not found")
 *         )
 *     )
 * )
 */

final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $groups = $this->getGroupsService()->getAllGroups();

        if (empty($groups)) {
            return $this->jsonResponse($response, 'error', 'Groups not found', 404);
        }

        return $this->jsonResponse($response, 'success', $groups, 200);


    }

}