<?php


require_once 'boot.php';

$em = require_once 'get_entity_manager.php';

$b = new Book;

// echo $b->getTitle();
// $em->persist($b);
// $em->flush();

//  Doctrine\Common\Util\Debug::dump($em->getConfiguration());

$books = $em->createQuery('SELECT b.title FROM  Book b')->getArrayResult();

print_r($books);

// $eventmanager = new Doctrine\Common\EventManager;

// $em = new Doctrine\ORM\EntityManager($connection, $config, $eventManager);

// echo PHP_EOL,'HELLO WORLD';

