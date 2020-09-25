<?php
class Usuario{
	var $usuarioid;
	var $usuario;
	var $nombre;
	var $apellido;
	var $correo;
	var $clave;
	var $perfil;
	var $descripcion;

	public function __construct(){
		$this->estado = 0;
	}
	public function getUsuarioId(){
		return $this->usuarioid;
	}
	public function setUsuarioId($usuarioid){
		$this->usuarioid = $usuarioid;
	}
	public function getUsuario(){
		return $this->usuario;
	}
	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getApellido(){
		return $this->apellido;
	}
	public function setApellido($apellido){
		$this->apellido = $apellido;
	}
	public function getCorreo(){
		return $this->correo;
	}
	public function setCorreo($correo){
		$this->correo = $correo;
	}
	public function getClave(){
		return $this->clave;
	}
	public function setClave($clave){
		$this->clave = $clave;
	}
	public function getPerfil(){
		return $this->perfil;
	}
	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}

}
?>