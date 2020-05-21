<?php

declare(strict_types=1);

namespace App\Email;

class NewsletterManagerStaticFactory
{
    public static function createNewsletterManager()
    {
        return new NewsletterManager();
    }
}
