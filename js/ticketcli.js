jQuery(document).ready(function(){
	listar();
	jQuery('#addticket').on('click',function(){
		jQuery('#ventanaticket').modal('show');		
	});
	
	jQuery('#grabar').on('click', function(){
		var error = false;
		if(jQuery('#descripcion').val()==''){
			error = true;
			alert('Falta descripcion.');
		}
		
		if(!error){
			var datos = {
				param:50001,
				dusuarioid:jQuery('#usuarioid').val(),
				dtitulo:jQuery('#titulo').val(),
				ddescripcion:jQuery('#descripcion').val(),
				dprioridadid:jQuery('#prioridad').val(),
				dipservidor:jQuery('#ipservidor').val(),
				dclaveservidor:jQuery('#claveservidor').val(),	
				destado:jQuery('#estado').val(),
			};
			jQuery.ajax({
				type:'post',
				data:datos,
				url:'scripts/seguridad.php',
				dataType:'json',
				success:function(r){
					if(r.success){				
						jQuery('#formticket').css('display','none');
						listar();
					}else{
						alert('Error');
					}
				}
			});
		}
		$(".modal-body input").val('');
	});

	jQuery('#titulo').on('keypress',function(){
		jQuery(this).css('background-color','white');
	});
	jQuery('#tablatickets tbody').on('click', '.asignar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			async:true,
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:50003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#aticketid').val(r.ticketid);
				jQuery('#aarea').val(r.areaid);

				if (!isNaN (r.areaid)) {
					listaruser(r.tecnicoid);
				}

				jQuery('#modalarea').modal('show');
				
			}
		});
	});
	jQuery('#tablatickets tbody').on('click', '.historial', function(){
		var id = jQuery(this).attr('id');
		listarhistorial(id);
		jQuery('#hticketid').val(id);
		jQuery('#modalhistorial').modal('show');
		
	});
	jQuery('#tablatickets tbody').on('click', '.editar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			async:true,
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:50003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#dticketid').val(r.ticketid);
				jQuery('#dusuarioid').val(r.usuarioid);
				jQuery('#dtitulo').val(r.titulo);
				jQuery('#ddescripcion').val(r.descripcion);
				jQuery('#dprioridad').val(r.prioridadid);
				jQuery('#dipservidor').val(r.ipservidor);
				jQuery('#dclaveservidor').val(r.claveservidor);
				jQuery('#destado').val(r.estado)
				jQuery('#modalticket').modal('show');
				
			}
		});
	});
	
	jQuery('#tablatickets tbody').on('click', '.eliminar', function(){
		$('#eticketid').val($(this).attr('id')); 
		jQuery('#modalticketeliminar').modal('show');
	});

	jQuery('#editarticket').on('click', function(){
		var datos=jQuery('#fticket1').serialize();
		datos+='&param=50002';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalticket').modal('hide');
				listar();
			}
		});
	});
	jQuery('#eliminarticket').on('click', function(){
		datos='id='+jQuery('#eticketid').val();
		datos+='&param=50004';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalticketeliminar').modal('hide');
				listar();
			}
		});
	});
	jQuery('#asignarticket').on('click', function(){
		var datos=jQuery('#fticketarea').serialize();
		datos+='&param=60005';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalarea').modal('hide');
				listar();
			}
		});
	});
	jQuery('#guardarhistorial').on('click', function(){
		var datos=jQuery('#ftickethistorial').serialize();
		datos+='&param=90001';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalhistorial').modal('hide');
				listar();
			}
		});
	});
});
	function listar(){
		jQuery('#tablatickets tbody').empty();
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:50000},
			dataType:'json',
			success:function(r){
				jQuery.each(r.data,function(k,v){
					var fila = '';

					fila = '<tr><td>'+v.usuarioid+'</td><td>'+v.titulo+'</td><td>'+v.descripcion+'</td><td>'+v.prioridad+'</td><td>'+v.ipservidor+'</td><td>'+v.claveservidor+'</td><td>'+v.areaid+'</td>';
					//Admin
					if (r.rol=='1') {
						fila += '<td><button id="'+v.ticketid+'" class="btn btn-primary asignar">Asignar</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary historial">Historial</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary editar">Editar</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
					}
					//Cliente
					if (r.rol=='2') {
						fila += '<td><button id="'+v.ticketid+'" class="btn btn-primary asignar" disabled>Asignar</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary historial">Historial</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary editar">Editar</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
					}
					//Tecnico
					if (r.rol=='3') {
						fila += '<td><button id="'+v.ticketid+'" class="btn btn-primary asignar" disabled>Asignar</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary historial">Historial</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary editar" disabled>Editar</button></td><td><button id="'+v.ticketid+'" class="btn btn-primary eliminar" disabled>Eliminar</button></td></tr>';
					}
				
				jQuery('#tablatickets tbody').append(fila);
				
				})
			}
		});
	};

	function mostrarserv()
	{
		$('#divservidor')[0].hidden=false;

		if($('#servidores').val()== 2)
		{
			$('#divservidor').css('display','none');
		}
		else{
			$('#divservidor').css('display','inline');
		}
	}
	function listaruser(tecnicoid)
	{
		var id = jQuery('#aarea').val();
		jQuery('#atecnico').html('');
		var option = "<option value='0' selected>Seleccione un Tecnico</option>";
		jQuery('#atecnico').append(option);
		jQuery.ajax({
			async:true,
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:30005,param1:id},
			dataType:'json',
			success:function(r){
				jQuery.each(r.data,function(k,v){
					option = "<option value='"+v.usuarioid+"'>"+v.nombre+" "+v.apellido+"</option>";
					jQuery('#atecnico').append(option);
				})
					if (tecnicoid !== 'undefined') {
					jQuery('#atecnico').val(tecnicoid);
				}
			}
		});
	}
	function listarhistorial(ticketid)
	{
		jQuery.ajax({
			async:true,
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:90000,ticketid:ticketid},
			dataType:'json',
			success:function(r){
				jQuery('#tablahistorial').html(r);
			}
		});
	}