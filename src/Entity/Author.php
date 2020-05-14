<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @Assert\Choice(
     *     choices={ "fiction", "non-fiction" },
     *     message = "Choose a valid genre."
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @Assert\IsTrue(message="The password cannot contains your name")
     */
    public function isPasswordSafe()
    {
        if (empty($this->name)) {
            return false;
        }

        return strpos($this->password, (string) $this->name) === false;
    }

    /**
     * @Assert\Callback
     */
    public function isAuthorValid(ExecutionContextInterface $context, $payload): void
    {
        $fakeNames = [
            'fakename'
        ];

        // check if the name is actually a fake name
        if (in_array($this->name, $fakeNames)) {
            $context->buildViolation('This name sounds totally fake!')
                ->atPath('firstName')
                ->addViolation();
        }
    }
}
