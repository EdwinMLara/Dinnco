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