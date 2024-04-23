<?php

namespace App\Entity;

final class Groups
{
    private $id;
    private $programme;
    private $number;
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProgramme(): string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): void
    {
        $this->programme = $programme;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function toJson(): object
    {
        return json_decode(json_encode([
            'id' => $this->id,
            'programme' => $this->programme,
            'number' => $this->number,
            'type' => $this->type,
        ]));
    }
}