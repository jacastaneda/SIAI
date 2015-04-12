<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script src="../bootstrap/js/jquery-1.8.3.js"></script>
<script src="../bootstrap/js/bootstrap-collapse.js"></script> 
<script src="../bootstrap/js/bootstrap-dropdown.js"></script> 
<script src="../bootstrap/js/bootstrap-modal.js"></script> 
<style>
body {
	padding-top: 150px;
}
</style>
<!-- TemplateBeginEditable name="doctitle" -->

<title>SIAI</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<!--Inicio de MENU este clase deja fijo el menu no importa el tamaño-->
    <div class="navbar navbar-inverse navbar-fixed-top">
   <!--DIV -->
<div style="height:100px; background-color: #006; background-image:url(../img/baner2.png); background-repeat:inherit">
  
   </div>
    
<!-- COloca de colore nego el fonde donde reisidra el MENU-->
        <div class="navbar-inner">
        	<div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
             <span class="icon-bar"></span> <span class="icon-bar"></span>
             <span class="icon-bar"></span> 
            </a>
            
            
            <div class="nav-collapse collapse">
            
           
            <ul class="nav">
            
              
                 <!--inicio de validacion -->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==3 or $_SESSION["user"][0]["TIPO_USUAR"]==1 ){?> 
                
                <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-briefcase icon-white"></i> Expediente Alumno<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                     <li><a href="../ExpedienteAlumno/ExpedienteAlumno.php"><i class="icon-file"></i> Crear Carnet</a></li>
                      <li><a href="../ExpedienteAlumno/EditExpedienteAlumno.php"><i class="icon-edit"></i> Editar Expediente</a></li>
                    </ul> <!--FIn de dropdown-menu -->   
               </li> <!--fin del dropdown-->
               
               <?php }?>
               
               
               
               
                 <!--inicio de validacion  Coordinadores-->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==2 or $_SESSION["user"][0]["TIPO_USUAR"]==1 ){?> 
               
                <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-briefcase icon-white"></i> Equivalencias<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                     <li><a href="../Equivalencias/CrearSolicitud.php"><i class="icon-file"></i> Crear Solicitud Equivalencia</a></li>
                      <li><a href="../Equivalencias/CrearMatrizEquivalencia.php"><i class="icon-edit"></i> Mtto matriz equivalencia</a></li>
                      <li><a href="../Equivalencias/VistaMatrizWeb.php"><i class="icon-eye-open"></i> Vista matriz equivalencia</a></li>
                    </ul> <!--FIn de dropdown-menu -->   
               </li> <!--fin del dropdown-->
               
               
               
               <?php }?>
               
               
                <!--inicio de validacion  Coordinadores-->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==2  or $_SESSION["user"][0]["TIPO_USUAR"]==1){?> 
               
               
               <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-briefcase icon-white"></i> Mantenimientos<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                     <li><a href="../Equivalencias/MttoEsatdoEquivalencias.php"><i class="icon-file">
                     </i> Mtto estado equivalencia</a></li>
                      <li><a href="../Equivalencias/MttoEstadoMateria.php"><i class="icon-edit"></i> Mtto estado materias</a></li>
                       <li><a href="../Equivalencias/MttoUniversidades.php"><i class="icon-edit"></i> Mtto institución educación superior</a></li>
                        <li><a href="../Horarios/index.php"><i class="icon-edit"></i> Mtto Horarios</a></li>
                    </ul> <!--FIn de dropdown-menu -->   
               </li> <!--fin del dropdown-->
               
               <?php }?>
               
               
               <!--inicio de validacion  para contabilidad -->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==1 or $_SESSION["user"][0]["TIPO_USUAR"]==4){?>
               <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-briefcase icon-white"></i> Pagos<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                   	  <li><a href="../ventanilla/index.php"><i class="icon-arrow-up"></i> Cargar Archivo</a></li>  
                    </ul> <!--FIn de dropdown-menu -->               
               </li> <!--fin del dropdown-->
               <?php }?>


				<!--inicio de validacion  para contabilidad -->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==1 or $_SESSION["user"][0]["TIPO_USUAR"]==2){?>
               <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-briefcase icon-white"></i> Validación inscripción<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                   	  <li><a href="../siai_validacion/index.php"><i class="icon-arrow-up"></i> Validar</a></li>  
                    </ul> <!--FIn de dropdown-menu -->               
               </li> <!--fin del dropdown-->
               <?php }?>

			 <?php if($_SESSION["user"][0]["TIPO_USUAR"]==1 ){?>
                <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-briefcase icon-white"></i> Sincronizar Datos<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                    	 <li><a href="../ventanilla/index.php"><i class="icon-tasks"></i> Spago BI</a></li>        
                    </ul> <!--FIn de dropdown-menu -->                    
               </li> <!--fin del dropdown-->
             <?php }?>  
               
            </ul> <!--fin del NAV -->
              
              
              <p class="navbar-text pull-right"> Conectado como: 
              <a href="#" class="navbar-link"><strong><?php echo $_SESSION["user"][0]["usuario"]; ?></strong> </a>
              <i class="icon-user icon-white"></i> 
              <a href="../login/salir.php" class="icon-off icon-white"></a> </p>
            </div> 
            <!--FIN de nav-collapse collapse -->
            
          
            
            </div> <!--container -->
        </div> <!-- FIN de navbar-inner-->
        
    
    </div> <!--fin de  navbar navbar-inverse navbar-fixed-top-->


<div class="container">
	<div class=" well well-small"><!-- TemplateBeginEditable name="EditRegion3" -->Nombre de MOdulos<!-- TemplateEndEditable --></div>

<div class="well"><!-- TemplateBeginEditable name="EditRegion4" -->Cuerpo<!-- TemplateEndEditable --></div>
<footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
