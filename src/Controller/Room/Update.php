<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Put(
 *     path="/rooms/{id}",
 *     tags={"Rooms"},
 *     summary="Update a room by ID",
 *     description="Updates a room by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the room to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Room data to update",
 *         @OA\JsonContent(ref="#/components/schemas/Room")
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
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Room not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Room not found")
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

        if(!isset($data['name'])) {
            return $this->jsonResponse($response, 'error', 'Invalid data', 400);
        }



        $room = $this->getRoomService()->updateRoom($id, $data);

        if ($room === false) {
            return $this->jsonResponse($response, 'error', 'Room not found', 404);
        }

        return $this->jsonResponse($response, 'success', $room->toJson(), 200);
    }
}