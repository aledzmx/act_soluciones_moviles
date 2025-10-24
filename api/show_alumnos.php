<?php

header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=utf-8");

$id= $_GET["id"];
include("db.php");

$sql ="SELECT * FROM estudiantes where id=".$id;

$result = $conn->query($sql);
$response= [];

if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $response[]=$row;
    }
}

echo json_encode($response);