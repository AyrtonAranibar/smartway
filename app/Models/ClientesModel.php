<?php 
namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model{
    protected $table      = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres','apellidos','dni','observacion','direccion','latitud','longitud','email','celular'];
}