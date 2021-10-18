<?php

return array(
    'MAIL' => array(
        'M_HOST' => $_ENV['M_HOST'],
        'M_USERNAME' => $_ENV['M_USERNAME'],
        'M_PASSWORD' => $_ENV['M_PASSWORD'],
        'M_PORT' => $_ENV['M_PORT'] ? $_ENV['M_PORT'] : 465,
    )
);
