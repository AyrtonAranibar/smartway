<?=$cabecera?>

<h1>Sede Única</h1>
    <div class="container">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Nombre de la sede</th> 
                    <th>Longitud</th>
                    <th>Latitud</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sede as $edificio):?>
                <tr>
                    <td><?=$edificio['nombre']?></td>
                    <td><?=$edificio['longitud']?></td>
                    <td><?=$edificio['latitud']?></td>
                    <td><a href="<?= base_url()?>/editar_sede" class="btn btn-primary">Editar</a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?=$pie?>
