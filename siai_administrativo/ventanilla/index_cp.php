<?php 
include_once("../xajax/xajax/xajax_core/xajax.inc.php"); //clase para xajax
include_once("../clases/ClassAlumnoExpediente.php");//clase incluida
include_once("../clases/ClassConexion.php");//clase a a conexion de base de datos


$xajax=new xajax(); //construccion del objeto Xajax
$xajax->configure( 'defaultMode', 'synchronous' );
$cnx= new MySQL();

$expediente=new ClassAlumnoExpediente();

$carrare=$expediente->getCatCarrera();
$tipIingreso=$expediente->getTipoIingreso();
$tipobeca=$expediente->getTipoBeca();
/******************************************************************************************************
   Nombre:       cambia_texto()
   Proposito:  Eliminará los archvos que se corresponda y que se encuenteren en el directorio \LibUpload\savefiles\   
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo Para Eliminar los archivos Subidos al servidor.
  NOTAS:
*******************************************************************************************************/
 	function XajaxGuadarExpediente($f){
	$expediente= new ClassAlumnoExpediente();
	$respuesta=  new xajaxResponse();
	
	//Seteo de variables
	$expediente->setCARNET($f["txtCarnet"]);
	$expediente->setAPELLCASAD($f["txtApellidoCas"]);
	$expediente->setAPELLIDO1($f["txtApellido1"]);
	$expediente->setAPELLIDO2($f["txtApellido2"]);
	$expediente->setCARRERA($f["lstCarrera"]);
	$expediente->setCODIGO_PLA($f["txtCodigoPlan"]);
	$expediente->setNOMBRES($f["txtNombres"]);
	
	$expediente->setTIPOINGRES($f["lstTipoIngreso"]);
	$expediente->setTIPOBECA($f["lstTipoBeca"]);
	
	$expediente->GuardaExpedienteAlumno();
	
	$respuesta->alert($f["lstTipoBeca"]);
	return $respuesta;
	
	}




/******************************************************************************************************
   Nombre:       cambia_texto()
   Proposito:  Eliminará los archvos que se corresponda y que se encuenteren en el directorio \LibUpload\savefiles\   
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo Para Eliminar los archivos Subidos al servidor.
  NOTAS:
*******************************************************************************************************/
 	function XajaxValidaPlan($f){
	$expediente= new ClassAlumnoExpediente();
	$respuesta=  new xajaxResponse();
	$expediente->setCODIGO_PLA($f["txtCodigoPlan"]);
	$planes=$expediente->getPlanes();
	
	//buscando planes 
	
		if($planes[0]["CODIGO_PLA"]==$f["txtCodigoPlan"]){
			
		$ok="ok";
		
			}
			else{
				$ok="no";
				}
	
	$expediente->setCODIGO_PLA($f["txtCodigoPlan"]);
	if($ok=="ok"){
		$respuesta->script("Habilitar()");
		$msn="valido";
		}
	else{
		$msn="No valido";
		$respuesta->script("desHabilitar()");
		}	
	$respuesta->assign("msn","innerHTML",$msn.$planes[0]["CODIGO_PLA"]);	
	return $respuesta;
	
	}


//metodo para la limpieza de todos los datos de session puesto por el Usuario
	$xajax->registerFunction("XajaxGuadarExpediente");
	$xajax->registerFunction("XajaxValidaPlan");
	//procesando todas la variables de xajax
	$xajax->processRequest();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="../ExpedienteAlumno/css/blueprint/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection">
<link href="../ExpedienteAlumno/css/blueprint/blueprint/src/forms.css" type="text/css" rel="stylesheet" media="screen, projection">
<link href="../ExpedienteAlumno/css/blueprint/blueprint/print.css" type="text/css" rel="stylesheet" media="print">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Carga de archivo</title>
<?php  $xajax->printJavascript("../xajax/xajax/");  ?>

<script>
function Habilitar(){
			//document.f1.bo.disabled=true;
			document.alumno.guardar.disabled=false; 
			
			//confirmar.disabled=true;
			
			}
function desHabilitar(){
			//document.f1.bo.disabled=true;
			document.alumno.guardar.disabled=true; 
		
			//confirmar.disabled=true;
			
			}			
</script>		
<!-- InstanceEndEditable -->
<link href="../ExpedienteAlumno/css/estilos.css" rel="stylesheet" type="text/css" />

<style type="text/css">
body {
	background-color: #CCC;
}
</style>
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
</head>

<body style="margin-left:30px">

<div class="container " style="height:950px; width:990px; background-color: #033;border-radius: 30px 0 0 30px; margin-top:5px" >
<div class="" >
 <img src="../ExpedienteAlumno/img/baner2.png" width="990" height="200" />
 
 </div>
 <div id="info" style="width:990px; height:300px; margin-top:5px">

 
 <div id="menu" style="width:200px; height:600px; background-color:#9C0; float:left; margin-left:5px;border-radius: 30px 0 0 30px;">
 <div id="User" style=" width:195px; height:94px; background-color:#FFF;border-radius: 30px 0 30px 0px; border-color:#000; margin:2px; border-style:solid">
 <br />
 <img src="../ExpedienteAlumno/img/user.png" width="30" height="30" /><font color="#3333FF"><strong>Bienvenido <?php echo $_SESSION["usuario"]; ?> <br />
  <img src="../ExpedienteAlumno/img/salir.png" width="30" height="30" /><a href="../User/logout.php">Cerrar Sesion</a></strong>
 </font></div>
 
 <div id="slider">
      <ul>
          <li>
             <a href="#" class="menudesplieg">Expediente</a>
                <div>
                    <h5>Expediente</h5>
                      
						<span class="desplieg">
                          <a href="../ExpedienteAlumno/CarnetManual.php">
                          <img src="../ExpedienteAlumno/img/add1.png" width="20" height="20" />
                           Carnet Manual 
                           </a>
                       </span>
                       
                       <span class="desplieg">
                         <a href="../ExpedienteAlumno/CarnetGenerado.php">
                         <img src="../ExpedienteAlumno/img/procesos.png" width="20" height="20" /> 
                         Generar Carnet
                         </a>
                       </span>
                       
                       <span class="desplieg">
                         <a href="../ExpedienteAlumno/EditAlumno.php"> 
                         <img src="../ExpedienteAlumno/img/edit.png" width="20" height="20" /> 
                         Editar</a>
                       </span>
               </div>
          </li>
          <li>
             <a href="#" class="menudesplieg">Universidades</a>
                <div>
                   <h5>Universidades</h5>
                    
					<span class="desplieg">
                    	<a href="../Equivalencias/Universidad.php">
                    	<img src="../ExpedienteAlumno/img/edit.png" width="20" height="20" /> 
                        Universidad
                        </a>
                	 </span>   
                     
                     
                     <span class="desplieg">
  <a href="../Equivalencias/Matrizparam.php">
                    	<img src="../ExpedienteAlumno/img/edit.png" width="20" height="20" /> 
                        Matriz por Universidad
                        </a>
                	 </span>   
                     
                   
                  
                
                  
                  
                
                           
                </div>         
         </li>
         
         
        
         
         
         <li>
            <a href="#" class="menudesplieg">Materias</a>
                <div>
                   <h5>Estado de Materias</h5>
                     
<span class="desplieg">
                          <a href="../Equivalencias/EstadoMateria.php">
                          <img src="../ExpedienteAlumno/img/edit.png" width="20" height="20" /> 
                          Estado de Materias
</a>
                          </span>
               </div>
         </li>
         
        
         
         
         <li>
            <a href="#" class="menudesplieg">Equivalencias</a>
                <div>
                   <h5>Estado Equivalencia</h5>
                     
						<span class="desplieg">
                          <a href="../Equivalencias/vistaExpedieteAlumno.php">
                          <img src="../ExpedienteAlumno/img/edit.png" width="20" height="20" /> 
                         Vista Expediente Alumno
                        </a>
                  </span>
                          
<span class="desplieg">
                          <a href="../Equivalencias/EstadoSoliEquivalencia.php">
                          <img src="../ExpedienteAlumno/img/edit.png" width="20" height="20" /> 
                           Estado de Solicitudes
</a>
                          </span>
                          
                          <!--<span class="desplieg">
                          <a href="../Equivalencias/Matrizparam.php">
                          <img src="../ExpedienteAlumno/img/edit.png" width="20" height="20" /> 
                          Matriz de Equivalencia
                           </a>
                          </span> -->
                          
                          
                          
                          
            </div>
         </li>
         
         
          <li>
            <a href="#" class="menudesplieg">Equivalencia Web </a>
                <div>
                   <h5>Matriz </h5>
                     
						<span class="desplieg">
                        <a href="../Equivalencias/MatrizVista.php">
                        <img src="../ExpedienteAlumno/img/vista.png" width="20" height="20" /> 
                          Equivalencia vía Internet
                        </a>
                  </span>
               </div>
         </li>
         
         
         <li>
            <a href="#" class="menudesplieg">Sincronizar Datos</a>
                <div>
                   <h5>Sincronizar Datos</h5>
                     
				  	<span class="desplieg">
					<a href="http://localhost:8080/SpagoBI/"  target="_blank">
                        <img src="../ExpedienteAlumno/img/sincronizar.png" width="20" height="20" /> 
                        Sincronizar Datos
                        </a>
                 	 </span>
               </div>
         </li>
         
         
        
         <li>
            <a href="#" class="menudesplieg">Carga de Archivo</a>
                <div>
                   <h5>Carga de Archivo</h5>
                     
<span class="desplieg">
                          <a href="index.php">
                          <img src="../ExpedienteAlumno/img/upload.png" width="20" height="20" /> 
                          Cargar Archivo
</a>
                          </span>
               </div>
         </li>
         
    </ul>
 </div>

 </div>
  <div id="formularios"  style="float:left; height:600px; width:770px; background:#FFF;margin-left:3px;border-radius: 30px 30px 30px 0px;">

 <div style="margin-top:0px"><!-- InstanceBeginEditable name="EditRegion3" -->
 <div > 
   <div>
   <div class=" info" style="height:10px; margin-top:0px;border-radius: 30px 30px 0px 0px"><center>
     <h3>Carga de Archivo</h3>
   </center></div> 
   <div>

</div>

<div id="Info" align="center">
<iframe src="carga_archivo.php" height="500px" width="600px"></iframe>
</div>
   </div>
 </div>
 
 <!-- InstanceEndEditable --></div>
 
 </div>
 
 </div>
 <div id="pie" style="background-color:#660; float:left; height:5px; margin-top:3px;border-radius: 0px 0px 10px 10px; color:#FFF" align="center" class=" span-24 success">
   <h4 ><font color="#FFFFFF">UNIVERSIDAD POLITÉCNICA DE EL SALVADOR <?php echo date('Y');?> SIAI</font></h4>
 </div>
</div>
</body>
<!-- InstanceEnd --></html>