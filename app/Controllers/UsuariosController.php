<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios;


class UsuariosController extends Controller{
    public function index(){
        
        return view('usuarios/usuarios_list');
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