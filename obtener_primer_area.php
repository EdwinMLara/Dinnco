<?php
    require_once("conexion.php");
    if($con){
        $obj_id = new stdClass();
        $sql = "SELECT id_area FROM area LIMIT 1";
        $sql_result = mysqli_query($con,$sql);
        $sql_id_area = mysqli_fetch_array($sql_result);
        $id_area = $sql_id_area["id_area"];

        if($id_area){
            $obj_id->id_area = $id_area;
        }else{
            $obj_id->id_area = 0;
        }

        echo json_encode($obj_id);
    }else{
        echo "Error en la conexion a la base de datos";
    }
?>