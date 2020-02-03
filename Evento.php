<?php
	class Evento{
		public $id_evento;
		public $id_lampara;
		public $start;
		public $color;
		public $rendering;

		function __construct($id_evento,$id_lampara,$fecha_start,$color){
			$this->id_evento = $id_evento;
			$this->id_lampara = $id_lampara;
			$this->start = $fecha_start;
			$this->color = $color;
			$this->rendering = "background";
		}

		function get_id_evento(){
			return $this->id_evento;
		}

		function get_id_lampara(){
			return $this->id_lampara;
		}

		function get_fecha_start(){
			return $this->fecha_start;
		}

		function get_fecha_end(){
			return $this->fecha_end;
		}

		function get_color(){
			return $this->color;
		}
	}
?>