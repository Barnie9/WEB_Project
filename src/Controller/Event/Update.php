<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Put(
 *     path="/events/{id}",
 *     tags={"Events"},
 *     summary="Update an event by ID",
 *     description="Updates an event by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the event to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Updated event data",
 *         @OA\JsonContent(ref="#/components/schemas/Event")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Event")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Event not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Event not found")
 *         )
 *     )
 * )
 */

final class Update extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $event = $request->getParsedBody();

        $event = $this->getEventService()->updateEvent($id, $event);

        if ($event === null) {
            return $this->jsonResponse($response, 'error', 'Event not found', 404);
        }

        return $this->jsonResponse($response, 'success', $event, 200);
    }
}