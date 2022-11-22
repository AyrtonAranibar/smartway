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
                    <!-- <th>Latitud</th>
                    <th>Longitud</th>  -->
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cliente as $datos):?>
                <tr>
                    <td><?=$datos['nombres']?></td>
                    <td><?=$datos['apellidos']?></td>
                    <td><?=$datos['dni']?></td>
                    <td><?=$datos['observacion']?></td>
                    <td><?=$datos['direccion']?></td>
                    <!-- <td><?=$datos['latitud']?></td>
                    <td><?=$datos['longitud']?></td> -->
                    <td><?=$datos['email']?></td>
                    <td><?=$datos['celular']?></td>
                    <td><?php if($datos['activar_entrega']){
                        echo '<div class="alert alert-success"><strong> Activa </strong></div>';
                    }else{
                        echo '<div class="alert alert-warning"><strong> Desactivada </strong></div>';

                    }
                    ?></td>
                    <td>
                    <button class="btn btn-danger">Eliminar</button>
                    <a href="<?=base_url('editar_cliente/'.$datos['id'])?>" class="btn btn-primary">Editar</a>
                    
                    <button class="btn btn-warning">Entrega</button>
                </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?=$pie?>
