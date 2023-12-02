<?php 


use Dotenv\Dotenv;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

$config = ORMSetup::createAnnotationMetadataConfiguration(
    array(__DIR__."/src"),
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

$database_Url = $_ENV["DATABASE_URL"];

$dir = __DIR__;
$dir = str_replace("\\", "/", $dir);

$replace = "/%kernel.project_dir%/";
$database_Url = preg_replace($replace, $dir, $database_Url);


$database = array(
    "url" => $database_Url
);



$entityManager = EntityManager::create($database, $config);
$em = $entityManager;