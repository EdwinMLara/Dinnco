<?php
if(isset($_GET['status'])){
	$status = $_GET["status"];
	$id_lampara = $_GET["id_lampara"];
	require_once("conexion.php");
	
	if($con){
		$lampara = new stdClass();
		$sql = "UPDATE lamparas SET status_lampara = $status WHERE id_lampara = $id_lampara";
		if(mysqli_query($con,$sql) == TRUE){
			$lampara->status = "Actualizado";
		}else{
			$lamara->status = "Error";	
		}
		echo json_encode($lampara);
	}else{
		echo "Error con la conexion a la base de datos";
	}
}
?>