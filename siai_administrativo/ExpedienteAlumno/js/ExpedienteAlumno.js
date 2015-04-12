// JavaScript Document

function GeneraCarnet(){
	
	<!--datos JSON  en variable parametros-->
	var parametros={
					"txtApellido1":$("#txtApellido1").attr("value"),
					"txtApellido2":$("#txtApellido2").attr("value"),
					"txtApellidoCas":$("#txtApellidoCas").attr("value")		
		};
	
	<!--funcion jax de jquery -->
	
	$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_GeneraCarnet.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			//$("#msn").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			//$("#msn").html(response);
			//$("txtCarnet").val()=response;
			txtCarnet.value=response;
			},
		error:function(){
			$("#msn").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
	
	
	}//fin de la funcion
	
	
	function GuadarAlumno(){
		
		<!--datos JSON  en variable parametros-->
	var parametros={
					"txtCarnet":$("#txtCarnet").attr("value"),
					"txtNombres":$("#txtNombres").attr("value"),
					"txtApellido1":$("#txtApellido1").attr("value"),
					"txtApellido2":$("#txtApellido2").attr("value"),
					"txtApellidoCas":$("#txtApellidoCas").attr("value"),
					"lstCarrera":$("#lstCarrera").attr("value"),
					"lstTipoIngreso":$("#lstTipoIngreso").attr("value"),
					"lstTipoBeca":$("#lstTipoBeca").attr("value"),
					"txtCodigoPlan":$("#txtCodigoPlan").attr("value")				
		};
	
	<!--funcion jax de jquery -->
	
	
	
	//valdidando que los campos no vayan vacios
	
	if($("#txtCodigoPlan").attr("value")=="" || $("#lstCarrera").attr("value")=="" || $("#txtApellido1").attr("value")=="" || $("#txtNombres").attr("value")=="" ){
		//alert("Debe de Llenar los datos del Formulario");
		}
	else{
		$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_GuadarAlumno.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			//$("#msn").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			var ok='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Alumno Ingresado Correctamente <i class="icon-ok-sign"></i></div>';
			$("#alerta").html(ok);
			//$("txtCarnet").val()=response;
			txtCarnet.value="";
			txtNombres.value="";
			txtApellido1.value="";		
			txtApellido2.value="";		
			txtApellidoCas.value="";	
			lstCarrera.value="lstCarrera";		
			lstTipoIngreso.value="";		
			lstTipoBeca.value="";
			txtCodigoPlan.value="";
			},
		error:function(){
			$("#msn").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
		
	}//fin de la validacion else

		
		}// fin de la funcion
		
		
		
		function planCArrera(){
		
		
		<!--datos JSON  en variable parametros-->
	var parametros={
					"lstCarrera":$("#lstCarrera").attr("value")
		};
	
	<!--funcion jax de jquery -->
		
		$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_planCArrera.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			//$("#msn").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			//$("#msn").html(response);
			//$("txtCarnet").val()=response;
			txtCodigoPlan.value=response;
			},
		error:function(){
			$("#msn").html("HA ocurrido un Error en la Pagina");
			}				
		
		});
		
		
		}//fin de la funcion
		
		
		
		
		function ActualizarAlumno(){
			
			
			
			
			
			 <!--datos JSON  en variable parametros-->
			var parametros={
							
							"CARNET":	$("#CARNET").attr("value"),
							"SEXO":		$("#SEXO").attr("value"),
							"CODCARRERA":$("#CODCARRERA").attr("value"),
							"ESTADOCIVI":$("#ESTADOCIVI").attr("value"),
							"NOMBRES":	$("#NOMBRES").attr("value"),
							"APELLIDO1":$("#APELLIDO1").attr("value"),
							"APELLIDO2":$("#APELLIDO2").attr("value"),
							"APELLCASAD":$("#APELLCASAD").attr("value"),
							
							"DIRECCION":		$("#DIRECCION").attr("value"),
							"TELEFONO":$("#TELEFONO").attr("value"),
							"NACIONALID":$("#NACIONALID").attr("value"),
							"DEPTODIREC":	$("#DEPTODIREC").attr("value"),
							"MUNIDIRECC":$("#MUNIDIRECC").attr("value"),
							"DEPTONACIM":$("#DEPTONACIM").attr("value"),
							"MUNINACIMI":$("#MUNINACIMI").attr("value"),
							
							
							"PARTIDAORI":$('input[name=PARTIDAORI]').attr('checked'),
							"TITULOBACH":$('input[name=TITULOBACH]').attr('checked'),
							"CERTIFICAC":$('input[name=CERTIFICAC]').attr('checked'),
							"FOTOS":$('input[name=FOTOS]').attr('checked'),
							"DECLARACIO":$('input[name=DECLARACIO]').attr('checked'),
							
							"INSTITUCIO":	$("#INSTITUCIO").attr("value"),
							"EXPEDIENTE":		$("#EXPEDIENTE").attr("value"),
							"TITULO":$("#TITULO").attr("value"),
							"FEC_BAC":$("#FEC_BAC").attr("value"),
							"FEC_PDA":	$("#FEC_PDA").attr("value"),
							"FEC_CER":$("#FEC_CER").attr("value"),
							"FEC_FOT":$("#FEC_FOT").attr("value"),
							"FECHA_SOLI":$("#FECHA_SOLI").attr("value"),
							"LUGARTRABA":$("#LUGARTRABA").attr("value"),
							"TELTRABAJO":$("#TELTRABAJO").attr("value"),
							"TELTRABAJO":$("#TELTRABAJO").attr("value"),
							
							
							"CICLOINGRE":$("#CICLOINGRE").attr("value"),
							"CODIGO_PLA":$("#CODIGO_PLA").attr("value"),
							"TIPOINGRES":$("#TIPOINGRES").attr("value"),
							"ESTATUS":$("#ESTATUS").attr("value"),
							"OBSERVACIO":$("#OBSERVACIO").attr("value"),
							"FECHANACIM":$("#FECHANACIM").attr("value")
				};
	
			<!--funcion jax de jquery -->
			
			
			$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_ActualizarAlumno.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			//$("#msn").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			//$("#msn").html(response);
			//$("txtCarnet").val()=response;
			alert("Se ha Actualido Correctamente");
			txtCodigoPlan.value=response;
			},
		error:function(){
			$("#msn").html("HA ocurrido un Error en la Pagina");
			}				
		
		});
			
			
			
			} //fin de la funcion
			
			
			
			
			function fechaDocEntregados(control){
				
				<!--datos JSON  en variable parametros-->
	var parametros={
					"control":control
		};
	
	<!--funcion jax de jquery -->
		
		$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_fechaDocEntregados.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			//$("#msn").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			//$("#msn").html(response);
			//$("txtCarnet").val()=response;
			
			if(control==1){
				FEC_BAC.value=response;	
				}
			if(control==2){
				FEC_PDA.value=response;	
				}
			if(control==3){
				FEC_CER.value=response;	
				}
			if(control==4){
				FEC_FOT.value=response;	
				}			
			
			
			
			
		if(!$('input[name=PARTIDAORI]').attr('checked') & control==2){
			FEC_PDA.value="";
			
			}
		
		if(!$('input[name=TITULOBACH]').attr('checked')& control==1){
			FEC_BAC.value="";
			
			}
		
		if(!$('input[name=CERTIFICAC]').attr('checked') & control==3){
			FEC_CER.value="";
			
			}
		
		if(!$('input[name=FOTOS]').attr('checked') & control==4){
			FEC_FOT.value="";
			
			}
				
			
		
							
						
							
			
			
			
			
			
			
			},
		error:function(){
			$("#msn").html("HA ocurrido un Error en la Pagina");
			}				
		
		});
				
				
				}//find de la funcion