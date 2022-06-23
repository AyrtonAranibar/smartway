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
        <?php if (empty($respuesta)==false){ ?>

        <div id="alerta" class="alert alert-danger" role="alert">
            <?=$respuesta?>
            <svg class="bi" width="32" height="32" fill="currentColor">
            <use xlink:href="<?=base_url()?>/assets/bootstrap5/bootstrap-icons/bootstrap-icons.svg#x"/>
            </svg>
        </div>

        <?php }?>
        <h4>Autentificación</h4>
        <form action="<?=site_url('/ingresar_usuario')?>" method="post">
            <label for="username">Ingresa tu nombre de usuario</label>
            <input type="text" id="username" name="username" placeholder="Marcelo123" autocomplete="off">
            <label for="contrasena">Ingresa contraseña</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="************" autocomplete="off"><br>
            <a class="olvide"><p>olvidé mi contraseña</p></a>
            <div class="buttons-content">
            <input type="submit" value="Ingresar"><a href="<?php echo base_url('/registrarse')?>" class="registrarse-button">Registrarse</a>
            </div>
        </form>
    </div>
</body>
</html>
<script>
    alerta=document.getElementById('alerta');
    alerta.addEventListener('click',function(){
        alerta.remove();
    });
</script>