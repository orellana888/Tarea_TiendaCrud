<!DOCTYPE html>
<html>
<head>
    <style>
    .my-body {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #fce38a, #f38181);
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    height: 100%;
    min-height: calc(100% - 70px);
}

.login {
    width: 360px;
    height: min-content;
    padding: 20px;
    margin-top: 175px;
    border-radius: 12px;
    background: linear-gradient(135deg, #fce38a, #f38181);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}



.login h2 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 14px;
    margin-bottom: 8px;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-sucess {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #8B0000;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-sucess:hover {
    background-color: #6B0000;
}

.error {
    font-weight: bold;
    margin: 5px;
    padding: 5px;
    text-align: center;
    color: #d9534f;
}
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
    

    <title>Iniciar Sesión</title>
</head>

<body class="my-body">
    
    <div class="login">

    <h2 class="text-center">Iniciar Sesión</h2>

    <form action="./php/session.php" method="post">
        <div class="form-group">
            <label class="form-label" for="username_email"><span style="color: red; padding-right: 5px;">*</span>Usuario</label>
            <input class="form-control" type="text" id="username_email" name="username_email" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="password"><span style="color: red; padding-right: 5px;">*</span>Contraseña:</label>
            <input class="form-control" type="password" id="password" name="password" required>    
        </div>

        <div class="form-group">
            <button class="btn btn-sucess w-100" type="submit">Iniciar Sesión</button>
            <br>

        </div>
    
    <?php
    if (isset($_GET['error'])) {
        echo "<p class='error'>Credenciales de inicio de sesión incorrectas.</p>";
    }
?>
</div> 

<?php
    require_once('php/footer.php');
?>  

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>

</html>