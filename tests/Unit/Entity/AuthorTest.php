<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Author;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AuthorTest extends TestCase
{
    /**
     * @dataProvider nameOfAuthor()
     */
    public function testNameOfTheAuthorCanNotBeBlank($name, $expectedErrorCount)
    {
        $author = new Author();

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($author);
        $this->assertCount(1, $errors);

        $author->name = $name;
        $errors = $validator->validate($author);
        $this->assertCount($expectedErrorCount, $errors);
    }

    public function nameOfAuthor()
    {
        return [
            [
                'name' => '',
                'expectedErrorCount' => 1
            ],
            [
                'name' => null,
                'expectedErrorCount' => 1
            ],
            [
                'name' => [],
                'expectedErrorCount' => 1
            ],
            [
                'name' => false,
                'expectedErrorCount' => 1
            ],
            [
                'name' => 'MHRilwan',
                'expectedErrorCount' => 0
            ],
            [
                'name' => 0,
                'expectedErrorCount' => 0
            ],
            [
                'name' => true,
                'expectedErrorCount' => 0
            ],
        ];
    }
}
