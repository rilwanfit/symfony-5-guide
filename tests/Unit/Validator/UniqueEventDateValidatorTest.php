<?php

declare(strict_types=1);

namespace App\Tests\Unit\Validator;

use App\Entity\Event;
use App\Repository\EventRepository;
use App\Validator\UniqueEventDateValidator;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class UniqueEventDateValidatorTest extends TestCase
{
    /** @test */
    public function validate_build_violation_if_there_is_an_overlaping_event()
    {
        $repository = $this->prophesize(EventRepository::class);
        $repository->findOverlappingWithRange(Argument::cetera())->willReturn(['1']);
        $uniqueEventDateValidator = new UniqueEventDateValidator($repository->reveal());

        $constraintViolationBuilder = $this->prophesize(ConstraintViolationBuilderInterface::class);

        $executionContext = $this->prophesize(ExecutionContextInterface::class);
        $executionContext->buildViolation('There is already an event during this time!')->shouldBeCalledOnce()->willReturn($constraintViolationBuilder);

        $constraintViolationBuilder->addViolation()->shouldBeCalledOnce()->willReturn(null);

        $event = new Event();
        $event->setStartDate(new \DateTime());
        $event->setEndDate(new \DateTime('tomorrow'));

        $constraint = $this->prophesize(Constraint::class);

        $uniqueEventDateValidator->initialize($executionContext->reveal());
        $uniqueEventDateValidator->validate($event, $constraint->reveal());
    }
}
