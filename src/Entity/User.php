<?php

namespace App\Entity;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User entity schema",
 *     required={"id", "email", "firstName", "lastName", "type"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Unique identifier for the user"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="User email address"
 *     ),
 *     @OA\Property(
 *         property="firstName",
 *         type="string",
 *         description="User's first name"
 *     ),
 *     @OA\Property(
 *         property="lastName",
 *         type="string",
 *         description="User's last name"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         enum={"student", "teacher", "admin"},
 *         description="The type of user"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="User password, not generally returned in responses for security reasons",
 *         example="examplePassword123!",
 *         writeOnly=true
 *     )
 * )
 */
final class User
{
    private $id;
    private $email;
    private $password;
    private $first_name;
    private $last_name;
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
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
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
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'type' => $this->type,
        ]));
    }
}