<?php
	if(isset($_POST["ip_address"]) && isset($_POST["Nombre"])){
		$nombre_estacion = $_POST["Nombre"];
		$ip_address = $_POST["ip_address"];
		$num_lamparas = $_POST["num_lamparas"];

		require_once("conexion.php");

		if($con){
			$sql = "INSERT INTO area (nombre_area, num_lamparas,direccion_ip) VALUES ('$nombre_estacion','$num_lamparas','$ip_address')";
			mysqli_query($con,$sql);

			$sql_last_id = "SELECT id_area FROM area ORDER BY id_area DESC LIMIT 0,1";
			$result_sql = mysqli_query($con,$sql_last_id);
			$id_sql = mysqli_fetch_array($result_sql);
			$id_area = $id_sql["id_area"];

			for($i = 0;$i < intval($num_lamparas);$i++){
				$nombre_lampara = "Lampara ".$i;
				$sql_insert_lampara = "INSERT INTO lamparas (id_area, descripcion, status_lamparas, control_manual) VALUES ('$id_area','$nombre_lampara','0','0')";
				mysqli_query($con,$sql_insert_lampara);
			}


			header("location: configuracion_lampara.php");

		}else{
			echo "Error en la conexion a la base de datos";
		}
	}else{
		echo "no hay datos";
	}
?>