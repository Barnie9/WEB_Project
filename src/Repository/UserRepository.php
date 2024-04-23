<?php

namespace App\Repository;

use App\Entity\User;

final class UserRepository extends BaseRepository
{
    public function getAllUsers(): array
    {
        $query = 'SELECT * FROM users';
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUserById(int $id): ?User
    {
        $query = 'SELECT * FROM users WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        $user = $statement->fetchObject(User::class);
        return $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->execute(['email' => $email]);
        $user = $statement->fetchObject(User::class);
        return $user;
    }

    public function createUser($user): User
    {
        $query = 'INSERT INTO users VALUES (:id, :email, :password, :firstName, :lastName, :type)';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => null,
            'email' => $user['email'],
            'password' => $user['password'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'type' => $user['type']
        ]);
        return $this->getUserById($this->db->lastInsertId());
    }

    public function updateUser($user): User
    {
        $query = 'UPDATE users SET password = :password, firstName = :firstName, lastName = :lastName, type = :type WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => $user['id'],
            'password' => $user['password'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'type' => $user['type']
        ]);
        return $this->getUserById($user['id']);
    }

    public function deleteUser(int $id): bool
    {
        $query = 'DELETE FROM users WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        $user = $this->getUserById($id);
        return $user->getId() === null;
    }
}