<?php
require_once "../php/conexion.php"; 
$conexion = new Conexion();
$connection = $conexion->getConnection();

$id = $_GET["id"];

try {
    $stmt = $connection->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="icon" href="../upload/product11.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
</head>
<body>
<a href="../index.php" class="btn btn-sm btn-warning m-3 ml-5"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
<div class="container" style="margin-bottom: 10rem;">
<h2 class="text-center">Modificar Productos</h2>
    <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
    <?php 
    include "../controllers/controller_modificar_producto.php";
    ?>
    <form method="post">
        <div class="form-group">
            <label for="nombre"><span style="color: red">*</span> Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto->nombre; ?>">
        </div>
        <div class="form-group">
            <label for="descripcion"><span style="color: red">*</span> Descripción</label>
            <input class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto->descripcion; ?>">
        </div>
        <div class="form-group">
            <label for="precio"><span style="color: red">*</span> Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto->precio; ?>">
        </div>
        <div class="form-group">
            <label for="existencia"><span style="color: red">*</span> Existencia</label>
            <input type="number" class="form-control" id="existencia" name="existencia" value="<?php echo $producto->existencia; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="btnmodificar" value="ok">Modificar Producto</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
