<?php

class Area{
	private $areaid;
	private $descripcion;
	private $estado;

	public function __construct(){
		$this->areaid = 0;
		$this->descripcion = '';
		$this->estado = 0;
	}
	public function getAreaId(){
		return $this->areaid;
	}
	public function setEAreaId($areaid){
		$this->areaid = $areaid;
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