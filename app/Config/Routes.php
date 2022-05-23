<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
//usuarios
$routes->get('listar_usuarios', 'UsuariosController::index');
$routes->get('crear_usuario', 'UsuariosController::crearUsuario');
$routes->get('editar_usuarios', 'UsuariosController::editarUsuarios');
$routes->get('ver_usuarios', 'UsuariosController::verUsuarios');
//vehiculos
$routes->get('listar_vehiculos', 'VehiculosController::index');
$routes->get('crear_vehiculo', 'VehiculosController::crearVehiculos');
$routes->get('editar_vehiculos', 'VehiculosController::editarVehiculos');
$routes->get('ver_vehiculos', 'VehiculosController::verVehiculos');