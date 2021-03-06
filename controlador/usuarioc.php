<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include_once('conexion.php');
include_once('perfilc.php');

class UsuarioC{
	public function __construct(){
		$driver = new mysqli_driver();
    	$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
	}
	public function buscar($post){
		$arr= array();
		$usuarioid = $post['param1'];
		$mysqli = Conexion::abrir();
		$sql = "SELECT nombre, apellido, usuario, correo, clave, perfilid, areaid, usuarioid FROM usuario WHERE usuarioid= ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i',$usuarioid);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr['nombre'] = $fila[0];
				$arr['apellido'] = $fila[1];
				$arr['usuario'] = $fila[2];
				$arr['correo'] = $fila[3];
				$arr['clave'] = $fila[4];
				$arr['perfilid'] = $fila[5];
				$arr['areaid'] = $fila[6];
				
				$_SESSION['susuarioid'] = $fila[7];
			}
		}
		$stmt->close();
		return $arr;
	}
	public function listar(){
		$mysqli = Conexion::abrir();
		$arr = array();
		$arr2 = array();
		$sql = "SELECT u.nombre, u.apellido, u.usuario, u.correo, u.clave, p.descripcion, a.descripcion, u.usuarioid FROM usuario u INNER JOIN perfil p ON u.perfilid=p.perfilid
		INNER JOIN area a ON u.areaid=a.areaid WHERE u.estado=0";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr['nombre'] = $fila[0];
				$arr['apellido'] = $fila[1];
				$arr['usuario'] = $fila[2];
				$arr['correo'] = $fila[3];
				$arr['clave'] = $fila[4];
				$arr['perfilid'] = $fila[5];
				$arr['areaid'] = $fila[6];
				$arr['usuarioid'] = $fila[7];

				$arr2[] = $arr;
			}
		}
		$stmt->close();
		return array('data'=>$arr2);
	}
	public function add($post){
		$dnombre = $post['dnombre'];
		$dapellido = $post['dapellido'];
		$dusuario = $post['dusuario'];
		$dcorreo = $post['dcorreo'];
		$dclave = md5($post['dclave']);	
		$dperfilid = $post['dperfilid'];
		$dareaid = $post['dperfilid']==2? 1: $post['dareaid'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "INSERT INTO usuario (nombre, apellido, usuario, correo, clave, perfilid, areaid, estado) VALUES ('".$dnombre."','".$dapellido."','".$dusuario."','".$dcorreo."','".$dclave."',".$dperfilid.",".$dareaid.", 0)";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){			
			$estado = 0;		
			//$stmt->bind_param('sssssii',$dnombre,$dapellido,$dusuario,$dcorreo,$dclave,$dperfilid,$dareaid);
			$stmt->execute();
			$stmt->close();
			$arr = array('success'=>true);
		}
		return $arr;
	}
	public function eliminar(){
		$usuarioid = $_POST['id'];
		$mysqli = Conexion::abrir();
		$sql = "UPDATE usuario SET estado=1 WHERE usuarioid = ".$usuarioid;
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){
			$estado= 0;
			$stmt->execute();
			$stmt->close();			
		}
		return;
	}
	public function editar($post){
		$usuarioid = $_SESSION['susuarioid'];
		$dnombre = $post['dnombre'];
		$dapellido = $post['dapellido'];
		$dusuario = $post['dusuario'];
		$dcorreo = $post['dcorreo'];
		$dclave = $post['dclave'];
		$dperfilid = $post['dperfilid'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "UPDATE usuario SET nombre = ?, ";
		$sql .= " apellido = ?, ";
		$sql .= " usuario = ?, ";
		$sql .= " correo = ?, ";
		$sql .= " clave = ?, ";
		$sql .= " perfilid = ?,"; 
		$sql .= " areaid = ? WHERE usuarioid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){						
			$stmt->bind_param('sssssiii',$dnombre,$dapellido,$dusuario,$dcorreo,$dclave,$dperfilid,$areaid,$usuarioid);
			$stmt->execute();
			$stmt->close();
		}
		return;
	}
	public static function select($sAnd){
		$ret = '';
		$mysqli = Conexion::abrir();
		$sql = "SELECT perfilid, descripcion FROM perfil WHERE estado = 0 ".$sAnd;
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
			$us = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
						$usuario->$_SESSION['UserSession'] = $fila[0];
						$usuario->$_SESSION['snombre '] = $fila[1];
						$usuario->$_SESSION['sapellido'] = $fila[2];
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
	public function validarpass($pass){
		$error=false;
		$mysqli = Conexion::abrir();
		$sql = "SELECT * FROM usuario WHERE clave='".md5($pass)."'and usuarioid=".$_SESSION['UserSession'][0]['Id']; 
		$stmt = $mysqli->prepare($sql);
		if($stmt!==FALSE){
			$stmt->execute();
			$rs = $stmt->get_result();
			if($rs->num_rows>0){			
				$error=true;

			}
		}
		return $error;	
	}
	public function actualizarpass($pass){
		$error=false;
		$mysqli = Conexion::abrir();
		$sql = "UPDATE usuario SET clave='".md5($pass)."' WHERE usuarioid=".$_SESSION['UserSession'][0]['Id']; 
		$stmt = $mysqli->prepare($sql);
		if($stmt!==FALSE){
			$stmt->execute();
			$error=true;
		}
		return $error;	
	}
	public function traerarea($post){
		$arr= array();
		$areaid = $post['param1'];
		$mysqli = Conexion::abrir();
		$sql = "SELECT nombre, apellido, usuarioid FROM usuario WHERE areaid= ".$areaid;
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr['nombre'] = $fila[0];
				$arr['apellido'] = $fila[1];
				$arr['usuarioid'] = $fila[2];
				$arr2[] = $arr;
			}
		}
		$stmt->close();
		return array('data'=>$arr2);	
	}

}
?>