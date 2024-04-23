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

    public function getGroupById(int $id): Groups
    {
        $stmt = $this->db->prepare('SELECT * FROM groups WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $group = $stmt->fetchObject(Groups::class);

        if (!$group) {
            return new Groups();
        }

        $groupEntity = new Groups();
        $groupEntity->setId($group['id']);
        $groupEntity->setProgramme($group['programme']);
        $groupEntity->setNumber($group['number']);
        $groupEntity->setType($group['type']);

        return $groupEntity;
    }

    public function createGroup($group): Groups
    {
        $stmt = $this->db->prepare('INSERT INTO groups VALUES (:id, :programme, :number, :type)');
        $stmt->execute([
            'id' => null,
            'programme' => $group['programme'],
            'number' => $group['number'],
            'type' => $group['type']
        ]);

        return $this->getGroupById((int)$this->db->lastInsertId());
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
