<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ClientTest extends TestCase
{
    const TYPE_COMPANY = 1;
    const TYPE_PERSON = 2;


    public function testValidateClientType()
    {
        $client = new Client();

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($client);

        $this->assertContains('This value should not be null', $errors->__toString());
    }

    public function testValidateFirstAndLastnameWhenClientTypePerson()
    {
        $client = new Client();
        $client->setType(self::TYPE_PERSON);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($client);
        $this->assertContains('This firstname should not be blank.', $errors->__toString());
        $this->assertContains('This lastname should not be blank.', $errors->__toString());
    }

    public function testValidateCompanyNameWhenClientTypeCompany()
    {
        $client = new Client();
        $client->setType(self::TYPE_COMPANY);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($client);
        $this->assertContains('This company should not be blank.', $errors->__toString());
    }
}
