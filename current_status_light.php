<?php
require_once("conexion.php");
include "Clases/Evento.php";
include "Clases/Lampara.php";

$celda_msj_status = new stdClass();


$response_array = array();

if(isset($_GET["id_area"])){
    $id_area = $_GET["id_area"];

    $sql_celda = "SELECT status_celda FROM datos_celdas WHERE id_celda = 1";
    $celda = mysqli_fetch_array(mysqli_query($con,$sql_celda));
    $celda_status = $celda["status_celda"];

    if($celda_status){
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date('Y-m-d', time());
        $sql_status_lampara = "SELECT * FROM lamparas WHERE id_area = $id_area";

        $sql_lampara_result = mysqli_query($con,$sql_status_lampara);
        $count = 0;

        while($lamparas = mysqli_fetch_array($sql_lampara_result)){
            $id_lampara = $lamparas["id_lampara"];
            $eventos_aux = array();

            $response = new stdClass();
            $response->id_lampara = $id_lampara;
            $response->status = 1;
            
            $sql_eventos = "SELECT fecha FROM eventos WHERE id_lampara = $id_lampara";
            $sql_eventos_result = mysqli_query($con,$sql_eventos);

            while($eventos = mysqli_fetch_array($sql_eventos_result)){
                $fecha = $eventos["fecha"];
                if($fecha == $fecha_actual){
                    $response->status = 0;
                    break;
                }
            }

            array_push($response_array,$response);
            $count += 1;
        }
        
        if($count){
            echo json_encode($response_array);
        }else{
            $celda_msj_status->status = "continua";
        }

    }else{
        $celda_msj_status->status = "La celda esta activa";
        echo json_encode($celda_msj_status);
    }   
}else{
    $celda_msj_status->status = "Error";
    echo json_encode($celda_msj_status);
}

?>