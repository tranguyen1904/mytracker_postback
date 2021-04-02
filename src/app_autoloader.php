<?php

$mapping = [

    'APIResponse' => './APIResponse.php',
    'RestfulAPI' => './RestfulAPI.php',

    'BaseController' => './controller/BaseController.php',
    'PostbackController' => './controller/PostbackController.php',

    'APIContext' => './dbaccess/APIContext.php',
    'DBConnection' => './dbaccess/DBConnection.php',


    'ApiConfig' => './config/ApiConfig.php',
];

spl_autoload_register(function ($class) use ($mapping) {
    if (isset($mapping[$class])) {
        require_once $mapping[$class];
    }
}, true);