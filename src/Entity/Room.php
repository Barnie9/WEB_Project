<?php 


namespace App\Entity;

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
