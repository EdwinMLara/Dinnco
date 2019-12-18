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
						 		$sql_total_paginas = "SELECT COUNT(*) as total FROM lamparas";
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

						 		$sql = "SELECT * FROM lamparas LIMIT $inicio_paginador,$fin_paginador";
						 		$sql_array = mysqli_query($con,$sql);

						 		while($lampara = mysqli_fetch_array($sql_array)){
						 			$id_lampara = $lampara["id_lampara"];
						 			$descripcion = $lampara["Descripcion"];
						 			$direccion_ip = $lampara["ip_address"];
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
						 		$total_paginas = ceil($num_rows/5);
						 		}
						 	}
						?>
					</tbody>
				</table>