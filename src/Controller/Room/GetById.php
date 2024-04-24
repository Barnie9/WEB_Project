<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     path="/rooms/{id}",
 *     tags={"rooms"},
 *     summary="Retrieve a room by ID",
 *     description="Returns a room by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the room to retrieve",
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
 *                 ref="#/components/schemas/Room"
 *             )
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


final class GetById extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $room = $this->getRoomService()->getRoomById($id);
        
        if ($room->getId() === null){
            return $this->jsonResponse($response, 'error', 'Room not found', 404);
        }
            



        return $this->jsonResponse($response, 'success', $room->toJson(), 200);
    }
}