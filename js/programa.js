jQuery(document).ready(function(){ 
	listar();
	jQuery('#addprogramas').on('click',function(){
		
		jQuery('#nombre').val('');
		jQuery('#nombre').focus();
		jQuery('#link').val('');
		jQuery('#padre').val('');
		jQuery('#esopcion').val('');
		jQuery('#orden').val('');
		jQuery('#estado').val('');
		jQuery('#formprogramas').css('display','block');		
	});
	jQuery('#grabar').on('click', function(){
		var error = false;
		if(jQuery('#nombre').val()==''){
			error = true;
			alert('falta el nombre');
			jQuery('#nombre').css('background-color','red');
		}
		if(jQuery('#link').val()==''){
			error = true;
			alert('falta el link');
			jQuery('#link').css('background-color','red');
		}		
		if(jQuery('#padre').val()==''){
			error = true;
			alert('falta el padre');
			jQuery('#padre').css('background-color','red');
		}
		if(jQuery('#esopcion').val()==''){
			error = true;
			alert('falta la esopcion');
			jQuery('#esopcion').css('background-color','red');
		}
		if(jQuery('#orden').val()==''){
			error = true;
			alert('falta el orden');
			jQuery('#orden').css('background-color','red');
		}
		/*if(jQuery('#estado').val()==''){
			error = true;
			alert('falta el estado');
			jQuery('#estado').css('background-color','red');
		}*/
		
		if(!error){
			var datos = {
				param:40001,
				dnombre:jQuery('#nombre').val(),
				dlink:jQuery('#link').val(),
				dpadre:jQuery('#padre').val(),
				desopcion:jQuery('#esopcion').val(),
				dorden:jQuery('#orden').val(),
				destado:jQuery('#estado').val()
			};
			jQuery.ajax({
				type:'post',
				data:datos,
				url:'scripts/seguridad.php',
				dataType:'json',
				success:function(r){
					if(r.success){				
						jQuery('#formprogramas').css('display','none');
						listar();
					}else{
						alert('Error');
					}
				}
	});
		}
});

	jQuery('#nombre').on('keypress',function(){
		jQuery(this).css('background-color','white');
	});
	jQuery('#tablaprogramas tbody').on('click', '.editar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:40003,param1:id},
			dataType:'json',
			success:function(r){
				console.log(id);
				jQuery('#dnombre').val(r.nombre);
				jQuery('#dlink').val(r.link);
				jQuery('#dpadre').val(r.padre);
				jQuery('#desopcion').val(r.esopcion);
				jQuery('#dorden').val(r.orden);
				jQuery('#destado').val(r.estado);
				jQuery('#modalprogramas').modal('show');
				
			}
		});
	});
	jQuery('#tablaprogramas tbody').on('click', '.eliminar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:40003,param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#enombre').val(r.nombre);
				jQuery('#elink').val(r.link);
				jQuery('#epadre').val(r.padre);
				jQuery('#eesopcion').val(r.esopcion);
				jQuery('#eorden').val(r.orden);
				jQuery('#eestado').val(r.estado);
				jQuery('#modalprogramaseliminar').modal('show');
			}
		});
	});
	jQuery('#editarprogramas').on('click', function(){
		var datos=jQuery('#fprogramas1').serialize();
		datos+='&param=40002';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalprogramas').modal('hide');
				listar();
			}
		});
	});
	jQuery('#eliminarprogramas').on('click', function(){
		var datos=jQuery('#fprogramas2').serialize();
		datos+='&param=40004';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalprogramaseliminar').modal('hide');
				listar();
			}
		});
	});
});
	function listar(){
	jQuery('#tablaprogramas tbody').empty();
	jQuery.ajax({
		type:'post',
		url:'scripts/seguridad.php',
		data:{param:40000},
		dataType:'json',
		success:function(r){
			jQuery.each(r.data,function(k,v){
				var fila = '<tr><td>'+v.nombre+'</td><td>'+v.link+'</td><td>'+v.padre+'</td><td>'+v.esopcion+'</td><td>'+v.estado+'</td>';
				fila += '<td><button id="'+v.programaid+'" class="btn btn-primary editar">Editar</button></td><td><button id='+v.programaid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
				jQuery('#tablaprogramas tbody').append(fila);
			})
		}
	});
};
function ejemplo(param){
	console.log(param);
}