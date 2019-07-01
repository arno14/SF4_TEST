<?php

require_once 'boot.php';

$connection = require_once 'get_connection.php';

print_r( $connection->fetchAll('SHOW TABLES') );

print_r( $connection->fetchAll('SELECT * FROM book') );