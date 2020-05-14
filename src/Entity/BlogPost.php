<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Assert\Expression(
 *     "this.getCategory() in ['php', 'symfony'] or !this.isTechnicalPost()",
 *     message="If this is a tech post, the category should be either php or symfony!"
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 */
class BlogPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTechnicalPost;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isTechnicalPost(): ?bool
    {
        return $this->isTechnicalPost;
    }

    public function setIsTechnicalPost(bool $isTechnicalPost): self
    {
        $this->isTechnicalPost = $isTechnicalPost;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
