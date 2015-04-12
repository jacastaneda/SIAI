<?php 

	include_once("../../clases/ClassAlumnoExpediente.php");//clase incluida
	include_once("../../clases/ClassConexion.php");//clase a a conexion de base de datos
	$expediente= new ClassAlumnoExpediente();
	
	
	
	/****************************************************************************
			Actualizacion de de Expediente 
	*****************************************************************************/


	$expediente->setCARNET($_REQUEST["CARNET"]);
	$expediente->setSEXO($_REQUEST["SEXO"]);
	$expediente->setCODCARRERA($_REQUEST["CODCARRERA"]);
	$expediente->setESTADOCIVI($_REQUEST["ESTADOCIVI"]);
	$expediente->setNOMBRES($_REQUEST["NOMBRES"]);
	$expediente->setAPELLIDO1($_REQUEST["APELLIDO1"]);
	$expediente->setAPELLIDO2($_REQUEST["APELLIDO2"]);
	$expediente->setAPELLCASAD($_REQUEST["APELLCASAD"]);
	
	
	$expediente->setDIRECCION($_REQUEST["DIRECCION"]);
	$expediente->setTELEFONO($_REQUEST["TELEFONO"]);
	$expediente->setNACIONALID($_REQUEST["NACIONALID"]);
	$expediente->setDEPTODIREC($_REQUEST["DEPTODIREC"]);
	$expediente->setMUNIDIRECC($_REQUEST["MUNIDIRECC"]);
	$expediente->setDEPTONACIM($_REQUEST["DEPTONACIM"]);
	$expediente->setMUNINACIMI($_REQUEST["MUNINACIMI"]);
	
	//esta validacion sirve para que no se vaya vacia la fecha de nacimeinto cuando no seleccione nada
	
	$expediente->setCARNET($_REQUEST["CARNET"]);
	$Alumno=$expediente->GetExpedienteAlumno();
	if($_REQUEST["FECHANACIM"]==""){
		$f_nacimiento=$Alumno[0]["FECHANACIM"];
		}
	else{
		$f_nacimiento=$_REQUEST["FECHANACIM"];
		}
	$expediente->setFECHANACIM($f_nacimiento);
	
	
	

	//envio de 0 o 1 para el check partida
				if($_REQUEST["PARTIDAORI"]){
					$PARTIDAORI1=1;
					}
				else 
					{
					$PARTIDAORI1=0;
					}
	
	//envio de 0 o 1 para el check TITULOBACH
				if($_REQUEST["TITULOBACH"]){
					$TITULOBACH1=1;
					}
				else 
					{
					$TITULOBACH1=0;
					}
	
	//envio de 0 o 1 para el check partida
				if($_REQUEST["CERTIFICAC"]){
					$CERTIFICAC1=1;
					}
				else 
					{
					$CERTIFICAC1=0;
					}
	
	//envio de 0 o 1 para el check partida
				if($_REQUEST["FOTOS"]){
					$FOTOS1=1;
					}
				else 
					{
					$FOTOS1=0;
					}
	//envio de 0 o 1 para el check partida
				if($_REQUEST["DECLARACIO"]){
					$DECLARACIO1=1;
					}
				else 
					{
					$DECLARACIO1=0;
					}													
	
	$expediente->setINSTITUCIO($_REQUEST["INSTITUCIO"]);
	$expediente->setEXPEDIENTE($_REQUEST["EXPEDIENTE"]);
	$expediente->setTITULO($_REQUEST["TITULO"]);
	$expediente->setTITULOBACH($TITULOBACH1);
	$expediente->setFEC_BAC($_REQUEST["FEC_BAC"]);
	$expediente->setPARTIDAORI($PARTIDAORI1);
	$expediente->setFEC_PDA($_REQUEST["FEC_PDA"]);
	$expediente->setCERTIFICAC($CERTIFICAC1);
	$expediente->setFEC_CER($_REQUEST["FEC_CER"]);
	$expediente->setFOTOS($FOTOS1);
	$expediente->setFEC_FOT($_REQUEST["FEC_FOT"]);
	$expediente->setDECLARACIO($DECLARACIO1);
	$expediente->setFECHA_SOLI($_REQUEST["FECHA_SOLI"]);
	$expediente->setLUGARTRABA($_REQUEST["LUGARTRABA"]);
	$expediente->setDIRTRABAJO($_REQUEST["TELTRABAJO"]);
	$expediente->setTELTRABAJO($_REQUEST["TELTRABAJO"]);
	
	
	
	$expediente->setCICLOINGRE($_REQUEST["CICLOINGRE"]);
	$expediente->setCODIGO_PLA($_REQUEST["CODIGO_PLA"]);
	$expediente->setTIPOINGRES($_REQUEST["TIPOINGRES"]);
	$expediente->setESTATUS($_REQUEST["ESTATUS"]);
	$expediente->setOBSERVACIO($_REQUEST["OBSERVACIO"]);
	
	//opcion para actualizar
	
	$expediente->ActualizarExpedienteAlumno();
	
?>