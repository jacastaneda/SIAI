<?php
/*
* ClassControl.php
* version 1.0
*
*/
class Control{
     private $nombre;
     private $consecutiv;
     private $valor;
     private $incrementa;
     private $fecha;
     private $nombree;
     private $fechav;
     //Objeto gestionador de base de datos
     private $conexionControl;

     public function __construct()
     {
          $atributos= array( "CONSECUTIV","VALOR","INCREMENTA","FECHA","NOMBREE","FECHAV");
          $this->conexionControl = new MySQL();
          $this->conexionControl->setNombreTabla("control");
          $this->conexionControl->setNombreAtributos($atributos);
          $this->conexionControl->setNombreLlavePrimaria("NOMBRE");
     }

     public function setControlPorLlave($llave)
     {
          if($registro=$this->conexionControl->consultarRegistro($llave))
          {
               $this->nombre=$llave;
               $this->consecutiv=$registro[0];
               $this->valor=$registro[1];
               $this->incrementa=$registro[2];
               $this->fecha=$registro[3];
               $this->nombree=$registro[4];
               $this->fechav=$registro[5];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setNombre($NOMBRE)
     {
          $this->nombre=$NOMBRE;
     }
     public function setConsecutiv($CONSECUTIV)
     {
          $this->consecutiv=$CONSECUTIV;
     }
     public function setValor($VALOR)
     {
          $this->valor=$VALOR;
     }
     public function setIncrementa($INCREMENTA)
     {
          $this->incrementa=$INCREMENTA;
     }
     public function setFecha($FECHA)
     {
          $this->fecha=$FECHA;
     }
     public function setNombree($NOMBREE)
     {
          $this->nombree=$NOMBREE;
     }
     public function setFechav($FECHAV)
     {
          $this->fechav=$FECHAV;
     }

     //metodos Obtener(get)
     public function getNombre()
     {
          return $this->nombre;
     }
     public function getConsecutiv()
     {
          return $this->consecutiv;
     }
     public function getValor()
     {
          return $this->valor;
     }
     public function getIncrementa()
     {
          return $this->incrementa;
     }
     public function getFecha()
     {
          return $this->fecha;
     }
     public function getNombree()
     {
          return $this->nombree;
     }
     public function getFechav()
     {
          return $this->fechav;
     }

     //metodo generador de listado
     public function getListadoControls()
     {
          return $this->conexionControl->listaLlaves("CONSECUTIV", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarControl($valor)
     {
          return $this->conexionControl->buscar($valor,"CONSECUTIV", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertControl()
     {
           $atributos=array( $this->consecutiv , $this->valor , $this->incrementa , $this->fecha , $this->nombree , $this->fechav);
          //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->nombre , $this->consecutiv , $this->valor , $this->incrementa , $this->fecha , $this->nombree , $this->fechav );

          return $this->conexionControl->insertarRegistro($atributos);
     }
     public function updateControl()
     {
          $atributos=array( $this->consecutiv , $this->valor , $this->incrementa , $this->fecha , $this->nombree , $this->fechav );
          return $this->conexionControl->actualizarRegistro($this->nombre,$atributos);
     }
}