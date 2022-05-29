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
        <h4>Ingresa tus datos</h4>
        <form action="" method="post">
            <label for="correo">Ingresa tu correo</label>
            <input id="correo" name="correo" placeholder="ejemplo@mail.com">
            <label for="correo">Ingresa contraseña</label>
            <input id="correo" name="correo" placeholder="ejemplo@mail.com"><br>
            <a><p>olvidé mi contraseña</p></a>
            <input type="submit">
        </form>
    </div>
    <?php include('js.php')?>
</body>
</html>