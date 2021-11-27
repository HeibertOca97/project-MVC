<?php

return array(
    'APP' => array(
        "NAME" => $_ENV['APP_NAME'],
        "URL" => $_ENV['APP_URL'],
    ),

    'MAIL' => array(
        'M_HOST' => $_ENV['M_HOST'],
        'M_USERNAME' => $_ENV['M_USERNAME'],
        'M_PASSWORD' => $_ENV['M_PASSWORD'],
        'M_PORT' => $_ENV['M_PORT'] ? $_ENV['M_PORT'] : 465,
    ),

    'DATABASE' => array(
        "DRIVER" => $_ENV['DB_DRIVE'],
        "HOST" => $_ENV['DB_HOST'],
        "USER" => $_ENV['DB_USER'],
        "PASS" => $_ENV['DB_PASS'],
        "NAME" => $_ENV['DB_NAME'],
        "CHARSET" => $_ENV['DB_CHARSET'],
    ),

);
