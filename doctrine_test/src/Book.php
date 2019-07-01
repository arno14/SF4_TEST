<?php

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
     * @ManyToMany(targetEntity="Book")
     */
    private $categories;

}
