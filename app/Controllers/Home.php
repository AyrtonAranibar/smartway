<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('menu.php');
    }
    public function logeo()
    {
        return view('login/logeo.php');
    }
    public function autentificacion()
    {
        return view('login/registrarse.php');
    }
}
