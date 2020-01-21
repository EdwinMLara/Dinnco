<ul class="nav nav-tabs">
<?php
    require_once("conexion.php");
    if($con){
        $sql_total_paginas = "SELECT * FROM area";
        $sql_result = mysqli_query($con,$sql_total_paginas);
        $aux_page = 1;
         while($area = mysqli_fetch_array($sql_result)){
            $nombre_area = $area["nombre_area"];?>
                <li class="nav-item">
                    <input id="<?php echo $nombre_area; ?>" type="hidden" value="<?php echo $aux_page; ?>">
                    <a class="nav-link active" href="<?php echo 'index.php?area='.$aux_page; ?>"><?php echo $nombre_area; ?></a>
                </li>
            <?php
            $aux_page += 1;
         }
    }?>
        
</ul>

