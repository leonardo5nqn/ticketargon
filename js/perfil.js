jQuery(document).ready(function(){
	listar();
	jQuery('#addperfil').on('click',function(){
		jQuery('#ventanaperfil').modal('show');	
		/**jQuery('#descripcion').val('');
		jQuery('#formperfildesc').css('display','block');
		jQuery('#descripcion').focus();*/		
	});
	jQuery('#grabar').on('click', function(){
		var error = false;
		if(jQuery('#descripcion').val()==''){
			error = true;
			alert('falta la descripcion');
		}
		if(!error){
			var datos = {
				param:20001,
				ddescripcion:jQuery('#descripcion').val()
			};
			jQuery.ajax({
				type:'post',
				data:datos,
				url:'scripts/seguridad.php',
				dataType:'json',
				success:function(r){
					if(r.success){				
						jQuery('#formperfildesc').css('display','none');
						listar();
					}else{
						alert('Error');
					}
					
				}
			});
		}
	$(".modal-body input").val('');		
	
	});
	
	jQuery('#descripcion').on('keypress',function(){
		jQuery(this).css('background-color','white');
	});
	jQuery('#tablaperfil tbody').on('click', '.editar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:20003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#descperfil').val(r.descripcion);
				jQuery('#modalperfil').modal('show');
			}
		});
	});	
	jQuery('#tablaperfil tbody').on('click', '.eliminar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:20003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#descperfile').val(r.descripcion);
				jQuery('#modalperfileliminar').modal('show');
			}
		});
	});
	jQuery('#editarperfil').on('click', function(){
		var datos=jQuery('#formperfil').serialize();
		datos+='&param=20002';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalperfil').modal('hide');
				listar();
			}
		});
	});	
	jQuery('#eliminarperfil').on('click', function(){
	var datos=jQuery('#formperfile').serialize();
		datos+='&param=20004';
		jQuery.ajax({	
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalperfil').modal('hide');
				listar();
			}
		});
	});		
function listar(){
	jQuery('#tablaperfil tbody').empty();
	jQuery.ajax({
		type:'post',
		url:'scripts/seguridad.php',
		data:{param:20000},
		dataType:'json',
		success:function(r){
			jQuery.each(r.data,function(k,v){
				var fila = '<tr><td>'+v.perfilid+'</td><td>'+v.descripcion+'</td><td>'+v.estado+'</td>';
				fila += '<td><button id="'+v.perfilid+'" class="btn btn-primary editar">Editar</button></td><td><button id='+v.perfilid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
				jQuery('#tablaperfil tbody').append(fila);
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