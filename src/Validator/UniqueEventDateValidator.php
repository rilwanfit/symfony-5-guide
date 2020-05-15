<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\EventRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEventDateValidator extends ConstraintValidator
{
    /** @var EventRepository */
    private $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validate($object, Constraint $constraint)
    {
        $conflicts = $this->repository
            ->findOverlappingWithRange($object->getStartDate(), $object->getEndDate())
        ;

        if (count($conflicts) > 0) {
            $this->context->buildViolation('There is already an event during this time!')->addViolation();
        }
    }
}
