<?php
	class Evento{
		public $id_evento;
		public $title;
		public $start;
		public $fecha_end;
		public $color;
		public $rendering;

		function __construct($id_lampara,$fecha_start,$color){
			$this->title = $id_lampara;
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