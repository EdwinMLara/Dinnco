<?php
if(isset($_GET["area"])){
    require_once("conexion.php");
    if($con){
        $id_area = $_GET["area"];
        $sql_delete = "DELETE FROM area WHERE id_area = $id_area";
        mysqli_query($con,$sql_delete);
        echo "<script> alert('Se ha eliminado el área');
            window.location.href = 'configuracion_lampara.php';
         </script>";
    }
}
?>