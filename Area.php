<?php
    class Area{

        public $nombre_area;
        public $num_lamparas;
        public $control_manual;
        public $control_calendario;
        public $direccion_ip;

        public $lamparas = array();

        function __construct($nombre_area,$num_lamparas,$control_manual,$control_calendario,$direccion_ip,$lamparas){
            $this->nombre_area = $nombre_area;
            $this->num_lamparas = $num_lamparas;
            $this->control_manual = $control_manual;
            $this->control_calendario = $control_calendario;
            $this->direccion_ip = $direccion_ip;

            $this->lamparas = $lamparas;
        }
    }
?>