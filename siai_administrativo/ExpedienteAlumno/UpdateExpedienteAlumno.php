<?php session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/ClassAlumnoExpediente.php");

if(($_SESSION["user"][0]["TIPO_USUAR"])==""){
	
	header ("Location: ../index.php");
	}

//echo $Carnet;
$expediente=new ClassAlumnoExpediente();
$expediente->setCARNET($_GET["carnet"]);
$Alumno=$expediente->GetExpedienteAlumno();
$carrera=$expediente->getCatCarrera();
$Nacionalidad=$expediente->getCatNacionalidad();
$Departamentos=$expediente->getDepartamentos();
$Instituciones=$expediente->getInstituciones();
$Tipoingreso=$expediente->getTipoIingreso();
$Estatus=$expediente->getEstatus();



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
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
<!-- InstanceBeginEditable name="doctitle" -->
<title>SIAI</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="js/ExpedienteAlumno.js"></script>



<!--Inicio de instancia para JQUERY DATA picker-->
<link rel="stylesheet" href="../bootstrap/js/jQueryUI/development-bundle/themes/base/jquery.ui.all.css">
	<!--<script src="../JS/jQueryUI/development-bundle/jquery-1.4.4.js"></script> -->
	<script src="../bootstrap/js/jQueryUI/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../bootstrap/js/jQueryUI/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../bootstrap/js/jQueryUI/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="../bootstrap/js/jQueryUI/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
     <script src="../bootstrap/js/jQueryUI/development-bundle/ui/jquery-ui-1.8.10.custom.js"></script>


<!--fin de la instancia data PICKER -->

<script>
$(function() {
		$( "#FECHANACIM" ).datepicker({changeMonth: true,changeYear: true, autoSize: true, yearRange: '<?php echo date('Y')-95; ?>:<?php echo date('Y'); ?>',monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Deciembre'], dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S']});
  $( "#FECHANACIM" ).datepicker( "option", "dateFormat", "yy-mm-dd");
	});
	
<!-- scrip para CALENDARIO DE JQUERY-->	
	

<!-- scrip para Ventana Modal DE JQUERY-->	
				 $.fx.speeds._default = 2000;
				$(function() {
				$( "#dialog" ).dialog({
				autoOpen: false,
				show: "blind",
				hide: "explode",
				width: 700,
				height:500,
				});
				$( "#opener" ).click(function() {
				$( "#dialog" ).dialog( "open" );
				return false;
				});
				});
</script>

<!-- InstanceEndEditable -->
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
                     <li><a href="ExpedienteAlumno.php"><i class="icon-file"></i> Crear Carnet</a></li>
                      <li><a href="EditExpedienteAlumno.php"><i class="icon-edit"></i> Editar Expediente</a></li>
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
	<div class=" well well-small"><!-- InstanceBeginEditable name="EditRegion3" -->
	  <h4>Actualización de Expediente Alumno</h4>
	<!-- InstanceEndEditable --></div>

<div class="well"><!-- InstanceBeginEditable name="EditRegion4" -->
<form id="ss" action="javascript:void(null)" method="post" class="form-horizontal">
  <div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">
        <h5>Informacion General</h5>
      </li>
      <li class="TabbedPanelsTab" tabindex="0">
        <h5>Documentación</h5>
      </li>
      <li class="TabbedPanelsTab" tabindex="0">
        <h5>Universidad</h5>
      </li>
      <li class="TabbedPanelsTab" tabindex="0">
        <h5>Pensum</h5>
      </li>
    </ul>
    <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent">
<br />
     <table width="768" border="0">
  <tr>
    <td width="81">Carnet</td>
    <td width="320"><input name="CARNET1" type="text" disabled="disabled" id="CARNET1" value="<?php  echo $Alumno[0]["CARNET"]; ?>"/>
            <input type="hidden" name="CARNET" id="CARNET" value="<?php  echo $Alumno[0]["CARNET"]; ?>"/></td>
    <td width="93"><div align="right">Sexo</div></td>
    <td width="256"><input type="text" name="SEXO" id="SEXO" value="<?php  echo $Alumno[0]["SEXO"]; ?>" /></td>
  </tr>
  <tr>
    <td>Carrera</td>
    <td><select name="CODCARRERA" id="CODCARRERA" >
            <?php 
		 $z=$expediente->CatalogoBusqueda($carrera,$Alumno[0]["CODCARRERA"]);?>
            <option value="<?php echo $Alumno[0]["CODCARRERA"]; ?>"><?php echo  $z;  ?></option>
            <?php for($z=0;$z<count($carrera);$z++){
				if($Alumno[0]["CODCARRERA"]<>$carrera[$z]["CODIGO_CAR"]){
				?>
            <option value="<?php echo $carrera[$z]["CODIGO_CAR"]; ?>"> <?php echo $carrera[$z]["NOMBRE"]."|".$carrera[$z]["CODIGO_CAR"]; ?></option>
            <?php }
			}?>
          </select></td>
    <td><div align="right">Estado Civil</div></td>
    <td><input type="text" name="ESTADOCIVI" id="ESTADOCIVI"  value="<?php  echo $Alumno[0]["ESTADOCIVI"]; ?>"/></td>
  </tr>
  <tr>
    <td>Cod Inter</td>
    <td><input name="textfield4" type="text" disabled="disabled" id="textfield4" /></td>
    <td><div align="right">Edad</div></td>
    <td><input name="EDAD" type="text" disabled="disabled" id="EDAD" value="<?php  echo $Alumno[0]["EDAD"]; ?>"/></td>
  </tr>
  </table>

      <br />
      <hr />
      
      <table width="679" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="164"><div align="center">Nombre</div></td>
          <td width="178"><div align="center">Apellido1</div></td>
          <td width="181"><div align="center">Apellido2</div></td>
          <td width="144"><div align="center">Apellido Casada</div></td>
        </tr>
        <tr>
          <td><input type="text" name="NOMBRES"  id="NOMBRES"  value="<?php echo $Alumno[0]["NOMBRES"]; ?>"/></td>
          <td><input type="text" name="APELLIDO1" id="APELLIDO1"  value="<?php echo $Alumno[0]["APELLIDO1"]; ?>" /></td>
          <td><input type="text" name="APELLIDO2" id="APELLIDO2"  value="<?php echo $Alumno[0]["APELLIDO2"]; ?>"/></td>
          <td><input type="text" name="APELLCASAD" id="APELLCASAD"   value="<?php echo $Alumno[0]["APELLCASAD"]; ?>"/></td>
        </tr>
        <tr>
          <td colspan="4">Direccion
            <label for="DIRECCION"></label>
            <textarea name="DIRECCION" cols="200" id="DIRECCION" style="width:800px"><?php echo $Alumno[0]["DIRECCION"]; ?></textarea></td>
        </tr>
      </table>
      <table width="612" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="57">Telefono&nbsp;</td>
          <td width="144"><input type="text" name="TELEFONO" id="TELEFONO" value="<?php echo $Alumno[0]["TELEFONO"]; ?>"/></td>
          <td width="389"><div align="right">Nacionalidad</div></td>
          <td width="389"><select name="NACIONALID" id="NACIONALID">
            <?php 
			$p=$expediente->CatalogoBusquedaNacionalidad($Nacionalidad,$Alumno[0]["NACIONALID"]);
			?>
            <option value="<?php echo $Alumno[0]["NACIONALID"]; ?> "> <?php echo $p; ?></option>
            <?php
			for($i=0;$i<count($Nacionalidad);$i++){
				if($Alumno[0]["NACIONALID"]<>$Nacionalidad[$i]["CODIGO"]){
				
				?>
            <option value="<?php echo $Nacionalidad[$i]["CODIGO"]; ?> "> <?php echo $Nacionalidad[$i]["NOMBRE"]; ?></option>
            <?php  }}?>
          </select></td>
        </tr>
        <tr>
          <td>Departamento</td>
          <td><select name="DEPTODIREC" id="DEPTODIREC">
            <?php 
			
			$p=$expediente->CatalogoBusquedaDepto($Departamentos,$Alumno[0]["DEPTODIREC"]);
			?>
            <option value="<?php echo $Alumno[0]["DEPTODIREC"]; ?>"> <?php echo $p;?></option>
            <?php
			for($i=0;$i<count($Departamentos);$i++){
				
				if($Alumno[0]["DEPTODIREC"]<>$Departamentos[$i]["CODIGO"]){
				?>
            <option value="<?php echo $Departamentos[$i]["CODIGO"]; ?>"> <?php echo $Departamentos[$i]["NOMBRE"];?></option>
            <?php }
			}?>
          </select></td>
          <td><div align="right">Municipio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
          <td><input type="text" name="MUNIDIRECC" id="MUNIDIRECC" value ="<?php echo $Alumno[0]["MUNIDIRECC"];?>" /></td>
        </tr>
      </table>
      <hr />
      <table width="862" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="220">Departamento Nacimiento</td>
          <td width="256">Municipio Nacimiento</td>
          <td width="376">Feha Nacimiento: <?php echo $Alumno[0]["FECHANACIM"];?></td>
        </tr>
        <tr>
          <td><select name="DEPTONACIM" id="DEPTONACIM">
            <?php for($i=0;$i<count($Departamentos);$i++){?>
            <option value="<?php echo $Departamentos[$i]["CODIGO"] ?>"> <?php echo $Departamentos[$i]["NOMBRE"];?></option>
            <?php }?>
          </select></td>
          <td><input type="text" name="MUNINACIMI" id="MUNINACIMI"  value ="<?php echo $Alumno[0]["MUNINACIMI"];?>" /></td>
          <td>
            Cambiar Fecha            
              <input type="text" name="FECHANACIM" id="FECHANACIM" /> <span class="icon-calendar "></span></td>
        </tr>
        <tr>
          <td>Correo Electronico</td>
          <td>NIT</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input type="text" name="textfield15" id="textfield15" /></td>
          <td><input type="text" name="textfield16" id="textfield16" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </div>
      <div class="TabbedPanelsContent">
      <table width="765" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="63">Institución</td>
          <td width="63"><select name="INSTITUCIO" id="INSTITUCIO">
              ´
            
              <?php $p=$expediente->CatalogoBusquedaInstitucion($Instituciones,$Alumno[0]["INSTITUCIO"]);
			
			?>
            <option value="<?php echo $Alumno[0]["INSTITUCIO"]; ?>"><?php echo $p;?></option>
              <?php for($i=0;$i<count($Instituciones);$i++){
				if($Alumno[0]["INSTITUCIO"]<>$Instituciones[$i]["CODIGO"]){
				
				?>
              <option value="<?php echo $Instituciones[$i]["CODIGO"]; ?>"><?php echo $Instituciones[$i]["NOMBRE"];?></option>
              <?php }}?>
          </select></td>
          <td width="629"><div align="right">Expediente</div></td>
          <td width="629"><input type="text" name="EXPEDIENTE" id="EXPEDIENTE" value="<?php echo $Alumno[0]["EXPEDIENTE"]; ?>"/></td>
        </tr>
        <tr>
          <td>Titulo</td>
          <td><?php 
		  $Titulo=$expediente->getTitulo();
		  $p=$expediente->CatalogoBusquedaTitulo($Titulo,$Alumno[0]["TITULO"]);?>
            <select name="TITULO" id="TITULO">
              ´
           
             
              <option value="<?php echo $Alumno[0]["TITULO"]; ?>"><?php echo $p;?></option>
              <?php for($i=0;$i<count($Titulo);$i++){
				if($Alumno[0]["TITULO"]<>$Titulo[$i]["CODIGO"]){
				
				?>
              <option value="<?php echo $Titulo[$i]["CODIGO"]; ?>"><?php echo $Titulo[$i]["NOMBRE"];?></option>
              <?php }}?>
            </select></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <hr />
      Documentos Entregados
      <table width="800" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="78"><div align="right">
        <?php 
	  if($Alumno[0]["TITULOBACH"]==1){
		  $chek='checked="checked"';
		  
		  }
		 else{$chek='';} 
	  ?>
        <input name="TITULOBACH" type="checkbox" id="TITULOBACH" <?php echo $chek; ?> onclick="fechaDocEntregados(1);" />
      </div>
        </td>
      <td width="156">Título de bachiller</td>
      <td width="153">
        <input type="text" name="FEC_BAC" id="FEC_BAC" value="<?php echo $Alumno[0]["FEC_BAC"]; ?>"/></td>
      <td width="61"><div align="right">
        <?php 
	  if($Alumno[0]["PARTIDAORI"]==1){
		  $chek='checked="checked"';
		  
		  }
		 else{$chek='';} 
	  ?>
        <input type="checkbox" name="PARTIDAORI" id="PARTIDAORI"  <?php echo $chek; ?>  onclick="fechaDocEntregados(2);" />
      </div>
       </td>
      <td width="113"><div align="right">Partida original</div></td>
      <td width="174">
        <input type="text" name="FEC_PDA" id="FEC_PDA"  value="<?php echo $Alumno[0]["FEC_PDA"]; ?>"/></td>
    </tr>
    <tr>
      <td><div align="right">
        <?php  if($Alumno[0]["CERTIFICAC"]==1){
		  $chek='checked="checked"';
		  
		  }
		  else{$chek='';} 
		  ?>
        <input type="checkbox" name="CERTIFICAC" id="CERTIFICAC"  <?php echo $chek; ?>  onclick="fechaDocEntregados(3);"/>
      </div>
       </td>
      <td>Certificación Notas</td>
      <td><input type="text" name="FEC_CER" id="FEC_CER"  value="<?php echo $Alumno[0]["FEC_CER"]; ?>"/></td>
      <td><div align="right">
        <?php 
	  if($Alumno[0]["FOTOS"]==1){
		  $chek='checked="checked"';
		  
		  }
		 else{$chek='';} 
	  ?>
        <input type="checkbox" name="FOTOS" id="FOTOS" <?php echo $chek; ?>  onclick="fechaDocEntregados(4);" />
      </div></td>
      <td>Fotos</td>
      <td><input type="text" name="FEC_FOT" id="FEC_FOT" value="<?php echo $Alumno[0]["FEC_FOT"]; ?>"/></td>
    </tr>
  </table>
  
  <hr />
  <table width="716">
    <tr>
      <td width="128">Fecha Solicitud</td>
      <td width="576">
        <input name="FECHA_SOLI" type="text" id="FECHA_SOLI" value="<?php echo $Alumno[0]["FECHA_SOLI"]; ?>"/></td>
    </tr>
    <tr>
      <td>Lugar de trabajo</td>
      <td>
        <input name="LUGARTRABA" type="text" id="LUGARTRABA" size="40" value="<?php echo $Alumno[0]["LUGARTRABA"]; ?>"/></td>
    </tr>
    <tr>
      <td>Direccion Trabajo</td>
      <td>
        <input name="LUGARTRABA" type="text" id="LUGARTRABA" size="90" value="<?php echo $Alumno[0]["DIRTRABAJO"]; ?>" /></td>
    </tr>
    <tr>
      <td>Teléfono</td>
      <td>
        <input type="text" name="TELTRABAJO" id="TELTRABAJO"  value="<?php echo $Alumno[0]["TELTRABAJO"]; ?>"/>
        Extension
      
        <input type="text" name="EXTENSION" id="EXTENSION" value="<?php echo $Alumno[0]["TELTRABAJO"]; ?>" /></td>
    </tr>
  </table>
      </div>
      <div class="TabbedPanelsContent">
      <br />
      <table width="735" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="85">Ciclo Ingreso</td>
          <td width="240"><input name="CICLOINGRE" type="text" id="CICLOINGRE"  value="<?php echo $Alumno[0]["CICLOINGRE"]; ?>" readonly="readonly" /></td>
          <td width="109">Plan Estudio</td>
          <td width="288"><input type="text" name="CODIGO_PLA" id="CODIGO_PLA"  value="<?php echo $Alumno[0]["CODIGO_PLA"]; ?>"/></td>
        </tr>
        <tr>
          <td>Tipo Ingreso</td>
          <td><select name="TIPOINGRES" id="TIPOINGRES">
            <?php if($Alumno[0]["TIPOINGRES"]=="EQ"){?>
            <option value="EQ">INGRESO EQUIVALENCIAS</option>
              <option value="NI">NUEVO INGRESO</option>
              <?php  } 
			 ?>
              <?php if($Alumno[0]["TIPOINGRES"]=="NI"){?>
              <option value="NI">NUEVO INGRESO</option>
              <option value="EQ">INGRESO EQUIVALENCIAS</option>
              <?php } ?>
              <?php if($Alumno[0]["TIPOINGRES"]==""){?>
              <option value="-1">Seleccione Tipo Ingreso</option>
              <option value="NI">NUEVO INGRESO</option>
              <option value="EQ">INGRESO EQUIVALENCIAS</option>
              <?php } ?>
          </select></td>
          <td>Estatus</td>
          <td><?php $h=$expediente->CatalogoBusquedaEstatus($Estatus,$Alumno[0]["ESTATUS"]);?>
            <select name="ESTATUS" id="ESTATUS">
              <option value="<?php echo $Alumno[0]["ESTATUS"] ;?>"> <?php echo $h; ?></option>
              <?php 
			$h=$expediente->CatalogoBusquedaEstatus($Estatus,$Alumno[0]["ESTATUS"]);
			for($i=0;$i<count($Estatus);$i++){
				if($Estatus[$i]["CODIGO"]<>$Alumno[0]["ESTATUS"]){
				?>
              <option value="<?php echo $Estatus[$i]["CODIGO"]; ?>"> <?php echo $Estatus[$i]["NOMBRE"]; ?></option>
              <?php }}?>
            </select></td>
        </tr>
        <tr>
          <td>Graduacion</td>
          <td><input name="CICLOGRA" type="text" disabled="disabled" id="CICLOGRA"  value="<?php echo $Alumno[0]["CICLOGRA"]; ?>"/></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <hr />
      <table width="655" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="136"><div align="right">CUM General</div></td>
          <td width="164"><input name="textfield35" type="text" disabled="disabled" id="textfield35" value="<?php echo $Alumno[0]["CUMGENERAL"]; ?>"/></td>
          <td width="144"><div align="right">CUM Relativo</div></td>
          <td width="198"><input name="textfield36" type="text" disabled="disabled" id="textfield36"  value="<?php echo $Alumno[0]["CUMRELATIV"]; ?>"/></td>
        </tr>
        <tr>
          <td>Observaciones</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><label for="OBSERVACIO"></label>
            <textarea name="OBSERVACIO" cols="100" rows="4" id="OBSERVACIO" style="width:680px"><?php echo $Alumno[0]["OBSERVACIO"]; ?></textarea></td>
        </tr>
      </table>
      
      </div>
      <div class="TabbedPanelsContent">
      Pensum
      <?php include("../clases/DB_model.php");
	$cnx= new  DBmodel();
	$con=$cnx->Open_conexion();?>
    
    <div>
    <table  border="0">
  <tr>
<?php
$PLAN=$Alumno[0]["CODIGO_PLA"]; echo "PLAN :". $Alumno[0]["CODIGO_PLA"];  
$CARNET=$Alumno[0]["CARNET"]; echo " CARTNET : ". $Alumno[0]["CARNET"] ;   

 for($c=1;$c<=10;$c++){
	
	
	 $sql="call PROC_pensum('$PLAN','$CARNET','$c')";
 /*  $sql='SELECT a.CODIGO,
       a.NOMBRE,
       p.CORRELATIV,
       a.UNIDADVALO,
       fn_prerequisito(a.CODIGO,"2625") as pre,
	    fn_Materia_Aprobada(a.CODIGO,"TT200601") AS aprobada

 FROM planes p left JOIN asignatura a 
  ON p.ASIGNATURA = a.CODIGO
 WHERE p.codigo_pla = "2625"  AND p.CICLO = "'.$c.'"
ORDER BY p.CORRELATIV'; */

	$consulta=$con->query($sql);
	
	?>
    
    <td width="107"><div align="center">CICLO <?php echo $c; ?> 
      
      <?php   while($asi=$consulta->fetch_assoc()){
		  if($asi["aprobada"]==1){
			  $paso='background-color:#9C0';
			  }
			else{
				$paso="";
				}  
		  
		  ?>
      
    </div>
      <table width="95" border="0">
        <tr>
          <td width="89"><font size="-2">
		  <div style="height:125px; width:100px; border-style: solid; border-color:#000;border-radius: 20px 0 20px 0px; <?php echo $paso; ?>" align="center">
          
          <div style="width:50px; float:left; border-right:1px solid; border-bottom:1px solid">
          <?php echo $asi["CORRELATIV"]; ?>
          </div>
          <div style="width:44px; float:left;border-bottom:1px solid">
         <?php echo  $asi["UNIDADVALO"]; ?>
          </div>
          <div style="height:84px">
		  <?php echo "<br>".$asi["CODIGO"]."<BR>";  ?>
          <?php echo $asi["NOMBRE"]; ?>
           </div> 
            <div >
            _________________
            <!--<hr />  -->
			<?php echo $asi["pre"];?>
          </div>
          </div>
		
          </font></td>
        </tr>
    </table>
	
	<?php }//fin del while?>
	<?php if($consulta->num_rows==4){?>
     <table width="84" border="0">
        <tr>
          <td width="78"><font size="-1">
		  <div style="height:130px; width:100px">
          <?php echo $asi["NOMBRE"]; ?>
          </div>
		  
          </font></td>
        </tr>
    </table>
   <?php  }?>
	</td>
    
   
    <?php $con->next_result();/*LIBERO CONSULTA*/}//fin del for ?>
  </tr>
   
</table>
    </div>
      
      </div>
    </div>
  </div>
  <hr />
  <div align="center">
  
   <button type="submit" class="btn btn-success btn-large" onclick="ActualizarAlumno();">Actualizar <span class="icon-ok-sign icon-white"></span></button>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
  </script>
  </form>
<!-- InstanceEndEditable --></div>
<footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
<!-- InstanceEnd --></html>
