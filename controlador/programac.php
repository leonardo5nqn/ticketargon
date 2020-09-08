	<?php
include_once('validar.php');
include_once('conexion.php');
include_once('usuarioc.php');
include_once('perfilc.php');

class ProgramaC{
	public function __construct(){
		$driver = new mysqli_driver();
    	$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
	}
	public function buscar($post){
		$arr= array();
		$programaid = $post['param1'];
		$mysqli = Conexion::abrir();
		$sql = "SELECT nombre, link, padre, esopcion, orden, estado, programaid  FROM programa WHERE programaid= ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i',$programaid);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr['nombre'] = $fila[0];
				$arr['link'] = $fila[1];
				$arr['padre'] = $fila[2];
				$arr['esopcion'] = $fila[3];
				$arr['orden'] = $fila[4];
				$arr['estado'] = $fila[5];
				$_SESSION['sprogramaid'] = $fila[6];
			}
		}
		$stmt->close();
		return $arr;
	}
	public function listar(){
		$mysqli = Conexion::abrir();
		$arr = array();
		$arr2 = array();
		$sql = "SELECT nombre, link, padre, esopcion, orden, estado, programaid FROM programa WHERE estado=0 ORDER BY 2 DESC";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr['nombre'] = $fila[0];
				$arr['link'] = $fila[1];
				$arr['padre'] = $fila[2];
				$arr['esopcion'] = $fila[3];
				$arr['orden'] = $fila[4];
				$arr['estado'] = $fila[5];				
				$arr['programaid'] = $fila[6];
				$arr2[] = $arr;
			}
		}
		$stmt->close();
		return array('data'=>$arr2);
	}
	public function add($post){
		$dnombre = $post['dnombre'];
		$dlink = $post['dlink'];
		$dpadre = $post['dpadre'];
		$desopcion = $post['desopcion'];	
		$dorden = $post['dorden'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "INSERT INTO programa (nombre, link, padre, esopcion, orden, estado) VALUES (?,?,?,?,?,?)";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){			
			$estado = 0;		
			$stmt->bind_param('ssssii',$dnombre,$dlink,$dpadre,$desopcion,$dorden,$estado);
			$stmt->execute();
			$stmt->close();
			$arr = array('success'=>true);
		}
		return $arr;
	}
	public function eliminar(){
		$programaid = $_SESSION['sprogramaid'];
		$arr= array('success'=>false);
		$mysqli = Conexion::abrir();
		$sql = "UPDATE programa SET estado = 119 WHERE programaid=?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){
			$stmt->bind_param('i',$programaid);
			$stmt->execute();
			$stmt->close();		
			$arr= array('success'=>true);	
		}
		return $arr;
	}
	public function editar($post){
		$programaid = $_SESSION['sprogramaid'];
		$dnombre = $post['dnombre'];
		$dlink = $post['dlink'];
		$dpadre = $post['dpadre'];
		$desopcion = $post['desopcion'];
		$dorden = $post['dorden'];
		$destado = $post['destado'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "UPDATE programa SET nombre = ?, ";
		$sql .= " link = ?, ";
		$sql .= " padre = ?, ";
		$sql .= " desopcion = ?, ";
		$sql .= " orden = ?, ";
		$sql .= " estado = ? WHERE programaid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){						
			$stmt->bind_param('ssssii',$dnombre,$dlink,$dpadre,$desopcion,$destado,$programaid);
			$stmt->execute();
			$stmt->close();
		}
		return;
	}
	public function select(){
		$ret = '';
		$mysqli = Conexion::abrir();
		$sql = "SELECT nombre, link, padre, esopcion, estado, programaid FROM programa WHERE estado = 0";
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
	public function validar($post){
		try{
			$error = false;
			$us = filter_input(INPUT_POST, 'programa', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			if($us===FALSE || is_null($us)) $error = true;
			$clave = $post['clave'];
			if(!$error){		
				$mysqli = Conexion::abrir();
				$sql = "SELECT usuario, nombre, apellido FROM usuario ";
				$sql .= "WHERE usuario = ? and clave = ?";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param('ss',$us,$clave);
				$stmt->execute();
				$rs = $stmt->get_result();
				if($rs->num_rows>0){
					while($fila=$rs->fetch_array()){
						$usuario->setUsuario($fila[0]);
						$usuario->setNombre($fila[1]);
						$usuario->setApellido($fila[2]);
					}
				}else{
					$usuario = false;
				}
				//$stmt->close();
			}else{
				$usuario = $error;
			}

		}catch(Exception $e){
			$usuario =  $e->getMessage();
		}
		finally{
			if(isset($stmt))
				$stmt->close();
		}

		return $usuario;
	}
}
?>