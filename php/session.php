<?php
require_once('conexion.php');

$username_email = $_POST['username_email'];
$password = $_POST['password'];

// Instanciando la clase Conexion
$db = new Conexion();

// Obteniendo el objeto PDO
$conn = $db->getConnection();

// Consulta SQL para buscar un usuario con el nombre de usuario y contraseña proporcionados
$sql = "SELECT * FROM usuarios WHERE (username = ? OR email = ?) AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username_email, $username_email, $password]);

// Si se encuentra el usuario, crear una sesión y redirigirlo a la página de inicio de sesión
if ($stmt->rowCount() > 0) {
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username_email'] = $username_email;
    header('Location: ../index.php');
} else {
    header('Location: ../login.php?error=6969');
}


?>