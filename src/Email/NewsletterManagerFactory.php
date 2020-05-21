<?php

declare(strict_types=1);

namespace App\Email;

use Twig\Environment;

class NewsletterManagerFactory
{
    public function createNewsletterManager(Environment $twig)
    {
        return new NewsletterManager($twig);
    }
}
