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
        $query = 'INSERT INTO events VALUES (:id, :matterId, :teacherId, :groupId, :roomId,  :startTime, :endTime, :type)';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => null,
            'matterId' => $event['matterId'],
            'teacherId' => $event['teacherId'],
            'groupId' => $event['groupId'],
            'roomId' => $event['roomId'],
            'startTime' => $event['startTime'],
            'endTime' => $event['endTime'],
            'type' => $event['type']
        ]);
        return $this->getEventById($this->db->lastInsertId());
    }

    public function updateEvent($event): Event
    {

        $query = 'UPDATE events SET matter_id = :matterId, teacher_id = :teacherId, group_id = :groupId, room_id = :roomId,  start_time = :startTime, end_time = :endTime, type = :type WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->execute([
            'id' => $event['id'],
            'matterId' => $event['matterId'],
            'teacherId' => $event['teacherId'],
            'groupId' => $event['groupId'],
            'roomId' => $event['roomId'],
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
    public function getFilteredEvents(array $groupIds, string $startDate, string $endDate): array
    {
        $inQuery = implode(',', $groupIds);
        
        $query = "
            SELECT * 
            FROM events 
            WHERE group_id IN ($inQuery)
            AND start_time >= ?
            AND end_time <= ?
        ";

        $statement = $this->db->prepare($query);
        $params = array_merge($groupIds, [$startDate, $endDate]);
        $statement->execute($params);
        
        return $statement->fetchAll(PDO::FETCH_CLASS, Event::class);
    }
}