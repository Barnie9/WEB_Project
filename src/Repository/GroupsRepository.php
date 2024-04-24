<?php

namespace App\Repository;

use App\Entity\Groups;

final class GroupsRepository extends BaseRepository
{
    public function getAllGroups(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM groups');
        $stmt->execute();
        $groups = $stmt->fetchAll();
        return $groups;
        
    }

    public function getGroupById($id): Groups
    {
        $stmt = $this->db->prepare('SELECT * FROM groups WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $group = $stmt->fetchObject(Groups::class);

        if (!$group) {
            return new Groups();
        }

        return $group;
    }

    public function createGroup($group): Groups
    {
        $stmt = $this->db->prepare('INSERT INTO groups VALUES (:programme, :number, :type)');
        $stmt->execute([
            'programme' => $group['programme'],
            'number' => $group['number'],
            'type' => $group['type']
        ]);

        return $this->getGroupById($this->db->lastInsertId());
    }

    public function updateGroup($group): Groups
    {
        $stmt = $this->db->prepare('UPDATE groups SET programme = :programme, number = :number, type = :type WHERE id = :id');
        $stmt->execute([
            'id' => $group['id'],
            'programme' => $group['programme'],
            'number' => $group['number'],
            'type' => $group['type']
        ]);

        return $this->getGroupById($group['id']);
    }

    public function deleteGroup(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM groups WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }


}
