<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200); // Responder OK
    exit(); // Salir del script
}

header("Content-Type: application/json; charset=utf-8");

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    include("db.php");

    $stmt = $conn->prepare("SELECT * FROM estudiantes WHERE id = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();
    
    $response = [];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $response[] = $row;
        }
    }

    echo json_encode($response);

    $stmt->close();
    $conn->close();
}
?>
