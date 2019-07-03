<?php

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @Entity 
 * @Table(name="book")
 **/
class Book
{
    /**
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue 
     */
    private $id;

    /** 
     * @Column(type="string") 
     **/
    private $title;

    /** 
     * @Column(type="date", name="publication_date") 
     **/
    private $publicationDate;

    /** 
     * @Column(type="string") 
     **/
    private $isbn;

     /**
     * @ManyToOne(targetEntity="Author", inversedBy="books")
     * @JoinColumn(nullable=false)
     */
    private $author;

     /**
     * @ManyToMany(targetEntity="Category")
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set publicationDate.
     *
     * @param \DateTime $publicationDate
     *
     * @return Book
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate.
     *
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set isbn.
     *
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn.
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set author.
     *
     * @param \Author $author
     *
     * @return Book
     */
    public function setAuthor(\Author $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return \Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add category.
     *
     * @param \Book $category
     *
     * @return Book
     */
    public function addCategory(\Book $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category.
     *
     * @param \Book $category
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCategory(\Book $category)
    {
        return $this->categories->removeElement($category);
    }

    /**
     * Get categories.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
