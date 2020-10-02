<?php
if ($_POST['clavenueva']==$_POST['clavenueva2']) {
	include_once('../controlador/usuarioc.php');
	$usuarioc = new UsuarioC();
	$retorno = $usuarioc->validarpass($_POST['claveactual']);
	if ($retorno) {
		$retorno2 = $usuarioc->actualizarpass($_POST['clavenueva']);
		if ($retorno2) {
			header("Location: ../vista/admpass.php ?mensaje=Las contraseña se cambio correctamente.");
		}else
			header("Location: ../vista/admpass.php ?mensaje=Error en el cambio de contraseña.");
	}
	else{
		header("Location: ../vista/admpass.php ?mensaje=Las contraseñas no coinciden");	
	}
}else{
	header("Location: ../vista/admpass.php ?mensaje=Las contraseñas no coinciden");
}
?>