<?php
include_once("../clases/ClassConexion.php");
include_once("../clases/ClassAlumnoExpediente.php");
include_once("../xajax/xajax/xajax_core/xajax.inc.php"); //clase para xajax
$xajax=new xajax(); //construccion del objeto Xajax
$xajax->configure( 'defaultMode', 'synchronous' );

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



/******************************************************************************************************
metodos para utilizar con jaxax metodo que me devuelve todos los deptos segun region (Occidental,central,Oriental,Paracentral)
*******************************************************************************************************/
 function xajaxTituloBachiller($check,$campo){
	
	$respuesta=  new xajaxResponse();
	
	if($check)
	{
				if($campo=="certificacion"){
					$respuesta->assign("FEC_CER","value",date("Y-m-d"));
					}
				if($campo=="fotos"){
					$respuesta->assign("FEC_FOT","value",date("Y-m-d"));
					
					}	
		
			
				if($campo=="FEC_PDA"){
						$respuesta->assign("FEC_PDA","value",date("Y-m-d"));
						}	
						
				
			
				if($campo=="FEC_BAC"){
							$respuesta->assign("FEC_BAC","value",date("Y-m-d"));
						}
	}
	else
		{
			if($campo=="certificacion"){
					$respuesta->assign("FEC_CER","value","");
					}
				if($campo=="fotos"){
					$respuesta->assign("FEC_FOT","value","");
					
					}	
		
			
				if($campo=="FEC_PDA"){
						$respuesta->assign("FEC_PDA","value","");
						}	
						
				
			
				if($campo=="FEC_BAC"){
							$respuesta->assign("FEC_BAC","value","");
						}
		
		}
	return $respuesta;
	}
	
	

/******************************************************************************************************
			METODO PARA ACTUALIZAR INFORMACION DEL ALUMNO
*******************************************************************************************************/
 function xajaxActualizarExpediente($form){
	
	$respuesta=  new xajaxResponse();
	$expediente=new ClassAlumnoExpediente();
	
	$expediente->setCARNET($form["CARNET"]);
	$expediente->setSEXO($form["SEXO"]);
	$expediente->setCODCARRERA($form["CODCARRERA"]);
	$expediente->setESTADOCIVI($form["ESTADOCIVI"]);
	$expediente->setNOMBRES($form["NOMBRES"]);
	$expediente->setAPELLIDO1($form["APELLIDO1"]);
	$expediente->setAPELLIDO2($form["APELLIDO2"]);
	$expediente->setAPELLCASAD($form["APELLCASAD"]);
	
	
	$expediente->setDIRECCION($form["DIRECCION"]);
	$expediente->setTELEFONO($form["TELEFONO"]);
	$expediente->setNACIONALID($form["NACIONALID"]);
	$expediente->setDEPTODIREC($form["DEPTODIREC"]);
	$expediente->setMUNIDIRECC($form["MUNIDIRECC"]);
	$expediente->setDEPTONACIM($form["DEPTONACIM"]);
	$expediente->setMUNINACIMI($form["MUNINACIMI"]);
	
	//esta validacion sirve para que no se vaya vacia la fecha de nacimeinto cuando no seleccione nada
	
	$expediente->setCARNET($_GET["carnet"]);
	$Alumno=$expediente->GetExpedienteAlumno();
	if($form["FECHANACIM"]==""){
		$f_nacimiento=$Alumno[0]["FECHANACIM"];
		}
	else{
		$f_nacimiento=$form["FECHANACIM"];
		}
	$expediente->setFECHANACIM($f_nacimiento);
	
	
	

	//envio de 0 o 1 para el check partida
				if($form["PARTIDAORI"]){
					$PARTIDAORI1=1;
					}
				else 
					{
					$PARTIDAORI1=0;
					}
	
	//envio de 0 o 1 para el check TITULOBACH
				if($form["TITULOBACH"]){
					$TITULOBACH1=1;
					}
				else 
					{
					$TITULOBACH1=0;
					}
	
	//envio de 0 o 1 para el check partida
				if($form["CERTIFICAC"]){
					$CERTIFICAC1=1;
					}
				else 
					{
					$CERTIFICAC1=0;
					}
	
	//envio de 0 o 1 para el check partida
				if($form["FOTOS"]){
					$FOTOS1=1;
					}
				else 
					{
					$FOTOS1=0;
					}
	//envio de 0 o 1 para el check partida
				if($form["DECLARACIO"]){
					$DECLARACIO1=1;
					}
				else 
					{
					$DECLARACIO1=0;
					}													
	
	$expediente->setINSTITUCIO($form["INSTITUCIO"]);
	$expediente->setEXPEDIENTE($form["EXPEDIENTE"]);
	$expediente->setTITULO($form["TITULO"]);
	$expediente->setTITULOBACH($TITULOBACH1);
	$expediente->setFEC_BAC($form["FEC_BAC"]);
	$expediente->setPARTIDAORI($PARTIDAORI1);
	$expediente->setFEC_PDA($form["FEC_PDA"]);
	$expediente->setCERTIFICAC($CERTIFICAC1);
	$expediente->setFEC_CER($form["FEC_CER"]);
	$expediente->setFOTOS($FOTOS1);
	$expediente->setFEC_FOT($form["FEC_FOT"]);
	$expediente->setDECLARACIO($DECLARACIO1);
	$expediente->setFECHA_SOLI($form["FECHA_SOLI"]);
	$expediente->setLUGARTRABA($form["LUGARTRABA"]);
	$expediente->setDIRTRABAJO($form["TELTRABAJO"]);
	$expediente->setTELTRABAJO($form["TELTRABAJO"]);
	
	
	
	$expediente->setCICLOINGRE($form["CICLOINGRE"]);
	$expediente->setCODIGO_PLA($form["CODIGO_PLA"]);
	$expediente->setTIPOINGRES($form["TIPOINGRES"]);
	$expediente->setESTATUS($form["ESTATUS"]);
	$expediente->setOBSERVACIO($form["OBSERVACIO"]);
	
	//opcion para actualizar
	
	$expediente->ActualizarExpedienteAlumno();
	
	
	$respuesta->alert("DATOS GUARDADOS ".$form["TIPOINGRES"]);
	return $respuesta;
	}	
	
	/******************************************************************************************************
Registros de metodos de xajax
*******************************************************************************************************/


//Registro de metodos
	$xajax->registerFunction("xajaxTituloBachiller");
	$xajax->registerFunction("xajaxActualizarExpediente");
	$xajax->registerFunction("getEmpresasxajax");
	
	//procesando todas la variables de xajax
	$xajax->processRequest();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $xajax->printJavascript("../xajax/xajax/");  ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Actualizacion Datos</title>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript">
</script>

<!--Inicio de instancia para JQUERY DATA picker-->
<link rel="stylesheet" href="../js/jQueryUI/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../JS/jQueryUI/development-bundle/jquery-1.4.4.js"></script>
	<script src="../JS/jQueryUI/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../JS/jQueryUI/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../JS/jQueryUI/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="../JS/jQueryUI/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
     <script src="../JS/jQueryUI/development-bundle/ui/jquery-ui-1.8.10.custom.js"></script>
    
    

    
	<!--<link rel="stylesheet" href="../js/jQueryUI/development-bundle/demos/demos.css"> -->

<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

<!-- scrip para CALENDARIO DE JQUERY-->

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

</head>

<body>
<form action="" id="Alumno" name="Alumno" method="post">
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">
      <h3>Información General</h3>
    </li>
    <li class="TabbedPanelsTab" tabindex="0">
      <h3>Documentación</h3>
    </li>
    <li class="TabbedPanelsTab" tabindex="0">
      <h3>Universidad</h3>
    </li>
    <li class="TabbedPanelsTab" tabindex="0">
      <h3>Pensum</h3>
    </li>
</ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table width="725" border="0">
        <tr>
          <td width="117">Carnet</td>
          <td width="206"><input name="CARNET1" type="text" disabled="disabled" id="CARNET1" value="<?php  echo $Alumno[0]["CARNET"]; ?>"/>
            <input type="hidden" name="CARNET" id="CARNET" value="<?php  echo $Alumno[0]["CARNET"]; ?>"/></td>
          <td width="200" ><div align="right">Sexo</div></td>
          <td width="184"><label for="textfield2"></label>
            <input type="text" name="SEXO" id="SEXO" value="<?php  echo $Alumno[0]["SEXO"]; ?>" /></td>
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
          <td><label for="textfield3"></label>
            <input type="text" name="ESTADOCIVI" id="ESTADOCIVI"  value="<?php  echo $Alumno[0]["ESTADOCIVI"]; ?>"/></td>
        </tr>
        <tr>
          <td>Cod Inter</td>
          <td><label for="textfield4"></label>
            <input name="textfield4" type="text" disabled="disabled" id="textfield4" /></td>
          <td><div align="right">Edad</div></td>
          <td><label for="textfield5"></label>
            <input name="EDAD" type="text" disabled="disabled" id="EDAD" value="<?php  echo $Alumno[0]["EDAD"]; ?>"/></td>
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
          <td><input name="NOMBRES" type="text" id="NOMBRES"  value="<?php echo $Alumno[0]["NOMBRES"]; ?>"/></td>
          <td><label for="textfield7"></label>
            <input type="text" name="APELLIDO1" id="APELLIDO1"  value="<?php echo $Alumno[0]["APELLIDO1"]; ?>" /></td>
          <td><label for="textfield8"></label>
            <input type="text" name="APELLIDO2" id="APELLIDO2"  value="<?php echo $Alumno[0]["APELLIDO2"]; ?>"/></td>
          <td><label for="textfield9"></label>
            <input type="text" name="APELLCASAD" id="APELLCASAD"   value="<?php echo $Alumno[0]["APELLCASAD"]; ?>"/></td>
        </tr>
        <tr>
          <td colspan="4">Direccion
            <label for="DIRECCION"></label>
            <textarea name="DIRECCION" cols="70" id="DIRECCION" ><?php echo $Alumno[0]["DIRECCION"]; ?></textarea></td>
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
          <td><label for="textfield12"></label>
            <input type="text" name="MUNIDIRECC" id="MUNIDIRECC" value ="<?php echo $Alumno[0]["MUNIDIRECC"];?>" /></td>
        </tr>
      </table>
      <hr />
      <table width="819" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="174">Departamento Nacimiento</td>
          <td width="270">Municipio Nacimiento</td>
          <td width="365">Feha Nacimiento: <?php echo $Alumno[0]["FECHANACIM"];?></td>
        </tr>
        <tr>
          <td><select name="DEPTONACIM" id="DEPTONACIM">
            <?php for($i=0;$i<count($Departamentos);$i++){?>
            <option value="<?php echo $Departamentos[$i]["CODIGO"] ?>"> <?php echo $Departamentos[$i]["NOMBRE"];?></option>
            <?php }?>
          </select></td>
          <td><label for="textfield13"></label>
            <input type="text" name="MUNINACIMI" id="MUNINACIMI"  value ="<?php echo $Alumno[0]["MUNINACIMI"];?>" /></td>
          <td><label for="textfield14"></label>
            Cambiar Fecha
            <input type="text" name="FECHANACIM" id="FECHANACIM" />
            <img src="images/calendar.jpg" width="16" height="16" /></td>
        </tr>
        <tr>
          <td>Correo Electronico</td>
          <td>NIT</td>
          <td>Foto</td>
        </tr>
        <tr>
          <td><label for="textfield15"></label>
            <input type="text" name="textfield15" id="textfield15" /></td>
          <td><label for="textfield16"></label>
            <input type="text" name="textfield16" id="textfield16" /></td>
          <td><input name="" type="file" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">Documentacion
      <table width="765" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="63">Instirucion</td>
          <td width="63"><label for="select"></label>
            <select name="INSTITUCIO" id="INSTITUCIO">
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
          <td width="629"><label for="EXPEDIENTE"></label>
            <input type="text" name="EXPEDIENTE" id="EXPEDIENTE" value="<?php echo $Alumno[0]["EXPEDIENTE"]; ?>"/></td>
        </tr>
        <tr>
          <td>Titulo</td>
          <td><label for="textfield18"></label>
            <?php 
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
  <table width="754" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="78"><div align="right">
        <?php 
	  if($Alumno[0]["TITULOBACH"]==1){
		  $chek='checked="checked"';
		  
		  }
		 else{$chek='';} 
	  ?>
        <input name="TITULOBACH" type="checkbox" id="TITULOBACH" <?php echo $chek; ?> onclick="xajax_xajaxTituloBachiller(this.checked,'FEC_BAC')" />
      </div>
        <label for="TITULOBACH"></label></td>
      <td width="156">Título de bachicller</td>
      <td width="153"><label for="textfield19"></label>
        <input type="text" name="FEC_BAC" id="FEC_BAC" value="<?php echo $Alumno[0]["FEC_BAC"]; ?>"/></td>
      <td width="61"><div align="right">
        <?php 
	  if($Alumno[0]["PARTIDAORI"]==1){
		  $chek='checked="checked"';
		  
		  }
		 else{$chek='';} 
	  ?>
        <input type="checkbox" name="PARTIDAORI" id="PARTIDAORI"  <?php echo $chek; ?>  onclick="xajax_xajaxTituloBachiller(this.checked,'FEC_PDA')" />
      </div>
        <label for="checkbox2"></label></td>
      <td width="113"><div align="right">Partida original</div></td>
      <td width="174"><label for="textfield20"></label>
        <input type="text" name="FEC_PDA" id="FEC_PDA"  value="<?php echo $Alumno[0]["FEC_PDA"]; ?>"/></td>
    </tr>
    <tr>
      <td><div align="right">
        <?php  if($Alumno[0]["CERTIFICAC"]==1){
		  $chek='checked="checked"';
		  
		  }
		  else{$chek='';} 
		  ?>
        <input type="checkbox" name="CERTIFICAC" id="CERTIFICAC"  <?php echo $chek; ?>  onclick="xajax_xajaxTituloBachiller(this.checked,'certificacion')"/>
      </div>
        <label for="checkbox3"></label></td>
      <td>Certificación Notas</td>
      <td><input type="text" name="FEC_CER" id="FEC_CER"  value="<?php echo $Alumno[0]["FEC_CER"]; ?>"/></td>
      <td><div align="right">
        <?php 
	  if($Alumno[0]["FOTOS"]==1){
		  $chek='checked="checked"';
		  
		  }
		 else{$chek='';} 
	  ?>
        <input type="checkbox" name="FOTOS" id="FOTOS" <?php echo $chek; ?>  onclick="xajax_xajaxTituloBachiller(this.checked,'fotos')" />
      </div></td>
      <td><div align="right">Fotos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td><input type="text" name="FEC_FOT" id="FEC_FOT" value="<?php echo $Alumno[0]["FEC_FOT"]; ?>"/></td>
    </tr>
  </table>
  <table width="743" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="226"><div align="right">
        <?php 	if($Alumno[0]["DECLARACIO"]==1){
		  $chek='checked="checked"';
		  
		  }
		 else{$chek='';} ?>
        <input type="checkbox" name="DECLARACIO" id="DECLARACIO" <?php echo $chek;?> />
      </div>
        <label for="DECLARACIO"></label></td>
      <td width="227">Declaración Jurada</td>
      <td width="280">&nbsp;</td>
    </tr>
  </table>
  <hr />
  <table width="716">
    <tr>
      <td width="128">Fecha Solicitud</td>
      <td width="576"><label for="textfield23"></label>
        <input name="FECHA_SOLI" type="text" id="FECHA_SOLI" value="<?php echo $Alumno[0]["FECHA_SOLI"]; ?>"/></td>
    </tr>
    <tr>
      <td>Lugar de trabajo</td>
      <td><label for="textfield24"></label>
        <input name="LUGARTRABA" type="text" id="LUGARTRABA" size="40" value="<?php echo $Alumno[0]["LUGARTRABA"]; ?>"/></td>
    </tr>
    <tr>
      <td>Direccion Trabajo</td>
      <td><label for="textfield25"></label>
        <input name="LUGARTRABA" type="text" id="LUGARTRABA" size="90" value="<?php echo $Alumno[0]["DIRTRABAJO"]; ?>" /></td>
    </tr>
    <tr>
      <td>Teléfono</td>
      <td><label for="textfield26"></label>
        <input type="text" name="TELTRABAJO" id="TELTRABAJO"  value="<?php echo $Alumno[0]["TELTRABAJO"]; ?>"/>
        Extension
        <label for="textfield27"></label>
        <input type="text" name="EXTENSION" id="EXTENSION" value="<?php echo $Alumno[0]["TELTRABAJO"]; ?>" /></td>
    </tr>
  </table>
    </div>
    <div class="TabbedPanelsContent">
      <table width="640" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="100">Ciclo Ingreso</td>
          <td width="144"><label for="CICLOINGRE"></label>
            <input name="CICLOINGRE" type="text" id="CICLOINGRE"  value="<?php echo $Alumno[0]["CICLOINGRE"]; ?>" readonly="readonly" /></td>
          <td width="155">Plan Estudio</td>
          <td width="228"><label for="textfield33"></label>
            <input type="text" name="CODIGO_PLA" id="CODIGO_PLA"  value="<?php echo $Alumno[0]["CODIGO_PLA"]; ?>"/></td>
        </tr>
        <tr>
          <td>Tipo Ingreso</td>
          <td><label for="select4"></label>
            <select name="TIPOINGRES" id="TIPOINGRES">
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
          <td><label for="select5"></label>
            <?php $h=$expediente->CatalogoBusquedaEstatus($Estatus,$Alumno[0]["ESTATUS"]);?>
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
          <td><label for="textfield34"></label>
            <input name="CICLOGRA" type="text" disabled="disabled" id="CICLOGRA"  value="<?php echo $Alumno[0]["CICLOGRA"]; ?>"/></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <hr />
      <table width="655" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="136"><div align="right">Cum General</div></td>
          <td width="164"><label for="textfield35"></label>
            <input name="textfield35" type="text" disabled="disabled" id="textfield35" value="<?php echo $Alumno[0]["CUMGENERAL"]; ?>"/></td>
          <td width="144"><div align="right">CUM Relativo</div></td>
          <td width="198"><label for="textfield36"></label>
            <input name="textfield36" type="text" disabled="disabled" id="textfield36"  value="<?php echo $Alumno[0]["CUMRELATIV"]; ?>"/></td>
        </tr>
        <tr>
          <td>Observaciones</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><label for="OBSERVACIO"></label>
            <textarea name="OBSERVACIO" cols="100" rows="4" id="OBSERVACIO"><?php echo $Alumno[0]["OBSERVACIO"]; ?></textarea></td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">
    
     <?php include("../clases/DB_model.php");
	$cnx= new  DBmodel();
	$con=$cnx->Open_conexion();?>
    
    <div id="dialog">
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
		  <div style="height:110px; width:95px; border-style: solid; border-color:#000;border-radius: 20px 0 20px 0px; <?php echo $paso; ?>" align="center">
          
          <div style="width:50px; float:left; border-right:1px solid; border-bottom:1px solid">
          <?php echo $asi["CORRELATIV"]; ?>
          </div>
          <div style="width:44px; float:left;border-bottom:1px solid">
         <?php echo  $asi["UNIDADVALO"]; ?>
          </div>
          <div style="height:84px">
		  <?php echo "<br><br>".$asi["CODIGO"]."<BR><BR>";  ?>
          <?php echo $asi["NOMBRE"]; ?>
           </div> 
            <div >
            <hr />
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
		  <div style="height:115px; width:95px">
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
    <button id="opener">Ver Pensum</button>
    </div>
</div>
</div>
<div align="center">
  <input type="button" value="Actualizar" onclick="xajax_xajaxActualizarExpediente(xajax.getFormValues('Alumno'));"/>
</div>
</form>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html>
