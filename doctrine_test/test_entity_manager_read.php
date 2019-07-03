<?php
use Doctrine\Common\Util\Debug;

require_once 'boot.php';

/*@var $em EntityManager*/
$em = require_once 'get_entity_manager.php';


echo PHP_EOL, 'RETRIEVE BOOKS';

// print_r( $em->createQuery('SELECT b.title FROM  Book b')->getResult());

//sans jointures (Lazy loading)
$books = $em->createQuery('SELECT b FROM  Book b')->setMaxResults(5)->getResult();
// $books = $em->getRepository("Book")->findAll(5);

//avec jointures
// $books = $em->createQuery('SELECT b,a,c FROM  Book b JOIN b.author a JOIN b.categories c')->setMaxResults(5)->getResult();


foreach($books as $b){

    $bookClass = get_class($b);
    $authorClass = get_class($b->getAuthor());
    echo PHP_EOL,"- $bookClass '{$b->getTitle()}'\t\t";
    echo " | by = $authorClass '{$b->getAuthor()->getLastName()}";

    // echo "\t | categories=";
    // foreach($b->getCategories() as $c){
    //     echo $c->getName(),',';
    // }
}

echo PHP_EOL;