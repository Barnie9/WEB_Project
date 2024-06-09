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
        try {
            // Begin transaction
            $this->db->beginTransaction();
    
            // Delete memberships related to the group
            $query = 'DELETE FROM memberships WHERE group_id = :id';
            $statement = $this->db->prepare($query);
            $statement->execute(['id' => $id]);
    
            // Delete the group
            $query = 'DELETE FROM groups WHERE id = :id';
            $statement = $this->db->prepare($query);
            $statement->execute(['id' => $id]);
    
            // Commit transaction
            $this->db->commit();
    
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            // Rollback transaction in case of an error
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e; // Rethrow the exception to be handled elsewhere
        }
    }


}
