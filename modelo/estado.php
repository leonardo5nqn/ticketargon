<?php

class Estado{
	private $estadoid;
	private $descripcion;
	private $estado;

	public function __construct(){
		$this->estadoid = 0;
		$this->descripcion = '';
		$this->estado = 0;
	}
	public function getEstadoId(){
		return $this->estadoid;
	}
	public function setEstadoId($estadoid){
		$this->estadoid = $estadoid;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function setEstado($estado){
		$this->estado = $estado;
	}
}
?>