<?php
/*
* ClassHorarios.php
* version 1.0
*
*/
class Horarios{
     private $codigo;
     private $nombre;
     private $aula;
     //Objeto gestionador de base de datos
     private $conexionHorarios;

     public function __construct()
     {
          $atributos= array( "NOMBRE","AULA" );
          $this->conexionHorarios = new MySQL();
          $this->conexionHorarios->setNombreTabla("horarios");
          $this->conexionHorarios->setNombreAtributos($atributos);
          $this->conexionHorarios->setNombreLlavePrimaria("CODIGO");
     }

     public function setHorariosPorLlave($llave)
     {
          if($registro=$this->conexionHorarios->consultarRegistro($llave))
          {
               $this->codigo=$llave;
               $this->nombre=$registro[0];
               $this->aula=$registro[1];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setCodigo($CODIGO)
     {
          $this->codigo=$CODIGO;
     }
     public function setNombre($NOMBRE)
     {
          $this->nombre=$NOMBRE;
     }
     public function setAula($AULA)
     {
          $this->aula=$AULA;
     }

     //metodos Obtener(get)
     public function getCodigo()
     {
          return $this->codigo;
     }
     public function getNombre()
     {
          return $this->nombre;
     }
     public function getAula()
     {
          return $this->aula;
     }	
	
	  //metodo generador de listado
     public function getListadoHorarioss()
     {
          return $this->conexionHorarios->listaLlaves("NOMBRE", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarHorarios($valor)
     {
          return $this->conexionHorarios->buscar($valor,"NOMBRE", "ASC");
     }
	 
	 //metodo generador de listado
     public function getHorarioActualPorPlan($plan, $ciclo)
     {
		 $query="SELECT a.CODHOR, b.ASIGNATURA, a.SECCION FROM hordetalle AS a LEFT JOIN planes AS b ON a.CODIGO = b.ASIGNATURA
WHERE b.CODIGO_PLA = '$plan'
AND a.CICLO = '$ciclo' ORDER BY b.ASIGNATURA, a.SECCION ASC";
	//echo $query;
         return $this->conexionHorarios->consulta($query);
     }

     //metodos relacionados a la base de datos
     public function insertHorarios()
     {
           $atributos=array( $this->nombre , $this->aula );
          //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->codigo , $this->nombre , $this->aula );
          return $this->conexionHorarios->insertarRegistro($atributos);
     }
     public function updateHorarios()
     {
          $atributos=array( $this->nombre , $this->aula );
          return $this->conexionHorarios->actualizarRegistro($this->codigo,$atributos);
     }
}