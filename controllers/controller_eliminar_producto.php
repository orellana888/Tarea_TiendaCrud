<?php

require_once "./php/conexion.php"; 

$conexion = new Conexion();
$connection = $conexion->getConnection();

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $connection->prepare("DELETE FROM Productos WHERE id=:id");
    $sql->bindParam(':id', $id);

    if ($sql->execute() && $sql->rowCount() > 0) {
        echo '<div class="alert alert-success">Producto eliminado</div>';
    } else {
        echo '<div class="alert alert-danger">Error al eliminar producto.</div>';
    }
}


?>