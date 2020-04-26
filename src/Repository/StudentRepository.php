<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Student;

interface StudentRepository
{
    public function findAll(): array;

    public function find($id): ?Student;
}
