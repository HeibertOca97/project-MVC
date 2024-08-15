<?php
/*
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
*/
define('CONTROLLER_DEFAULT', "Home");
define('METHOD_DEFAULT', "index");
define('PATH', realpath(dirname(__DIR__)) . "/");
date_default_timezone_set("America/Guayaquil");

error_reporting(E_ERROR);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set('error_log', PATH . "config/php-error.log");