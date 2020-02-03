<?php
    require_once("conexion.php");
    if($con){
        $sql_total_paginas = "SELECT * FROM area";
        $sql_result = mysqli_query($con,$sql_total_paginas);
        $bandera = 0;
         while($area = mysqli_fetch_array($sql_result)){
            if(!$bandera){ ?>
                <ul class="nav nav-tabs">
            <?php
                $area_inicial = $area["id_area"];  
            }
            $aux_page = $area["id_area"];
            $nombre_area = $area["nombre_area"]; ?>
                <li class="nav-item">
                    <input id="<?php echo $nombre_area; ?>" type="hidden" value="<?php echo $aux_page; ?>">
                    <a class="nav-link active" href="<?php echo 'index.php?area='.$aux_page; ?>"><?php echo $nombre_area; ?></a>
                </li>
            <?php
            $bandera++;
         }
         if(!$bandera){
             $area_inicial = 0;
            echo '<div class="No_dispositivos"> No hay dispositivos Registrados </div>';
         }else{
            echo '</ul>'; 
         }
    }?>
        

