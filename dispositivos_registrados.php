<h3>Dispositivos Registrados</h3>
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th>id_area</th>
							<th>Area</th>
							<th>Lamparas</th>
							<th>Dirección ip</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						 	require_once("conexion.php");
						 	if($con){
						 		$sql_total_paginas = "SELECT COUNT(*) as total FROM area";
						 		$sql_result = mysqli_query($con,$sql_total_paginas);
						 		$total = mysqli_fetch_array($sql_result);
						 		$num_rows = (int) $total["total"];
						 		$inicio_paginador = 0;
						 		$fin_paginador = 4;

						 		if(isset($_GET["page"])){
						 			$inicio_paginador = (((int) $_GET["page"])-1)*$fin_paginador;
						 			$fin_paginador = $inicio_paginador+$fin_paginador;
						 			if($fin_paginador > $num_rows){
						 				$fin_paginador = $num_rows;
						 			}
						 		}

						 		$sql = "SELECT * FROM area LIMIT $inicio_paginador,$fin_paginador";
						 		$sql_array = mysqli_query($con,$sql);

						 		while($area = mysqli_fetch_array($sql_array)){
						 			$id_area = $area["id_area"];
						 			$nombre_area = $area["nombre_area"];
						 			$num_lamparas = $area["num_lamparas"];
						 			$direccion_ip = $area["direccion_ip"];
						 			?>
						 			<tr>
										<td><?php echo $id_area; ?></td>
										<td><?php echo $nombre_area; ?></td>
										<td><?php echo $num_lamparas; ?></td>
										<td><?php echo $direccion_ip; ?></td>
										<th>
											<a href="#" class="btn btn-warning btn-sm">Editar</a>
											<a href="eliminar_area.php?area=<?php echo $id_area; ?>" class="btn btn-danger btn-sm">Eliminar</a>
										</th>
									</tr>
						 		<?php
								}
								$total_paginas = ceil($num_rows/5);
						 	}
						?>
					</tbody>
				</table>