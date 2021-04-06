<?php
echo "a";

// require __DIR__ . '/vendor/autoload.php';
require_once ('./app_autoloader.php');
echo "a";
$cApiHandler = new PostbackAPI\RestfulAPI();
$cApiHandler->response();