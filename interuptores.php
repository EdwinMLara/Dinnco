<?php
    require_once("conexion.php");
    if(isset($_GET["area"])){
        $id_area = $_GET["area"];
    }else{
        $sql_id_area = "SELECT id_area FROM area LIMIT 1";
        $sql_result_id = mysqli_query($con,$sql_id_area);
        $id_result = mysqli_fetch_array($sql_result_id);
        if($id_result){
            $id_area = $id_result["id_area"];
        }else{
            $id_area = "0";
        }
    }
    $sql_count = "SELECT lamparas.id_lampara, lamparas.descripcion, lamparas.status_lamparas, lamparas.control_manual as control_manual_lampara, area.direccion_ip FROM lamparas INNER JOIN area ON area.id_area = lamparas.id_area WHERE lamparas.id_area = $id_area";
    $sql_count_result = mysqli_query($con,$sql_count);
    while($interuptor = mysqli_fetch_array($sql_count_result)){
        $id_lampara = $interuptor["id_lampara"];
        $descripcion = $interuptor["descripcion"];
        $status_lampara = $interuptor["status_lamparas"];
        $control_manual = $interuptor["control_manual_lampara"];
        $direccion_ip = $interuptor["direccion_ip"];
        $array = array(intval($id_area),intval($id_lampara));
        ?>
        <div class="hijo_botons">
            <div class="row">
            <div class="col-md-12">
                <div id="<?php echo $descripcion; ?>" class="d-flex justify-content-center">
                    <div class="p-2">
                        <?php echo $descripcion; ?>
                    </div>
                </div> 
            </div>    
            </div>
            <div class="row">
                <button type="button" id='<?php echo json_encode($array); ?>' class="button_recon"></button>
            </div>
        <?php
        if($status_lampara){ ?>  
            <input id="input_<?php echo $id_lampara; ?>" type="button" class="button_red" data-direccion_ip="<?php echo $direccion_ip; ?>" data-id_lampara="<?php echo $id_lampara; ?>" data-control_manual="<?php echo $control_manual; ?>"></input>
        <?php } else{ ?>
            <input id="input_<?php echo $id_lampara; ?>" type="button" class="button_red button_grey" data-direccion_ip="<?php echo $direccion_ip; ?>" data-id_lampara="<?php echo $id_lampara; ?>" data-control_manual="<?php echo $control_manual; ?>"></input>
        <?php } ?>
        
        </div> 
        <?php
    }
?>