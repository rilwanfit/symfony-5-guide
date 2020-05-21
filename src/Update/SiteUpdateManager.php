<?php

declare(strict_types=1);

namespace App\Update;

class SiteUpdateManager
{
    private $adminEmail;

    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }
}
