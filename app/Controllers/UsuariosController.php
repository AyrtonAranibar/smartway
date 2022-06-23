<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios;
use App\Controllers\Gmaps;
use App\Libraries\Googlemaps;
use App\Libraries\Dijkstra;
use App\Libraries\Graph;
require ROOTPATH.'/app/Libraries/Dijkstra.php';

class UsuariosController extends Controller{
    public function index(){
        $usuarios = new Usuarios();
        $datos['usuarios'] = $usuarios->where('activo',1)->orderBy('id','ASC')->findAll();

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
    public function guardarUsuario(){
        $usuario = new Usuarios();
        $username = $this->request->getVar('usuario');//ignorar, error de Visual Code
        $nombres = $this->request->getVar('nombre');//ignorar, error de Visual Code
        $apellidos = $this->request->getVar('apellidos');
        $correo = $this->request->getVar('correo');
        $contrasena = $this->request->getVar('contrasena');
        $tipo = $this->request->getVar('tipo');
        $datos=array(
            'nombres'       =>  $nombres,
            'apellidos'     =>  $apellidos,
            'nombre_usuario'=>  $username,
            'contrasenia'   =>  $contrasena,
            'email'         =>  $correo,
            'tipo_usuario'  =>  $tipo,
        ); 
        $usuario->insert($datos);
        return view('login/logeo.php');
    }
    public function ingresarUsuario(){
        $todo_usuarios = new Usuarios();
        $username = $this->request->getVar('username');//ignorar, error de Visual Code
        $contrasena = $this->request->getVar('contrasena');//ignorar, error de Visual Code
        $usuarios = $todo_usuarios->findAll();
        foreach($usuarios as $usuario){
            if($username == $usuario['nombre_usuario'] and $contrasena == $usuario['contrasenia']){
                if($usuario['tipo_usuario']==1 or $usuario['tipo_usuario']==0){
                    $datos['usuarios'] = $todo_usuarios->orderBy('id','ASC')->findAll();
                    $datos['cabecera']=view('base/header');
                    $datos['pie']=view('base/footer');
                    return view('usuarios/usuarios_list' , $datos);
                }
                if($usuario['tipo_usuario']==3){
                
                $google = new  \App\Libraries\Googlemaps();

                $config = array();
                $config['center'] = 'auto';
                $config['onboundschanged'] = 'if (!centreGot) {
                var mapCentre = map.getCenter();
                marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(),      mapCentre.lng()) 
                });
                }
                centreGot = true;';
                $nodes = [['PUNTO 1','-16.3910877835','-71.54671308'],['PUNTO 2','-16.3743452','-71.5665099'],['PUNTO 3','-16.39889','-71.535'], ];
                //$config['directionsStart'] = '-16.3910877835, -71.54671308';
                //$config['directionsEnd'] = '-16.3743452, -71.5665099';
                $config['directionsDivID'] = 'directionsDiv';
                $google->initialize($config);
                $marker = array();
                $marker['position'] = '-16.39889, -71.535';
                $google->add_marker($marker);
                $data['map'] = $google->create_map();

                $g = new  \App\Libraries\Graph();


                $g->addedge("PUNTO A", "PUNTO B", $this->getDistanceBetweenPointsNew($nodes[0][1], $nodes[0][2],$nodes[1][1], $nodes[1][2], 'kilometers'));
                $g->addedge("PUNTO A", "PUNTO C", $this->getDistanceBetweenPointsNew($nodes[0][1], $nodes[0][2],$nodes[2][1], $nodes[2][2], 'kilometers'));
                $g->addedge("PUNTO B", "PUNTO C", $this->getDistanceBetweenPointsNew($nodes[1][1], $nodes[1][2],$nodes[2][1], $nodes[2][2], 'kilometers'));
                $g->addedge("PUNTO C", "PUNTO A", $this->getDistanceBetweenPointsNew($nodes[2][1], $nodes[2][2],$nodes[0][1], $nodes[0][2], 'kilometers'));


                list($distances, $prev) = $g->paths_from("PUNTO A");
                
                $path = $g->paths_to($prev, "PUNTO C");
                
                print_r($path);


                return view('marker.php', $data);
                }
            }
        }
        $respuesta=array(
            'respuesta' =>"Usuario o contraseña incorrectos"
        );
        return view('login/logeo.php',$respuesta);
    }

    function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
        switch($unit) { 
          case 'miles': 
            break; 
          case 'kilometers' : 
            $distance = $distance * 1.609344; 
        } 
        return (round($distance,2)); 
    }
    
}