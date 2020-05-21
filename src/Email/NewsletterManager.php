<?php

declare(strict_types=1);

namespace App\Email;

use Twig\Environment;

class NewsletterManager
{
    /** @var Environment */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
}
