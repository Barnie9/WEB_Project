<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Put(
 *     path="/matters/{id}",
 *     tags={"Matters"},
 *     summary="Update a matter by ID",
 *     description="Updates a matter by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the matter to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Matter data to update",
 *         @OA\JsonContent(ref="#/components/schemas/Matter")
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


final class Update extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $matter = $request->getParsedBody();


        $matter = $this->getMatterService()->updateMatter($id, $matter);

        if($matter->getId() === null) {
            return $this->jsonResponse($response, 'error', 'Matter not found', 404);
        }

        return $this->jsonResponse($response,'success',$matter->toJson() ,200);
    }
}