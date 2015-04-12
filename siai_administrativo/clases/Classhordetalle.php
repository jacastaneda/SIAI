<?php 
require_once("ClassConexion2.php");
class Classhordetalle extends Conexion
{

private $CICLO;
private $SECCION;
private $CODIGO;
private $CODHOR;


public function setCICLO($CICLO)
	{
		$this->CICLO=$CICLO;
	}
	
public function setSECCION($SECCION)
	{
		$this->SECCION=$SECCION;
	}
	
public function setCODIGO($CODIGO)
	{
		$this->CODIGO=$CODIGO;
	}
	
public function setCODHOR($CODHOR)
	{
		$this->CODHOR=$CODHOR;
	}
	
	

	public function insertarHoraDetalle()
	{
		$sql="insert into hordetalle(CICLO,
									  SECCION,
									  CODIGO,
									  CODHOR)
								values('".$this->CICLO."',
									    '".$this->SECCION."',
										'".$this->CODIGO."',
										'".$this->CODHOR."')";
										
		return $this->DUI($sql);									
	}
	
				

}