<?php
	if(isset($_GET["tag_ejecucion"])){
		$fecha = $_GET["fecha"];
		$id_lampara = $_GET["id_lampara"];
		$color = "red";
		
		require_once("conexion.php");

		if($con){

			$tag_ejecucion = $_GET["tag_ejecucion"];
			$sql = "";

			switch ($tag_ejecucion) {
				case 'insertar':
					$sql = "INSERT INTO eventos (id_lampara,fecha, color) VALUES ('$id_lampara','$fecha','$color')";
					break;
				case 'eliminar':
					$sql = "DELETE FROM eventos WHERE fecha = '$fecha'";
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