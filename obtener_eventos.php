<?php
	require_once("conexion.php");
	include "Clases/Evento.php";
	$array = array();
	if(isset($_GET["id_lampara"])){
		$id_lampara = $_GET["id_lampara"]; 

		if($con){
			
			$sql = "SELECT * FROM eventos WHERE id_lampara = $id_lampara";
			$sql_eventos_array = mysqli_query($con,$sql);
			if($sql_eventos_array){
				while($sql_evento = mysqli_fetch_array($sql_eventos_array)){
					$id_evento = $sql_evento["id_evento"];
					$id_lampara = $sql_evento["id_lampara"];
					$fecha_start = $sql_evento["fecha"];
					$color = $sql_evento["color"];

					$evento = new Evento($id_evento,$id_lampara,$fecha_start,$color);
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
	}else{
		echo json_encode($array);
	}

?>