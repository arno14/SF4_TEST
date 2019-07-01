<?php
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="book")
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
     * @Column(type="string") 
     */
    private $firstName;

    /**
     * @Column(type="string") 
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

}
