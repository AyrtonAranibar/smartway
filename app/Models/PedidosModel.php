<?php 
namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model{
    protected $table     = 'pedido_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha','subtotal','igv','total','id_cliente','id_transportista','observaciones'];
}