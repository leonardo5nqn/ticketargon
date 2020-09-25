<?php
include_once('validar.php');
include_once('conexion.php');


class PrioridadC{
	var $oprioridad = null;
	public function __construct(){

	}
	public function buscar($post){
		$prioridadid = $post['param1'];
		$_SESSION['sprioridadid'] = $areaid;
		$mysqli = Conexion::abrir();
		$sql = "SELECT prioridadid, descripcion, estado FROM area WHERE prioridadid = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i',$prioridadid);
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
		$sql = "SELECT prioridadid, descripcion, estado FROM prioridad";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr = array();
				$arr['prioridadid'] = $fila[0];
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
		$sql = "INSERT INTO prioridad (descripcion, estado) VALUES (?,?)";
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
		$prioridadid = $_SESSION['sprioridadid'];
		$mysqli = Conexion::abrir();
		$sql = "DELETE FROM area WHERE prioridadid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){
			$estado = 0;		
			$stmt->bind_param('i',$prioridadid);
			$stmt->execute();
			$stmt->close();			
		}
		return;
	}
	public function editar($post){
		$prioridadid = $_SESSION['sprioridadid'];
		$descripcion = $post['param1'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "UPDATE prioridad SET descripcion = ? WHERE prioridadid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){						
			$stmt->bind_param('si',$descripcion,$prioridadid);
			$stmt->execute();
			$stmt->close();
		}
		return;
	}
	public static function select(){
		$ret = '';
		$mysqli = Conexion::abrir();
		$sql = "SELECT prioridadid, descripcion FROM prioridad WHERE estado = 0 ";
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