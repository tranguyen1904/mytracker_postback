<?php
namespace API;

require_once ('./app_autoloader.php');

$cApiHandler = new RestfulAPI();
$cApiHandler->response();