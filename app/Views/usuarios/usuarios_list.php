<?=$cabecera?>

<h1 class="mb-5">Lista de Usuarios</h1>
    <div class="container-fluid">
        <table class="table table-hover table-light">
            <thead class="thead-light table-dark ">
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Tipo</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Imagen</th>
                    <th>Creado</th> 
                    <th>Ciudad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario):?>
                <tr>
                    <td><?=$usuario['nombre_usuario']?></td>
                    <td><?=$usuario['nombres']?></td>
                    <td><?=$usuario['apellidos']?></td>
                    <td><?php
                    switch($usuario['tipo_usuario']){
                        case 0:
                            echo 'Super admin';
                            break;
                        case 1:
                            echo 'Administrador';
                            break;
                        case 2:
                            echo 'Empleado';
                            break;
                        case 3:
                            echo 'Chofer';
                            break;
                        
                    }
                    ?></td>
                    <td><?=$usuario['email']?></td>
                    <td><?=$usuario['observacion']?></td>
                    <td><?=$usuario['imagen']?></td>
                    <td><?=$usuario['fecha_creado']?></td>
                    <td><?=$usuario['ciudad']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?=$pie?>
