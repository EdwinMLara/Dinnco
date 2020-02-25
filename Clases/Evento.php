<?php
	class Evento{
		public $id_evento;
		public $fecha;
		public $color;
		public $rendering;

		function __construct($id_evento,$fecha,$color){
			$this->id_evento = $id_evento;
			$this->fecha = $fecha;
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