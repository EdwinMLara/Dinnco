<?php
	$servername = "localhost";
	$user = "root";
	$password = "";
	$database = "diinco";
	
	$con = mysqli_connect($servername,$user,$password,$database);
	if(!$con){
		echo "Error en la conexion";
	}
?>