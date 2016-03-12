<?php
// bootstrap_doctrine.php

// See :doc:`Configuration <../reference/configuration>` for up to date autoloading details.
use Doctrine\ORM\Tools\Setup;
require_once("Doctrine/ORM/Tools/Setup.php");
Setup::registerAutoloadPEAR();

// Create a simple "default" Doctrine ORM configuration for XML Mapping
$isDevMode = true;
$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
// or if you prefer yaml or annotations
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entities"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
//$conn = array(
  //  'driver' => 'pdo_sqlite',
   // 'path' => __DIR__ . '/db.sqlite',
//);

$conn = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'wwwwhats_betaPhase',
    'user'     => 'root',
    'password' => 'toor'
);
// obtaining the entity manager
$entityManager = Doctrine\ORM\EntityManager::create($conn, $config);
