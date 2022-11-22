<?php 
namespace App\Controllers;
require ROOTPATH.'/app/Libraries/Dijkstra.php';
require ROOTPATH.'/vendor/autoload.php';
use CodeIgniter\Controller;
use App\Models\Usuarios;
use App\Models\ClientesModel;
use App\Models\PedidosModel;
use App\Controllers\Gmaps;
use App\Libraries\Googlemaps;
use App\Libraries\Dijkstra;
use App\Libraries\Graph;
use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\PublicKeyLoader; 
use phpseclib3\Net\SFTP;


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
        $hoy = date("Y-m-d H:i:s");

        //ENCRIPTADO PROPIO
        list($contraseña_encriptada, $ascii_resultante) = $this->encriptado_propio($username, $contrasena, $hoy);

        //cifrado RSA
        //creado de carpetas
        $filename = "C:/smartway/";
        if(!file_exists($filename)){//comprueba si no existe el archivo
            mkdir("C:/smartway", 0777); //crea una carpeta llamada smartway
        }
        $filename = "C:/smartway/".$username."/";
        if(!file_exists($filename)){
            mkdir($filename,0777);
        }  


        
        //encriptado RSA
        $private = RSA::createKey(2048); //inicializamos RSA y creamos la clave privada con 2048 bits 
        $private = $private->withPadding(RSA::ENCRYPTION_NONE);
        $public_key = $private->getPublicKey(); //obtenemos la clave publica
    
        
        mkdir("C:/smartway/".$username."/privatekey/", 0777); //crea la subcarpeta
        mkdir("C:/smartway/".$username."/publickey/", 0777);
        file_put_contents('C:/smartway/'.$username.'/privatekey/privatekey.pem', $private); //guardado de la clave privada
        file_put_contents('C:/smartway/'.$username.'/publickey/publickey.pem', $public_key); //guardado de la clave privada
        //$signature = $private->sign($mensaje); // contraseña firmada firmado 
        $contra_encrip = $public_key->encrypt($contraseña_encriptada);
        //$respuesta = $private->getPublicKey()->verify($contrasena, $signature) ? 'valid signature' : 'invalid signature'; //verifica si el mensaje es autentico o no "si lo realizo el dueño"
        $contra_desencrip = $private->decrypt($contra_encrip); //desencriptado de contraseña
        $datos=array(
            'nombres'       =>  $nombres,
            'apellidos'     =>  $apellidos,
            'nombre_usuario'=>  $username,
            'contraseña_ingresada' => $contrasena,
            'contraseña_encriptada_propia' => $contraseña_encriptada,
            'contrasenia'   =>  base64_encode($contra_encrip),
            'email'         =>  $correo,
            'tipo_usuario'  =>  $tipo,
            'fecha_creado'  =>  $hoy,
            'ascii_resultante' => $ascii_resultante,
            
        ); 

        $usuario->insert($datos);
        return view('login/logeo.php');
    }
    
    public function ingresarUsuario(){
        $todo_usuarios = new Usuarios();
        $username = $this->request->getVar('username');
        $contrasena = $this->request->getVar('contrasena');
        $usuarios = $todo_usuarios->findAll();

        $permitir_logeo = true;
        $mensaje = null;

        //encriptado pidiendo clave pública para autenticar
        $filename = 'C:/smartway/'.$username.'/publickey/publickey.pem';//pedimos la llave publica
        $permitir_logeo = file_exists($filename);
        if ($permitir_logeo){
            $public_key = RSA::loadFormat('PKCS8', file_get_contents($filename), $password = false);//cargado de clave pública
            $public_key = $public_key->withPadding(RSA::ENCRYPTION_NONE);
            $contra_ingre_encrip = $public_key->encrypt($contrasena); //cogemos la clave publica para cifrar la contraseña enviada
        }
        

        $filename = 'C:/smartway/'.$username.'/privatekey/privatekey.pem';//pedimos la llave privada
        $permitir_logeo = file_exists($filename) ? true : false;
        if ($permitir_logeo){
            $private_key = RSA::loadFormat('PKCS8', file_get_contents($filename), $password = false);//cargado de clave privada
            $private_key = $private_key->withPadding(RSA::ENCRYPTION_NONE);
            $contra_ingresada_desencrip = $private_key->decrypt($contra_ingre_encrip); //desencriptado de contraseña
        }
        if ($permitir_logeo){
            foreach($usuarios as $usuario){
                if($username == $usuario['nombre_usuario']){//logeo, comprueba si existe el usuario en la bd
                    $contraseña = base64_decode($usuario['contrasenia'],false);
                    $contraseña_desencriptada = $private_key->decrypt($contraseña); //desencriptado de contraseña de la base de datos
                    $contraseña_desencriptada_propia = $this->desencriptado_propio( $usuario['nombre_usuario'], $contraseña_desencriptada, $usuario['fecha_creado']);
                    if ($contraseña_desencriptada_propia == $contrasena){
                        if($usuario['tipo_usuario'] == 1 or $usuario['tipo_usuario'] == 0){
                            $datos['usuarios'] = $todo_usuarios->orderBy('id','ASC')->findAll();
                            $datos['cabecera']=view('base/header');
                            $datos['pie']=view('base/footer');
                            return view('usuarios/usuarios_list' , $datos);
                        }
                        if($usuario['tipo_usuario']==3){
                        
                        
                            $mapa=$this->dibujarMapa();
        
                            return view('marker.php', $mapa);
                        }
                    }else{
                        $mensaje = "Contraseña incorrecta";
                        break;
                    }
                }
            }
            $mensaje = "Usuario o contraseña incorrectos";
        }else{
            $mensaje = "No se encontró la llave publica o privada";
        }
        
        $respuesta = array(
            'mensaje'            => $mensaje,
            'usuario_ingresado'     => $username,
            'contra_ingresada'   => $contra_ingresada_desencrip,
            'contra_bd'          => $usuario['contrasenia'],
            'contra_bd_desen'    => $contraseña_desencriptada,
            'contra_desencriptado_propio' => $contraseña_desencriptada_propia,
        );

        return view('login/logeo.php', $respuesta);
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

    public function encriptado_propio($username,$contrasena,$fecha_actual){
        //CREAMOS UN un array ASCII en base 64 de solo los caracteres imprimibles => total 222
        $ascii = [];
        for ($i = 32; $i <= 255; $i++) {
            if ($i != 127){
                array_push($ascii, base64_encode(chr($i)));
            }
        }

        //GENERAMOS UN ARRAY NUMERICO RESULTANTE DEL NOMBRE DE USUARIO Y SU FECHA DE CREACION
        $array_nombre_usuario = str_split($username);//array de la separacion del nombre de usuario
        $array_usuario_ascii_value = [];

        foreach ($array_nombre_usuario as $letra) {// transforma el array de string a int segun su valor ASCII
            array_push($array_usuario_ascii_value,  ord($letra));
        }

        //obtenemos las horas, minutos, segundos de la hora actual (en la que se registró el usuario)
        $horas = getdate($fecha_actual)['hours'];
        $minutos =  getdate($fecha_actual)['minutes'];
        $segundos =  getdate($fecha_actual)['seconds'];
        $tiempo = [$horas,$minutos,$segundos];
        //se genera un array que multiplica el valor entero del nombre de usuario segun ASCII con cada uno de las variables del tiempo
        $array_resultante = [];
        foreach ($array_usuario_ascii_value as $numero) {
            foreach ($tiempo as $multiplicador){
                array_push($array_resultante,$numero*$multiplicador);
            }
        }

        //expandimos el array para que tenga 222 campos para que tenga igual tamaño de los imprimibles del ASCII
        $array_total = [];
        while (count($array_total) < 222){
            foreach($array_resultante as $numero){
                if (count($array_total) < 222){
                    array_push($array_total, $numero);
                }else{
                    break;
                }
            }
        }
        array_reverse($array_total);//revertimos el array para añadir complejidad

        // GENERADO DEL NUEVO ARRAY ASCII RESULTANTE (del nombre de usuario y fecha de creacion)
        $ascii_resultante = [];
        for ($i = 0; $i <= 222; $i++){
        array_push($ascii_resultante, null);//ingresamos null para llenar el array resultante
        }

        $aux = 0;
        for ($i = 0; $i <= 222; $i++) {// creamos un array con un orden ascii resultante en base 64 para evitar la perdida de datos
            $variable = $array_total[$i] % 222;
            if ($ascii_resultante[$variable] == null){
                $ascii_resultante[$variable] = $ascii[$i];
            }else{
                $aux = $variable;
                $iteration = true;
                while ($iteration){//si está ocupado buscamos el siguiente campo disponible
                    if ($aux < 222){
                        $aux = $aux + 1;
                    }else{
                        $aux = 0;
                    }
                    if ($ascii_resultante[$aux] == null){
                        $ascii_resultante[$aux] = $ascii[$i];
                        $iteration = false;
                    }
                }
            }
        }

        //generamos array de la contraseña en base 64
        $array_contraseña = str_split($contrasena);
        $array_contraseña_64 = [];
        foreach ($array_contraseña  as $letra) {
            array_push($array_contraseña_64, base64_encode($letra));
        }

        $array_encryptado = [];

        // IGUALAMOS DE ASCII A ASCII RESULTANTE
        foreach ($array_contraseña_64 as $pass_element){
            for ($i = 0; $i <= 222; $i++) {
                if ($pass_element  == $ascii[$i]){
                    array_push($array_encryptado, $ascii_resultante[$i]);
                }
            }
        }
        $contraseña_encriptada = "";
        foreach($array_encryptado as $letra_encriptada){
            $contraseña_encriptada = $contraseña_encriptada.base64_decode($letra_encriptada);
        }
        //CONTRASEÑA CON NUEVO ENCRIPTADO EN BASE 64
        $contraseña_encriptada = base64_encode($contraseña_encriptada);
        return array ($contraseña_encriptada,$ascii_resultante);
    }

    public function desencriptado_propio($username,$contrasena_encriptada,$fecha_actual){
        //CREAMOS UN un array ASCII en base 64 de solo los caracteres imprimibles => total 222
        $ascii = [];
        for ($i = 32; $i <= 255; $i++) {
            if ($i != 127){
                array_push($ascii, base64_encode(chr($i)));
            }
        }

        //GENERAMOS UN ARRAY NUMERICO RESULTANTE DEL NOMBRE DE USUARIO Y SU FECHA DE CREACION
        $array_nombre_usuario = str_split($username);
        $array_usuario_ascii_value = [];

        foreach ($array_nombre_usuario as $letra) {// genera un array de numeros del codigo ascii del nombre de usuario
            array_push($array_usuario_ascii_value,  ord($letra));
        }

        //obtenemos las horas, minutos, segundos de la hora actual (en la que se registró el usuario)
        $horas = getdate($fecha_actual)['hours'];
        $minutos =  getdate($fecha_actual)['minutes'];
        $segundos =  getdate($fecha_actual)['seconds'];
        $tiempo = [$horas,$minutos,$segundos];
        //$numero_auxiliar = $horas*$minutos*$segundos;
        //CREADO DEL ARRAY MULTIPLICADOR
        $array_resultante = [];
        foreach ($array_usuario_ascii_value as $numero) {
            foreach ($tiempo as $multiplicador){
                array_push($array_resultante,$numero*$multiplicador);
            }
        }

        //expandimos el array para que tenga 222 campos para que tenga igual tamaño de los imprimibles del ASCII
        $array_total = [];
        while (count($array_total) < 222){
            foreach($array_resultante as $numero){
                if (count($array_total) < 222){
                    array_push($array_total, $numero);
                }else{
                    break;
                }
            }
        }
        array_reverse($array_total);//revertimos el array para añadir complejidad

        // GENERADO DEL NUEVO ARRAY ASCII RESULTANTE (del nombre de usuario y fecha de creacion)
        $ascii_resultante = [];
        for ($i = 0; $i <= 222; $i++){
        array_push($ascii_resultante, null);//ingresamos null para llenar el array resultante
        }

        $aux = 0;
        for ($i = 0; $i <= 222; $i++) {// creamos un array con un orden ascii resultante en base 64 para evitar la perdida de datos
            $variable = $array_total[$i] % 222;
            if ($ascii_resultante[$variable] == null){
                $ascii_resultante[$variable] = $ascii[$i];
            }else{
                $aux = $variable;
                $iteration = true;
                while ($iteration){//si está ocupado buscamos el siguiente campo disponible
                    if ($aux < 222){
                        $aux = $aux + 1;
                    }else{
                        $aux = 0;
                    }
                    if ($ascii_resultante[$aux] == null){
                        $ascii_resultante[$aux] = $ascii[$i];
                        $iteration = false;
                    }
                }
            }
        }


        //la contraseña ingresada la decodificamos ya que está en base 64
        $contrasena_encriptada = base64_decode($contrasena_encriptada);
        $array_contraseña = str_split($contrasena_encriptada);//separamos por letras

        //codificamos a base 64 letra por letra (antes estaba todo el texto junto codificado)
        $array_contraseña_64 = [];
        foreach ($array_contraseña  as $letra) {
            array_push($array_contraseña_64, base64_encode($letra));
        }

        //IGUALAMOS DE ASCII RESULTANTE A ASCII NORMAL
        $array_desencryptado = [];
        foreach ($array_contraseña_64 as $pass_element){
            for ($i = 0; $i <= 222; $i++) {
                if ($pass_element  == $ascii_resultante[$i]){//ahora en vez de igualarlo al ascii normal, lo hacemos al ascii resultante
                    array_push($array_desencryptado, $ascii[$i]);//ahora tomamos el de la lista de ascii original en vez del encriptado (para el desencriptado)
                }
            }
        }
        $contraseña_desencriptada = "";
        //OBTENEMOS LA CONTRASEÑA DESENCRIPTADA
        foreach($array_desencryptado as $letra_desencriptada){
            $contraseña_desencriptada = $contraseña_desencriptada.base64_decode($letra_desencriptada);
        }
        //$contraseña_desencriptada = base64_decode($contraseña_desencriptada);
        return $contraseña_desencriptada;
    }
}