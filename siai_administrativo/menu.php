<?php
$url_server='http://'.$_SERVER['SERVER_NAME'].'/siai/siai_administrativo/';
?>
<div class="navbar navbar-inverse navbar-fixed-top">
   <!--DIV -->
<div style="height:100px; background-color: #006; background-image:url(<?php echo $url_server;?>img/baner2.png); background-repeat:inherit">
  
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
                     <li><a href="<?php echo $url_server;?>ExpedienteAlumno/ExpedienteAlumno.php"><i class="icon-file"></i> Crear Carnet</a></li>
                      <li><a href="<?php echo $url_server;?>ExpedienteAlumno/EditExpedienteAlumno.php"><i class="icon-edit"></i> Editar Expediente</a></li>
                    </ul>    
               </li> 
               
               <?php }?>
               
               
               
               
                 <!--inicio de validacion  Coordinadores-->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==2 or $_SESSION["user"][0]["TIPO_USUAR"]==1 ){?> 
               
                <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-refresh icon-white"></i> Equivalencias<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                     <li><a href="<?php echo $url_server;?>Equivalencias/CrearSolicitud.php"><i class="icon-file"></i> Crear Solicitud Equivalencia</a></li>
                      <li><a href="<?php echo $url_server;?>Equivalencias/CrearMatrizEquivalencia.php"><i class="icon-edit"></i> Mtto matriz equivalencia</a></li>
                      <li><a href="<?php echo $url_server;?>Equivalencias/VistaMatrizWeb.php"><i class="icon-eye-open"></i> Vista matriz equivalencia</a></li>
                    </ul> <!--FIn de dropdown-menu -->   
               </li> <!--fin del dropdown-->
               
               
               
               <?php }?>
               
               
                <!--inicio de validacion  Coordinadores-->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==2  or $_SESSION["user"][0]["TIPO_USUAR"]==1){?> 
               
               
               <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-flag icon-white"></i> Mantenimientos<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                     <li><a href="<?php echo $url_server;?>Equivalencias/MttoEsatdoEquivalencias.php"><i class="icon-file">
                     </i> Mtto estado equivalencia</a></li>
                      <li><a href="<?php echo $url_server;?>Equivalencias/MttoEstadoMateria.php"><i class="icon-edit"></i> Mtto estado materias</a></li>
                       <li><a href="<?php echo $url_server;?>Equivalencias/MttoUniversidades.php"><i class="icon-edit"></i> Mtto institución educación superior</a></li>
                        <li><a href="<?php echo $url_server;?>Horarios/index.php"><i class="icon-edit"></i> Mtto Horarios</a></li>
                     <li><a href="<?php echo $url_server;?>Franjas/MttoFranjas.php"><i class="icon-calendar"></i> Franjas horarias de acceso</a></li>
                     <li><a href="<?php echo $url_server;?>Accesos/MttoCatedraticos.php"><i class="icon-user"></i> Catedr&aacute;ticos</a></li>
                     <li><a href="<?php echo $url_server;?>Accesos/MttoCoordinadores.php"><i class="icon-briefcase"></i> Coordinadores de carreras</a></li>
                     <li><a href="<?php echo $url_server;?>Accesos/MttoUsuarios.php"><i class="icon-user"></i> Usuarios del m&oacute;dulo administrativo</a></li>
                    </ul> <!--FIn de dropdown-menu -->   
               </li> <!--fin del dropdown-->
               
               <?php }?>
               
               
               <!--inicio de validacion  para contabilidad -->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==1 or $_SESSION["user"][0]["TIPO_USUAR"]==4){?>
               <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-check icon-white"></i> Pagos<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                   	  <!--<li><a href="<?php // echo $url_server;?>ventanilla/index.php"><i class="icon-arrow-up"></i> Cargar Archivo</a></li>-->  
                          <li><a href="<?php echo $url_server;?>ventanilla/obligaciones_siai.php"><i class="icon-arrow-up"></i> Obligaciones-siai</a></li>  
                    </ul> <!--FIn de dropdown-menu -->               
               </li> <!--fin del dropdown-->
               <?php }?>


				<!--inicio de validacion  para contabilidad -->

               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==1 or $_SESSION["user"][0]["TIPO_USUAR"]==2){?>
               <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-thumbs-up icon-white"></i> Validación inscripción<b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                   	  <li><a href="<?php echo $url_server;?>siai_validacion/index.php"><i class="icon-arrow-up"></i> Validar</a></li>  
                    </ul> <!--FIn de dropdown-menu -->               
               </li> <!--fin del dropdown-->
               <?php }?>
               
               <?php if($_SESSION["user"][0]["TIPO_USUAR"]==1){?>
               <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-search icon-white"></i> Consultas<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $url_server;?>Reportes/VistaCuposReservados.php"><i class="icon-check"></i> Cupos reservados</a></li> 
                        <li><a href="<?php echo $url_server;?>Reportes/VistaAlumnosInscritos.php"><i class="icon-list"></i> Alumnos inscritos</a></li> 
                    </ul> <!--FIn de dropdown-menu -->               
               </li> <!--fin del dropdown-->
               <?php }?>
               
            </ul> <!--fin del NAV -->
              
              
              <p class="navbar-text pull-right">Conectado como: 
              <a href="<?php echo $url_server;?>Accesos/MttoPerfil.php" class="navbar-link"><strong><?php echo $_SESSION["user"][0]["usuario"]; ?></strong> </a>
              <i class="icon-user icon-white"></i> 
              <a href="<?php echo $url_server;?>login/salir.php" class="icon-off icon-white"></a> </p>
            </div> 
            <!--FIN de nav-collapse collapse -->
            
          
            
            </div> <!--container -->
        </div> <!-- FIN de navbar-inner-->
        
    
    </div> <!--fin de  navbar navbar-inverse navbar-fixed-top-->