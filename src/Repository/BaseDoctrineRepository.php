<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;

abstract class BaseDoctrineRepository
{
    /** @var ObjectManager */
    private $objectManager;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
