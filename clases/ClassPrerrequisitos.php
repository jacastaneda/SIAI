<?php
/*
* ClassPrerequisitos.php
* version 1.0
*
*/
class Prerequisitos{
     private $plan;
     private $asignatura;
     private $prerequisito;
     //Objeto gestionador de base de datos
     private $conexionPrerequisitos;

     public function __construct()
     {
          $atributos= array( "ASIGNATURA","PREREQUISITO" );
          $this->conexionPrerequisitos = new MySQL();
          $this->conexionPrerequisitos->setNombreTabla("prerequisitos");
          $this->conexionPrerequisitos->setNombreAtributos($atributos);
          $this->conexionPrerequisitos->setNombreLlavePrimaria("PLAN");
     }

     public function setPrerequisitosPorLlave($llave)
     {
          if($registro=$this->conexionPrerequisitos->consultarRegistro($llave))
          {
               $this->plan=$llave;
               $this->asignatura=$registro[0];
               $this->prerequisito=$registro[1];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setPlan($PLAN)
     {
          $this->plan=$PLAN;
     }
     public function setAsignatura($ASIGNATURA)
     {
          $this->asignatura=$ASIGNATURA;
     }
     public function setPrerequisito($PREREQUISITO)
     {
          $this->prerequisito=$PREREQUISITO;
     }

     //metodos Obtener(get)
     public function getPlan()
     {
          return $this->plan;
     }
     public function getAsignatura()
     {
          return $this->asignatura;
     }
     public function getPrerequisito()
     {
          return $this->prerequisito;
     }

     //metodo generador de listado
     public function getListadoPrerequisitoss()
     {
          return $this->conexionPrerequisitos->listaLlaves("ASIGNATURA", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarPrerequisitos($valor)
     {
          return $this->conexionPrerequisitos->buscar($valor,"ASIGNATURA", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertPrerequisitos()
     {
           $atributos=array( $this->asignatura , $this->prerequisito );
          //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->plan , $this->asignatura , $this->prerequisito );

          return $this->conexionPrerequisitos->insertarRegistro($atributos);
     }
     public function updatePrerequisitos()
     {
          $atributos=array( $this->asignatura , $this->prerequisito );
          return $this->conexionPrerequisitos->actualizarRegistro($this->plan,$atributos);
     }
}