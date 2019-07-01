<?php

/**
 * Création de l'objet DBAL Connection
 */
$connectionConfig = [
    'driver'=>'pdo_mysql',
    'host'=>'database',
    'user'=> 'db_user',
    'password'=>'db_pass',
    'dbname'=>'sf_test'
];

$driver = new Doctrine\DBAL\Driver\PDOMySql\Driver;

$connection = new Doctrine\DBAL\Connection($connectionConfig, $driver);

return $connection;


