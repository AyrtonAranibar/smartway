<?=$cabecera?>

<h1>Editar Cliente</h1>
    <div class="contenedor">
        <div class="d-flex flex-row">
            <div style="width:50%;margin:1em">
				<h4>Datos del cliente:</h4>
				<p>Arrastra el marcador del mapa para modificar la ubicación del cliente</p>
                <form action="<?=base_url('cliente_creado')?>" method="post" >
					<label for="nombres">Nombres</label><br>
                    <input type="text" id="nombres" name="nombres" placeholder="Marcelo Edmundo" autocomplete="off"><br>
					<label for="apellidos">Apellidos</label><br>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Castillo Hualpa" autocomplete="off"  ><br>
					<label for="dni">DNI</label><br>
                    <input type="text" id="dni" name="dni" placeholder="919191919191" autocomplete="off" ><br>
					<label for="observacion">Observación</label><br>
                    <input type="text" id="observacion" name="observacion" placeholder="Entrega frágil" autocomplete="off" ><br>
					<label for="direccion">Dirección</label><br>
                    <input type="text" id="direccion" name="direccion" placeholder="Calle S/n ..." autocomplete="off"><br>
                    <label for="latitud">Latitud</label><br>
                    <input type="text" id="latitud" name="latitud" placeholder="-16.51188" autocomplete="off" value="-16.406240" ><br>
                    <label for="longitud">Longitud</label><br>
                    <input type="text" id="longitud" name="longitud" placeholder="-71.51714" autocomplete="off" value="-71.54747"  ><br>
                    <label for="email">Email</label><br>
                    <input type="mail" id="email" name="email" placeholder="ejemplo@gmail.com" autocomplete="off"><br>
					<label for="celular">Número Telefónico</label><br>
                    <input type="text" id="celular" name="celular" placeholder="+51 999 111 999" autocomplete="off" ><br>
                    <div class="buttons-content">
                    <input type="submit" value="Guardar" class="btn btn-success">&nbsp;<a href="<?=base_url('/listar_clientes')?>" class="btn btn-primary">Atrás</a>
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
