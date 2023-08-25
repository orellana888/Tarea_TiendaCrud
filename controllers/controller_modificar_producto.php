<?php 
require_once "../php/conexion.php"; 

$conexion = new Conexion();
$connection = $conexion->getConnection();

if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["existencia"])) {
        $id = $_GET["id"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $existencia = $_POST["existencia"];

        try {
            $sql = $connection->prepare("UPDATE Productos SET nombre=:nombre, descripcion=:descripcion, precio=:precio, existencia=:existencia WHERE id=:id");
            $sql->bindParam(':nombre', $nombre);
            $sql->bindParam(':descripcion', $descripcion);
            $sql->bindParam(':precio', $precio);
            $sql->bindParam(':existencia', $existencia);
            $sql->bindParam(':id', $id);
            
            if ($sql->execute() && $sql->rowCount() > 0) {
                header("Location: ../index.php");
            } else {
                echo '<div class="alert alert-danger">Error al modificar.</div>';
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