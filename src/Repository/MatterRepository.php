<?php

namespace App\Repository;

use App\Entity\Matter;

final class MatterRepository extends BaseRepository
{
    public function getAllMatters(): array
    {
        $query = 'SELECT * FROM matters';
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getMatterByTitle(string $title): Matter
    {
        $query = 'SELECT * FROM matters WHERE title = :title';
        $statement = $this->db->prepare($query);
        $statement->execute(['title' => $title]);
        $matter = $statement->fetchObject(Matter::class);
        if (!$matter) {
            return new Matter();
        }
        return $matter;
    }

    public function getMatterById(int $id): Matter
    {
        $query = 'SELECT * FROM matters WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        $matter = $statement->fetchObject(Matter::class);
        if (!$matter) {
            return new Matter();
        }
        return $matter;
    }

    public function createMatter($matter): Matter
    {
        $query = 'INSERT INTO matters VALUES (:id, :title, :type)';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => null,
            'title' => $matter['title'],
            'type' => $matter['type']
        ]);
        return $this->getMatterByTitle($matter['title']);
    }

    public function updateMatter($matter): Matter
    {
        $query = 'UPDATE matters SET title = :title, type = :type WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => $matter['id'],
            'title' => $matter['title'],
            'type' => $matter['type']
        ]);
        return $this->getMatterById($matter['id']);
    }

    public function deleteMatter(int $id): bool
    {
        $query = 'DELETE FROM matters WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        $matter = $this->getMatterById($id);
        return $matter->getId() === null;
    }
}