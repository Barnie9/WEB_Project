<?php

namespace App\Service;

use App\Entity\Groups;
use App\Service\BaseService;

final class GroupsService extends BaseService
{
    public function getAllGroups(): array
    {
        return $this->getGroupsRepository()->getAllGroups();
    }
    public function getGroupById(int $id): Groups
    {
        return $this->getGroupsRepository()->getGroupById($id);
    }

    public function createGroup($group): Groups
    {
        $existingGroup = $this->getGroupsRepository()->getGroupById($group['id']);

        if ($existingGroup->getId() !== null) {
            return new Groups();
        }

        return $this->getGroupsRepository()->createGroup($group);
    }

    public function updateGroup(int $id, $group): Groups
    {
        if ($id !== $group['id']) {
            return new Groups();
        }

        $existingGroup = $this->getGroupsRepository()->getGroupById($group['id']);

        if ($existingGroup->getId() === null) {
            return new Groups();
        }

        $group['programme'] = isset($group['programme']) ? $group['programme'] : $existingGroup->getProgramme();
        $group['number'] = isset($group['number']) ? $group['number'] : $existingGroup->getNumber();
        $group['type'] = isset($group['type']) ? $group['type'] : $existingGroup->getType();

        return $this->getGroupsRepository()->updateGroup($group);
    }

    public function deleteGroup(int $id): bool
    {
        $existingGroup = $this->getGroupsRepository()->getGroupById($id);

        if ($existingGroup->getId() === null) {
            return false;
        }

        return $this->getGroupsRepository()->deleteGroup($id);
    }

    
   



}