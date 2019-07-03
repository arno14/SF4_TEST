<?php

require_once 'boot.php';

$connection = require_once 'get_connection.php';

// print_r( $connection->fetchAll('SHOW TABLES') );


$connection->insert('author',['first_name'=>'TEST','last_name'=>'TEST']);

print_r( $connection->fetchAll('SELECT * FROM author ORDER BY id DESC LIMIT 0,3') );


echo PHP_EOL, $connection->delete('book', ['title'=>'TEST']).' books deleted';
echo PHP_EOL, $connection->delete('author', ['first_name'=>'TEST']).' authors deleted';

echo PHP_EOL;