<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientesModel;
class ClientesController extends Controller{
    public function index(){
        $clientes = new ClientesModel();
        $datos['clientes'] = $clientes->orderBy('id','ASC')->findAll();

        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');

        return view('clientes/clientes_list' , $datos);
    }
    public function crearCliente(){
        
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('clientes/clientes_create', $datos);
    }
    public function editarclientes(){
        
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('clientes/clientes_edit', $datos);
    }
    public function verclientes(){
        
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('clientes/clientes_view', $datos);
    }
}