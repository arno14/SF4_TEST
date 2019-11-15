<?php declare(strict_types = 1);

use App\Kernel;

require dirname(__DIR__) . '/../config/bootstrap.php';
$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

$em = $kernel->getContainer()->get('doctrine')->getManager();

if(!$em){
    echo 'NO ENTITY MANAGER!!!';
    return null;
}
echo 'EM FOUND!!!';

return $em;