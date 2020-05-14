<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Author;
use App\Entity\BlogPost;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class BlogPostTest extends TestCase
{
    /**
     * @dataProvider dataSet1()
     */
    public function testCategoryMustBeEitherPhpOrSymfonyWhenIsTechnicalPostIsTrue(
        $category,
        $isTechnicalPost,
        $expectedErrorCount
    ) {
        $blogPost = new BlogPost();
        $blogPost->setCategory($category)->setIsTechnicalPost($isTechnicalPost);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($blogPost);
        $this->assertCount($expectedErrorCount, $errors);
    }

    public function dataSet1()
    {
        return [
            [
                'category' => 'symfony',
                'isTechnicalPost' => true,
                'expectedErrorCount' => 0
            ],
            [
                'category' => 'php',
                'isTechnicalPost' => true,
                'expectedErrorCount' => 0
            ],
            [
                'category' => 'marketing',
                'isTechnicalPost' => true,
                'expectedErrorCount' => 1
            ],
            [
                'category' => 'marketing',
                'isTechnicalPost' => false,
                'expectedErrorCount' => 0
            ],
            [
                'category' => 'php',
                'isTechnicalPost' => false,
                'expectedErrorCount' => 0
            ],
        ];
    }
}
