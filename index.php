<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require_once('./php/conexion.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $_GET['id'] = 0;
    $id = 0;
}

$database = new conexion();

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zapatos Online</title>
    <link rel="icon" href="upload/product11.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    .hoverable-row:hover {
    background-color: #f5f5f5; 
    cursor: pointer;
    }
    </style>
</head>

<body>

    <?php require_once("php/header.php"); ?>

    <?php 
    include "./controllers/controller_eliminar_producto.php";
    ?>
    <div class="container" style="margin-bottom: 10rem;">
    <h2 class="text-center">Agregar Productos</h2>
    <?php 
    include "./controllers/controller_agregar_producto.php";
    ?>
    <form method="post">
        <div class="form-group">
            
            <label for="nombre"><span style="color: red">*</span> Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group">
            <label for="descripcion"><span style="color: red">*</span> Descripción</label>
            <input class="form-control" id="descripcion" name="descripcion"></input>
        </div>
        <div class="form-group">
            <label for="precio"><span style="color: red">*</span> Precio</label>
            <input type="number" class="form-control" id="precio" name="precio">
        </div>
        <div class="form-group">
            <label for="existencia"><span style="color: red">*</span> Existencia</label>
            <input type="number" class="form-control" id="existencia" name="existencia">
        </div>
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok"><i class="fas fa-plus"></i> Agregar Producto</button>
    </form>
    <h2 class="text-center m-5">Tabla de Productos</h2>
    <div class="row py-3">
        <div class="container text-right">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                        <th>Existencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $productos = $database->getData(); 
                    foreach ($productos as $producto) {
                        echo '<tr class="hoverable-row">';
                        echo '<td>' . $producto['id'] . '</td>';
                        echo '<td>' . $producto['nombre'] . '</td>';
                        echo '<td>' . $producto['descripcion'] . '</td>';
                        echo '<td>' . $producto['precio'] . '</td>';
                        echo '<td>' . $producto['existencia'] . '</td>';
                        echo '<td>';
                        echo '<a href="./php/modificar_producto.php?id=' . $producto['id'] . '" class="btn btn-sm btn-warning m-2"><i class="far fa-edit"></i> Editar</a>';
                        echo '<a onclick="return eliminar()" href="./index.php?id=' . $producto['id'] . '" class="btn btn-sm btn-danger ml-2"><i class="fas fa-trash-alt"></i> Eliminar</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div class="text-center text-white footer" style="position:relative; width:100%; clear: both; margin-top: 2rem; background-color: #e3f2fd;">
        <div class=" pt-4">
            <section>
                <a class="btn btn-link btn-floating btn-lg text-black m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-facebook-f"></i></a>
    
                <a class="btn btn-link btn-floating btn-lg text-black m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-twitter"></i></a>
    
                <a class="btn btn-link btn-floating btn-lg text-black m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>
            </section>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./js/eliminar_producto.js"></script>

</body>
</html>