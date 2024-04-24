<?php

namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Get(
 *     path="/events",
 *     tags={"Events"},
 *     summary="List all events",
 *     description="Retrieves a list of all events.",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Event")
 *         )
 *     )
 * )
 */
final class GetAll extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $events = $this->getEventService()->getAllEvents();

        return $this->jsonResponse($response, 'success', $events, 200);
    }
}