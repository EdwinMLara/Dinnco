<?php
 	class Lampara {
 		public $id_lampara;
 		public $status_lampara;
 		public $ip_lampara;

 		function __construct($id_lampara,$status_lampara,$ip_lampara){
 			$this->id_lampara = $id_lampara;
 			$this->status_lampara = $status_lampara;
 			$this->ip_lampara = $ip_lampara;
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