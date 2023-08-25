<?php
require_once "./php/conexion.php"; 

$conexion = new Conexion();
$connection = $conexion->getConnection();

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["existencia"])) {
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $existencia = $_POST["existencia"];

        try {
            $sql = "INSERT INTO Productos(nombre, descripcion, precio, existencia) VALUES (:nombre, :descripcion, :precio, :existencia)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':existencia', $existencia);

            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Producto Agregado Correctamente</div>';
            } else {
                echo '<div class="alert alert-danger">Producto No Agregado, revise de nuevo.</div>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo '<div class="alert alert-danger">Campos Vacíos.</div>';
    }
}

$connection = null;
?>