<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PedidosModel;

class PedidosController extends Controller{

    public function index(){
        $pedidos = new PedidosModel();
        $datos['pedidos'] = $pedidos->orderBy('id','ASC')->findAll();

        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');

        return view('pedidos/pedidos_list' , $datos);
    }
}