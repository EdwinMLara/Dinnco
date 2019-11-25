<?php
	require_once("conexion.php");
	include "Evento.php";

	if($con){
		$array = array();
		$sql = "SELECT * FROM eventos";
		$sql_eventos_array = mysqli_query($con,$sql);
		if($sql_eventos_array){
			while($sql_evento = mysqli_fetch_array($sql_eventos_array)){
				$id_evento = $sql_evento["id_evento"];
				$id_lampara = $sql_evento["id_lampara"];
				$fecha_start = $sql_evento["fecha_start"];
				$fecha_end = $sql_evento["fecha_end"];
				$color = $sql_evento["color"];

				$evento = new Evento($id_evento,$id_lampara,$fecha_start,$fecha_end,$color);
				array_push($array,$evento);
			}

			$array_eventos = array('Eventos' => $array);
			echo json_encode($array_eventos);
		}else{
			echo "Error al ejecutar la consulta";
		}
	}else{
		echo "Error en la conexion a la base de datos";
	}

?>