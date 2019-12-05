<?php
	if(isset($_POST["ip_address"]) && isset($_POST["Nombre"])){
		$nombre_estacion = $_POST["Nombre"];
		$ip_address = $_POST["ip_address"];

		require_once("conexion.php");

		if($con){
			$sql = "INSERT INTO lamparas (Descripcion, status_lampara, ip_address) VALUES ('$nombre_estacion','0','$ip_address')";

			mysqli_query($con,$sql);

			header("location: configuracion_lampara.php");

		}else{
			echo "Error en la conexion a la base de datos";
		}
	}else{
		echo "no hay datos";
	}
?>