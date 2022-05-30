<?=$cabecera?>

<h1>Lista de Clientes</h1>
    <div class="container">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Nombre del Cliente</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Observacion</th>
                    <th>Direccion</th>
                    <th>Latitud</th>
                    <th>Longitud</th> 
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clientes as $cliente):?>
                <tr>
                    <td><?=$cliente['nombres']?></td>
                    <td><?=$cliente['apellidos']?></td>
                    <td><?=$cliente['dni']?></td>
                    <td><?=$cliente['observacion']?></td>
                    <td><?=$cliente['direccion']?></td>
                    <td><?=$cliente['latitud']?></td>
                    <td><?=$cliente['longitud']?></td>
                    <td><?=$cliente['email']?></td>
                    <td><?=$cliente['celular']?></td>
                    <td><button class="btn btn-danger">Eliminar</button><button class="btn btn-primary">Editar</button><button class="btn btn-secondary">ver</button></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?=$pie?>
