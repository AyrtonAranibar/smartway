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
<h1>Lista de usuarios</h1>
    <div class="container">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Contraseña</th>
                    <th>Email</th>
                    <th>Activo</th>
                    <th>Description</th>
                    <th>Imagen</th>
                    <th>Creado</th>
                    <th>Ciudad</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario):?>
                <tr>
                    <td><?=$usuario['nombre_usuario']?></td>
                    <td><?=$usuario['contrasenia']?></td>
                    <td><?=$usuario['email']?></td>
                    <td><?=$usuario['activo']?></td>
                    <td><?=$usuario['observacion']?></td>
                    <td><?=$usuario['imagen']?></td>
                    <td><?=$usuario['fecha_creado']?></td>
                    <td><?=$usuario['ciudad']?></td>
                    <td><button class="btn btn-danger">Eliminar</button><button class="btn btn-primary">Editar</button><button class="btn btn-secondary">ver</button></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>


    <div class="footer bg-dark">
      <p class="text-light">©Todos los derechos Inreservados - Ayrton Aranibar y Jasmin Salas</p>
    </div>
    <?php include('js.php')?>
</body>
</html>