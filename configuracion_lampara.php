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
					<button type="submit" class="btn btn-primary">Agregar</button>
				</form>
			</div>
			<div class="col-md-7">
				<h3>Dispositivos Registrados</h3>
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th>Identificador</th>
							<th>Descripción</th>
							<th>Dirección ip</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						 	require_once("conexion.php");
						 	if($con){
						 		$sql = "SELECT * FROM lamparas";
						 		$sql_array = mysqli_query($con,$sql);
						 		$num_rows = 0;

						 		while($lampara = mysqli_fetch_array($sql_array)){
						 			$id_lampara = $lampara["id_lampara"];
						 			$descripcion = $lampara["Descripcion"];
						 			$direccion_ip = $lampara["ip_address"];
						 			$num_rows += 1;
						 			?>
						 			<tr>
										<td><?php echo $id_lampara; ?></td>
										<td><?php echo $descripcion; ?></td>
										<td><?php echo $direccion_ip; ?></td>
										<th>
											<a href="#" class="btn btn-primary btn-sm">Actualizar</a>
											<a href="#" class="btn btn-danger btn-sm">Eliminar</a>
										</th>
									</tr>
						 		<?php
						 		$total_paginas = $num_rows/5;
						 		}
						 	}
						?>
					</tbody>
				</table>
				<nav aria-label="Page navigation example">
  					<ul class="pagination justify-content-end">
						<li class="page-item disabled">
		      				<a class="page-link" href="#" tabindex="-1">Previous</a>
		    			</li>
		    			<?php if($total_paginas <= 1){ ?>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
		    			<?php }else{ ?>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
    							<li class="page-item"><a class="page-link" href="#">2</a></li>
    							<li class="page-item"><a class="page-link" href="#">Next</a></li>
		    			<?php } ?>
		    		</ul>
		    	</nav>
			</div>
		</div>
	</div>
	<?php
		require_once("footer.php");
	?>
</body>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>