<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Googlemaps;
use App\Libraries\Dijkstra;
use App\Libraries\Graph;
// use App\Libraries\Dijkstra\Edge;

// require ROOTPATH.'/vendor/autoload.php';
require ROOTPATH.'/app/Libraries/Dijkstra.php';

class Gmaps extends Controller{
    // function __construct() {
    //     parent::__construct();
    // }
    
    
    public function index(){
       
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

        $nodes = [['PUNTO A','-16.3910877835','-71.54671308'],['PUNTO B','-16.3743452','-71.5665099'],['PUNTO C','-16.39889','-71.535'], ];

        // $config['center'] = '-16.39889, -71.535';
        $config['directionsStart'] = '-16.3910877835, -71.54671308';
        $config['directionsEnd'] = '-16.3743452, -71.5665099';
        $config['directionsDivID'] = 'directionsDiv';
        // $config['zoom'] = 'auto';
        $google->initialize($config);
        // $alg = $this->getDistanceBetweenPointsNew($lat1, $lon1,'-16.3743452', '-71.5665099', 'miles');
        // print_r($alg);
        // $marker = array();
        // $marker['position'] = '-16.39889, -71.535';
        // print_r($marker);
        // $google->add_marker($marker);
        // $marker['position'] = '-16.3743452, -71.5665099';
        // print_r($marker);
        // $google->add_marker($marker);
        // $marker['position'] = '-16.39889, -71.535';
        // print_r($marker);
        // $google->add_marker($marker);
        $data['map'] = $google->create_map();

        $g = new  \App\Libraries\Graph();

        for ($i=0; $i < count($nodes) ; $i++) { 
          for ($j=0; $j < count($nodes) ; $j++) { 
            if ($i == $j) {
              continue;
            }
            $dis = $this->getDistanceBetweenPointsNew($nodes[$i][1], $nodes[$i][2],$nodes[$j][1], $nodes[$j][2], 'kilometers');
            $g->addedge($nodes[$i][0], $nodes[$j][0], $dis);
          }  
        }

        // $g->addedge("PUNTO A", "PUNTO B", $this->getDistanceBetweenPointsNew($nodes[0][1], $nodes[0][2],$nodes[1][1], $nodes[1][2], 'kilometers'));
        // $g->addedge("PUNTO A", "PUNTO C", $this->getDistanceBetweenPointsNew($nodes[0][1], $nodes[0][2],$nodes[2][1], $nodes[2][2], 'kilometers'));
        // $g->addedge("PUNTO B", "PUNTO C", $this->getDistanceBetweenPointsNew($nodes[1][1], $nodes[1][2],$nodes[2][1], $nodes[2][2], 'kilometers'));
        // $g->addedge("PUNTO C", "PUNTO A", $this->getDistanceBetweenPointsNew($nodes[2][1], $nodes[2][2],$nodes[0][1], $nodes[0][2], 'kilometers'));


        list($distances, $prev) = $g->paths_from("PUNTO A");
        
        $path = $g->paths_to($prev, "PUNTO C");

        // $config['directionsStart'] = $nodes[0][1] . ',' . $nodes[0][2];
        // $config['directionsEnd'] = $nodes[2][1] . ',' . $nodes[2][2];
        // $config['directionsDivID'] = 'directionsDiv';

        for ($i=0; $i < count($nodes) ; $i++) { 
          // print_r($path[$i]);
          $marker = array();
          $marker['position'] = $nodes[$i][1] . ',' . $nodes[$i][2];
          $marker['id'] = $i;
          print_r($marker);
          $google->add_marker($marker);
        }


        
        print_r($path);

        


        return view('marker.php', $data);
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