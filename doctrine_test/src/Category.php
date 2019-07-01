<?php

/**
 * @Entity
 */
class Category
{
    /**
     * @Id()
     * @GeneratedValue()
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string", length=255)
     */
    private $name;
    
}
