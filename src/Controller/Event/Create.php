<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Post(
 *     path="/events",
 *     tags={"Events"},
 *     summary="Create a new event",
 *     description="Creates a new event.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Event data to create",
 *         @OA\JsonContent(ref="#/components/schemas/Event")
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
 *                 ref="#/components/schemas/Event"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Bad request")
 *         )
 *     )
 * )
 */


final class Create extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $event = $request->getParsedBody();

        if (!isset($event['matterId'], $event['teacherId'], $event['groupId'], $event['roomId'],  $event['startTime'], $event['endTime'], $event['type']))
        {
            return $this->jsonResponse($response, 'error', 'Bad request', 400);
        }

        $event = $this->getEventService()->createEvent($event);

        if ($event === null)
        {
            return $this->jsonResponse($response, 'error', 'Event not created', 400);
        }

        return $this->jsonResponse($response, 'success', $event, 201);
    }
}