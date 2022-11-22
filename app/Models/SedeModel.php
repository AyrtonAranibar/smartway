<?php 
namespace App\Models;

use CodeIgniter\Model;

class SedeModel extends Model{
    protected $table      = 'sede';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','longitud','latitud'];
}