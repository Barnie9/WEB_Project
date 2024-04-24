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

        $existingEvent = $this->getEventRepository()->getExistingEventById($event['id']);

        if ($existingEvent === null) {
            return null;
        }

        $event['matterId'] = isset($event['matterId']) ? $event['matterId'] : $existingEvent->getMatterId();
        $event['teacherId'] = isset($event['teacherId']) ? $event['teacherId'] : $existingEvent->getTeacherId();
        $event['groupId'] = isset($event['groupId']) ? $event['groupId'] : $existingEvent->getGroupId();
        $event['roomId'] = isset($event['roomId']) ? $event['roomId'] :
        $existingEvent->getroomId();
        $event['startDate'] = isset($event['startDate']) ? $event['startDate'] : $existingEvent->getStartDate();
        $event['startTime'] = isset($event['startTime']) ? $event['startTime'] : $existingEvent->getStartTime();
        $event['endTime'] = isset($event['endTime']) ? $event['endTime'] : $existingEvent->getEndTime();
        $event['type'] = isset($event['type']) ? $event['type'] : $existingEvent->getType();

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
}