<?php
if(isset($_GET["status_celda"])){
    $status_celda = $_GET["status_celda"];
    $id_celda = $_GET["id_celda"];

    require_once("conexion.php");
    if($con){
        $celda_update = new stdClass();
        $sql = "UPDATE datos_celdas SET status_celda = $status_celda , fecha_hora = now() WHERE id_celda = $id_celda";
        if(mysqli_query($con,$sql) == TRUE){
            $celda_update->status = "Actualizado"; 
        }else{
            $celda_update->status = "Error";
        }
        echo json_encode($celda_update);
    }else{
        echo "Error con la conexion a la base de datos";
    }

}

?>