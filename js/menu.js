jQuery(document).ready(function(){
	jQuery('#home').on('click', function(){
		jQuery('#contenedor').load('vista/home.php')
	});
	jQuery('#ticket').on('click', function(){
		jQuery('#contenedor').load('vista/admticket.php')
	});
	jQuery('#ticketcli').on('click', function(){
		jQuery('#contenedor').load('vista/admticket.php')
	});
	jQuery('#usuario').on('click', function(){
		jQuery('#contenedor').load('vista/admusuarios.php')
	});
	jQuery('#perfiles').on('click', function(){
		jQuery('#contenedor').load('vista/admperfil.php')
	});
	jQuery('#areas').on('click', function(){
		jQuery('#contenedor').load('vista/admarea.php')
	});
	jQuery('#prioridades').on('click', function(){
		jQuery('#contenedor').load('vista/admprioridad.php')
	});
	jQuery('#pass').on('click', function(){
		jQuery('#contenedor').load('vista/admpass.php')
	});
	jQuery('#info').on('click', function(){
		jQuery('#contenedor').load('vista/info.php')
	});

	dashboard();

});

function dashboard(){

		jQuery.ajax({
			async:true,
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:80000},
			dataType:'json',
			success:function(r){
				jQuery('#cantticket').html(r.cantticket);
				jQuery('#totalsinasig').html(r.cantasignado);
				jQuery('#totalprioalta').html(r.cantalta);
				jQuery('#totaluser').html(r.cantuser);
			}
		});
}