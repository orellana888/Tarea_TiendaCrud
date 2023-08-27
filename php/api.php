<?php
require_once './conexion.php';

// Definir las cabeceras para permitir peticiones desde otros dominios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Crear una instancia de la clase Conexion
$con = new Conexion();
$connection = $con->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $nombre = $_POST['username'];
    $contrasena = $_POST['password'];

    $sql = "SELECT id, password FROM usuarios WHERE username = :username";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':username', $nombre, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($contrasena, $row['password'])) {
        http_response_code(200);
        echo json_encode(["mensaje" => "¡Bienvenido! Inicio de sesión exitoso"]);
    } else {
        http_response_code(401);
        echo json_encode(["mensaje" => "Credenciales incorrectas"]);
    }
    
} else {
    http_response_code(400);
    echo json_encode(["mensaje" => "Solicitud incorrecta"]);
}

?>
