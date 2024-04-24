<?php 


namespace App\Entity;
/**
 * @OA\Schema(
 *     schema="Room",
 *     type="object",
 *     title="Room",
 *     description="Room entity schema",
 *     required={"id", "name"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Unique identifier for the room"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the room"
 *     )
 * )
 */
final class Room{

    private $id;
    private $name;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toJson(): object
    {
        return json_decode(json_encode([
            'id' => $this->id,
            'name' => $this->name,
        ]));
    }
}
