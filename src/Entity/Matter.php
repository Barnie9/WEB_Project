<?php

namespace App\Entity;

/**
 * @OA\Schema(
 *     schema="Matter",
 *     type="object",
 *     title="Matter",
 *     description="Matter entity schema",
 *     required={"id", "title", "type"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Unique identifier for the matter"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Title of the matter"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         description="Type of the matter"
 *     )
 * )
 */


final class Matter
{
    private $id;
    private $title;
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
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
            'title' => $this->title,
            'type' => $this->type,
        ]));
    }
}