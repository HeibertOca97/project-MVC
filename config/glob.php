<?php

define("APP", "MVC");
define('CONTROLLER_DEFAULT', "Home");
define('METHOD_DEFAULT', "index");
define('URL', "http://localhost/www/backend/php/mvc1/");
define('PATH', $_SERVER['DOCUMENT_ROOT'] . "/www/backend/php/mvc1/");

error_reporting(E_ALL);

ini_set('ignore_repeated_errors', TRUE);

ini_set('display_errors', FALSE);

ini_set('log_errors', FALSE);

ini_set('error_log', "./config/log/php-error.log");
