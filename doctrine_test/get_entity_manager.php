<?php

$connection = require_once('get_connection.php');



// $isDevMode = true;
// $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
// // or if you prefer XML
// // $config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config"), $isDevMode);
// // database configuration parameters
// $conn = array(
//     'driver' => 'pdo_sqlite',
//     'path' => __DIR__ . '/db.sqlite',
// );

// // obtaining the entity manager
// $entityManager = Doctrine\ORM\EntityManager::create($connection, $config);

// return $entityManager;

// exit;

/**
 * Création de l'objet Configuration
 */
$config = new Doctrine\ORM\Configuration();

$cache = new Doctrine\Common\Cache\ArrayCache;
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);
$config->setResultCacheImpl($cache);

$proxyDir = sys_get_temp_dir();
$config->setProxyDir($proxyDir);
        
$config->setProxyNamespace('DoctrineProxies');
$config->setAutoGenerateProxyClasses(true);


$pathsToAnnotations= __DIR__."/src";

$annotationReader = new Doctrine\Common\Annotations\AnnotationReader();
$cachedReader =  new Doctrine\Common\Annotations\CachedReader($annotationReader, $cache);
$metadataDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver( $cachedReader,(array) $pathsToAnnotations);

// $metadataDriver = $config->newDefaultAnnotationDriver($paths, true);

$config->setMetadataDriverImpl($metadataDriver);

$config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([$pathsToAnnotations], true);



/**
 * Création de l'objet EntityManager
 */

 $em = Doctrine\ORM\EntityManager::create($connection, $config);


 return $em;
