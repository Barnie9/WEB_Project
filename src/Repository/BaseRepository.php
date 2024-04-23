<?php

namespace App\Repository;

use PDO;

abstract class BaseRepository
{
    public function __construct(protected PDO $db)
    {
    }
}