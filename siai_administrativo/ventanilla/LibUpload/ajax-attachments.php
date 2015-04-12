<?php session_start();

require_once("phpuploader/include_phpuploader.php"); 
include_once("xajax/xajax/xajax_core/xajax.inc.php");


//Construimos el objeto xajax
$xajax=new xajax();
$xajax->configure( 'defaultMode', 'synchronous' );
 
 
  function cambia_texto($texto){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$respuesta->assign("h","innerHTML",unlink("savefiles/".$texto));
	//$respuesta->addAssign("respuesta","innerHTML",$salida); 
	return $respuesta;
	
	}
	

function retorna_bytes($img){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$to=round(filesize('savefiles/'.$img)/1024,2);
	$respuesta->setReturnValue($to);
	
	return $respuesta;
	
	}
	


	
	function tamano_img($texto,$total){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$to=round($total+filesize('savefiles/'.$texto)/1024,2);
	$respuesta->assign("tam","value",$to);
	
	return $respuesta;
	
	}
	
	
	
		
	function restar_bytes($texto,$total){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	
	
	$to=round($total-(filesize('savefiles/'.$texto)/1024),2);
	
	$respuesta->assign("tam","value",$to);
	//$respuesta->addAssign("respuesta","innerHTML",$salida); 
	
	return $respuesta;
	
	}
	
	
	
	//Registro de variables
	$xajax->registerFunction("cambia_texto");
	$xajax->registerFunction("tamano_img");
	$xajax->registerFunction("restar_bytes");
	//$xajax->registerFunction("tamano_actual");
	$xajax->registerFunction("retorna_bytes");
	
	//procesando todas la variables de xajax
	$xajax->processRequest();
//cambia_texto("555053_424923374191002_217282281621780_1852481_565006252_n.jpg");

?>
<?php //session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
//imprimirmos en los encabezados el xajax
//$xajax->printJavascript("xajax/");
$xajax->printJavascript("xajax/xajax/"); 

?>

<script>
		function obtieb_va(){
			var valor=document.getElementById('tam').value; 
			//alert(valor);

			return valor;
			//alert(valor);
			}
		</script>
        
        <script>
		function desactiva(){
			//document.f1.bo.disabled=true;
			
			var bytesTotal= document.getElementById('tam').value;
			if(bytesTotal>5120){
			f2.myuploaderButton.disabled=true; 
			//f1.bo.disabled=true; 
			}
			//alert(bytesTotal);
			}
			
			
			function activa(){
			//document.f1.bo.disabled=true;
			
			var bytesT=document.getElementById('tam').value;
			if(bytesT<5120){
			f2.myuploaderButton.disabled="";
			//alert(bytesT); 
			//f1.bo.disabled=true; 
			}
			
			}
			
			
			
			
		</script>
        
	<title>
		Ajax - Espress
	</title>
	<link href="demo.css" rel="stylesheet" type="text/css" />
			
	<script type="text/javascript">
		var handlerurl='ajax-attachments-handler.php'
		
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
	</script>
	<script type="text/javascript">
	
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
		
		for (var i = 0; i < list.length; i++)
		{
			
			var item = list[i];
			
			xajax_tamano_img(item.FileName,obtieb_va());
			desactiva();
			//xajax_tamano_actual(item.FileName);
			var f=xajax_retorna_bytes(item.FileName);
			
			
			var row=table.insertRow(-1);
			row.setAttribute("fileguid",item.FileGuid);
			row.setAttribute("filename",item.FileName);
			var tam=item.size;	
			var td1=row.insertCell(-1);
			td1.innerHTML="<img src='phpuploader/resources/circle.png' border='0'/>";
			var td2=row.insertCell(-1);
			td2.innerHTML=item.FileName;
			var td4=row.insertCell(-1);
			td4.innerHTML="[<a href='"+handlerurl+"?download="+item.FileGuid+"'>download</a>]";
			var td4=row.insertCell(-1);
			
			
			td4.innerHTML="[<a href='javascript:void(0)' onclick='Attachment_Remove(this)'>Eliminar / "+f+"Bytes </a>]";
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
		xajax_restar_bytes(name_e,totalBytes);
		xajax_cambia_texto(name_e);
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
	
	</script>
</head>
<body >
	<div class="demo">
        <h2>Seleccion Archivos</h2>
		<p>Adjunte los archivos.</p>
	 <form id="f2">   
<?php


				 $uploader=new PhpUploader();
				//$uploader->MaxSizeKB=100;
				$uploader->MaxSizeKB=5120;
								
				$uploader->Name="myuploader";
				$uploader->MultipleFilesUpload=true;
				$textoBoton=utf8_decode("Seleccione un máximo de 5 Megas");
				$uploader->InsertText=$textoBoton;
				$uploader->AllowedFileExtensions="*.jpg,*.png,*.gif,*.bmp,*.txt,*.zip,*.rar";
				$uploader->CancelAllMsg="Cancel all Uploads";   
				$uploader->SaveDirectory="savefiles/"; 
				$uploader->Render(); 
				///$uploader->MaxFilesLimit=1;
				echo '<div id="render">';
			    //$uploader->Render();
				
				echo '</div>';
				?>
			<input type="text" name="tam" id="tam" />
</form>
			<br/><br/>

			<table id="filelist" style='border-collapse: collapse' class='Grid' border='0' cellspacing='0' cellpadding='2'>
			</table>
			
			<br/><br/>
			
			<button onclick="ShowFiles()">Show files</button>

	</div>
	
<div id="ddd">

</div>

<form id="f1">
<input id="bo" type="button"  value="Enviar" onclick="xajax_habilita_boton('555053_424923374191002_217282281621780_1852481_565006252_n.jpg');" enabled="false" />
</form>
<?php //echo $peso_archivo = filesize('savefiles/A1.png')/1024; // obtenemos su peso en bytes ?>

  <p>
    <label for="tam">Acumulado</label>
  </p>
<div style="display:none">
sasas

</div>
</body>
</html>

