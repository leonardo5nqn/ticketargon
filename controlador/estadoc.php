<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include_once('validar.php');
include_once('conexion.php');


class EstadoC{
	var $oestado = null;
	public function __construct(){

	}
	public function buscar($post){
		$estadoid = $post['param1'];
		$_SESSION['sperfilid'] = $estadoid;
		$mysqli = Conexion::abrir();
		$sql = "SELECT estadoid, descripcion, estado FROM estado WHERE estadoid = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i',$estadoid);
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
		$sql = "SELECT estadoid, descripcion, estado FROM estado ORDER BY 2 DESC";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr = array();
				$arr['estadoid'] = $fila[0];
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
		$sql = "INSERT INTO estado (descripcion, estado) VALUES (?,?)";
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
		$estadoid = $_SESSION['sestadoid'];
		$mysqli = Conexion::abrir();
		$sql = "DELETE FROM estado WHERE estadoid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){
			$estado = 0;		
			$stmt->bind_param('i',$estadoid);
			$stmt->execute();
			$stmt->close();			
		}
		return;
	}
	public function editar($post){
		$estadoid = $_SESSION['sestadoid'];
		$descripcion = $post['param1'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "UPDATE estado SET descripcion = ? WHERE estadoid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){						
			$stmt->bind_param('si',$descripcion,$estadoid);
			$stmt->execute();
			$stmt->close();
		}
		return;
	}
	public static function select($sAnd){
		$ret = '';
		$mysqli = Conexion::abrir();
		$sql = "SELECT estadoid, descripcion FROM estado";
		$stmt = $mysqli->prepare($sql);
		if($stmt!==FALSE){
			$stmt->execute();
			$rs = $stmt->get_result();
			while($fila=$rs->fetch_array()){
				$ret .= '<option value="'.$fila[0].'">'.$fila[1].'</option>';
			}
		}
		return $ret;
	}
}
?>