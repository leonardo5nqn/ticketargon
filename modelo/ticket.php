<?php
class Ticket{

	var $ticketid;
	var $usuarioid;
	var $titulo;
	var $descripcion;
	var $fechainicio;
	var $fechafin;
	var $ipservidor;
	var $claveservidor;
	var $prioridad;
	
	/*
	DIRECCION IP DEL SERVIDOR
	CLAVE DEL SERVIDOR
	*/

	public function __construct(){
		$this->estado = 0;
	}
	public function getTicketId(){
		return $this->ticketid;
	}
	public function setTicketId($ticketid){
		$this->ticketid = $ticketid;
	}	
	public function getUsuarioId(){
		return $this->usuarioid;
	}
	public function setUsuarioId($usuarioid){
		$this->usuarioid = $usuarioid;
	}
	public function getTitulo(){
		return $this->Titulo;
	}
	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	public function getFechaInicio(){
		return $this->fechainicio;
	}
	public function setFechaInicio($fechainicio){
		$this->fechainicio = $fechainicio;
	}
	public function getFechaFin(){
		return $this->fechafin;
	}
	public function setFechaFin($fechafin){
		$this->fechafin = $fechafin;
	}
	public function getIpServidor(){
		return $this->ipservidor;
	}
	public function setIpServidor($ipservidor){
		$this->ipservidor = $ipservidor;
	}
	public function getClaveServidor(){
		return $this->claveservidor;
	}
	public function setClaveServidor($claveservidor){
		$this->claveservidor = $claveservidor;
	}
	public function getPrioridad(){
		return $this->prioridad;
	}
	public function setPrioridad($prioridad){
		$this->prioridad = $prioridad;
	}
}
?>