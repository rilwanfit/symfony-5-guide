<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class UserTest extends TestCase
{
    public function testItShouldAssertRegistrationGroup() {
        $user = new User();
        $user->setEmail('wrong-email');

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($user, null, ['registration']);
        $this->assertContains('This value is not a valid email address', $errors->__toString());
        $this->assertContains('This value should not be blank', $errors->__toString());
    }

    public function testItShouldAssertDefaultGroupWhenNoGroupSpecified() {
        $user = new User();
        $user->setEmail('wrong-email');
        $user->setCity('A');

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($user);

        $this->assertContains('This value is too short. It should have 2 characters or more.', $errors->__toString());
    }
}
