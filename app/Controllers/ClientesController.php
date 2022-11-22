<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientesModel;
use App\Libraries\Googlemaps;
use App\Libraries\Dijkstra;
use App\Libraries\Graph;
use App\Models\SedeModel;

class ClientesController extends Controller{
    public function index(){
        $clientes = new ClientesModel();
        $datos['cliente'] = $clientes->orderBy('id','ASC')->findAll();
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('clientes/clientes_list' , $datos);
    }

    public function crearCliente(){
    
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('clientes/clientes_create', $datos);
    }


    public function clienteCreado(){
        $clientes = new ClientesModel();
        $nombres = $this->request->getVar('nombres');
        $apellidos = $this->request->getVar('apellidos');
        $dni = $this->request->getVar('dni');
        $observacion = $this->request->getVar('observacion');
        $direccion = $this->request->getVar('direccion');
        $latitud = $this->request->getVar('latitud');
        $longitud = $this->request->getVar('longitud');
        $email = $this->request->getVar('email');
        $celular = $this->request->getVar('celular');

        $datos = [
            'nombres'    =>  $nombres,
            'apellidos'   =>  $apellidos,
            'dni'  =>  $dni,
            'observacion'  =>  $observacion,
            'direccion'  =>  $direccion,
            'latitud'  =>  $latitud,
            'longitud'  =>  $longitud,
            'email'  =>  $email,
            'celular'  =>  $celular
        ];
        $clientes->insert($datos);

        return $this->index();
    }


    public function editarCliente($id = null){
        $clientes = new ClientesModel();
        
        $datos['cliente'] = $clientes->where('id', $id)->first();
        $datos['cabecera'] = view('base/header');
        $datos['pie'] = view('base/footer');
        return view('clientes/clientes_edit' , $datos);
    }

    public function guardarCliente($id){
        $clientes = new ClientesModel();
        $nombres = $this->request->getVar('nombres');
        $apellidos = $this->request->getVar('apellidos');
        $dni = $this->request->getVar('dni');
        $observacion = $this->request->getVar('observacion');
        $direccion = $this->request->getVar('direccion');
        $latitud = $this->request->getVar('latitud');
        $longitud = $this->request->getVar('longitud');
        $email = $this->request->getVar('email');
        $celular = $this->request->getVar('celular');

        $datos = [
            'nombres'    =>  $nombres,
            'apellidos'   =>  $apellidos,
            'dni'  =>  $dni,
            'observacion'  =>  $observacion,
            'direccion'  =>  $direccion,
            'latitud'  =>  $latitud,
            'longitud'  =>  $longitud,
            'email'  =>  $email,
            'celular'  =>  $celular
        ];
        $clientes->update( $id, $datos);

        return $this->index();
    }

    public function verCliente(){
        
        $datos['cabecera']=view('base/header');
        $datos['pie']=view('base/footer');
        return view('clientes/clientes_view', $datos);
    }

    public function optimizarRutas(){
        $sede = new SedeModel();
        $sede = $sede->where('id',1)->first();

        $google = new  \App\Libraries\Googlemaps();
        $posicion_local=[$sede['latitud'], $sede['longitud']];
        $posicion_latitud = $sede['latitud'];
        $posicion_longitud = $sede['longitud'];
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) { var mapCentre = map.getCenter(); marker_0.setOptions({ 
                                    position: new google.maps.LatLng(mapCentre.lat(),mapCentre.lng()) });}centreGot = true;';
        $config['center'] = $posicion_local[0].','.$posicion_local[1];
        $config['zoom'] = 'auto';
        $config['directions'] = TRUE;
        $config['directionsMode'] = "DRIVING"; //modes: DRIVING WALKING BICYCLING
        $config['directionsStart'] = $posicion_local[0].','.$posicion_local[1];
        $coordenadas = $this->generarListaCoordenadas();
        //optimizacion
        $ch = curl_init();
        //tu api key de routeservice optimizacion v1
        $api_key = "pk.eyJ1Ijoid29sZmdhbmcxIiwiYSI6ImNsYTY2OG80bzFjcXEzb21uNGk5Z25zNW4ifQ.Psv8h5qGk6ipigikuH0IgA";
        $url = 'https://api.mapbox.com/optimized-trips/v1/mapbox/driving-traffic/'.$coordenadas.'?access_token='.$api_key;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) echo curl_error($ch);
        else $decoded = json_decode($response, true);
        curl_close($ch);
        $rutas_optimizadas = $decoded["waypoints"];
        $nuevas_coordenadas = $this->generarArrayCoordenadas($posicion_local);

        $config['directionsWaypointArray'] = $nuevas_coordenadas;
        $config['directionsEnd'] = $posicion_local[0].','.$posicion_local[1];
        $config['directionsDivID'] = 'directionsDiv';
        $google->initialize($config);
        $mapa['map'] = $google->create_map();

        // return $mapa;
        return view('marker.php', $mapa);
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

    public function generarListaCoordenadas(){
        $clientes = new ClientesModel();
        $datos['clientes'] = $clientes->where('activo',1)->orderBy('id','ASC')->findAll();
        $coordenadas = array();
        $coordenadas_lat = array();
        $coordenadas_lon = array();
        $conjunto_coordenadas = "";
        foreach ($datos['clientes'] as $cliente){
            $coordenada = $cliente['longitud'].','.$cliente['latitud'].';';
            $conjunto_coordenadas = $conjunto_coordenadas.$coordenada;
        }
        $conjunto_coordenadas = substr($conjunto_coordenadas, 0, -1);

        return $conjunto_coordenadas;
    }

    public function generarArrayCoordenadas($posicion_local){
        $clientes = new ClientesModel();
        $datos['clientes'] = $clientes->where('activo',1)->orderBy('id','ASC')->findAll();
        $coordenadas = array();
        $coordenadas_lat = array();
        $coordenadas_lon = array();
        foreach ($datos['clientes'] as $cliente){
            $coordenada = $cliente['latitud'].', '.$cliente['longitud'];
            array_push($coordenadas, $coordenada);
        }

        return $coordenadas;
    }

}