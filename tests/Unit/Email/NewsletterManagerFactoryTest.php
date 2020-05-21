<?php

declare(strict_types=1);

namespace App\Tests\Unit\Email;

use App\Email\NewsletterManager;
use App\Email\NewsletterManagerFactory;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class NewsletterManagerFactoryTest extends TestCase
{
    public function testItCreatesNewsletterManager()
    {
        $factory = new NewsletterManagerFactory();
        $newsletterManager = $factory->createNewsletterManager($this->prophesize(Environment::class)->reveal());
        $this->assertInstanceOf(NewsletterManager::class, $newsletterManager);
    }
}
