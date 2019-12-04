<?php
	if(isset($_GET["tag_ejecucion"])){
		$fecha_start = $_GET["fecha"];
		$id_lampara = $_GET["id_lampara"];
		
		require_once("conexion.php");

		if($con){

			$tag_ejecucion = $_GET["tag_ejecucion"];
			$sql = "";

			switch ($tag_ejecucion) {
				case 'insertar':
					$sql = "INSERT INTO eventos (id_lampara, fecha_start, fecha_end, color) VALUES ('$id_lampara','$fecha_start','','red')";
					break;
				case 'eliminar':
					$sql = "DELETE FROM eventos WHERE fecha_start = '$fecha_start'";
					break;
			}

			$mensaje = new stdClass();
			if(mysqli_query($con,$sql) == TRUE){
				$mensaje->status = "correcto";
			}else{
				$mensaje->status = "Error";
			}

			echo json_encode($mensaje);
				
		}else{
			echo "Error en la conexion a la base de datos";
		}
	}else{
		echo "Error en la petición";
	}
?>