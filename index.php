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
    <div id="main_container" class="container">
    	<div id="sistema" class="row add_padding_row">

    		<div class="col-md-6 datos">

                <div class="row">
                    <?php require_once("tabs.php"); ?>
                </div>

                <div id="botones" class="row"> 
                    <div class="padre_botons">
                        <?php require_once("interuptores.php"); ?>                                     
                    </div>
                </div> 

                <div class="row add_padding_row_int">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <div class="p-2">
                                <button type="button" id="Prueba" class="btn btn-success"> Control Manual Desactivado </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p id="response"></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6 calendar" id="calendar">      
            </div>

    	</div>
    </div>
</body>
<?php require_once("footer.php"); ?>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</html>