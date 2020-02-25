<?php
	require_once("conexion.php");
	include "Clases/Lampara.php";
	$inicio = $_GET["inicio"];
	$fin = $_GET["fin"];
	if($con){
		$array = array();
		$sql = "SELECT * FROM lamparas LIMIT $inicio,$fin";
		$sql_lamparas_array = mysqli_query($con,$sql);
		while($sql_lampara = mysqli_fetch_array($sql_lamparas_array)){
			$id_lampara = $sql_lampara["id_lampara"];
			$status_lampara = $sql_lampara["status_lampara"];
			$ip_address = $sql_lampara["ip_address"];

			$lampara = new Lampara($id_lampara,$status_lampara,$ip_address);
			array_push($array, $lampara); 
		}

		$array_lamparas = array('Lamparas' => $array );
		echo json_encode($array_lamparas);
	}else{
		echo "Error en la conexion a la base de datos";
	}


?>