<?php
    require_once("conexion.php");
    if(isset($_GET["area"])){
        $id_area = $_GET["area"];
    }else{
        $id_area = "1";
    }
    $sql_count = "SELECT * FROM lamparas WHERE id_area = $id_area";
    $sql_count_result = mysqli_query($con,$sql_count);
    while($interuptor = mysqli_fetch_array($sql_count_result)){
        $id_lampara = $interuptor["id_lampara"];
        $status_lampara = $interuptor["status_lamparas"];
        $array = array(intval($id_area),intval($id_lampara));
        ?>
        <div class="hijo_botons">
            <button type="button" id='<?php echo json_encode($array); ?>' class="button_recon"></button>
        <?php
        if($status_lampara){ ?>  
            <input onClick="change()" id="input_<?php echo $id_lampara; ?>" type="button" class="button_red"></input>
        <?php } else{ ?>
            <input onClick="change()" id="input_<?php echo $id_lampara; ?>" type="button" class="button_red button_grey"></input>
        <?php } ?>
        
        </div> 
        <?php
    }
?>