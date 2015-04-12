// ActionScript Document


function AgregarFranjaOrarios(accion){
	
	<!--datos JSON  en variable parametros-->
	var parametros={
					"lst_horarios":$("#lst_horarios").val(),
					"accion":accion
						
		};
	
	<!--funcion jax de jquery -->
	
	$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"Ajax/Ajax_Franja_Horarios.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			$("#S_Franja").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			$("#S_Franja").html(response);
			//$("txtCarnet").val()=response;
			
			},
		error:function(){
			$("#S_Franja").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
	
	
	}//fin de la funcion
	
	
	
	function EliminarFranja(){
	
	<!--datos JSON  en variable parametros-->
	var parametros={
					"lst_horarios":$("#lst_horarios").val()
						
		};
	
	<!--funcion jax de jquery -->
	
	$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_Eliminar.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			$("#S_Franja").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			AgregarFranjaOrarios("");
			//$("txtCarnet").val()=response;
			
			},
		error:function(){
			$("#S_Franja").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
	
	
	}//fin de la funcion
	
	
	
	
	function GuardarHorarios(){
	
	if($("#txt_seccion").val()=="")
	{
		alert("Debe de agregar Seccion");
		return;
	}
	
	if($("#txt_asignatura").val()=="")
	{
		alert("Debe de agregar Asignatura");
		return;
	}
	
	if($("#txt_aulas").val()=="")
	{
		alert("Debe de agregar Aula");
		return;
	}
	
	if($("#txt_cupos").val()=="")
	{
		alert("Debe de agregar cupos");
		return;
	}
	
	
	<!--datos JSON  en variable parametros-->
	var parametros={
					"txt_CICLO":$("#txt_CICLO").val(),
					"txt_seccion":$("#txt_seccion").val(),
					"txt_asignatura":$("#txt_asignatura").val(),
					"lst_horarios":$("#lst_horarios").val(),
					"txt_aulas":$("#txt_aulas").val(),
					"txt_cupos":$("#txt_cupos").val()
						
		};
	
	<!--funcion jax de jquery -->
	
	$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_Guardar.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			$("#S_Franja").html("Cagragando.....");
			
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			LimpiarCajas();
			AgregarFranjaOrarios("");
			$("S_Franja").html(response);
			$("#s_guardado1").html('<span class="label label-success">El horario se ha guardado correctamente</span>');
			
			},
		error:function(){
			$("#S_Franja").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
	
	
	}//fin de la funcion
	
	
	function LimpiarCajas()
	
		{
				
				$("#txt_seccion").val("");
				$("#txt_asignatura").val("");
				$("#lst_horarios").val();
				$("#txt_aulas").val("");
				$("#txt_cupos").val("");
		
		}
		
	function validarHorarios()
		{
			
			<!--datos JSON  en variable parametros-->
	var parametros={
					"txt_CICLO":$("#txt_CICLO").val()
						
		};
	
	<!--funcion jax de jquery -->
	
	$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"Ajax/Ajax_validarHorarios.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			//$("#S_Franja").html("Cagragando.....");
		
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			//$("#S_Franja").html("");
			if(response==1)
				{
					GuardarHorarios();
				}
			if(response==0){
				alert("Debe de agrgar Horarios");
				
				}	
			//$("txtCarnet").val()=response;
			
			},
		error:function(){
			$("#S_Franja").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
	
		}	