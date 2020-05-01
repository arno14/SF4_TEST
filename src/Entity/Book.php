<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 *
 * @ApiFilter(ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter::class, properties={"title":"partial"})
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"book"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"book"})
     */
    private $title;

    /**
     * @Assert\NotNull
     * @ORM\Column(type="date")
     * @Groups({"book"})
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"book"})
     */
    private $ISBN;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"book_author"})
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @Groups({"book_categories"})
     */
    private $categories;

    public function __toString()
    {
        return (string) $this->getTitle();
    }

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate = null): self
    {
        if ($this->publicationDate instanceof DateTime && $publicationDate instanceof DateTime) {
            if ($this->publicationDate->format('Y-m-d') === $publicationDate->format('Y-m-d')) {
                return $this;
            }
        }

        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }
}
