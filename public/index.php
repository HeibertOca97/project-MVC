<?php

require_once './config/Autoload.php';

try {
    config\Autoload::run();

    new core\Routing();
}catch(\Error $err){
    core\help\Logger::info($err->getMessage());
    print $err->getMessage();
}

