<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar</title>
    <?php include('css.php')?>
</head>
<body>
    <div class="contenedor">
        <h4>Autentificación</h4>
        <form action="" method="post">
            <label for="correo">Ingresa tu correo</label>
            <input type="text" id="correo" name="correo" placeholder="ejemplo@mail.com" autocomplete="off">
            <label for="contrasena">Ingresa contraseña</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="************" autocomplete="off"><br>
            <a class="olvide"><p>olvidé mi contraseña</p></a>
            <div class="buttons-content">
            <input type="submit"><a href="<?php echo base_url() ?>/registrarse" class="registrarse-button">Registrarse</a>
            </div>
        </form>
    </div>
</body>
</html>