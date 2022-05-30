<!DOCTYPE html>
<html lang="en">
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
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Pedidos <i class="fa fa-cubes" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Vehículos <i class="fa fa-bus" aria-hidden="true"></i></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link disabled text-light" href="#" tabindex="-1" aria-disabled="true">Proximamente...</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<div class="content">