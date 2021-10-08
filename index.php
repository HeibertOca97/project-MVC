<?php
require_once './Config/glob.php';
require_once './Config/Autoload.php';

//Autoload - load file
Config\Autoload::run();

//Configuration - Router and Request application
new Core\Core();