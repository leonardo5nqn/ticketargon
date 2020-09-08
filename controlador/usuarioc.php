<?php
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
		$sql = "SELECT nombre, apellido, fecnac, usuario, correo, clave, perfilid, usuarioid  FROM usuario WHERE usuarioid= ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i',$usuarioid);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr['nombre'] = $fila[0];
				$arr['apellido'] = $fila[1];
				$arr['fecnac'] = $fila[2];
				$arr['usuario'] = $fila[3];
				$arr['correo'] = $fila[4];
				$arr['clave'] = $fila[5];
				$arr['perfilid'] = $fila[6];
				
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
		$sql = "SELECT nombre, apellido, fecnac, usuario, correo, clave, perfilid, usuarioid FROM usuario";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$rs = $stmt->get_result();
		if($rs->num_rows>0){
			while($fila=$rs->fetch_array()){
				$arr['nombre'] = $fila[0];
				$arr['apellido'] = $fila[1];
				$arr['fecnac'] = $fila[2];
				$arr['usuario'] = $fila[3];
				$arr['correo'] = $fila[4];
				$arr['clave'] = $fila[5];
				$arr['perfilid'] = $fila[6];
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
		$dfecnac = $post['dfecnac'];
		$dusuario = $post['dusuario'];
		$dcorreo = $post['dcorreo'];
		$dclave = $post['dclave'];	
		$dperfilid = $post['dperfilid'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "INSERT INTO usuario (nombre, apellido, fecnac, usuario, correo, clave, perfilid) VALUES (?,?,?,?,?,?,?)";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){			
			$estado = 0;		
			$stmt->bind_param('ssssssi',$dnombre,$dapellido,$dfecnac,$dusuario,$dcorreo,$dclave,$dperfilid);
			$stmt->execute();
			$stmt->close();
			$arr = array('success'=>true);
		}
		return $arr;
	}
	public function eliminar(){
		$usuarioid = $_SESSION['susuarioid'];
		$mysqli = Conexion::abrir();
		$sql = "DELETE FROM usuario WHERE usuarioid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){
			$estado= 0;
			$stmt->bind_param('i',$usuarioid);
			$stmt->execute();
			$stmt->close();			
		}
		return;
	}
	public function editar($post){
		$usuarioid = $_SESSION['susuarioid'];
		$dnombre = $post['dnombre'];
		$dapellido = $post['dapellido'];
		$dfecnac = $post['dfecnac'];
		$dusuario = $post['dusuario'];
		$dcorreo = $post['dcorreo'];
		$dclave = $post['dclave'];
		$dperfilid = $post['dperfilid'];
		//$destado = $post['destado'];
		$mysqli = Conexion::abrir();
		$mysqli->set_charset("utf8");
		$sql = "UPDATE usuario SET nombre = ?, ";
		$sql .= " apellido = ?, ";
		$sql .= " fecnac = ?, ";
		$sql .= " usuario = ?, ";
		$sql .= " correo = ?, ";
		$sql .= " clave = ?, ";
		$sql .= " perfilid = ? WHERE usuarioid = ?";
		$stmt = $mysqli->prepare($sql);
		if($stmt!== FALSE){						
			$stmt->bind_param('ssssssii',$dnombre,$dapellido,$dfecnac,$dusuario,$dcorreo,$dclave,$dperfilid,$usuarioid);
			$stmt->execute();
			$stmt->close();
		}
		return;
	}
	public function select(){
		$ret = '';
		$mysqli = Conexion::abrir();
		$sql = "SELECT perfilid, descripcion FROM perfil WHERE estado = 0";
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
}
?>