<?php

use AR\Model;
use AR\Author;
use AR\Book;

require_once 'boot.php';

Model::registerConnection([
    'dsn'=>'mysql:dbname=sf_test;host=database',
    'username'=>'db_user',
    'password'=>'db_pass'
]);


$a = new Author();
$a->set('first_name','test')
   ->set('last_name','test');

$a->save();

foreach(Author::findBy() as $auth){
    // echo PHP_EOL, $auth;
}


foreach(Book::findBy() as $b){
    echo PHP_EOL," - $b written by {$b->get('author')}";
}