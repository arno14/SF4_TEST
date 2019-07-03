<?php

namespace DoctrineProxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Author extends \Author implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Author' . "\0" . 'id', '' . "\0" . 'Author' . "\0" . 'firstName', '' . "\0" . 'Author' . "\0" . 'lastName', '' . "\0" . 'Author' . "\0" . 'birthDate', '' . "\0" . 'Author' . "\0" . 'deathDate', '' . "\0" . 'Author' . "\0" . 'books'];
        }

        return ['__isInitialized__', '' . "\0" . 'Author' . "\0" . 'id', '' . "\0" . 'Author' . "\0" . 'firstName', '' . "\0" . 'Author' . "\0" . 'lastName', '' . "\0" . 'Author' . "\0" . 'birthDate', '' . "\0" . 'Author' . "\0" . 'deathDate', '' . "\0" . 'Author' . "\0" . 'books'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Author $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName($firstName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstName', [$firstName]);

        return parent::setFirstName($firstName);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', []);

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastName', [$lastName]);

        return parent::setLastName($lastName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', []);

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function setBirthDate($birthDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBirthDate', [$birthDate]);

        return parent::setBirthDate($birthDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getBirthDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBirthDate', []);

        return parent::getBirthDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeathDate($deathDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeathDate', [$deathDate]);

        return parent::setDeathDate($deathDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeathDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeathDate', []);

        return parent::getDeathDate();
    }

    /**
     * {@inheritDoc}
     */
    public function addBook(\Book $book)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addBook', [$book]);

        return parent::addBook($book);
    }

    /**
     * {@inheritDoc}
     */
    public function removeBook(\Book $book)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeBook', [$book]);

        return parent::removeBook($book);
    }

    /**
     * {@inheritDoc}
     */
    public function getBooks()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBooks', []);

        return parent::getBooks();
    }

}
