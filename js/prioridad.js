jQuery(document).ready(function(){
	listar();
	jQuery('#addprioridad').on('click',function(){
		jQuery('#ventanaprioridad').modal('show');		
	});

	jQuery('#grabar').on('click', function(){
		var error = false;
		if(jQuery('#descripcion').val()==''){
			error = true;
			alert('falta la descripcion');
		}
		if(!error){
			var datos = {
				param:70001,
				descripcion:jQuery('#descripcion').val()
			};
			jQuery.ajax({
				type:'post',
				data:datos,
				url:'scripts/seguridad.php',
				dataType:'json',
				success:function(r){
					if(r.success){				
						jQuery('#formprioridaddesc').css('display','none');
						listar();
					}else{
						alert('Error');
					}
				}
			});
		}	
	});	
	jQuery('#descripcion').on('keypress',function(){
		jQuery(this).css('background-color','white');
	});
	jQuery('#tablaprioridad tbody').on('click', '.editar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:70003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#descprioridad').val(r.descripcion);
				jQuery('#prioridadid').val(id);
				jQuery('#modalprioridad').modal('show');
			}
		});
	});	
	jQuery('#tablaprioridad tbody').on('click', '.eliminar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:70003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#eprioridadid').val(id)
				jQuery('#modalprioridadeliminar').modal('show');
			}
		});
	});
	jQuery('#editarprioridad').on('click', function(){
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:70002,param1:jQuery('#descprioridad').val(),id:jQuery('#prioridadid').val()},
			dataType:'json',
			success:function(r){
				jQuery('#modalprioridad').modal('hide');
				listar();
			}
		});
	});	
	jQuery('#eliminarprioridad').on('click', function(){
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:70004,id:jQuery('#eprioridadid').val()},
			dataType:'json',
			success:function(r){
				if (r==false) {
					alert('No se puede eliminar. La prioridad se encuentra asignada a un ticket.');
				}
				jQuery('#modalprioridadeliminar').modal('hide');
				listar();
			}
		});
	});
});
function listar(){
	jQuery('#tablaprioridad tbody').empty();
	jQuery.ajax({
		type:'post',
		url:'scripts/seguridad.php',
		asyc: true,
		data:{param:70000},
		dataType:'json',
		success:function(r){
			console.log(r.data);
			jQuery.each(r.data,function(k,v){
				var fila = '<tr><td>'+v.prioridadid+'</td><td>'+v.descripcion+'</td><td>'+v.estado+'</td>';
				fila += '<td><button id="'+v.prioridadid+'" class="btn btn-primary editar">Editar</button></td><td><button id="'+v.prioridadid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
				jQuery('#tablaprioridad tbody').append(fila);
			})
		}
	});
}
function ejemplo(param){
	console.log(param);
}