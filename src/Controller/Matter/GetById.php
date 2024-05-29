<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use App\Entity\Matter;
use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Get(
 *     path="/matters/{id}",
 *     tags={"Matters"},
 *     summary="Retrieve a matter by ID",
 *     description="Retrieves a matter by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the matter to retrieve",
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
 *             type="object",
 *             @OA\Property(
 *                 property="status",
 *                 type="string",
 *                 example="success"
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/Matter"
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
final class GetById extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        if ($id === 0) {
            $matter = new Matter();
            return $this->jsonResponse($response, 'success', $matter->toJson(), 200);
        }

        $matter = $this->getMatterService()->getMatterById($id);

        if ($matter->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Matter not found', 404);
        }

        return $this->jsonResponse($response, 'success', $matter->toJson(), 200);
    }
}