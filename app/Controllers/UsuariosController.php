<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios;
use App\Models\ClientesModel;
use App\Models\PedidosModel;
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
                
                
                $mapa=$this->dibujarMapa();

                return view('marker.php', $mapa);
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
    function dibujarMapa(){
        $google = new  \App\Libraries\Googlemaps();
        $posicion_local='-16.391250525, -71.542904013';
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
        var mapCentre = map.getCenter();
        marker_0.setOptions({
        position: new google.maps.LatLng(mapCentre.lat(),      mapCentre.lng()) 
        });
        }
        centreGot = true;';

        $config['center'] = $posicion_local;
        $config['zoom'] = 'auto';
        $config['directions'] = TRUE;
        $config['directionsMode'] = "DRIVING"; //modes: DRIVING WALKING BICYCLING
        $config['directionsStart'] = $posicion_local;
        $coordenadas = $this->generarArrayCoordenadas($posicion_local);
        print_r($coordenadas);
        $config['directionsWaypointArray'] = $coordenadas;
        $config['directionsEnd'] = $posicion_local;
        $config['directionsDivID'] = 'directionsDiv';
        $google->initialize($config);
        $mapa['map'] = $google->create_map();

        return $mapa;
    }

    public function generarArrayCoordenadas($posicion_local){
        $clientes = new ClientesModel();
        $datos['clientes'] = $clientes->where('activo',1)->orderBy('id','ASC')->findAll();
        $coordenadas = array();
        $coordenadas_lat = array();
        $coordenadas_lon = array();
        foreach ($datos['clientes'] as $cliente){
            //$coordenada_lat = floatval($cliente['latitud']);
            //$coordenada_lon = floatval($cliente['longitud']);
            $coordenada = $cliente['latitud'].', '.$cliente['longitud'];
            array_push($coordenadas, $coordenada);
        }
        //$coordenadas= $this->generarCaminoMasCorto($coordenadas, $posicion_local);

        return $coordenadas;
    }


    public function generarCaminoMasCorto($lista_cordenadas, $posicion_local){
        $array_posicion_local = explode(',', $posicion_local);
        $posicion_local_lat = floatval($array_posicion_local[0]);
        $posicion_local_lon = floatval($array_posicion_local[1]);
        $array_results=array();

        
        $minimo=0.0;
        $index=0;
        foreach ($lista_cordenadas as $key => $coordenada){
            $resultado = $this->distanciaEntreDosPuntos($posicion_local_lat, $posicion_local_lon, $coordenada['latitud'], $coordenada['longitud']);
            if ($key == 0){
                $minimo = $resultado;
                $index=0;
            }else{
                if ($minimo > $resultado){
                    $minimo =  $resultado;
                    $index=$key;
                }
            }
        }
        array_push($array_results, array($posicion_local_lat, $posicion_local_lon ));
    }


    public function distanciaEntreDosPuntos($lat1,$lon1,$lat2,$lon2){
        $resultado=sqrt(($lat2 - $lat1)+($lon2 - $lon1));
        return $resultado;
    } 
}