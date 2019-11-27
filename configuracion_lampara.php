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
			<div class="col-md-12">
				<form autocomplete="off" action="agregar_estacion.php">
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre de la estación</label>
					    <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre de la estación">
					    <small id="emailHelp" class="form-text text-muted">Nombre descriptivo del lugar donde se instala el dispositivo.</small>
					</div>
					<div class="form-group">
					    <label for="exampleInputPassword1">Direccion IP</label>
					    <input type="text" class="form-control" id="Direccion" placeholder="Direccion IP">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</body>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>