<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include_once('validar.php');
include_once('conexion.php');


class PerfilC{
	var $operfil = null;
	public function __construct(){

	}
	public function buscar($post){
		$perfilid = $post['param1'];
		$_SESSION['sperfilid'] = $perfilid;
		$mysqli = Conexion::abrir();
		$sql = "SELECT perfilid, descripcion, estado FROM perfil WHERE perfilid = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i',$perfilid);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr = $fila;
			}
		}
		$stmt->close();
		return $arr;
	}
	public function listar(){
		$mysqli = Conexion::abrir();
		$arr1 = array();
		$sql = "SELECT perfilid, descripcion, estado FROM perfil ORDER BY 2 DESC";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr = array();
				$arr['perfilid'] = $fila[0];
				$arr['descripcion'] = $fila[1];
				$arr['estado'] = $fila[2];
				$arr1[] = $arr;
			}
		}
		$stmt->close();
		return array('data'=>$arr1);
	}
	public function add($post){
		$arr = array('success'=>false);
		$descripcion = $post['descripcion'];		
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "INSERT INTO perfil (descripcion, estado) VALUES (?,?)";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){			
			$estado = 0;		
			$stmt->bind_param('si',$descripcion,$estado);
			$stmt->execute();
			$stmt->close();
			$arr = array('success'=>true);
		}
		return $arr;
	}
	public function eliminar(){
		$perfilid = $_SESSION['sperfilid'];
		$mysqli = Conexion::abrir();
		$sql = "DELETE FROM perfil WHERE perfilid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){
			$estado = 0;		
			$stmt->bind_param('i',$perfilid);
			$stmt->execute();
			$stmt->close();			
		}
		return;
	}
	public function editar($post){
		$perfilid = $_SESSION['sperfilid'];
		$descripcion = $post['param1'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "UPDATE perfil SET descripcion = ? WHERE perfilid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){						
			$stmt->bind_param('si',$descripcion,$perfilid);
			$stmt->execute();
			$stmt->close();
		}
		return;
	}
	public function select(){
		
	}
}
?>