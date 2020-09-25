<?php
include_once('usuario.php');

class Cliente extends Usuario{
	var $numerotel;

	public function __construct(){
		$this->estado = 0;
	}
	public function getNumeroTel(){
		return $this->numerotel;
	}
	public function setNumeroTel($numerotel){
		$this->numerotel = $numerotel;
	}
	

}
?>