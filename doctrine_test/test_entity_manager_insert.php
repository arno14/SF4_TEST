<?php


require_once 'boot.php';

/*@var $em EntityManager*/
$em = require_once 'get_entity_manager.php';


$author = new Author;

$author->setFirstName('TEST');
$author->setLastName('TEST');
$author->setBirthDate(new DateTime('2000-01-01'));

$em->persist($author);

$book=new Book();
$book->setTitle('TEST');
$book->setIsbn('test');
$book->setPublicationDate(new DateTime('2000-01-01'));
$book->setAuthor($author);

$em->persist($book);

echo PHP_EOL, 'BEFORE FLUSH',PHP_EOL;
$em->flush();
echo PHP_EOL, 'AFTER FLUSH',PHP_EOL;


foreach($em->getRepository(Book::class)->findBy(['title'=>'TEST']) as $a){
    $em->remove($a);
}
foreach($em->getRepository(Author::class)->findBy(['firstName'=>'TEST']) as $a){
    $em->remove($a);
}
$em->flush();