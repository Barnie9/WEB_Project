<?php

namespace App\Entity;

final class User
{
    private $id;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function toJson(): object
    {
        return json_decode(json_encode([
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'type' => $this->type,
        ]));
    }
}