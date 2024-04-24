<?php

namespace App\Repository;

use App\Entity\Room;

class RoomRepository extends BaseRepository
{
  

    public function getAllRooms(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM rooms');
        $stmt->execute();
        $rooms = $stmt->fetchAll();
        return $rooms;
    }

    public function getRoomById(int $id): Room
    {
        $stmt = $this->db->prepare('SELECT * FROM rooms WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $room = $stmt->fetchObject(Room::class);

        if (!$room) {
            return new Room();
        }
        return $room ;
    }

    public function createRoom($room): Room
    {
        $stmt = $this->db->prepare('INSERT INTO rooms VALUES (:id, :name)');
        $stmt->execute([
            'id' => null,
            'name' => $room['name']
        ]);

        return $this->getRoomById($this->db->lastInsertId());
        
    }

    public function updateRoom($room): Room
    {
        $stmt = $this->db->prepare('UPDATE rooms SET name = :name WHERE id = :id');
        $stmt->execute([
            'id' => $room['id'],
            'name' => $room['name']
        ]);

        return $this->getRoomById($room['id']);
    }

    public function deleteRoom(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM rooms WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return true;
    }
   
}