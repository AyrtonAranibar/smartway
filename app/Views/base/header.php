<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Title</title>
    <?php include('css.php')?>
    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-dark bg-gradient shadow">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#">SmartWay <i class="fa fa-truck" aria-hidden="true"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link text-light" href="<?= base_url()?>/listar_pedidos">Pedidos <i class="fa fa-cubes" aria-hidden="true"></i></a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-light" href="<?= base_url()?>/listar_vehiculos">Vehículos <i class="fa fa-bus" aria-hidden="true"></i></a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Usuarios <i class="fa fa-users" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url()?>/listar_usuarios">Lista de usuarios</a></li>
            <!-- <li><a class="dropdown-item" href="<?= base_url()?>/crear_usuario">Crear un usuario</a></li> -->
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Clientes <i class="fa fa-users" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url()?>/listar_clientes">Lista de clientes</a></li>
            <li><a class="dropdown-item" href="<?= base_url()?>/crear_cliente">Crear un cliente</a></li>
            <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?= base_url()?>/optimizar_rutas">Optimizar rutas <i class="fa fa-road" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?= base_url()?>/sede">Sede <i class="fa fa-building" aria-hidden="true"></i></a>
        </li>
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
<div class="content">