jQuery(document).ready(function(){
	listar();
	jQuery('#addarea').on('click',function(){
		jQuery('#ventanaarea').modal('show');		
	});

	jQuery('#grabar').on('click', function(){
		var error = false;
		if(jQuery('#descripcion').val()==''){
			error = true;
			alert('falta la descripcion');
		}
		if(!error){
			var datos = {
				param:60001,
				descripcion:jQuery('#descripcion').val()
			};
			jQuery.ajax({
				type:'post',
				data:datos,
				url:'scripts/seguridad.php',
				dataType:'json',
				success:function(r){
					if(r.success){				
						jQuery('#formareadesc').css('display','none');
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
	jQuery('#tablaarea tbody').on('click', '.editar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:60003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#descarea').val(r.descripcion);
				jQuery('#modalarea').modal('show');
			}
		});
	});	
	jQuery('#tablaarea tbody').on('click', '.eliminar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:60003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#descareae').val(r.descripcion);
				jQuery('#modalareaeliminar').modal('show');
			}
		});
	});
	jQuery('#editararea').on('click', function(){
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:60002,param1:jQuery('#descarea').val()},
			dataType:'json',
			success:function(r){
				jQuery('#modalarea').modal('hide');
				listar();
			}
		});
	});	
	jQuery('#eliminararea').on('click', function(){
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:60004},
			dataType:'json',
			success:function(r){
				jQuery('#modalareaeliminar').modal('hide');
				listar();
			}
		});
	});
});		
function listar(){
	jQuery('#tablaarea tbody').empty();
	jQuery.ajax({
		type:'post',
		url:'scripts/seguridad.php',
		data:{param:60000},
		dataType:'json',
		success:function(r){
			console.log(r);
			jQuery.each(r.data,function(k,v){
				var fila = '<tr><td>'+v.areaid+'</td><td>'+v.descripcion+'</td><td>'+v.estado+'</td>';
				fila += '<td><button id="'+v.areaid+'" class="btn btn-primary editar">Editar</button></td><td><button id='+v.areaid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
				jQuery('#tablaarea tbody').append(fila);
			})
		}
	});
};
/*function listarprograma(){
	jQuery('#tablaprogramas tbody').empty();
	jQuery.ajax({
		type:'post',
		url:'scripts/seguridad.php',
		data:{param:40000},
		dataType:'json',
		success:function(r){
			jQuery.each(r.data,function(k,v){
				var fila = '<tr><td>'+v.nombre+'</td><td>'+v.link+'</td><td>'+v.padre+'</td><td>'+v.esopcion+'</td><td>'+v.orden+'</td><td>'+v.estado+'</td>';
				fila += '<td><button id="'+v.programaid+'" class="btn btn-primary seleccionar">Seleccionar</button></td></tr>';
				jQuery('#tablaprogramas tbody').append(fila);
			});
		jQuery('#modalprograma').modal('show');	
		}
	});
}*/
function ejemplo(param){
	console.log(param);
}