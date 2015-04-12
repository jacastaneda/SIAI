// JavaScript Document


<!--funcion de ajax  -->

function  SubirArchivo(){
	var inputFileImage = document.getElementById("archivo");
	
	var file = inputFileImage.files[0];
	var data = new FormData();
	data.append('archivos',file);
	//alert(file);
	<!--datos JSON  en variable parametros-->
	//var parametros={
		//			"archivos":$("#archivo").serialize()
						
		//};
	//alert($("#archivo").attr("value"));
	<!--funcion jax de jquery -->
	
	$.ajax({
		
		data:data ,//ENVIO LOS PARAMETROS
		url:"ajax/Ajax_UploadArchivo.php",//PAGINA QUE PROCESA LOS DATOS
		type:"POST",
		processData: false,
        contentType: false,
		beforeSend:function() {//FUNCION QUE HACE LO QUE ANTES DE QUE SE EJECUTE EL AJAX
			$("#msn").html("Cagragando.....");
			},
		success:function(response){//FUNCION QUE ME DEVUELVE CUANDO HAYA PROCESADO
			
			if(response==1){
				$("#msn").html("<font color='#FF0000'>* Formato no permitido</font>");
				archivos.value="";
				}
			else if(response==2){
				$("#msn").html("<font color='#FF0000'>* Tamaño no permitido</font>");
				archivos.value="";
				}	
			else{
			archivos.value=response;
			$("#msn").html("<font color='#060'>Archivo  cargado  exitosamente</font>");
			btnCarga.disabled=false;
			}
			
			},
		error:function(){
			$("#msn").html("HA ocurrido un Erros en la Pagina");
			}				
		
		});
	
	}<!--fin de la funcion -->