<?=$cabecera?>

<h1>Lista de Usuarios</h1>
    <div class="container">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Contraseña</th>
                    <th>Email</th>
                    <th>Activo</th>
                    <th>Description</th>
                    <th>Imagen</th>
                    <th>Creado</th> 
                    <th>Ciudad</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario):?>
                <tr>
                    <td><?=$usuario['nombre_usuario']?></td>
                    <td><?=$usuario['contrasenia']?></td>
                    <td><?=$usuario['email']?></td>
                    <td><?=$usuario['activo']?></td>
                    <td><?=$usuario['observacion']?></td>
                    <td><?=$usuario['imagen']?></td>
                    <td><?=$usuario['fecha_creado']?></td>
                    <td><?=$usuario['ciudad']?></td>
                    <td><button class="btn btn-danger">Eliminar</button><button class="btn btn-primary">Editar</button><button class="btn btn-secondary">ver</button></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?=$pie?>
