<?php

class Prioridad{
	private $prioridadid;
	private $descripcion;
	private $estado;

	public function __construct(){
		$this->prioridadid = 0;
		$this->descripcion = '';
		$this->estado = 0;
	}
	public function getPrioridadId(){
		return $this->prioridadid;
	}
	public function setPrioridadId($prioridadid){
		$this->prioridadid = $prioridadid;
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