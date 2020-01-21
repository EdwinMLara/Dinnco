<?php
	if(isset($_POST["ip_address"]) && isset($_POST["Nombre"])){
		$nombre_estacion = $_POST["Nombre"];
		$ip_address = $_POST["ip_address"];
		$num_lamparas = $_POST["num_lamparas"];

		require_once("conexion.php");

		if($con){
			$sql = "INSERT INTO area (nombre_area, num_lamparas,direccion_ip) VALUES ('$nombre_estacion','$num_lamparas','$ip_address')";

			mysqli_query($con,$sql);

			header("location: configuracion_lampara.php");

		}else{
			echo "Error en la conexion a la base de datos";
		}
	}else{
		echo "no hay datos";
	}
?>