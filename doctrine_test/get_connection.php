<?php
use Doctrine\DBAL\Logging\EchoSQLLogger;

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

class CustomSQLLogger implements \Doctrine\DBAL\Logging\SQLLogger
{
    public function startQuery($sql, array $params = null, array $types = null)
    {
        // $log = str_replace('?','%s',$sql);
        // $log = call_user_func_array('sprintf', array_merge([$log], (array) $params));
        // echo PHP_EOL, ' - execute SQL "',$log,'"';

        echo PHP_EOL,"' [[[execute SQL: '$sql'";
        if ($params) {
            echo "' with params '",str_replace("\n",' ',print_r($params,true)),"'";
        }
        echo ']]] ';
    }

    public function stopQuery()
    {
    }
}


// $connection->getConfiguration()->setSQLLogger(new EchoSQLLogger);
$connection->getConfiguration()->setSQLLogger(new CustomSQLLogger);

return $connection;


