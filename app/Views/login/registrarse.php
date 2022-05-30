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
        <h4>Registrarse</h4>
        <form action="" method="post">
            <label for="nombre">Nombres</label>
            <input type="text" id="nombre" name="nombre" placeholder="Marcelo Edmundo" autocomplete="off" required >
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Castillo Hualpa" autocomplete="off" required >
            <label for="correo">Correo</label>
            <input type="text" id="correo" name="correo" placeholder="ejemplo@mail.com" autocomplete="off" value="" required >
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="************" autocomplete="off" value=""  required >
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" placeholder="selecciona una opcion" required>
                <option value="1">Administrador</option>
                <option value="2">Chofer</option>
            </select>
            <br>
            <div class="buttons-content">
            <input type="submit"><a href="<?php echo base_url() ?>/ingresar" class="registrarse-button">Atrás</a>
            </div>
        </form>
    </div>
</body>
</html>
<script>
    window.addEventListener('load', (event) => {
    });
</script>