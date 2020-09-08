jQuery(document).ready(function(){
	
	listar();
	jQuery('#addusuario').on('click',function(){
		jQuery('#ventanausuario').modal('show');		
	});
	
	jQuery('#grabar').on('click', function(){
		var error = false;
		if(jQuery('#nombre').val()==''){
			error = true;
			alert('falta el nombre');
			jQuery('#nombre').css('background-color','red');
		}
		if(jQuery('#apellido').val()==''){
			error = true;
			alert('falta el apellido');
			jQuery('#apellido').css('background-color','red');
		}
		if(jQuery('#fecnac').val()==''){
			error = true;
			alert('falta la fecha de nacimiento');
			jQuery('#fecnac').css('background-color','red');	
		}
		if(jQuery('#correo').val()==''){
			error = true;
			alert('falta el correo');
			jQuery('#correo').css('background-color','red');
		}			
		if(jQuery('#usu').val()==''){
			error = true;
			alert('falta el usuario');
			jQuery('#usu').css('background-color','red');
		}
		if(jQuery('#clave').val()==''){
			error = true;
			alert('falta la clave');
			jQuery('#clave').css('background-color','red');
		}
		if(jQuery('#perfilid').val()==''){
			error = true;
			alert('falta el perfilid');
			jQuery('#perfilid').css('background-color','red');
		}
		/*if(jQuery('#estado').val()==''){
			error = true;
			alert('falta el estado');
			jQuery('#estado').css('background-color','red');
		}*/
		
		if(!error){
			var datos = {
				param:30001,
				dnombre:jQuery('#nombre').val(),
				dapellido:jQuery('#apellido').val(),
				dfecnac:jQuery('#fecnac').val(),	
				dcorreo:jQuery('#correo').val(),
				dusuario:jQuery('#usu').val(),
				dclave:jQuery('#clave').val(),
				destado:jQuery('#estado').val(),
				dperfilid:jQuery('#perfilid').val(),
			};
			jQuery.ajax({
				type:'post',
				data:datos,
				url:'scripts/seguridad.php',
				dataType:'json',
				success:function(r){
					if(r.success){				
						jQuery('#formusuario').css('display','none');
						listar();
					}else{
						alert('Error');
					}
				}
	});
		}
	$(".modal-body input").val('');	
});

	jQuery('#nombre').on('keypress',function(){
		jQuery(this).css('background-color','white');
	});
	jQuery('#tablausuarios tbody').on('click', '.editar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:30003,param1:id},
			dataType:'json',
			success:function(r){
				console.log(id);
				jQuery('#dnombre').val(r.nombre);
				jQuery('#dapellido').val(r.apellido);
				jQuery('#dfecnac').val(r.fecnac);
				jQuery('#dcorreo').val(r.correo);
				jQuery('#dusuario').val(r.usuario);
				jQuery('#dclave').val(r.clave);
				jQuery('#dperfilidid').val(r.perfilid);
				jQuery('#destado').val(r.estado);
				jQuery('#modalusuario').modal('show');
				
			}
		});
	});
	jQuery('#tablausuarios tbody').on('click', '.eliminar', function(){
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:{param:30003,
				param1:id},
			dataType:'json',
			success:function(r){
				jQuery('#enombre').val(r.nombre);
				jQuery('#eapellido').val(r.apellido);
				jQuery('#efecnac').val(r.fecnac);
				jQuery('#ecorreo').val(r.correo);
				jQuery('#eusuario').val(r.usuario);
				jQuery('#eclave').val(r.clave);
				jQuery('#eperfilid').val(r.perfilid);
				jQuery('#eestado').val(r.estado);
				jQuery('#modalusuarioeliminar').modal('show');
			}
		});
	});
	jQuery('#editarusuario').on('click', function(){
		var datos=jQuery('#fusuario1').serialize();
		datos+='&param=30002';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalusuario').modal('hide');
				listar();
			}
		});
	});
	jQuery('#eliminarusuario').on('click', function(){
		var datos=jQuery('#fusuario2').serialize();
		datos+='&param=30004';
		jQuery.ajax({
			type:'post',
			url:'scripts/seguridad.php',
			data:datos,
			dataType:'json',
			success:function(r){
				jQuery('#modalusuarioeliminar').modal('hide');
				listar();
			}
		});
	});
});
	function listar(){
	jQuery('#tablausuarios tbody').empty();
	jQuery.ajax({
		type:'post',
		url:'scripts/seguridad.php',
		data:{param:30000},
		dataType:'json',
		success:function(r){
			jQuery.each(r.data,function(k,v){
				var fila = '<tr><td>'+v.nombre+'</td><td>'+v.apellido+'</td><td>'+v.fecnac+'</td><td>'+v.correo+'</td><td>'+v.usuario+'</td><td>'+v.perfilid+'</td>';
				fila += '<td><button id="'+v.usuarioid+'" class="btn btn-primary editar">Editar</button></td><td><button id='+v.usuarioid+'" class="btn btn-primary eliminar">Eliminar</button></td></tr>';
				jQuery('#tablausuarios tbody').append(fila);
			})
		}
	});
};
function ejemplo(param){
	console.log(param);
}