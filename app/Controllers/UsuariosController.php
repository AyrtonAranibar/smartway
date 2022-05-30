<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios;


class UsuariosController extends Controller{
    public function index(){
        $usuarios = new Usuarios();
        $datos['usuarios'] = $usuarios->orderBy('id','ASC')->findAll();
        return view('usuarios/usuarios_list' , $datos);
    }
    public function crearUsuario(){
        
        return view('usuarios/usuarios_create');
    }
    public function editarUsuarios(){
        
        return view('usuarios/usuarios_edit');
    }
    public function verUsuarios(){
        
        return view('usuarios/usuarios_view');
    }

}