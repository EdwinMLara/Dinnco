<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta class="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/home.css"/>
    <link href='calendar/packages/core/main.css' rel='stylesheet' />
    <link href='calendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='calendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='calendar/packages/list/main.css' rel='stylesheet' />
    <script src='calendar/packages/core/main.js'></script>
    <script src='calendar/packages/interaction/main.js'></script>
    <script src='calendar/packages/daygrid/main.js'></script>
    <script src='calendar/packages/timegrid/main.js'></script>
    <script src='calendar/packages/list/main.js'></script>
	<title>Diinco Panel de Control</title>
</head>
<body>
    <?php
        require_once("navbar.php");
    ?>
    <div class="container">
    	<div class="row">
    		
    		<div class="col-md-6 datos">
                <div class="row add_padding_row">
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
                </div>
                <div class="row">                  
                        <?php
                            if($con){
                                $inicio = 0;
                                $fin = 6;

                                if(isset($_GET["area"])){
                                    $id_area = $_GET["area"];
                                }else{
                                    $id_area = 1;
                                }

                                $sql = "SELECT * FROM lamparas WHERE id_area = $id_area";


                                $lamparas = mysqli_query($con,$sql);
                                while($lampara = mysqli_fetch_array($lamparas)){
                                    $id_lampara = $lampara["id_lampara"];
                                    $descripcion = $lampara["descripcion"];
                                    $status = $lampara["status_lamparas"];
                                    $ip_address = $lampara["control_manual"];

                                    if($status == 1){
                                        $class = "btn btn-danger";
                                        $tag_btn = "Off";
                                    } else if($status == 0){
                                        $class = "btn btn-success";
                                        $tag_btn = "On";
                                    } else if($status == 2){
                                        $class = "btn btn-warning disabled";
                                        $tag_btn = "Desactivado";
                                    }?>
                                    <div class='col-md-4'>
                                        <div class='form-group'>
                                            <label><?php echo $descripcion; ?></label>
                                        </div>
                                        <button id="<?php echo 'btn-'.$id_lampara; ?>" class='<?php echo 'btn-'.$class; ?>' onclick='encender();'><?php echo $tag_btn; ?></button>
                                        <p id='response-$id_lampara'>response <?php echo $id_lampara; ?></p>
                                    </div>
                                <?php }
                            }
                        ?>
                </div>
                <div class="row">
                </div>    
            </div>
            <div class="col-md-6 calendar" id="calendar"></div>
    	</div>
    </div>
    <?php require_once("footer.php"); ?>
</body>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</html>