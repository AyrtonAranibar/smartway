<?=$cabecera?>

<h1>Lista de Pedidos</h1>
    <div class="container">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Fecha Creación</th> 
                    <th>Subtotal</th>
                    <th>IGV</th>
                    <th>Total</th>
                    <th>ID cliente</th>
                    <th>TD transportista</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pedidos as $pedido):?>
                <tr>
                    <td><?=$pedido['fecha']?></td>
                    <td><?=$pedido['subtotal']?></td>
                    <td><?=$pedido['igv']?></td>
                    <td><?=$pedido['total']?></td>
                    <td><?=$pedido['id_cliente']?></td>
                    <td><?=$pedido['id_transportista']?></td>
                    <td><?=$pedido['observaciones']?></td>
                    <td><button class="btn btn-danger">Eliminar</button><button class="btn btn-primary">Editar</button><button class="btn btn-secondary">ver</button></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?=$pie?>
