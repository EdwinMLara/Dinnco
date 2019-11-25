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
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="#">
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>    
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mc-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="index.php">Panel de Control</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="configuracion_lamparas.php">Configuracion de lampara</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <a class="navbar-brand" href="#">
                    <div class="logo">
                        <img src="img/insoel2.png" alt="logo">
                    </div>    
                </a>
            </ul>
      </div>
    </nav>
    <div class="container">
    	<div class="row">
    		
    		<div class="col-md-6 datos">
                <div class="row">                  
                        <?php
                            require_once("conexion.php");
                            if($con){
                                $sql = "SELECT * FROM lamparas";
                                $lamparas = mysqli_query($con,$sql);
                                while($lampara = mysqli_fetch_array($lamparas)){
                                    $id_lampara = $lampara["id_lampara"];
                                    $status = $lampara["status_lampara"];
                                    $ip_address = $lampara["ip_address"];

                                    if($status == 1){
                                        $class = "btn btn-danger";
                                        $tag_btn = "Off";
                                    } else if($status == 0){
                                        $class = "btn btn-success";
                                        $tag_btn = "On";
                                    } else if($status == 2){
                                        $class = "btn btn-warning disabled";
                                        $tag_btn = "Desactivado";
                                    }

                                    echo "
                                    <div class='col-md-4'>
                                        <div class='form-group'>
                                            <label> Lamparas $id_lampara</label>
                                        </div>
                                        <button id='btn-$id_lampara' class='$class' onclick='encender(\"http://$ip_address\",\"response-$id_lampara\",\"$id_lampara\");'>$tag_btn</button>
                                        <p id='response-$id_lampara'>response $id_lampara</p>
                                    </div>";
                                }
                            }
                        ?>
                </div>
                <div class="row">
                    <button onclick="actualizar_estado_base_datos('1','1');">Prueba</button>
                </div>    
            </div>
            <div class="col-md-6 calendar" id="calendar"></div>
    	</div>
    </div>
</body>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</html>