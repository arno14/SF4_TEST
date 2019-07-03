<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity 
 * @Table(name="author")
 **/
class Author
{
    /**
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue 
     */
    private $id;

    /**
     * @Column(type="string",  name="first_name") 
     */
    private $firstName;

    /**
     * @Column(type="string",  name="last_name") 
     */
    private $lastName;

    /** 
     * @Column(type="date", name="birth_date") 
     **/
    private $birthDate;

    /** 
     * @Column(type="date", name="death_date") 
     **/
    private $deathDate;

     /**
     * @OneToMany(targetEntity="Book", mappedBy="author")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
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
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Author
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Author
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthDate.
     *
     * @param \DateTime $birthDate
     *
     * @return Author
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set deathDate.
     *
     * @param \DateTime $deathDate
     *
     * @return Author
     */
    public function setDeathDate($deathDate)
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    /**
     * Get deathDate.
     *
     * @return \DateTime
     */
    public function getDeathDate()
    {
        return $this->deathDate;
    }

    /**
     * Add book.
     *
     * @param \Book $book
     *
     * @return Author
     */
    public function addBook(\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book.
     *
     * @param \Book $book
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBook(\Book $book)
    {
        return $this->books->removeElement($book);
    }

    /**
     * Get books.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
}
