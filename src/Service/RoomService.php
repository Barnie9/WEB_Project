<?php

namespace App\Service;

use App\Entity\Room;
use App\Service\BaseService;

final class RoomService extends BaseService
{
    public function getAllRooms(): array
    {
        return $this->getRoomRepository()->getAllRooms();
    }

    public function getRoomById(int $id): Room
    {
        return $this->getRoomRepository()->getRoomById($id);
    }



    public function createRoom($room): Room
    {
        $existingRoom = $this->getRoomRepository()->getRoomById($room['id']);

        if ($existingRoom->getId() !== null) {
            return new Room();
        }

        return $this->getRoomRepository()->createRoom($room);
    }

    public function updateRoom(int $id, $room): Room
    {
        if ($id !== $room['id']) {
            return new Room();
        }

        $existingRoom = $this->getRoomRepository()->getRoomById($room['id']);

        if ($existingRoom->getId() === null) {
            return new Room();
        }

        $room['name'] = isset($room['name']) ? $room['name'] : $existingRoom->getName();
        
    
        return $this->getRoomRepository()->updateRoom($room);
    }

    public function deleteRoom(int $id): bool
    {
        $existingRoom = $this->getRoomRepository()->getRoomById($id);

        if ($existingRoom->getId() === null) {
            return false;
        }

        return $this->getRoomRepository()->deleteRoom($id);
    }
}


