<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Delete(
 *     path="/events/{id}",
 *     tags={"Events"},
 *     summary="Delete an event by ID",
 *     description="Deletes an event by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the event to delete",
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
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Event deleted")
 *         )
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

final class Delete extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');

        $deleted = $this->getEventService()->deleteEvent($id);

        if ($deleted === false) {
            return $this->jsonResponse($response, 'error', 'Event not found', 404);
        }

        return $this->jsonResponse($response, 'success', 'Event deleted', 204);
    }
}