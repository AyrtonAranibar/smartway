<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Vehiculos;

class VehiculosController extends Controller{

    public function index(){
        $vehiculo = new Vehiculos();
        $datos['vehiculos'] = $vehiculo->orderBy('id','ASC')->findAll;
        return view('vehiculos/vehiculos_list',$datos);
        var_dump($datos);
    }
    public function crearVehiculos(){
        
        return view('vehiculos/vehiculos_create');
    }
    public function editarVehiculos(){
        
        return view('vehiculos/vehiculos_edit');
    }
    public function verVehiculos(){
        
        return view('vehiculos/vehiculos_view');
    }
}