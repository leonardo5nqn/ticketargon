<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include_once('validar.php');
include_once('conexion.php');


class AreaC{
	var $oarea = null;
	public function __construct(){
    	$driver = new mysqli_driver();
      	$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
	}
	public function buscar($post){
		$areaid = $post['param1'];
		$_SESSION['sareaid'] = $areaid;
		$mysqli = Conexion::abrir();
		$sql = "SELECT areaid, descripcion, estado FROM area WHERE areaid = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i',$areaid);
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
		$sql = "SELECT areaid, descripcion, estado FROM area";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr = array();
				$arr['areaid'] = $fila[0];
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
		$sql = "INSERT INTO area (descripcion, estado) VALUES (?,?)";
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
	public function eliminar($post){
		$areaid = $post['id'];
		$mysqli = Conexion::abrir();
		$sqlvalidar = "SELECT count(ticketid) as cantidad FROM ticket WHERE areaid=".$areaid;
		$stmtvalidar = $mysqli->prepare($sqlvalidar);
		$stmtvalidar->execute();
		$rs = $stmtvalidar->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				
				if ($fila[0]>0){
					$stmtvalidar->close();
					return false;			
				}
			}	
		}
		
		$sql = "DELETE FROM area WHERE areaid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){
			$estado = 0;		
			$stmt->bind_param('i',$areaid);
			$stmt->execute();
			$stmt->close();			
		}
		return true;
	}
	public function editar($post){
		$areaid = $_SESSION['sareaid'];
		$descripcion = $post['param1'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "UPDATE area SET descripcion = ? WHERE areaid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){						
			$stmt->bind_param('si',$descripcion,$areaid);
			$stmt->execute();
			$stmt->close();
		}
		return;
	}
	public static function select(){
		$ret = '';
		$mysqli = Conexion::abrir();
		$sql = "SELECT areaid, descripcion FROM area WHERE estado = 0 ";
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
	public function asignar($post){
		$ticketid=$post['aticketid'];
		$area=$post['aarea'];
		$tecnico = $post['atecnico'] == 0 || $post['atecnico'] == "0" ? 'NULL' : $post['atecnico'] ;
		$error=false;
		$mysqli = Conexion::abrir();

		$sqlvalidar = "SELECT count(usuarioid) as cantidad FROM usuario WHERE areaid=".$area;
		$stmtvalidar = $mysqli->prepare($sqlvalidar);
		$stmtvalidar->execute();
		$rs = $stmtvalidar->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				
				if ($fila[0]>0){
					$stmtvalidar->close();
					// El usuario corresponde al area
					$sql = "UPDATE ticket SET areaid=".$area.", tecnicoid=".$tecnico." WHERE ticketid= ".$ticketid; 
					$stmt = $mysqli->prepare($sql);
					if($stmt!==FALSE){
						$stmt->execute();
						return true;
					}else{
						return false;
					}
				}else{
					// El usuario no corresponde al area
					return false;			
				}
			}	
		}

		return $error;	
	}
}
?>