<?php
	$opcion = $_POST['param'];
	switch($opcion){
		case 20000:
			include_once('../controlador/perfilc.php');
			$perfilc = new PerfilC();
			$retorno = $perfilc->listar();
			break;
		case 20001:
			include_once('../controlador/perfilc.php');
			$perfilc = new PerfilC();
			$retorno = $perfilc->add($_POST);
			break;	
		case 20002:
			include_once('../controlador/perfilc.php');
			$perfilc = new PerfilC();
			$retorno = $perfilc->editar($_POST);
			break;	
		case 20003:
			include_once('../controlador/perfilc.php');
			$perfilc = new PerfilC();
			$retorno = $perfilc->buscar($_POST);
			break;	
		case 20004:
			include_once('../controlador/perfilc.php');
			$perfilc = new PerfilC();
			$retorno = $perfilc->eliminar();
			break;
		case 30000:
			include_once('../controlador/usuarioc.php');
			$usuarioc = new UsuarioC();
			$retorno = $usuarioc->listar();
			break;	
		case 30001:
			include_once('../controlador/usuarioc.php');
			$usuarioc = new UsuarioC();
			$retorno = $usuarioc->add($_POST);
			break;
		case 30002:
			include_once('../controlador/usuarioc.php');
			$perfilc = new UsuarioC();
			$retorno = $perfilc->editar($_POST);
			break;	
		case 30003:
			include_once('../controlador/usuarioc.php');
			$usuarioc = new UsuarioC();
			$retorno = $usuarioc->buscar($_POST);
			break;	
		case 30004:
			include_once('../controlador/usuarioc.php');
			$usuarioc = new UsuarioC();
			$retorno = $usuarioc->eliminar();
			break;
		case 40000:
			include_once('../controlador/programac.php');
			$programac = new ProgramaC();
			$retorno = $programac->listar();
			break;	
		case 40001:
			include_once('../controlador/programac.php');
			$programac = new ProgramaC();
			$retorno = $programac->add($_POST);
			break;
		case 40002:
			include_once('../controlador/programac.php');
			$perfilc = new ProgramaC();
			$retorno = $perfilc->editar($_POST);
			break;	
		case 40003:
			include_once('../controlador/programac.php');
			$programac = new ProgramaC();
			$retorno = $programac->buscar($_POST);
			break;	
		case 40004:
			include_once('../controlador/programac.php');
			$programac = new ProgramaC();
			$retorno = $programac->eliminar();
			break;
		case 50000:
			include_once('../controlador/ticketc.php');
			$ticketc = new TicketC();
			$retorno = $ticketc->listar();
			break;	
		case 50001:
			include_once('../controlador/ticketc.php');
			$ticketc = new TicketC();
			$retorno = $ticketc->add($_POST);
			break;
		case 50002:
			include_once('../controlador/ticketc.php');
			$ticketc = new TicketC();
			$retorno = $ticketc->editar($_POST);
			break;	
		case 50003:
			include_once('../controlador/ticketc.php');
			$ticketc = new TicketC();
			$retorno = $ticketc->buscar($_POST);
			break;	
		case 50004:
			include_once('../controlador/ticketc.php');
			$ticketc = new TicketC();
			$retorno = $ticketc->eliminar();
			break;
		case 60000:
			include_once('../controlador/areac.php');
			$areac = new AreaC();
			$retorno = $areac->listar();
			break;	
		case 60001:
			include_once('../controlador/areac.php');
			$areac = new AreaC();
			$retorno = $areac->add($_POST);
			break;
		case 60002:
			include_once('../controlador/areac.php');
			$areac = new AreaC();
			$retorno = $areac->editar($_POST);
			break;	
		case 60003:
			include_once('../controlador/areac.php');
			$areac = new AreaC();
			$retorno = $areac->buscar($_POST);
			break;	
		case 60004:
			include_once('../controlador/areac.php');
			$areac = new AreaC();
			$retorno = $areac->eliminar();
			break;
		case 70000:
			include_once('../controlador/prioridadc.php');
			$prioridadc = new PrioridadC();
			$retorno = $prioridadc->listar();
			break;	
		case 70001:
			include_once('../controlador/prioridadc.php');
			$prioridadc = new PrioridadC();
			$retorno = $prioridadc->add($_POST);
			break;
		case 70002:
			include_once('../controlador/prioridadc.php');
			$prioridadc = new PrioridadC();
			$retorno = $prioridadc->editar($_POST);
			break;	
		case 70003:
			include_once('../controlador/prioridadc.php');
			$prioridadc = new PrioridadC();
			$retorno = $prioridadc->buscar($_POST);
			break;	
		case 70004:
			include_once('../controlador/prioridadc.php');
			$prioridadc = new PrioridadC();
			$retorno = $prioridadc->eliminar();
			break;					
	}
	echo json_encode($retorno);
?>