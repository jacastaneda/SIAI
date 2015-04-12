<?php session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/ClassAlumnoExpediente.php");
 
$_GET["carnet"];
//echo $Carnet;
$expediente=new ClassAlumnoExpediente();
$expediente->setCARNET($_GET["carnet"]);
$Alumno=$expediente->GetExpedienteAlumno();
$carrera=$expediente->getCatCarrera();
$Nacionalidad=$expediente->getCatNacionalidad();
$Departamentos=$expediente->getDepartamentos();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="css/blueprint/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection">
<link href="css/blueprint/blueprint/src/forms.css" type="text/css" rel="stylesheet" media="screen, projection">
<link href="css/blueprint/blueprint/print.css" type="text/css" rel="stylesheet" media="print">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<link rel="stylesheet" href="../js/jQueryUI/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../js/jQueryUI/development-bundle/jquery-1.4.4.js"></script>
	<script src="../js/jQueryUI/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../js/jQueryUI/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../js/jQueryUI/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<!--<link rel="stylesheet" href="../js/jQueryUI/development-bundle/demos/demos.css"> -->
    
    
    <script>
	
	<!-- scrip para CALENDARIO DE JQUERY-->
	

	
	
	$(function() {
		$( "#txtFechaInicio" ).datepicker({changeMonth: true,changeYear: true, autoSize: true, yearRange: '<?php echo date('Y')-95; ?>:<?php echo date('Y'); ?>',monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Deciembre'], dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S']});
  $( "#txtFechaInicio" ).datepicker( "option", "dateFormat", "yy-mm-dd");
	});
	
	
	$(function() {
		$( "#txtFechaFinal" ).datepicker({changeMonth: true,changeYear: true, autoSize: true, yearRange: '<?php echo date('Y')-95; ?>:<?php echo date('Y'); ?>',monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Deciembre'], dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S']});
  $( "#txtFechaFinal" ).datepicker( "option", "dateFormat", "yy-mm-dd");
	});
	
	
	</script>

<!-- FIN DE scrip para CALENDARIO DE JQUERY-->
 <meta charset="utf-8">
        <!--    ESTILO GENERAL   -->
        <link type="text/css" href="css/style.css" rel="stylesheet" />
        <!--    FORMATO DE TABLAS    -->
<!-- InstanceEndEditable -->
<link href="css/estilos.css" rel="stylesheet" type="text/css" />

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
 <img src="img/baner2.png" width="990" height="200" />
 
 </div>
 <div id="info" style="width:990px; height:300px; margin-top:5px">

 
 <div id="menu" style="width:200px; height:600px; background-color:#9C0; float:left; margin-left:5px;border-radius: 30px 0 0 30px;">
 <div id="User" style=" width:195px; height:94px; background-color:#FFF;border-radius: 30px 0 30px 0px; border-color:#000; margin:2px; border-style:solid">
 <br />
 <img src="img/user.png" width="30" height="30" /><font color="#3333FF"><strong>Bienvenido <?php echo $_SESSION["usuario"]; ?> <br />
  <img src="img/salir.png" width="30" height="30" /><a href="../User/logout.php">Cerrar Sesion</a></strong>
 </font></div>
 
 <div id="slider">
      <ul>
          <li>
             <a href="#" class="menudesplieg">Expediente</a>
                <div>
                    <h5>Expediente</h5>
                      
						<span class="desplieg">
                          <a href="CarnetManual.php">
                          <img src="img/add1.png" width="20" height="20" />
                           Carnet Manual 
                           </a>
                       </span>
                       
                       <span class="desplieg">
                         <a href="CarnetGenerado.php">
                         <img src="img/procesos.png" width="20" height="20" /> 
                         Generar Carnet
                         </a>
                       </span>
                       
                       <span class="desplieg">
                         <a href="EditAlumno.php"> 
                         <img src="img/edit.png" width="20" height="20" /> 
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
                    	<img src="img/edit.png" width="20" height="20" /> 
                        Universidad
                        </a>
                	 </span>   
                     
                     
                     <span class="desplieg">
  <a href="../Equivalencias/Matrizparam.php">
                    	<img src="img/edit.png" width="20" height="20" /> 
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
                          <img src="img/edit.png" width="20" height="20" /> 
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
                          <img src="img/edit.png" width="20" height="20" /> 
                         Vista Expediente Alumno
                        </a>
                  </span>
                          
<span class="desplieg">
                          <a href="../Equivalencias/EstadoSoliEquivalencia.php">
                          <img src="img/edit.png" width="20" height="20" /> 
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
                        <img src="img/vista.png" width="20" height="20" /> 
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
                        <img src="img/sincronizar.png" width="20" height="20" /> 
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
                          <a href="../ventanilla/index.php">
                          <img src="img/upload.png" width="20" height="20" /> 
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
<div align="center" class="success" style="height:10px; margin-top:0px;border-radius: 30px 30px 0px 0px;"> 
Edición de Alumnos
</div>
<div id="tablaAlumnos" class="span-17" style="margin-left:1px">

 <iframe src="updatealumno2.php" height="600px" width="770px"></iframe>

 </div><!--fin de tablaAlumnos -->
  

 
 <!-- InstanceEndEditable --></div>
 
 </div>
 
 </div>
 <div id="pie" style="background-color:#660; float:left; height:5px; margin-top:3px;border-radius: 0px 0px 10px 10px; color:#FFF" align="center" class=" span-24 success">
   <h4 ><font color="#FFFFFF">UNIVERSIDAD POLITÉCNICA DE EL SALVADOR <?php echo date('Y');?> SIAI</font></h4>
 </div>
</div>
</body>
<!-- InstanceEnd --></html>