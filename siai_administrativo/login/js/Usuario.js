// JavaScript Document


function Login(){
	
	<!--datos JSON  en variable parametros-->
	var parametros={
					"user":$("#user").attr("value"),
					"pass":$("#pass").attr("value")
						
		};
	
	<!--funcion jax de jquery -->
	
	if($("#user").attr("value")==""){
	var msn= '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>	<strong>Error: </strong> Digite su Usuario. </div>';
	$("#msn").html(msn);
		}
	
	
	else if($("#pass").attr("value")==""){
	var msn= '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>	<strong>Error: </strong>Digite su Password . </div>';
	$("#msn").html(msn);
		}
	
	else{
	
	
	
	$.ajax({
		
		data:parametros,//ENVIO LOS PARAMETROS
		url:"login/Ajax/Ajax_Login.php",//PAGINA QUE PROCESA LOS DATOS
		type:"post",
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
		
		var msn='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> Bienvenido  '+$("#user").attr("value")+'<i class="icon-ok-sign"></i></div>';
		
			$("#msn").html(msn);
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			
			//$("txtCarnet").val()=response;
			
			if(response==1){
				$(location).attr('href','principal.php')
				
				}
			
			if(response==0){
				var msn= '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>	<strong>Error: </strong>Usuario o Contraseña incorrecto. </div>';
				
				$("#msn").html(msn);
				}
			
			//pass.value=response;
			//$(location).attr('href','ExpedienteAlumno/ExpedienteAlumno.php');
			},
		error:function(){
			$("#msn").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
	
	}//find el else
	
	}//fin de la funcion