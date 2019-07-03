<?php

/**
 * récupération de l'objet Connection
 */
$connection = require_once('get_connection.php');

/**
 * Création de l'objet Configuration
 */
$config = new Doctrine\ORM\Configuration();

$cache = new Doctrine\Common\Cache\ArrayCache;
// $config->setMetadataCacheImpl($cache);
// $config->setQueryCacheImpl($cache);
// $config->setResultCacheImpl($cache);

$config->setProxyDir('tmp_dir');
        
$config->setProxyNamespace('DoctrineProxies');

$config->setAutoGenerateProxyClasses(true);

/**
 * Configuration du Mapping
 */
$pathsToAnnotations= __DIR__."/src";
Doctrine\Common\Annotations\AnnotationRegistry::registerFile( 'vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
$annotationReader = new Doctrine\Common\Annotations\AnnotationReader();
// $annotationReader =  new Doctrine\Common\Annotations\CachedReader($annotationReader, $cache);
$metadataDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver( $annotationReader,(array) $pathsToAnnotations);

$config->setMetadataDriverImpl($metadataDriver);

/**
 * Création de l'objet EntityManager
 */
 $em = Doctrine\ORM\EntityManager::create($connection, $config);



 return $em;
