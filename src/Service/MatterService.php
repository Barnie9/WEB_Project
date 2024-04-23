<?php

namespace App\Service;

use App\Entity\Matter;
use App\Service\BaseService;

final class MatterService extends BaseService
{
    public function getAllMatters(): array
    {
        return $this->getMatterRepository()->getAllMatters();
    }

    public function getMatterById(int $id): Matter
    {
        return $this->getMatterRepository()->getMatterById($id);
    }

    public function createMatter($matter): Matter
    {
        $existingMatter = $this->getMatterRepository()->getMatterByTitle($matter['title']);

        if ($existingMatter->getId() !== null) {
            return new Matter();
        }

        return $this->getMatterRepository()->createMatter($matter);
    }

    public function updateMatter(int $id, $matter): Matter
    {
        if ($id !== $matter['id']) {
            return new Matter();
        }

        $existingMatter = $this->getMatterRepository()->getMatterById($matter['id']);

        if ($existingMatter->getId() === null) {
            return new Matter();
        }

        $matter['title'] = isset($matter['title']) ? $matter['title'] : $existingMatter->getTitle();
        $matter['type'] = isset($matter['type']) ? $matter['type'] : $existingMatter->getType();

        return $this->getMatterRepository()->updateMatter($matter);
    }

    public function deleteMatter(int $id): bool
    {
        $existingMatter = $this->getMatterRepository()->getMatterById($id);

        if ($existingMatter->getId() === null) {
            return false;
        }

        return $this->getMatterRepository()->deleteMatter($id);
    }
}