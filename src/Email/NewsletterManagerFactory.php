<?php

declare(strict_types=1);

namespace App\Email;

class NewsletterManagerFactory
{
    public function createNewsletterManager()
    {
        return new NewsletterManager();
    }
}
