
<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="es">
	<head>
		<title>Smart Way Application</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <title>Proyecto</title>
		
        <?php include('css.php')?>
	</head>
	<body class="is-preload landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1 id="logo"><a href="#">Smart Way</a></h1>
					<nav id="nav">
						<ul>
							<!--<li><a href="#">Home</a></li>-->
							<li>
								<a href="#">Paneles</a>
								<ul>
									<li>
										<a>Panel de Usuarios</a>
										<ul>
											<li><a href="<?php echo base_url() ?>/listar_usuarios">Listar Usuarios</a></li>
											<li><a href="<?php echo base_url() ?>/crear_usuario"> Crear Usuario</a></li>
											<li><a href="<?php echo base_url() ?>/editar_usuarios"> Editar Usuario</a></li>
											<li><a href="<?php echo base_url() ?>/ver_usuarios"> Ver Usuarios</a></li>
										</ul>
									</li>
									<li>
										<a>Panel de Vehiculos</a>
										<ul>
										<li><a href="<?php echo base_url() ?>/listar_vehiculos">Listar Vehiculos</a></li>
											<li><a href="<?php echo base_url() ?>/crear_vehiculo"> Crear Vehiculos</a></li>
											<li><a href="<?php echo base_url() ?>/editar_vehiculos"> Editar Vehiculos</a></li>
											<li><a href="<?php echo base_url() ?>/ver_vehiculos"> Ver Vehiculos</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<!--<li><a href="elements.php">Elements</a></li>-->
							<li><a href="<?php echo base_url() ?>/ingresar" class="button primary">Ingresar</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<div class="content">
						<header>
							<h2>Smart Way</h2>
							<p>Llega a tus clientes<br />
							De la forma más rápida posible</p>
						</header>
						<span class="image"><img src="<?php echo base_url() ?>/images/car_fast.jpg" alt="vehiculo rapido" /></span>
					</div>
					<a href="#one" class="goto-next scrolly">Next</a>
				</section>

			<!-- One -->
				<section id="one" class="spotlight style1 bottom">
					<span class="image fit main"><img src="<?php echo base_url() ?>/images/traffic.jpg" alt="" /></span>
					<div class="content">
						<div class="container">
							<div class="row">
								<div class="col-4 col-12-medium">
									<header>
										<h2>¿Cuanto tiempo pasas en en tráfico al día?</h2>
										<p>Según investigaciones, el Arequipeño puede estar hasta 3 horas en el laberinto del tráfico</p>
									</header>
								</div>
								<div class="col-4 col-12-medium">
									<p>Geoffrey Rivas, especialista en transporte, explica que la cantidad de
										 unidades de transporte, como cústers o combis, no aumentaron en los últimos 
										 años. Pero sí se incrementaron las unidades pequeñas que hacen servicio de 
										 taxi. De los 280 mil vehículos, el 70% circulan a diario; y de esos solo
										  3 mil 600 dan servicio público, mientras que 34 mil son taxis.</p>
								</div>
								<div class="col-4 col-12-medium">
									<p>Un arequipeño pasa al día hasta tres horas dentro de un vehículo 
										público. Sobre todo quienes tienen recorridos desde el Cono Norte 
										o Sur hasta el Cercado de Arequipa. Normalmente un viaje en estas 
										rutas debería demorar 50 minutos de ida y otros 50 de vuelta pero 
										actualmente demora una hora con 20 minutos, señala un investigador.</p>
								</div>
							</div>
						</div>
					</div>
					<a href="#two" class="goto-next scrolly">Next</a>
				</section>

			<!-- Two -->
				<section id="two" class="spotlight style2 right">
					<span class="image fit main"><img src="<?php echo base_url() ?>/images/clustering.png" alt="mapa de agrupamiento" /></span>
					<div class="content">
						<header>
							<h2>Entrega los pedidos de tus clientes, más rápido</h2>
							<p>Con SmartWay puedes llegar a tu destino de una forma más rápida</p>
						</header>
						<p>Smartway se encarga de agrupar tus pedidos mediante el algoritmo de agrupamiento (clustering) y mediante un algoritmo calcula la trayectoria más rapida posible considerando al tráfico</p>
						<ul class="actions">
							<li><a href="#" class="button">Learn More</a></li>
						</ul>
					</div>
					<a href="#three" class="goto-next scrolly">Next</a>
				</section>

			<!-- Three -->
				<section id="three" class="spotlight style3 left">
					<span class="image fit main bottom"><img src="<?php echo base_url() ?>/images/traffic_layer.png" alt="trafic layer" /></span>
					<div class="content">
						<header>
							<h2>Integracion con Google Maps</h2>
							<p>Google Maps api predice el tiempo de viaje considerando la congestion vehicular</p>
						</header>
						<p>Feugiat accumsan lorem eu ac lorem amet ac arcu phasellus tortor enim mi mi nisi praesent adipiscing. Integer mi sed nascetur cep aliquet augue varius tempus lobortis porttitor lorem et accumsan consequat adipiscing lorem.</p>
						<ul class="actions">
							<li><a href="#" class="button">Learn More</a></li>
						</ul>
					</div>
					<a href="#four" class="goto-next scrolly">Next</a>
				</section>

			<!-- Four -->
				<section id="four" class="wrapper style1 special fade-up">
					<div class="container">
						<header class="major">
							<h2>Beneficios de usar SmartWay</h2>
							<p>Iaculis ac volutpat vis non enim gravida nisi faucibus posuere arcu consequat</p>
						</header>
						<div class="box alt">
							<div class="row gtr-uniform">
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon solid alt major fa-chart-area"></span>
									<h3>Ahorra costos</h3>
									<p>Ahorrarás dinero por no perder tiempo en el tráfico</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon solid alt major fa-comment"></span>
									<h3>Eleifend lorem ornare</h3>
									<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon solid alt major fa-flask"></span>
									<h3>Ahorra tiempo</h3>
									<p>Contarás con más tiempo para que lo dedique a lo que más te importa</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon solid alt major fa-paper-plane"></span>
									<h3>Non semper interdum</h3>
									<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon solid alt major fa-file"></span>
									<h3>Odio laoreet accumsan</h3>
									<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon solid alt major fa-lock"></span>
									<h3>Massa arcu accumsan</h3>
									<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
								</section>
							</div>
						</div>
						<footer class="major">
							<ul class="actions special">
								<li><a href="#" class="button">Magna sed feugiat</a></li>
							</ul>
						</footer>
					</div>
				</section>

			<!-- Five -->
				<section id="five" class="wrapper style2 special fade">
					<div class="container">
						<header>
							<h2>Contáctanos</h2>
							<p>Por favor, mandanos un correo electrónico</p>
						</header>
						<form method="post" action="#" class="cta">
							<div class="row gtr-uniform gtr-50">
								<div class="col-8 col-12-xsmall"><input type="email" name="email" id="email" placeholder="Tu direccion de correo" /></div>
								<div class="col-4 col-12-xsmall"><input type="submit" value="Contactar" class="fit primary" /></div>
							</div>
						</form>
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
						<li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
						<li><a href="#" class="icon solid alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Diseño: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
		<?php include('js.php')?>

	</body>
</html>