<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

/**
 * @Assert\GroupSequenceProvider()
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client implements GroupSequenceProviderInterface
{
    const TYPE_COMPANY = 1;
    const TYPE_PERSON = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotNull()
     * @Assert\Choice({ Client::TYPE_COMPANY, CLIENT::TYPE_PERSON })
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @Assert\NotBlank(message="This company should not be blank.", groups = {"company"})
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @Assert\NotBlank(message="This firstname should not be blank.", groups = {"person"})
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @Assert\NotBlank(message="This lastname should not be blank.", groups = {"person"})
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getGroupSequence()
    {
        return [
            // Include the "Client" group to validate the $type property as well.
            // Note that using the "Default" group here won't work!
            'Client',
            // Use either the person or company group based on the selected type.
            $this->type === self::TYPE_PERSON ? 'person' : 'company',
        ];


        /**
         * If we want to get all violations at once we will return just one validation step containing an array of the groups to validate.
         * return [
                    [
                        'Client',
                        $this->type === self::TYPE_PERSON ? 'person' : 'company',
                    ]
                ];
         */
    }
}
