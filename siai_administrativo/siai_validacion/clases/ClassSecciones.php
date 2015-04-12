<?php
/*
* ClassSecciones.php
* version 1.0
*
*/
class Secciones{
     private $ciclo;
     private $codigoasi;
     private $seccion;
     private $catedratic;
     private $aula;
     private $cupos;
     private $reservacio;
     private $utilizados;
     private $disponible;
     //Objeto gestionador de base de datos
     private $conexionSecciones;

     public function __construct()
     {
          $atributos= array( "CICLO","CODIGO_ASI","SECCION","CATEDRATIC","AULA","CUPOS","RESERVACIO","UTILIZADOS","DISPONIBLE" );
          $this->conexionSecciones = new MySQL();
          $this->conexionSecciones->setNombreTabla("secciones");
          $this->conexionSecciones->setNombreAtributos($atributos);
     }

     public function setSeccionesPorParametros($ciclo, $seccion,$asignatura)
     {
		 $query="SELECT * FROM secciones WHERE CICLO='$ciclo' AND CODIGO_ASI='$asignatura' AND SECCION='$seccion'";
          if($registro=$this->conexionSecciones->consulta($query))
          {
               $this->ciclo=$registro[0]['CICLO'];
               $this->codigoasi=$registro[0]['CODIGO_ASI'];
               $this->seccion=$registro[0]['SECCION'];
               $this->catedratic=$registro[0]['CATEDRATIC'];
               $this->aula=$registro[0]['AULA'];
               $this->cupos=$registro[0]['CUPOS'];
               $this->reservacio=$registro[0]['RESERVACIO'];
               $this->utilizados=$registro[0]['UTILIZADOS'];
               $this->disponible=$registro[0]['DISPONIBLE'];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setCiclo($CICLO)
     {
          $this->ciclo=$CICLO;
     }
     public function setCodigoAsi($CODIGO_ASI)
     {
          $this->codigoasi=$CODIGO_ASI;
     }
     public function setSeccion($SECCION)
     {
          $this->seccion=$SECCION;
     }
     public function setCatedratic($CATEDRATIC)
     {
          $this->catedratic=$CATEDRATIC;
     }
     public function setAula($AULA)
     {
          $this->aula=$AULA;
     }
     public function setCupos($CUPOS)
     {
          $this->cupos=$CUPOS;
     }
     public function setReservacio($RESERVACIO)
     {
          $this->reservacio=$RESERVACIO;
     }
     public function setUtilizados($UTILIZADOS)
     {
          $this->utilizados=$UTILIZADOS;
     }
     public function setDisponible($DISPONIBLE)
     {
          $this->disponible=$DISPONIBLE;
     }

     //metodos Obtener(get)
     public function getCiclo()
     {
          return $this->ciclo;
     }
     public function getCodigoAsi()
     {
          return $this->codigoasi;
     }
     public function getSeccion()
     {
          return $this->seccion;
     }
     public function getCatedratic()
     {
          return $this->catedratic;
     }
     public function getAula()
     {
          return $this->aula;
     }
     public function getCupos()
     {
          return $this->cupos;
     }
     public function getReservacio()
     {
          return $this->reservacio;
     }
     public function getUtilizados()
     {
          return $this->utilizados;
     }
     public function getDisponible()
     {
          return $this->disponible;
     }

     public function updateSecciones()
     {
		 $this->conexionSecciones->conectarse();
          $consulta="UPDATE secciones SET RESERVACIO = '".$this->reservacio."', UTILIZADOS = '".$this->utilizados."', DISPONIBLE = '".$this->disponible."' WHERE CICLO = '".$this->ciclo."' AND CODIGO_ASI = '".$this->codigoasi."' AND SECCION = '".$this->seccion."' AND CATEDRATIC = '".$this->catedratic."';";
          return $this->conexionSecciones->ejecutarQuery($consulta);
		  $this->conexionSecciones->desconectarse();
     }
}