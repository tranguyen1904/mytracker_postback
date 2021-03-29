<?php

$mapping = [

    'AppResponse' => './AppResponse.php',
    'DataAccess' => './DataAccess.php',
    'RestfulAPI' => './RestfulAPI.php',
    'PostbackController' => './PostbackController.php',
    'APIContext' => './APIContext.php',
    'ApiConfig' => './config/ApiConfig.php',
];

//----------------------------------------------------------------------------------------------------------------------
spl_autoload_register(function ($class) use ($mapping) {
    if (isset($mapping[$class])) {
        require_once $mapping[$class];
    }
}, true);