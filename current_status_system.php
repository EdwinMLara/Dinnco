<?php
	require_once("conexion.php");
	include "Lampara.php";
	$id_area = $_GET["id_area"];
	if($con){
		$array = array();
		$sql = "SELECT control_manual FROM area where id_area =  $id_area";
		$sql_control_manual_result = mysqli_query($con,$sql);
		$control_manual = mysqli_fetch_array($sql_control_manual_result);
		if($control_manual["control_manual"]){
			$("#main_catainer").addClass("div_disable");
		}
		/*while(){
			$id_lampara = $sql_lampara["id_lampara"];
			$status_lampara = $sql_lampara["status_lamparas"];
			$control_manual = $sql_lampara["control_manual"];

			$lampara = new Lampara($id_lampara,$status_lampara,$control_manual,"");
			array_push($array, $lampara); 
		}

		$array_lamparas = array('Lamparas' => $array );
		echo json_encode($array_lamparas);*/
	}else{
		echo "Error en la conexion a la base de datos";
	}


?>