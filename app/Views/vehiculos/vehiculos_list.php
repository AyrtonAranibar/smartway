<?=$cabecera?>

<h1>Lista de Vehiculos</h1>
    <div class="container">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th> 
                    <th>Imagen</th>
                    <th>Activo</th>
                    <th>Fecha creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vehiculos as $vehiculo):?>
                <tr>
                    <td><?=$vehiculo['nombre_vehiculo']?></td>
                    <td><?=$vehiculo['imagen']?></td>
                    <td><?=$vehiculo['activo']?></td>
                    <td><?=$vehiculo['creado_fecha']?></td>
                    <td><button class="btn btn-danger">Eliminar</button><button class="btn btn-primary">Editar</button><button class="btn btn-secondary">ver</button></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?=$pie?>
