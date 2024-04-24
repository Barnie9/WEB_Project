<?php

namespace App\Entity;

/**
 * @OA\Schema(
 *     schema="Event",
 *     type="object",
 *     title="Event",
 *     description="Event entity schema",
 *     required={"id", "matterId", "teacherId", "groupId", "roomId", "startTime", "endTime", "type"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Unique identifier for the event"
 *     ),
 *     @OA\Property(
 *         property="matterId",
 *         type="integer",
 *         description="Identifier for the matter associated with the event"
 *     ),
 *     @OA\Property(
 *         property="teacherId",
 *         type="integer",
 *         description="Identifier for the teacher associated with the event"
 *     ),
 *     @OA\Property(
 *         property="groupId",
 *         type="integer",
 *         description="Identifier for the group associated with the event"
 *     ),
 *     @OA\Property(
 *         property="roomId",
 *         type="integer",
 *         description="Identifier for the room associated with the event"
 *     ),
 *     @OA\Property(
 *         property="startTime",
 *         type="string",
 *         format="date-time",
 *         description="Start time of the event (in ISO 8601 format)"
 *     ),
 *     @OA\Property(
 *         property="endTime",
 *         type="string",
 *         format="date-time",
 *         description="End time of the event (in ISO 8601 format)"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         enum={"course", "seminary", "laboratory"},
 *         description="Type of the event"
 *     )
 * )
 */

final class Event
{
    private $id;
    private $matterId;
    private $teacherId;
    private $groupId;
    private $roomId;
    private $startTime;
    private $endTime;
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMatterId(): int
    {
        return $this->matterId;
    }

    public function getTeacherId(): int
    {
        return $this->teacherId;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function getroomId(): int
    {
        return $this->roomId;
    }

    public function getStartTime(): \DateTime
    {
        return new \DateTime($this->startTime);
    }

    public function getEndTime(): \DateTime
    {
        return new \DateTime($this->endTime);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function toJson(): object
    {
        return json_decode(json_encode([
            'id' => $this->id,
            'matterId' => $this->matterId,
            'teacherId' => $this->teacherId,
            'groupId' => $this->groupId,
            'roomId' => $this->roomId,
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            'type' => $this->type,
        ]));
    }
}