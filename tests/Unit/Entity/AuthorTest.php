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
        $this->assertGreaterThanOrEqual(1, count($errors));

        $author->name = $name;
        $errors = $validator->validate($author);
        $this->assertGreaterThanOrEqual($expectedErrorCount, count($errors));
    }

    /**
     * @dataProvider genreOfAuthor()
     */
    public function testGenreOfTheAuthorCanOnlyBeAllowedType($genre, $expectedErrorCount)
    {
        $author = new Author();
        $author->name = 'MH Rilwan';

        $author->setGenre($genre);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($author);
        $this->assertCount($expectedErrorCount, $errors);
    }

    /**
     * @dataProvider usenameAndPasswordOfAuthor()
     */
    public function testPasswordDoesNotContainsTheNameOfTheAuthor($user, $expectedErrorCount)
    {
        $author = new Author();
        $author->name = $user['name'];

        $author->setPassword($user['password']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($author);
        $this->assertCount($expectedErrorCount, $errors);
    }

    public function testFakeNameOfTheAuthor()
    {
        $author = new Author();
        $author->name = 'fakename';

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($author);
        $this->assertCount(1, $errors);


        $author->name = 'goodname';
        $errors = $validator->validate($author);
        $this->assertCount(0, $errors);
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

    public function genreOfAuthor()
    {
        return [
            [
                'genre' => '',
                'expectedErrorCount' => 1
            ],
            [
                'genre' => 'not-allowed-type',
                'expectedErrorCount' => 1
            ],
            [
                'genre' => 'fiction',
                'expectedErrorCount' => 0
            ],
            [
                'genre' => 'non-fiction',
                'expectedErrorCount' => 0
            ],
        ];
    }

    public function usenameAndPasswordOfAuthor()
    {
        return [
            [
                'user' => [
                    'name' => 'rilwan',
                    'password' => 'rilwan123'
                ],
                'expectedErrorCount' => 1
            ],
            [
                'user' => [
                    'name' => 'rilwan',
                    'password' => '123rilwan'
                ],
                'expectedErrorCount' => 1
            ],
            [
                'user' => [
                    'name' => 'rilwan',
                    'password' => '12rilwan3'
                ],
                'expectedErrorCount' => 1
            ],
            [
                'user' => [
                    'name' => 'rilwan',
                    'password' => '123456'
                ],
                'expectedErrorCount' => 0
            ],
        ];
    }
}
