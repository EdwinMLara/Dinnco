<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta class="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/home.css"/>
	<title>Diinco Panel de Control</title>
</head>
<body>
	<?php
		require_once("navbar.php");
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<h4>Agregar Dispositivo</h4><br>
				<form autocomplete="off" action="agregar_estacion.php" method="post" onsubmit="return validacion_datos()">
					<div class="form-group">
						<label>Nombre de la estación</label>
					    <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre de la estación">
					    <small class="form-text text-muted">Nombre descriptivo del lugar donde se instala el dispositivo.</small>
					</div>
					<div class="form-group">
					    <label>Número de relevadores</label>
					    <select name="num_lamparas" id="cant_interruptores" class="form-control" >
					    	<option value="1">1</option>
					    	<option value="2">2</option>
					    	<option value="3">3</option>
					    	<option value="4">4</option>
					    	<option value="6">5</option>
					    </select>
					    <small class="form-text text-muted">Numero de relevadores controlados por el dispositivo</small>
					</div>
					<div class="form-group">
					    <label>Direccion IP</label>
					    <input type="text" class="form-control" id="direccion" name="ip_address" placeholder="Direccion IP">
					</div>
					<button  type="submit" class="btn btn-primary">Agregar</button>
				</form>
			</div>
			<div class="col-md-7">
				<div id="dipositivos_registrados">
					<?php require_once("dispositivos_registrados.php"); ?>
				</div>
				<?php 
					require_once("paginador.php");
					paginador(1,1,$total_paginas,1);
				?>
			</div>
		</div>
	</div>
	<?php
		require_once("footer.php");
	?>
</body>
<script src="js/jQuery.js"></script>
<script src="js/configuracion_lampara.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>