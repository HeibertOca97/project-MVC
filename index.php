<?php

require_once './config/glob.php';
require_once './vendor/autoload.php';

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (\Exception $ex) {
    print $ex->getMessage();
}


try {
    $appRoute = "./public/index.php";
    if (!file_exists($appRoute)) throw new \Exception("<p>Problema al encontrar su directorio <strong>public/</strong> revice su archivo <strong>index.php</strong></p>");
    
    require_once $appRoute; 
}catch (\Exception $ex){
    echo $ex->getMessage();
}

