<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Student;

class InMemoryStudentRepository implements StudentRepository
{
    private $students = [];

    public function __construct() {

        $id = 1; $s1 = new Student(); $s1->setId(1); $s1->setFirstName('A'); $s1->setSurname('B');
        $this->students[$id] = $s1;

        $id = 2; $s2 = new Student(); $s2->setId(2); $s2->setFirstName('C'); $s2->setSurname('D');
        $this->students[$id] = $s2;

        $id = 3; $s3 = new Student(); $s3->setId(3); $s3->setFirstName('E'); $s3->setSurname('F');
        $this->students[$id] = $s3;
    }

    public function findAll(): array
    {
        return $this->students;
    }

    public function find($id): ?Student
    {
        if(array_key_exists($id, $this->students)){
            return $this->students[$id];
        }

        return null;
    }
}
