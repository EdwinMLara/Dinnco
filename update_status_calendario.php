<?php
	if(isset($_GET['control_calendario'])){
		$control_calendario = $_GET["control_calendario"];
		$id_area = $_GET["id_area"];

		require_once('conexion.php');

		if($con){
			$calendario = new stdClass();

			$sql = "UPDATE area SET control_calendario = $control_calendario  WHERE id_area = $id_area";

			if(mysqli_query($con,$sql) == TRUE){
				$calendario->status = "Actualizado";
			}else{
				$calendario->status = "Error";	
			}
			echo json_encode($calendario);

		}else{
			echo "Error con la conexion a la base de datos";
		}
	}
?>