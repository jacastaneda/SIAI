<?php
/*
* ClassAsignatura.php
* version 1.1
*
*/
class Asignatura{
     private $codigo;
     private $nombre;
     private $unidadvalo;
     private $codigoarea;
     private $arancel;
     private $facultad;
     private $ciclo;
     private $relacion;
     private $depto;
     private $tg;
     //Objeto gestionador de base de datos
     private $conexionAsignatura;

     public function __construct()
     {
          $atributos= array( "NOMBRE","UNIDADVALO","CODIGOAREA","ARANCEL","FACULTAD","CICLO","RELACION","DEPTO","TG" );
          $this->conexionAsignatura = new MySQL();
          $this->conexionAsignatura->setNombreTabla("asignatura");
          $this->conexionAsignatura->setNombreAtributos($atributos);
          $this->conexionAsignatura->setNombreLlavePrimaria("CODIGO");
     }

     public function setAsignaturaPorLlave($llave)
     {
          if($registro=$this->conexionAsignatura->consultarRegistro($llave))
          {
               $this->codigo=$llave;
               $this->nombre=$registro[0];
               $this->unidadvalo=$registro[1];
               $this->codigoarea=$registro[2];
               $this->arancel=$registro[3];
               $this->facultad=$registro[4];
               $this->ciclo=$registro[5];
               $this->relacion=$registro[6];
               $this->depto=$registro[7];
               $this->tg=$registro[8];
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
     public function setUnidadvalo($UNIDADVALO)
     {
          $this->unidadvalo=$UNIDADVALO;
     }
     public function setCodigoarea($CODIGOAREA)
     {
          $this->codigoarea=$CODIGOAREA;
     }
     public function setArancel($ARANCEL)
     {
          $this->arancel=$ARANCEL;
     }
     public function setFacultad($FACULTAD)
     {
          $this->facultad=$FACULTAD;
     }
     public function setCiclo($CICLO)
     {
          $this->ciclo=$CICLO;
     }
     public function setRelacion($RELACION)
     {
          $this->relacion=$RELACION;
     }
     public function setDepto($DEPTO)
     {
          $this->depto=$DEPTO;
     }
     public function setTg($TG)
     {
          $this->tg=$TG;
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
     public function getUnidadvalo()
     {
          return $this->unidadvalo;
     }
     public function getCodigoarea()
     {
          return $this->codigoarea;
     }
     public function getArancel()
     {
          return $this->arancel;
     }
     public function getFacultad()
     {
          return $this->facultad;
     }
     public function getCiclo()
     {
          return $this->ciclo;
     }
     public function getRelacion()
     {
          return $this->relacion;
     }
     public function getDepto()
     {
          return $this->depto;
     }
     public function getTg()
     {
          return $this->tg;
     }

     //metodo generador de listado
     public function getListadoAsignaturas()
     {
          return $this->conexionAsignatura->listaLlaves("NOMBRE", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarAsignatura($valor)
     {
          return $this->conexionAsignatura->buscar($valor,"NOMBRE", "ASC");
     }
	 //devuelve el prerequisito de la materia ingresada segun el plan ingresado
	 public function getPrerequisito($asignatura, $plan)
	 {
		 $query="SELECT PREREQUISITO FROM prerequisitos WHERE PLAN='$plan' AND ASIGNATURA='$asignatura'";
		 if($registro=$this->conexionAsignatura->consulta($query))
		 {
			 return $registro[0]['PREREQUISITO'];
		 }
		 else
		 {
			 return false;
		 }
	 }

     //metodos relacionados a la base de datos
     public function insertAsignatura()
     {
          //$atributos=array( $this->nombre , $this->unidadvalo , $this->codigoarea , $this->arancel , $this->facultad , $this->ciclo , $this->relacion , $this->depto , $this->tg );
          //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          $atributos=array( $this->codigo , $this->nombre , $this->unidadvalo , $this->codigoarea , $this->arancel , $this->facultad , $this->ciclo , $this->relacion , $this->depto , $this->tg );

          return $this->conexionAsignatura->insertarRegistro($atributos);
     }
     public function updateAsignatura()
     {
          $atributos=array( $this->nombre , $this->unidadvalo , $this->codigoarea , $this->arancel , $this->facultad , $this->ciclo , $this->relacion , $this->depto , $this->tg );
          return $this->conexionAsignatura->actualizarRegistro($this->codigo,$atributos);
     }
}