<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once "vendor/autoload.php";

$app = new \Slim\Slim();




$app->run();
?>