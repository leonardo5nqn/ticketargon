<?php
	class Programa{
		var $programaid;
		var $nombre;
		var $link;
		var $padre;
		var $esopcion;
		var $orden;
		var $estado;

		public function __construct(){
			$this->estado = 0;
		}
		public function getProgramaId(){
			return $this->programaid;
		}
		public function setProgramaId($programaid){
		$this->programaid = $programaid;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getLink(){
			return $this->link;
		}
		public function setLink($link){
			$this->link = $link;
		}
		public function getPadre(){
			return $this->padre;
		}
		public function setPadre($padre){
			$this->padre = $padre;
		}
		public function getEsopcion(){
			return $this->esopcion;
		}
		public function setEsopcion($esopcion){
			$this->esopcion = $esopcion;
		}
		public function getOrden(){
			return $this->orden;
		}
		public function setOrden($orden){
			$this->orden = $orden;
		}
			public function getEstado(){
			return $this->estado;
		}
		public function setEstado($link){
			$this->estado = $estado;
		}

}

?>