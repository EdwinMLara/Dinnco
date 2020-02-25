<?php
	require_once("conexion.php");
	include "Clases/Area.php";
	include "Clases/Lampara.php";
	include "Clases/Evento.php";

	
	if($con){
		if(isset($_GET["id_area"])){
			$id_area = $_GET["id_area"];

			$sql = "SELECT * FROM area where id_area =  $id_area";
			$sql_control_manual_result = mysqli_query($con,$sql);
			$area_sql = mysqli_fetch_array($sql_control_manual_result);
			
			$nombre_area = $area_sql["nombre_area"];
			$num_lamparas = $area_sql["num_lamparas"];
			$control_manual = $area_sql["control_manual"];
			$control_calendario = $area_sql["control_calendario"];
			$direccion_ip = $area_sql["direccion_ip"];

			$lamparas = array();

			$sql_lamparas = "SELECT * FROM lamparas WHERE id_area = $id_area";
			$sql_lamparas_result = mysqli_query($con,$sql_lamparas);
			
			while($lampara_sql = mysqli_fetch_array($sql_lamparas_result)){
				$id_lampara = $lampara_sql["id_lampara"];
				$descripcion = $lampara_sql["descripcion"];
				$status_lampara = $lampara_sql["status_lamparas"];
				$control_manual_lampara = $lampara_sql["control_manual"];

				$eventos = array();

				$sql_evento = "SELECT * FROM eventos WHERE id_lampara = $id_lampara";
				$sql_evento_result = mysqli_query($con,$sql_evento);

				while($evento_sql = mysqli_fetch_array($sql_evento_result)){
					$id_evento = $evento_sql["id_evento"];
					$fecha = $evento_sql["fecha"];
					$color = $evento_sql["color"];

					$evento = new Evento($id_evento,$fecha,$color);
					array_push($eventos,$evento);
				}

				$lampara = new Lampara($id_lampara,$descripcion,$status_lampara,$control_manual_lampara,$eventos);
				array_push($lamparas, $lampara); 
			}

			$area = new Area($nombre_area,$num_lamparas,$control_manual,$control_calendario,$direccion_ip,$lamparas);
			echo json_encode($area);
		}else{
			echo "falta el parametro id_area";
		}

	}else{
		echo "Error en la conexion a la base de datos";
	}


?>