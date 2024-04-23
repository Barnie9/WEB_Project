<?php

namespace App\Entity;

final class Event
{
    private $id;
    private $matterId;
    private $teacherId;
    private $groupId;
    private $roomId;
    private $startDate;
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

    public function getStartDate(): \DateTime
    {
        return new \DateTime($this->startDate);
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
            'startDate' => $this->startDate,
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            'type' => $this->type,
        ]));
    }
}