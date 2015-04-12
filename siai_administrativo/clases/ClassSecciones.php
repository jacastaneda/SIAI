<?php 
require_once("ClassConexion2.php");
class ClassSecciones extends Conexion
{
private $CICLO;
private $CODIGO_ASI;
private $SECCION;
private $CATEDRATIC;
private $AULA;
private $CUPOS;
private $RESERVACIO;
private $UTILIZADOS;
private $DISPONIBLE;


public function setCICLO($CICLO)
	{
		$this->CICLO=$CICLO;
	}

public function setCODIGO_ASI($CODIGO_ASI)
	{
		$this->CODIGO_ASI=$CODIGO_ASI;
	}
	
public function setSECCION($SECCION)
	{
		$this->SECCION=$SECCION;
	}
	
public function setCATEDRATIC($CATEDRATIC)
	{
		$this->CATEDRATIC=$CATEDRATIC;
	}
	
public function setAULA($AULA)
	{
		$this->AULA=$AULA;
	}
	
public function setCUPOS($CUPOS)
	{
		$this->CUPOS=$CUPOS;
	}
	
public function setRESERVACIO($RESERVACIO)
	{
		$this->RESERVACIO=$RESERVACIO;
	}
	
public function setUTILIZADOS($UTILIZADOS)
	{
		$this->UTILIZADOS=$UTILIZADOS;
	}
	
public function setDISPONIBLE($DISPONIBLE)
	{
		$this->DISPONIBLE=$DISPONIBLE;
	}
	
	
	
	public function InsertarSeccion()
		{
		$sql="insert into secciones(CICLO,
								    CODIGO_ASI,
									SECCION,
									AULA,
									CUPOS,
									RESERVACIO,
									UTILIZADOS,
									DISPONIBLE) 
							values('".$this->CICLO."',
								    '".$this->CODIGO_ASI."',
									'".$this->SECCION."',
									'".$this->AULA."',
									'".$this->CUPOS."',
									'0',
									'0',
									'".$this->CUPOS."')";
									
									
		$this->DUI($sql);							
		
		
		}								
	
}