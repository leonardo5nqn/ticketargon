jQuery(document).ready(function(){
	listar();
	jQuery('#addusuario').on('click',function(){
		jQuery('#ventanausuario').modal('show');		
	});
	
	jQuery('#grabar').on('click', function(){
		var error = false;
		if(jQuery('#nombre').val()==''){
			error = true;
		}
		if(jQuery('#apellido').val()==''){
			error = true;
		}
		if(jQuery('#fecnac').val()==''){
			error = true;
		}
		if(jQuery('#correo').val()==''){
			error = true;
		}			
		if(jQuery('#usu').val()==''){
			error = true;
		}
		if(jQuery('#clave').val()==''){
			error = true;
		}
		if(jQuery('#perfilid').val()==''){
			error = true;
		}

		
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

function showarea(){
	//si el id seleccionado por el usuario es tecnico
		//Muestro una lista de areas (option hidden)
		//cargamos el select hidden a traves de ajax con listararea()
	
	
	//si no es tecnico 
		//Oculto AREA
}

function listararea()
{
	//debe buscar en base de datos a traves de ajax y en un php todas las areas de la bd
	//Retorna o llena las opciones del select area
	$('#areaid')[0].hidden=false;
	console.log ('$areaid');
}