<?php

namespace App\Controller\Room;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     path="/rooms",
 *     tags={"rooms"},
 *     summary="Retrieve all rooms",
 *     description="Returns all rooms available.",
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
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/Room")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Rooms not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Rooms not found")
 *         )
 *     )
 * )
 */


final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $rooms = $this->getRoomService()->getAllRooms();

        if (empty($rooms)) {
            return $this->jsonResponse($response, 'error', 'Rooms not found', 404);
        }


        return $this->jsonResponse($response, 'success', $rooms, 200);
    }
}