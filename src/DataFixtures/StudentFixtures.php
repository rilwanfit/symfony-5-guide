<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i < 10; $i++) {
            $student = new Student();
            $student->setFirstName($faker->firstName);
            $student->setSurname($faker->lastName);

            $manager->persist($student);
        }

        $manager->flush();
    }
}
