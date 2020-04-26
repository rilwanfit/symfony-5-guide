<?php

declare(strict_types=1);

namespace App\Repository;

interface StudentRepository
{
    public function findAll();

    public function find($id);
}
