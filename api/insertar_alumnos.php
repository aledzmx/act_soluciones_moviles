<?php

header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=utf-8");

if(isset($_GET["nombre"])){

$nombre=$_GET["nombre"];
$apellidos=$_GET["apellidos"];

include("db.php");

$stmt = $conn->prepare("INSERT INTO estudiantes (nombre, apellidos) VALUES (?,?)");
$stmt->bind_param("ss",$nombre,$apellidos);

if($stmt->execute()){
    http_response_code(201);
    echo json_encode([
        "status"=>"success",
        "menssage"=>"Datos insertados correctamente",
        "insert_id"=>$stmt->insert_id
    ]);
}else{
    http_response_code(500);
    echo json_encode([
        "status"=>"error",
        "menssage"=>"Error al insertar los datos"
    ]);

}

}