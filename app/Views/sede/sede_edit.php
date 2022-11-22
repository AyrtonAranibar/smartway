<?=$cabecera?>

<h1>Editar Sede</h1>
    <div class="contenedor">
        <div class="d-flex flex-row">
            <div style="width:50%;margin:1em">
				<h4>Datos de la sede o almacen:</h4>
				<p>Arrastra el marcador del mapa para modificar la posicion de la sede</p>
                <form action="<?=site_url('/guardar_sede')?>" method="post" >
                    <label for="nombre">Nombre</label><br>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre de la sede" autocomplete="off" value="<?=$sede['nombre']?>" required><br>
                    <label for="latitud">Latitud</label><br>
                    <input type="text" id="latitud" name="latitud" placeholder="-16.51188" autocomplete="off" value="<?=$sede['latitud']?>" required><br>
                    <label for="longitud">Longitud</label><br>
                    <input type="text" id="longitud" name="longitud" placeholder="-71.51714" autocomplete="off" value="<?=$sede['longitud']?>" required ><br>
                    <br>
                    <div class="buttons-content">
                    <input type="submit" value="Guardar" class="btn btn-success">&nbsp;<a href="<?=base_url('/sede')?>" class="btn btn-primary">Atrás</a>
                    </div>
                </form>
            </div>
            <div id="map_canvas" style="width:50%;height:600px;margin:1em">

            </div>
        </div>
    </div>


        
			
			
	<script type="text/javascript">
		function iniciarMapa(){

			longitud = document.getElementById("longitud").value;
			latitud = document.getElementById("latitud").value;
			
			coordenadas = {
				lng:longitud,
				lat:latitud 
			}

			generarMapa(coordenadas);
		}


		function generarMapa(coordenadas){
			var mapa = new google.maps.Map(document.getElementById('map_canvas'),
			{
				zoom:13,
				center:new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
			});

			marcador = new google.maps.Marker({
				map: mapa,
				draggable: true,
				position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
			});

			marcador.addListener('dragend', function(event){
				document.getElementById('latitud').value = this.getPosition().lat();
				document.getElementById('longitud').value = this.getPosition().lng();
			});
		}
	</script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDJhVYEQxGiNDo4CYkRK0QnZJnkoiq0V9g&callback=iniciarMapa"></script>


    <?=$pie?>
