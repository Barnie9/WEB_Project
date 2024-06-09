<?php
namespace App\Controller\Event;

use App\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Post(
 *     path="/events/filter",
 *     tags={"Events"},
 *     summary="Get events with filters",
 *     description="Retrieves events based on a list of group IDs and a date range.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="groupIds",
 *                 type="array",
 *                 @OA\Items(type="integer")
 *             ),
 *             @OA\Property(
 *                 property="startDate",
 *                 type="string",
 *                 format="date-time"
 *             ),
 *             @OA\Property(
 *                 property="endDate",
 *                 type="string",
 *                 format="date-time"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Event"))
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Invalid input")
 *         )
 *     )
 * )
 */

final class GetByIdFiltered extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        $groupIds = $body['groupIds'] ?? [];
        $startDate = $body['startDate'] ?? '';
        $endDate = $body['endDate'] ?? '';

        if (empty($groupIds) || empty($startDate) || empty($endDate)) {
            return $this->jsonResponse($response, 'error', 'Invalid input', 400);
        }

        $events = $this->getEventService()->getFilteredEvents($groupIds, $startDate, $endDate);

        if (empty($events)) {
            return $this->jsonResponse($response, 'error', 'No events found', 404);
        }

        return $this->jsonResponse($response, 'success', $events, 200);
    }
}
