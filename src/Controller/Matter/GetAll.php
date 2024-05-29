<?php

namespace App\Controller\Matter;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     tags={"Matters"},
 *     path="/matters",
 *     summary="List all matters or filter by matter ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="ID of the matter to retrieve",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="A list of matters",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Matter")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="A matter with the specified criteria was not found"
 *     )
 * )
 */
final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $matters = $this->getMatterService()->getAllMatters();

        return $this->jsonResponse($response, 'success', $matters, 200);
    }
}