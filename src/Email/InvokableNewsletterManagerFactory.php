<?php

declare(strict_types=1);

namespace App\Email;

class InvokableNewsletterManagerFactory
{
    public function __invoke()
    {
        return new NewsletterManager();
    }
}
