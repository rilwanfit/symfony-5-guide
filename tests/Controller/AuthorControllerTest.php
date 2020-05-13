<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthorControllerTest extends WebTestCase
{
    public function testNameOfTheAuthorCanNotBeBlank()
    {
        $client = static::createClient();

        $client->request('GET', '/author');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString(
            'This value should not be blank',
            $client->getResponse()->getContent()
        );
    }
}
