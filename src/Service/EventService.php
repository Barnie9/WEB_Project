<?php

namespace App\Service;

use App\Entity\Event;
use App\Service\BaseService;

final class EventService extends BaseService
{
    public function getAllEvents(): array
    {
        return $this->getEventRepository()->getAllEvents();
    }

    public function getEventById(int $id): Event
    {
        return $this->getEventRepository()->getEventById($id);
    }

    public function createEvent($event): Event
    {
        return $this->getEventRepository()->createEvent($event);
    }

    public function updateEvent(int $id, $event): ?Event
    {
        if ($id !== $event['id']) {
            return new Event();
        }

        $existingEvent = $this->getEventRepository()->getEventById($event['id']);

        if ($existingEvent === null) {
            return null;
        }

   // Convert incoming snake_case keys to camelCase
   $event['matterId'] = isset($event['matter_id']) ? $event['matter_id'] : $existingEvent->getMatterId();
   $event['teacherId'] = isset($event['teacher_id']) ? $event['teacher_id'] : $existingEvent->getTeacherId();
   $event['groupId'] = isset($event['group_id']) ? $event['group_id'] : $existingEvent->getGroupId();
   $event['roomId'] = isset($event['room_id']) ? $event['room_id'] : $existingEvent->getRoomId();
   $event['startDate'] = isset($event['start_time']) ? $event['start_time'] : $existingEvent->getStartDate();
   $event['startTime'] = isset($event['start_time']) ? $event['start_time'] : $existingEvent->getStartTime();
   $event['endTime'] = isset($event['end_time']) ? $event['end_time'] : $existingEvent->getEndTime();
   $event['type'] = isset($event['type']) ? $event['type'] : $existingEvent->getType();

   // Remove snake_case keys
   unset($event['matter_id'], $event['teacher_id'], $event['group_id'], $event['room_id'], $event['start_time'], $event['end_time']);
        return $this->getEventRepository()->updateEvent($event);
    }

    public function deleteEvent(int $id): bool
    {
        $existingEvent = $this->getEventRepository()->getEventById($id);

        if ($existingEvent === null) {
            return false;
        }

        return $this->getEventRepository()->deleteEvent($id);
    }
    public function getFilteredEvents(array $groupIds, string $startDate, string $endDate): array
    {
        return $this->getEventRepository()->getFilteredEvents($groupIds, $startDate, $endDate);
    }
}