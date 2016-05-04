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

$app->post("/login-conductor", function() use($con,$app){
	//$query="SELECT id FROM conductores WHERE password = "'{$app->request->post("password")}'" AND (username = "'{$app->request->post("username")}'" OR email = "'{$app->request->post("email")}'")";
	$query = $con->query("SELECT * FROM conductores WHERE password='{$app->request->post("password")}' AND (username='{$app->request->post("username")}' OR email='{$app->request->post("email")}');");

	$conductores = array();
	while($fila=$query->fetch_assoc()){
		$conductores[]=$fila;
	}

	echo json_encode ($conductores);

	//var_dump($conductores["id"]);
	//$id = $conductores["id"];
	//$result = array("STATUS" => "true", "id" => "$id", "message" => "Usuario existe");

	//$login = $con->query($query);
	//var_dump($login);

	//SELECT id from conductores WHERE password="123456" AND (username="leinva" OR email="aaleiva93@gmail.com")

	/*if($query){
		$result = array("STATUS" => "true", "id" => "$id", "message" => "Usuario existe");
	}else{
		$result = array("STATUS" => "false", "message" => "Usuario NO existe");
	}

	echo json_encode($result);*/

});

$app->run();
