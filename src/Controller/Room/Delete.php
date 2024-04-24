<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Delete(
 *     path="/rooms/{id}",
 *     tags={"Rooms"},
 *     summary="Delete a room by ID",
 *     description="Deletes a room by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the room to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Room deleted successfully"
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
final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $room = $this->getRoomService()->deleteRoom($id);

        if ($room === false) {
            return $this->jsonResponse($response, 'error', 'Room not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Room deleted', 204);
    }
}