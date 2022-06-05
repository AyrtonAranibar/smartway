<?php 
namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model{
    protected $table      = 'usuarios';
    
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres','apellidos','nombre_usuario','contrasenia','email','activo','observacion','imagen','fecha_creado','ciudad','tipo_usuario','celular','sueldo'];
}