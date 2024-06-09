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

    public function getUserById(int $id): User
    {
        $query = 'SELECT * FROM users WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        $user = $statement->fetchObject(User::class);
        if (!$user) {
            return new User();
        }
        return $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->execute(['email' => $email]);
        $user = $statement->fetchObject(User::class);
        if (!$user) {
            return null;
        }
        return $user;
    }

    public function createUser($user): User
    {
        $query = 'INSERT INTO users VALUES (:id, :email, :password, :first_name, :last_name, :type)';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => null,
            'email' => $user['email'],
            'password' => $user['password'],
            'first_name' => $user['firstName'],
            'last_name' => $user['lastName'],
            'type' => $user['type']
        ]);
        return $this->getUserById($this->db->lastInsertId());
    }

    public function updateUser($user): User
    {
        $query = 'UPDATE users SET password = :password, first_name = :first_name, last_name = :last_name, type = :type WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => $user['id'],
            'password' => $user['password'],
            'first_name' => $user['firstName'],
            'last_name' => $user['lastName'],
            'type' => $user['type']
        ]);
        return $this->getUserById($user['id']);
    }

    public function deleteUser(int $id): bool
    {
        try {
            // Begin transaction
            $this->db->beginTransaction();
    
            // Delete memberships related to the user
            $query = 'DELETE FROM memberships WHERE user_id = :id';
            $statement = $this->db->prepare($query);
            $statement->execute(['id' => $id]);
    
            // Delete events related to the user (as teacher)
            $query = 'DELETE FROM events WHERE teacher_id = :id';
            $statement = $this->db->prepare($query);
            $statement->execute(['id' => $id]);
    
            // Delete the user
            $query = 'DELETE FROM users WHERE id = :id';
            $statement = $this->db->prepare($query);
            $statement->execute(['id' => $id]);
    
            // Commit transaction
            $this->db->commit();
    
            // Check if the user is really deleted
            $user = $this->getUserById($id);
            return $user->getId() === null;
        } catch (PDOException $e) {
            // Rollback transaction in case of an error
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e; // Rethrow the exception to be handled elsewhere
        }
    
    }
}