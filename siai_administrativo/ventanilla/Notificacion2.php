<?php session_start();//inicio de session

		/******************************************
				Seguridad de SESIONES para LOGIN
			******************************************/

//unset($_SESSION["cli"]);
//require_once("phpuploader/include_phpuploader.php"); 
require_once("LibUpload/phpuploader/include_phpuploader.php"); 
include_once("../xajax/xajax/xajax_core/xajax.inc.php"); //clase para xajax
include_once("../clases/ClassNotificaciones.php");//clase incluida
include_once("../clases/ClassConexion.php");//clase a a conexion de base de datos








/******************************************************************************************************
Cosntruccion de objetos
*******************************************************************************************************/
$xajax=new xajax(); //construccion del objeto Xajax
$xajax->configure( 'defaultMode', 'synchronous' );
$notificacion= new ClassNotificaciones();//Construccion del Objeto
$cnx= new MySQL();// Construccion del Objeto de conexion 

if(!empty($_GET["id"])){
$_SESSION["ccap_id"]=$_GET["id"];
}
//buscado plantilla  relacionadas al EVENTO





















/******************************************************************************************************
   Nombre:       cambia_texto()
   Proposito:  Eliminará los archvos que se corresponda y que se encuenteren en el directorio \LibUpload\savefiles\   
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo Para Eliminar los archivos Subidos al servidor.
  NOTAS:
*******************************************************************************************************/
 	function cambia_texto($texto){
	
	$respuesta=  new xajaxResponse();
	$respuesta->assign("h","innerHTML",unlink("LibUpload/savefiles/".$texto));
	
	return $respuesta;
	
	}



/******************************************************************************************************
   Nombre:       retorna_bytes($img)
   Proposito:  Me retornara el tamaño en Bytes para realizar la resta o la suma para limitar a 5 megas de subida 
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo que me retorna un valor en Bytes
  NOTAS:
*******************************************************************************************************/
	function retorna_bytes($img){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$to=round(filesize('LibUpload/savefiles/'.$img)/1024,2);
	$respuesta->setReturnValue($to);
	
	return $respuesta;
	
	}
	


/******************************************************************************************************
   Nombre:       tamano_img($texto,$total)
   Proposito:  Metodo para saber cuanto es el total de los archivos subidos
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo que me retorna la cantidad total de los archivos
  NOTAS:
*******************************************************************************************************/
function tamano_img($texto,$total){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$to=round($total+filesize('LibUpload/savefiles/'.$texto)/1024,2);
	$respuesta->assign("tam","value",$to);
	
	return $respuesta;
	
	}
	
/******************************************************************************************************
   Nombre:       restar_bytes($texto,$total)
   Proposito:  Metodo para restar la cantidad total del archivo cuando el usuario lo elimine en la panatalla 
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo asiganara el valor a la caja de texto con id tama
  NOTAS:
*******************************************************************************************************/
function restar_bytes($texto,$total){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	
	
	$to=round($total-(filesize('LibUpload/savefiles/'.$texto)/1024),2);
	
	$respuesta->assign("tam","value",$to);
	//$respuesta->addAssign("respuesta","innerHTML",$salida); 
	
	return $respuesta;
	
	}




/******************************************************************************************************
   Nombre:       concatenar_Archivo($ArrgleArchivos)
   Proposito:  Metodo para concatenar los archivos que se vayan subiendo 
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo asignara lso valors a una caja de texto para que no se pierdan los datos
  NOTAS:
*******************************************************************************************************/
function concatenar_Archivo($ArrgleArchivos){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	
	
	$_SESSION["archivos"]=$ArrgleArchivos;
	
	$respuesta->assign("archivos","value",$ArrgleArchivos);
	//$respuesta->addAssign("respuesta","innerHTML",$salida); 
	
	return $respuesta;
	
	}


//Funcion para mostrar los datos de los archivos a emviar
function Mostrar_Archivo(){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$respuesta->alert($_SESSION["archivos"]);
	//$respuesta->addAssign("respuesta","innerHTML",$salida); 
	
	return $respuesta;
	
	}





	
	
		

/******************************************************************************************************
Registros de metodos de xajax
*******************************************************************************************************/


//Registro de metodos
	$xajax->registerFunction("getDeptoxajax");
	$xajax->registerFunction("getMunixajax");
	$xajax->registerFunction("getEmpresasxajax");
	$xajax->registerFunction("dormir");
	$xajax->registerFunction("checkEnvio");
	$xajax->registerFunction("mostrarClientes");
	//metodos que pertenecen a la subida de archivos
	$xajax->registerFunction("cambia_texto");
	$xajax->registerFunction("retorna_bytes");
	$xajax->registerFunction("tamano_img");
	$xajax->registerFunction("restar_bytes");
	$xajax->registerFunction("concatenar_Archivo");
	$xajax->registerFunction("Mostrar_Archivo");
	$xajax->registerFunction("comprobar_seleccion");
	//metodo para la limpieza de todos los datos de session puesto por el Usuario
	$xajax->registerFunction("Limpieza_Sesion");
	//procesando todas la variables de xajax
	$xajax->processRequest();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $xajax->printJavascript("../xajax/xajax/");  ?>

<script>



<!--*********************************************************************************************************************** -->
<!-- JAVA SCRIPT PARA INDICAR LA CARGA DE TODOS LOS XAJAX -->
<!--************************************************************************************************************************* -->
function muestra_cargando(){
      xajax.$('msn_carga').style.display='block';
   }
   function oculta_cargando(){
      xajax.$('msn_carga').style.display='none';
   }
   xajax.callback.global.onRequest = muestra_cargando;
   xajax.callback.global.onComplete = oculta_cargando;

</script>

<link href="../css/styles2.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type="text/javascript" src="../js/ckeditor/ckeditor.js">

</script>


<script type="text/javascript" src="js/LibUpload.js"> 

</script>
</head>

<body onunload="xajax_Limpieza_Sesion11();">
<div style="display:none">
  <form action="javascript:void(null)" method="post" name="fil" id="fil">
    <table width="850" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="133">&nbsp;</td>
      <td width="693">
     
      <div id="region" style="float:left">
        Region
            
            <select name="lstRegion" id="lstRegion" onchange="xajax_getDeptoxajax(document.fil.lstRegion.options[document.fil.lstRegion.selectedIndex].value)">
              <option value="*">Todos</option>
              <?php for($p=0;$p<count($regiones);$p++){?>
              <option value="<?php echo $regiones[$p][zona_id]; ?>"><?php echo $regiones[$p][zona_nombre]; ?></option>
              <?php }?>
            </select>
            </div>
           		 <div id="dep" style="float:left">
            Departamento
<select name="lstDepto" id="lstDepto" onchange="xajax_getMunixajax(1)">
          <option value="*">Todos</option>
         
      </select>
      			</div>
      
    &nbsp;&nbsp;
    	<div id="municipio" style="float:left" >
    	Municipio
    <select name="lstMunicipio" id="lstMunicipio">
      <option value="*">Todos</option>
    </select>
   		 </div>
      
        &nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td>Sector Estratégico</td>
      <td><select name="lstSector" id="lstSector">
        <option value="*">Seleccione Sector</option>
        <?php for($i=0;$i<count($sector_e);$i++){?>
        <option value="<?php echo $sector_e[$i]["sec_id"];?>"><?php echo $sector_e[$i][sec_nombre];?></option>
        <?php }?>
    </select>
      <input type="button"  value="Realizar Busqueda"  onclick="xajax_getEmpresasxajax(xajax.getFormValues('fil'),-1,0);" /></td>
    </tr>
    <tr>
      <td>Nombres</td>
      <td><input name="nombres" type="text" id="nombres" size="50" />
        <input type="hidden" name="n_pagina" id="n_pagina" value="0"/>
        <input type="hidden" name="borrar" id="borrar" value="1"/>
        
        </td>
    </tr>
    <tr>
      <td>NIT</td>
      <td><!--<input type="button"  value="Realizar Busqueda"  onclick="xajax_getEmpresasxajax(document.fil.lstRegion.options[document.fil.lstRegion.selectedIndex].value);" /> -->
        <input name="nit" type="text" id="nit" size="50" /></td>
    </tr>
  </table>
</form>
</div>


<div  align="center">
 
<center>
  <div id="msn_carga" style="display:none">
<img src="../xajax/img/cargando1.gif" width="300" height="230" />
</div>
<div > <font size="+2"><strong>ASUNTO</strong></font></div> 

<form action="SeleccionClientes.php" method="post" id="carga" name="carga">
  <table width="683" border="1" align="center">
    <tr>
      <td width="677">&nbsp;</td>
      </tr>
    <tr>
      <td>
      <?php 
	  
				
				 $uploader=new PhpUploader();
				//$uploader->MaxSizeKB=100;
				$uploader->MaxSizeKB=5120;
								
				$uploader->Name="myuploader";
				$uploader->MultipleFilesUpload=true;
				$textoBoton=utf8_decode("Seleccione un maximo de 5 Megas");
				$uploader->InsertText=$textoBoton;
				$uploader->AllowedFileExtensions="*.pdf";
				$uploader->CancelAllMsg="Cancel all Uploads";   
				$uploader->SaveDirectory="LibUpload/savefiles/"; 
				$uploader->Render(); 
	  
	  ?> Seleccione Archivo para Adjuntar
      <table id="filelist" style='border-collapse: collapse' class='Grid' border='0' cellspacing='0' cellpadding='2'>
			</table>
      <input type="hidden" name="tam" id="tam" />
      <label for="archivos"></label>
      <input name="archivos" type="text" id="archivos" value="" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</center>
  <script type="text/javascript">
				CKEDITOR.replace( 'asunto' ,{
        filebrowserBrowseUrl : '/browser/browse.php',
        filebrowserUploadUrl : '/uploader/upload.php'
    });
				CKEDITOR.config.skin='office2003';
				CKEDITOR.config.toolbar_Full =
[
    ['Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['BidiLtr', 'BidiRtl'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    
    ['Link','Unlink','Anchor'],
    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar'], ['ShowBlocks','-'],
    '/',
    ['Styles','Format','Font','FontSize'],
    ['TextColor','BGColor'],
   
];


			</script>
            
            </div>

<center> 
    <!--<input name="66" type="button" value="Enviar Invitaciones"  onclick="xajax_mostrarClientes();"/>&nbsp;&nbsp; -->
 <!-- <input name="input" type="button" value="Enviar Invitaciones y Guardar plantilla" onclick="xajax_Mostrar_Archivo();"/> -->
  <!--<input type="submit" name="button" id="button" value="Enviar"  onclick="ShowFiles()"/>
 -->  <input type="submit" name="button2" id="button2" value="Siguiente >>" onclick="submitForm();" />
</center>


<div id="Datos">
</div>

</body>
</html>
<?php unset($_SESSION["cli"]);
	  unset($_SESSION["archivos"]);
	  unset( $_SESSION["archivos1"]);
	  unset($_SESSION["clientes"]);
	  unset($_SESSION["Guardar_plantilla"]);
	
?>