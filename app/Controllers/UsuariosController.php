<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios;


class UsuariosController extends Controller{
    public function index(){
        $usuarios = new Usuarios();
        $datos['usuarios'] = $usuarios->orderBy('id','ASC')->findAll();

        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');

        return view('usuarios/usuarios_list' , $datos);
    }
    public function crearUsuario(){
        
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('usuarios/usuarios_create', $datos);
    }
    public function editarUsuarios(){
        
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('usuarios/usuarios_edit', $datos);
    }
    public function verUsuarios(){
        
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('usuarios/usuarios_view', $datos);
    }

}