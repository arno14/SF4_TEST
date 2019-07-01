
<?php


require_once 'boot.php';

$entityManager = require_once 'get_entity_manager.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);




// use Doctrine\ORM\Tools\Console\ConsoleRunner;

// // replace with file to your own project bootstrap
// require_once __DIR__.'/vendor/autoload.php';

// // replace with mechanism to retrieve EntityManager in your app
// $entityManager = GetEntityManager();

// return ConsoleRunner::createHelperSet($entityManager);

