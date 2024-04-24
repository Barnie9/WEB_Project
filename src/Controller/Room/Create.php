<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Post(
 *     path="/rooms",
 *     tags={"rooms"},
 *     summary="Create a new room",
 *     description="Creates a new room.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Room data to create",
 *         @OA\JsonContent(ref="#/components/schemas/Room")
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
 *                 ref="#/components/schemas/Room"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid data",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Invalid data")
 *         )
 *     )
 * )
 */

final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();
        if(!isset($data['id']) || !isset($data['name'])) {
            return $this->jsonResponse($response, 'error', 'Invalid data', 400);
        }

        $room = $this->getRoomService()->createRoom($data);
        return $this->jsonResponse($response, 'success', $room->toJson(), 201);
    }
}
