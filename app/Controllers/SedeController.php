<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SedeModel;

class SedeController extends Controller{

    public function index(){
        $sede = new SedeModel();
        $datos['sede'] = $sede->orderBy('id')->findAll();

        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');

        return view('sede/sede_list' , $datos);
    }

    public function editarSede(){
        $sede = new SedeModel();
        $edificio = $sede->orderBy('id')->findAll();
        $edificio = $edificio[0];
        $datos['sede'] = $edificio;
        $datos['cabecera'] = view('base/header');
        $datos['pie'] = view('base/footer');
        return view('sede/sede_edit' , $datos);
    }

    public function guardarSede(){
        $sede = new SedeModel();
        $nombre = $this->request->getVar('nombre');
        $latitud = $this->request->getVar('latitud');
        $longitud = $this->request->getVar('longitud');
        $datos = [
            'nombre'    =>  $nombre,
            'latitud'   =>  $latitud,
            'longitud'  =>  $longitud
        ];
        $sede->update( 1, $datos);
        return $this->index();
    }
}