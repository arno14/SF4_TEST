<?php
use Doctrine\Common\Util\Debug;

require_once 'boot.php';

/*@var $em EntityManager*/
$em = require_once 'get_entity_manager.php';


echo PHP_EOL, 'RETRIEVE BOOKS WITH DQL ';


// En passant par un query builder
// $queryBuilder = $em->createQueryBuilder()
//                     ->select('b')
//                     ->from(Book::class)
//                     ->where('b.title LIKE :term');
// $query =$queryBuilder->getQuery();

//en passant par une query directement
$query = $em->createQuery('SELECT b FROM Book b WHERE b.title LIKE :term');

//en passant par une query avec récupération de données calculées
// $query = $em->createQuery('SELECT b, COUNT(c) AS count_categories FROM Book b LEFT JOIN b.categories c WHERE b.title LIKE :term GROUP BY b');


$query->setParameter('term','%er%');
$query->setMaxResults(2);

echo PHP_EOL,'DQL QUERY = ', $query->getDQL(), PHP_EOL;

echo PHP_EOL,'SQL QUERY = ', $query->getSQL(), PHP_EOL;

echo PHP_EOL,'QUERY PARAMETERS ', print_r($query->getParameters()), PHP_EOL;

echo PHP_EOL, 'EXECUTE DOCTRINE QUERY ', PHP_EOL;

$results = $query->getResult();


echo PHP_EOL, 'LIST RESULTS ', PHP_EOL;

foreach($results as $r){
    echo PHP_EOL,' --- ';
    if($r instanceof Book){
        echo "the book is $r";
    }elseif (is_array($r)) {
       foreach ($r as $key => $value) {
          echo "$key=>$value, ";
       }
    }else{
        Debug::dump($r);
    }

}

echo PHP_EOL;