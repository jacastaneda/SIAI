// JavaScript Document

<!--***********************************************************************************************************************  	  -->
<!--	Nombre:       obtieb_va()																			  	  				  -->
<!--	Proposito:  Metodo para saber el total del tamaño del archivo														  	  -->
<!-- 	REVISIONS: 																									    	 	  -->
<!-- 	 Ver        Date        Author           Description 															     	  -->
<!--	---------  ----------  ---------------  ------------------------------------ 											  -->
<!-- 	1.0        24/09/2012   Denys Urquilla       1. Metodo que me retorna el valor de arcivivo								  -->
<!--	NOTAS:																												 	  -->
<!--	************************************************************************************************************************* -->




		function obtieb_va(){
			var valor=document.getElementById('tam').value; 
			//alert(valor);

			return valor;
			//alert(valor);
			}
	


<!--***********************************************************************************************************************  	  -->
<!--	Nombre:       desactiva()																			  	  				  -->
<!--	Proposito:  Metodo para Descartivar el Boton de subidan,													  			  -->
<!-- 	REVISIONS: 																									    	 	  -->
<!-- 	 Ver        Date        Author           Description 															     	  -->
<!--	---------  ----------  ---------------  ------------------------------------ 											  -->
<!-- 	1.0        24/09/2012   Denys Urquilla       1. Metodo que no retorna valor solo inactiva el boton						  -->
<!--	NOTAS:																												 	  -->
<!--	************************************************************************************************************************* -->

  
		function desactiva(){
			//document.f1.bo.disabled=true;
			
			var bytesTotal=document.getElementById('tam').value;
			if(bytesTotal>5120){
			carga.myuploaderButton.disabled=true; 
			//f1.bo.disabled=true; 
			}
			//alert(bytesTotal);
			}
 
  

<!--***********************************************************************************************************************  	  -->
<!--	Nombre:       activa() 																				  	  				  -->
<!--	Proposito:  Metodo para activar  el Boton de subidan,													  			 	  -->
<!-- 	REVISIONS: 																									    	 	  -->
<!-- 	 Ver        Date        Author           Description 															     	  -->
<!--	---------  ----------  ---------------  ------------------------------------ 											  -->
<!-- 	1.0        24/09/2012   Denys Urquilla       1. Metodo que no retorna valor solo activa el boton						  -->
<!--	NOTAS:																												 	  -->
<!--	************************************************************************************************************************* -->

 function activa(){
			//document.f1.bo.disabled=true;
			
			var bytesT=document.getElementById('tam').value;
			if(bytesT<5120){
				
				carga.myuploaderButton.disabled="";
			//fil.myuploaderButton.disabled="";
			//alert(bytesT); 
			//f1.bo.disabled=true; 
			}
			
			}

 
 

 
<!--***********************************************************************************************************************  	  -->
<!--	Nombre:      Funciones generales de la libreria LibUPLOAD											  	  				  -->
<!--	Proposito:  Metodos para subir los archivos al servidor,												  			 	  -->
<!-- 	REVISIONS: 																									    	 	  -->
<!-- 	 Ver        Date        Author           Description 															     	  -->
<!--	---------  ----------  ---------------  ------------------------------------ 											  -->
<!-- 	1.0        24/09/2012   Denys Urquilla       1. funcion principal subir,eliminar archivos del servidor					  -->
<!--	NOTAS:																												 	  -->
<!--	************************************************************************************************************************* -->


		var handlerurl='LibUpload/ajax-attachments-handler.php';
		//require_once("LibUpload/phpuploader/include_phpuploader.php"); 
		
		function CreateAjaxRequest()
		{
			var xh;
			if (window.XMLHttpRequest)
				xh = new window.XMLHttpRequest();
			else
				xh = new ActiveXObject("Microsoft.XMLHTTP");
			
			xh.open("POST", handlerurl, false, null, null);
			xh.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");
			return xh;
		}


	
	var fileArray=[];
	
	function ShowAttachmentsTable()
	{
		var table = document.getElementById("filelist");
		while(table.firstChild)table.removeChild(table.firstChild);
		
		AppendToFileList(fileArray);
	}
	function AppendToFileList(list)
	{
		var table = document.getElementById("filelist");
		desactiva();
		
		for (var i = 0; i < list.length; i++)
		{
			
			var item = list[i];
			
			//xajax_tamano_img(item.FileName,obtieb_va());
			desactiva();
			//xajax_tamano_actual(item.FileName);
			//para capturar los nombr
			//asignar_archivos();
			//var f=xajax_retorna_bytes(item.FileName);
			var img='<img src="../images/delete.png" width="16" height="16" />';
			
			var row=table.insertRow(-1);
			row.setAttribute("fileguid",item.FileGuid);
			row.setAttribute("filename",item.FileName);
			var tam=item.size;	
			var td1=row.insertCell(-1);
			td1.innerHTML="<img src='LibUpload/phpuploader/resources/circle.png' border='0'/>";
			var td2=row.insertCell(-1);
			td2.innerHTML=item.FileName;
			archivos.value=item.FileName;
			var td4=row.insertCell(-1);
			//td4.innerHTML="[<a href='"+handlerurl+"?download="+item.FileGuid+"'>download</a>]";
			td4.innerHTML="<a href='javascript:void(0)' onclick='Attachment_Remove(this)'>"+img+"</a>";
			var td4=row.insertCell(-1);
			
			
			td4.innerHTML=+f+" Bytes";
			//td4.innerHTML='<input type="button"  value="Enviar" onclick="xajax_cambia_texto("A1.png");" />';
		}
		
		//buscare elementos iguales en la tabla
		
		
	}
	
	function Attachment_FindRow(element)
	{
		while(true)
		{
			if(element.nodeName=="TR")
				return element;
			element=element.parentNode;
		}
	}
	
		
	
	function Attachment_Remove(link)
	{
				
		var row=Attachment_FindRow(link);
		if(!confirm("Esta seguro que desea Elininar de la lista el Archivo '"+row.getAttribute("filename")+"'?"))
			return;
	   
		var guid=row.getAttribute("fileguid");
		var name_e=row.getAttribute("filename");
		var totalBytes=obtieb_va();
		//xajax_restar_bytes(name_e,totalBytes);
		//xajax_cambia_texto(name_e);
		activa();
		var xh=CreateAjaxRequest();
		xh.send("delete=" + guid);
		
		var table = document.getElementById("filelist");
		table.deleteRow(row.rowIndex);
		
		for(var i=0;i<fileArray.length;i++)
		{
			 
			if(fileArray[i].FileGuid==guid)
			{
				fileArray.splice(i,1);
				break;
			}
		}
		
		//asignar_archivos();
	}
	
	
	function CuteWebUI_AjaxUploader_OnPostback()
	{
		var uploader = document.getElementById("myuploader");
		var guidlist = uploader.value;

		var xh=CreateAjaxRequest();
		xh.send("guidlist=" + guidlist);

		//call uploader to clear the client state
		uploader.reset();

		if (xh.status != 200)
		{
			alert("http error " + xh.status);
			setTimeout(function() { document.write(xh.responseText); }, 10);
			return;
		}

		var list = eval(xh.responseText); //get JSON objects
		
		fileArray=fileArray.concat(list);

		AppendToFileList(list);
	}
	
	function ShowFiles()
	{
		var msgs=[];
		for(var i=0;i<fileArray.length;i++)
		{
			msgs.push(fileArray[i].FileName);
		}
		alert(msgs.join("\r\n"));
	}
	
	function asignar_archivos()
	{
		var msgs=[];
		for(var i=0;i<fileArray.length;i++)
		{
			msgs.push(fileArray[i].FileName+"*");
			
			//xajax_concatenar_Archivo((fileArray[i].FileName)+"");
			
		}
		//xajax_concatenar_Archivo((msgs.join("\r\n"))+"");
	}
	
	
	
<!--***********************************************************************************************************************  	  -->
<!--	Nombre:      Función para Realizar  el sumit del formulario											  	  				  -->
<!--	Proposito:  Realizar el sumir atravéz , de Java Script 												  				 	  -->
<!-- 	REVISIONS: 																									    	 	  -->
<!-- 	 Ver        Date        Author           Description 															     	  -->
<!--	---------  ----------  ---------------  ------------------------------------ 											  -->
<!-- 	1.0        24/09/2012   Denys Urquilla       1. Realizar el sumit de formulario de envio de notificaciones				  -->
<!--	NOTAS:																												 	  -->
<!--	************************************************************************************************************************* -->

function submitForm(){
	
	//var valor;
	//valor=xajax_comprobar_seleccion();
	valor=3;
	if(valor==1){
		//alert("debe seleccionar una Empresa ");
		}
	else{	
	
	document.carga.submit();
	}
	
}	


function submitFormSeleccionCliente(){
	
	var valor;
	valor=xajax_comprobar_seleccion();
	
	if(valor==1){
		alert("debe seleccionar una Empresa ");
		}
	else{	
	
	document.carga.submit();
	}
	
}		
	

 
	
  