<?php
session_start();
include "conexionlg.php";
$re=mysql_query("select * from usuario where usuario='".$_POST['usuario']."' AND 
 					clave='".md5($_POST['clave'])."'")	or die(mysql_error());
	while ($f=mysql_fetch_array($re)) {
		$arreglo[]=array('Usuario'=>$f['usuario'],
			'PerfilId'=>$f['perfilid'], 'Id'=>$f['usuarioid'], 'Nombre'=>$f['nombre'], 'Apellido'=>$f['apellido'],);
	}
	if(isset($arreglo)){
		$_SESSION['UserSession']=$arreglo;
		header("Location: ../index.php");
	}else{
		header("Location: ../vista/login.php ?error=datos no validos");
	}
?>
