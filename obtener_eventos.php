<?php
	require_once("conexion.php");
	include "Evento.php";

	if($con){
		$array = array();
		$sql = "SELECT * FROM eventos";
		$sql_eventos_array = mysqli_query($con,$sql);
		if($sql_eventos_array){
			while($sql_evento = mysqli_fetch_array($sql_eventos_array)){
				$id_lampara = $sql_evento["id_lampara"];
				$fecha_start = $sql_evento["fecha_start"];
				$color = $sql_evento["color"];

				$evento = new Evento($id_lampara,$fecha_start,$color);
				array_push($array,$evento);
			}

			//$array_eventos = array('Eventos' => $array);
			echo json_encode($array);
		}else{
			echo "Error al ejecutar la consulta";
		}
	}else{
		echo "Error en la conexion a la base de datos";
	}

?>