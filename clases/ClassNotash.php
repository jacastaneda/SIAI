<?php
/*
* ClassNotash.php
* version 1.0
*
*/
class Notash{
     private $carnet;
     private $codigoasi;
     private $promedio;
     //Objeto gestionador de base de datos
     private $conexionNotash;

     public function __construct()
     {
          $atributos= array( "CODIGO_ASI","PROMEDIO");
          $this->conexionNotash = new MySQL();
          $this->conexionNotash->setNombreTabla("notash");
          $this->conexionNotash->setNombreAtributos($atributos);
          $this->conexionNotash->setNombreLlavePrimaria("CARNET");
     }
	 
     //metodo generador de listado
     public function getListadoMateriasAprobadas($carnet)
     {
          return $this->conexionNotash->listaPorCondicion("CODIGO_ASI","PROMEDIO>=6 && CARNET='".$carnet."'","CODIGO_ASI", "ASC");
     }
	 
	 public function getNumeroInscripciones($carnet, $asignatura)
	 {
		$consulta="SELECT count( * ) FROM notash WHERE CARNET = '".$carnet."' AND CODIGO_ASI = '".$asignatura."'";
		 $resultado=$this->conexionNotash->consulta($consulta);
		 return $resultado[0][0];
		 //consulta($query)
	 }
	 public function getTipoInscripciones($carnet, $asignatura)
	 {
		$consulta="SELECT TIPO_INS FROM notash WHERE CARNET = '".$carnet."' AND CODIGO_ASI = '".$asignatura."' AND PROMEDIO>=6";
		 $resultado=$this->conexionNotash->consulta($consulta);
		 return $resultado[0][0];
		 //consulta($query)
	 }
 
}