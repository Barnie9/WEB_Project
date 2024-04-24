<?php

namespace App\Repository;

use App\Entity\Event;

final class EventRepository extends BaseRepository
{
    public function getAllEvents(): array
    {
        $query = 'SELECT * FROM events';
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getEventById(int $id): Event
    {
        $query = 'SELECT * FROM events WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        $event = $statement->fetchObject(Event::class);
        if (!$event) {
            return new Event();
        }
        return $event;
    }

    public function createEvent($event): Event
    {
        $query = 'INSERT INTO events VALUES (:id, :matterId, :teacherId, :groupId, :roomId, :startDate, :startTime, :endTime, :type)';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => null,
            'matterId' => $event['matterId'],
            'teacherId' => $event['teacherId'],
            'groupId' => $event['groupId'],
            'roomId' => $event['roomId'],
            'startDate' => $event['startDate'],
            'startTime' => $event['startTime'],
            'endTime' => $event['endTime'],
            'type' => $event['type']
        ]);
        return $this->getEventById($this->db->lastInsertId());
    }

    public function updateEvent($event): Event
    {
        $query = 'UPDATE events SET matterId = :matterId, teacherId = :teacherId, groupId = :groupId, roomId = :roomId, startDate = :startDate, startTime = :startTime, endTime = :endTime, type = :type WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => $event['id'],
            'matterId' => $event['matterId'],
            'teacherId' => $event['teacherId'],
            'groupId' => $event['groupId'],
            'roomId' => $event['roomId'],
            'startDate' => $event['startDate'],
            'startTime' => $event['startTime'],
            'endTime' => $event['endTime'],
            'type' => $event['type']
        ]);
        return $this->getEventById($event['id']);
    }

    public function deleteEvent($id): bool
    {
        $query = 'DELETE FROM events WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        $event = $this->getEventById($id);
        return $event->getId() === null;
    }
}