jQuery(document).ready(function(){
	jQuery('#home').on('click', function(){
		jQuery('#contenedor').load('vista/home.php')
	});
		jQuery('#ticket').on('click', function(){
		jQuery('#contenedor').load('vista/admticket.php')
	});
	jQuery('#usuario').on('click', function(){
		jQuery('#contenedor').load('vista/admusuarios.php')
	});
	jQuery('#perfiles').on('click', function(){
		jQuery('#contenedor').load('vista/admperfil.php')
	});
	jQuery('#info').on('click', function(){
		jQuery('#contenedor').load('vista/info.php')
	});
});