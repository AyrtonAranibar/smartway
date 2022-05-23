<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Vehiculos;

class VehiculosController extends Controller{

    public function index(){

        return view('vehiculos/vehiculos_list');

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