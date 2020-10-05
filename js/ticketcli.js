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
	jQuery('#tablatickets tbody').on('click', '.editar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:50003,param1:id},
			dataType:'json',
			success:function(r){
				console.log(id);
				jQuery('#dusuarioid').val(r.usuarioid);
				jQuery('#dtitulo').val(r.titulo);
				jQuery('#ddescripcion').val(r.descripcion);
				jQuery('#dprioridad').val(r.prioridad);
				jQuery('#dipservidor').val(r.ipservidor);
				jQuery('#dclaveservidor').val(r.claveservidor);
				jQuery('#destado').val(r.estado)
				jQuery('#modalticket').modal('show');
				
			}
		});
	});
	jQuery('#tablatickets tbody').on('click', '.eliminar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:50003,
				param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#eusuarioid').val(r.usuarioid);
				jQuery('#etitulo').val(r.titulo);
				jQuery('#edescripcion').val(r.descripcion);
				jQuery('#eprioridad').val(r.prioridad);
				jQuery('#eipservidor').val(r.ipservidor);
				jQuery('#eclaveservidor').val(r.claveservidor);
				jQuery('#eestado').val(r.estado);
				jQuery('#modalticketeliminar').modal('show');
			}
		});
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
		var datos=jQuery('#fticket2').serialize();
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
});
	function listar(){
		jQuery('#tablatickets tbody').empty();
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:50000},
			dataType:'json',
			success:function(r){
				console.log(r);
				jQuery.each(r.data,function(k,v){
					var fila = '<tr><td>'+v.usuarioid+'</td><td>'+v.titulo+'</td><td>'+v.descripcion+'</td><td>'+v.prioridad+'</td><td>'+v.ipservidor+'</td><td>'+v.claveservidor+'</td>';
					fila += '<td><button id="'+v.ticketid+'" class="btn btn-primary editar">Editar</button></td><td><button id='+v.ticketid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
					jQuery('#tablatickets tbody').append(fila);
				})
			}
		});
	};
	
	function ejemplo(param){
	console.log(param);
	}

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