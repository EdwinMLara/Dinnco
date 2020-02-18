<?php
 	class Lampara {
 		public $id_lampara;
 		public $status_lampara;
		public $control_manual;
		public $eventos = array(); 

 		function __construct($id_lampara,$status_lampara,$control_manual,$eventos){
 			$this->id_lampara = $id_lampara;
 			$this->status_lampara = $status_lampara;
			$this->control_manual = $control_manual;
			$this->eventos =  $eventos;
 		}

 		function get_id_lampara(){
 			return $this->id_lampara;
 		}

 		function get_status_lampara(){
 			return $this->status_lampara;
 		}

 		function get_ip_lampara(){
 			return $this->ip_lampara;
 		}
 	}
?>