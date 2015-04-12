<?php
/*
* ClassFacultades.php
* version 1.0
*
*/
class Facultades{
     private $codigo;
     private $nombre;
     private $uv;
     //Objeto gestionador de base de datos
     private $conexionFacultades;

     public function __construct()
     {
          $atributos= array( "NOMBRE","UV" );
          $this->conexionFacultades = new MySQL();
          $this->conexionFacultades->setNombreTabla("facultades");
          $this->conexionFacultades->setNombreAtributos($atributos);
          $this->conexionFacultades->setNombreLlavePrimaria("CODIGO");
     }

     public function setFacultadesPorLlave($llave)
     {
          if($registro=$this->conexionFacultades->consultarRegistro($llave))
          {
               $this->codigo=$llave;
               $this->nombre=$registro[0];
               $this->uv=$registro[1];
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
     public function setUv($UV)
     {
          $this->uv=$UV;
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
     public function getUv()
     {
          return $this->uv;
     }

     //metodo generador de listado
     public function getListadoFacultadess()
     {
          return $this->conexionFacultades->listaLlaves("NOMBRE", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarFacultades($valor)
     {
          return $this->conexionFacultades->buscar($valor,"NOMBRE", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertFacultades()
     {
           $atributos=array( $this->nombre , $this->uv );
          //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->codigo , $this->nombre , $this->uv );

          return $this->conexionFacultades->insertarRegistro($atributos);
     }
     public function updateFacultades()
     {
          $atributos=array( $this->nombre , $this->uv );
          return $this->conexionFacultades->actualizarRegistro($this->codigo,$atributos);
     }
}