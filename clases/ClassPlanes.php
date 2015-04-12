<?php
/*
* ClassPlanes.php
* version 1.2
*
*/
class Planes{
     private $codigopla;
     private $asignatura;
     private $correlativ;
     private $ciclo;
     private $fechaplan;
     private $uv;
     private $acuerdo;
     //Objeto gestionador de base de datos
     private $conexionPlanes;

     public function __construct()
     {
          $atributos= array( "ASIGNATURA","CORRELATIV","CICLO","FECHAPLAN","UV","ACUERDO" );
          $this->conexionPlanes = new MySQL();
          $this->conexionPlanes->setNombreTabla("planes");
          $this->conexionPlanes->setNombreAtributos($atributos);
          $this->conexionPlanes->setNombreLlavePrimaria("CODIGO_PLA");
     }

     public function setPlanesPorLlaves($plan, $asignatura)
     {
		 $consulta="SELECT CODIGO_PLA, ASIGNATURA, CORRELATIV, CICLO, FECHAPLAN, UV, ACUERDO FROM PLANES WHERE CODIGO_PLA='$plan' AND ASIGNATURA='$asignatura'";
          if($registro=$this->conexionPlanes->consulta($consulta))
          {
               $this->codigopla=$registro[0][0];
               $this->asignatura=$registro[0][1];
               $this->correlativ=$registro[0][2];
               $this->ciclo=$registro[0][3];
               $this->fechaplan=$registro[0][4];
               $this->uv=$registro[0][5];
               $this->acuerdo=$registro[0][5];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setCodigoPla($CODIGO_PLA)
     {
          $this->codigopla=$CODIGO_PLA;
     }
     public function setAsignatura($ASIGNATURA)
     {
          $this->asignatura=$ASIGNATURA;
     }
     public function setCorrelativ($CORRELATIV)
     {
          $this->correlativ=$CORRELATIV;
     }
     public function setCiclo($CICLO)
     {
          $this->ciclo=$CICLO;
     }
     public function setFechaplan($FECHAPLAN)
     {
          $this->fechaplan=$FECHAPLAN;
     }
     public function setUv($UV)
     {
          $this->uv=$UV;
     }
     public function setAcuerdo($ACUERDO)
     {
          $this->acuerdo=$ACUERDO;
     }

     //metodos Obtener(get)
     public function getCodigoPla()
     {
          return $this->codigopla;
     }
     public function getAsignatura()
     {
          return $this->asignatura;
     }
     public function getCorrelativ()
     {
          return $this->correlativ;
     }
     public function getCiclo()
     {
          return $this->ciclo;
     }
     public function getFechaplan()
     {
          return $this->fechaplan;
     }
     public function getUv()
     {
          return $this->uv;
     }
     public function getAcuerdo()
     {
          return $this->acuerdo;
     }

     //metodo generador de listado
     public function getListadoAsignaturasPorPlan($plan)
     {
		 $query="SELECT ASIGNATURA FROM planes WHERE CODIGO_PLA='$plan' ORDER BY CORRELATIV;";
		 if($registro=$this->conexionPlanes->consulta($query))
		 {
			 for($i=0; $i<count($registro);$i++)
			 {
				 $resultado[$i]=$registro[$i]['ASIGNATURA'];
			 }
			 
			 return $resultado;
		 }
		 else
		 {
			 return false;
		 }
     }

     //metodo buscador de coincidencias
     public function buscarPlanes($valor)
     {
          return $this->conexionPlanes->buscar($valor,"ASIGNATURA", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertPlanes()
     {
           $atributos=array( $this->asignatura , $this->correlativ , $this->ciclo , $this->fechaplan , $this->uv , $this->acuerdo );
          //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->codigopla , $this->asignatura , $this->correlativ , $this->ciclo , $this->fechaplan , $this->uv , $this->acuerdo );

          return $this->conexionPlanes->insertarRegistro($atributos);
     }
     public function updatePlanes()
     {
          $atributos=array( $this->asignatura , $this->correlativ , $this->ciclo , $this->fechaplan , $this->uv , $this->acuerdo );
          return $this->conexionPlanes->actualizarRegistro($this->codigopla,$atributos);
     }
}