<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once "vendor/autoload.php";
include "php/conexion.php";

$app = new \Slim\Slim();

$app->post("/registrar-conductor", function() use($con,$app){
	$query="INSERT INTO conductores VALUES (NULL,"
	. "'{$app->request->post("fullname")}',"
	. "'{$app->request->post("username")}',"
	. "'{$app->request->post("email")}',"
	. "'{$app->request->post("mobile")}',"
	. "'{$app->request->post("passwdord")}',"
	. "'{$app->request->post("created_at")}'"
	. ")";
	$insert = $con->query($query);

	if($insert){
		$result = array("STATUS" => "true", "message" => "Usuario creado correctamente");
	}else{
		$result = array("STATUS" => "false", "message" => "Usuario NO creado correctamente");
	}

	echo json_encode($result);

});

$app->run();
