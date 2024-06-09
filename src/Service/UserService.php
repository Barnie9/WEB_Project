<?php

namespace App\Service;

use App\Entity\User;
use App\Service\BaseService;

final class UserService extends BaseService
{
    public function login($email, $password): ?User
    {
        $user = $this->getUserRepository()->getUserByEmail($email);

        if ($user === null) {
            return null;
        }

        // if (!password_verify($password, $user->getPassword())) {
        //     return null;
        // }

        if ($password !== $user->getPassword()) {
            return null;
        }

        return $user;
    }

    public function getAllUsers(): array
    {
        return $this->getUserRepository()->getAllUsers();
    }

    public function getUserById(int $id): User
    {
        return $this->getUserRepository()->getUserById($id);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->getUserRepository()->getUserByEmail($email);
    }

    public function createUser($user): ?User
    {
        $existingUser = $this->getUserRepository()->getUserByEmail($user['email']);

        if ($existingUser !== null) {
            return null;
        }

        return $this->getUserRepository()->createUser($user);
    }

    public function updateUser(int $id, $user): ?User
    {
        if ($id !== $user['id']) {
            return new User();
        }

        $existingUser = $this->getUserRepository()->getUserById($user['id']);

        if ($existingUser === null) {
            return null;
        }

        $user['password'] = isset($user['password']) ? $user['password'] : $existingUser->getPassword();
        $user['firstName'] = isset($user['firstName']) ? $user['firstName'] : $existingUser->getFirstName();
        $user['lastName'] = isset($user['lastName']) ? $user['lastName'] : $existingUser->getLastName();
        $user['type'] = isset($user['type']) ? $user['type'] : $existingUser->getType();

        return $this->getUserRepository()->updateUser($user);
    }

    public function deleteUser(int $id): bool
    {
        $existingUser = $this->getUserRepository()->getUserById($id);

        if ($existingUser === null) {
            return false;
        }

        return $this->getUserRepository()->deleteUser($id);
    }

    public function getUserGroups(int $userId): array
    {
        return $this->getUserRepository()->getUserGroups($userId);
    }
}