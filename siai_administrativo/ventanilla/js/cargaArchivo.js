// ActionScript Remote Document


function cargaArchivo(){
	//alert($("#archivo").attr("value"));
	//datos JSON  en variable parametros-
	var parametros={
					"archiv":$("#archivo").attr("value")
						
		};
	$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax_CargaArchivo.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			$("#Datos").html("Cargando pagos de alumnos .....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			var ok='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>La carga de datos se realizado ha correctamente <i class="icon-ok-sign"></i></div>';
			$("#Datos").html(ok);
			},
		error:function(){
			$("#Datos").html("HA ocurrido un Error en la Pagina");
			}	
		
		
		
		});
	
	
	
	}
