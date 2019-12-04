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
                <div class="row">                  
                        <?php
                            require_once("conexion.php");
                            if($con){
                                $sql = "SELECT * FROM lamparas";
                                $lamparas = mysqli_query($con,$sql);
                                while($lampara = mysqli_fetch_array($lamparas)){
                                    $id_lampara = $lampara["id_lampara"];
                                    $descripcion = $lampara["Descripcion"];
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
                                            <label>$descripcion</label>
                                        </div>
                                        <button id='btn-$id_lampara' class='$class' onclick='encender(\"http://$ip_address\",\"response-$id_lampara\",\"$id_lampara\");'>$tag_btn</button>
                                        <p id='response-$id_lampara'>response $id_lampara</p>
                                    </div>";
                                }
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