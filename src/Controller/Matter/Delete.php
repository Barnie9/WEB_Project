<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Delete(
 *     path="/matters/{id}",
 *     tags={"Matters"},
 *     summary="Delete a matter by ID",
 *     description="Deletes a matter by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the matter to delete",
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
 *                 example="Matter deleted"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Matter not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Matter not found")
 *         )
 *     )
 * )
 */


final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getMatterService()->deleteMatter($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'Matter not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Matter deleted', 204);
    }
}