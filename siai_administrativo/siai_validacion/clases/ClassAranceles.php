<?php
/*
* ClassAranceles.php
* version 1.0
*
*/
class Aranceles{
     private $codigo;
     private $nombre;
     private $valor;
     private $codigocon;
     private $exento;
     private $accion;
     private $rubro;
     private $nomcuen;
     private $permitir;
     private $dolares;
     private $valorold;
     private $idunicoara;
     //Objeto gestionador de base de datos
     private $conexionAranceles;

     public function __construct()
     {
          $atributos= array( "NOMBRE","VALOR","CODIGO_CON","EXENTO","ACCION","RUBRO","NOMCUEN","PERMITIR","DOLARES","VALOROLD","IDUNICOARA" );
          $this->conexionAranceles = new MySQL();
          $this->conexionAranceles->setNombreTabla("aranceles");
          $this->conexionAranceles->setNombreAtributos($atributos);
          $this->conexionAranceles->setNombreLlavePrimaria("CODIGO");
     }

     public function setArancelesPorLlave($llave)
     {
          if($registro=$this->conexionAranceles->consultarRegistro($llave))
          {
               $this->codigo=$llave;
               $this->nombre=$registro[0];
               $this->valor=$registro[1];
               $this->codigocon=$registro[2];
               $this->exento=$registro[3];
               $this->accion=$registro[4];
               $this->rubro=$registro[5];
               $this->nomcuen=$registro[6];
               $this->permitir=$registro[7];
               $this->dolares=$registro[8];
               $this->valorold=$registro[9];
               $this->idunicoara=$registro[10];
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
     public function setValor($VALOR)
     {
          $this->valor=$VALOR;
     }
     public function setCodigoCon($CODIGO_CON)
     {
          $this->codigocon=$CODIGO_CON;
     }
     public function setExento($EXENTO)
     {
          $this->exento=$EXENTO;
     }
     public function setAccion($ACCION)
     {
          $this->accion=$ACCION;
     }
     public function setRubro($RUBRO)
     {
          $this->rubro=$RUBRO;
     }
     public function setNomcuen($NOMCUEN)
     {
          $this->nomcuen=$NOMCUEN;
     }
     public function setPermitir($PERMITIR)
     {
          $this->permitir=$PERMITIR;
     }
     public function setDolares($DOLARES)
     {
          $this->dolares=$DOLARES;
     }
     public function setValorold($VALOROLD)
     {
          $this->valorold=$VALOROLD;
     }
     public function setIdunicoara($IDUNICOARA)
     {
          $this->idunicoara=$IDUNICOARA;
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
     public function getValor()
     {
          return $this->valor;
     }
     public function getCodigoCon()
     {
          return $this->codigocon;
     }
     public function getExento()
     {
          return $this->exento;
     }
     public function getAccion()
     {
          return $this->accion;
     }
     public function getRubro()
     {
          return $this->rubro;
     }
     public function getNomcuen()
     {
          return $this->nomcuen;
     }
     public function getPermitir()
     {
          return $this->permitir;
     }
     public function getDolares()
     {
          return $this->dolares;
     }
     public function getValorold()
     {
          return $this->valorold;
     }
     public function getIdunicoara()
     {
          return $this->idunicoara;
     }

     //metodo generador de listado
     public function getListadoAranceless()
     {
          return $this->conexionAranceles->listaLlaves("NOMBRE", "ASC");
     }


     //metodo buscador de coincidencias
     public function buscarAranceles($valor)
     {
          return $this->conexionAranceles->buscar($valor,"NOMBRE", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertAranceles()
     {
           $atributos=array( $this->nombre , $this->valor , $this->codigocon , $this->exento , $this->accion , $this->rubro , $this->nomcuen , $this->permitir , $this->dolares , $this->valorold , $this->idunicoara );
          //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->codigo , $this->nombre , $this->valor , $this->codigocon , $this->exento , $this->accion , $this->rubro , $this->nomcuen , $this->permitir , $this->dolares , $this->valorold , $this->idunicoara );

          return $this->conexionAranceles->insertarRegistro($atributos);
     }
     public function updateAranceles()
     {
          $atributos=array( $this->nombre , $this->valor , $this->codigocon , $this->exento , $this->accion , $this->rubro , $this->nomcuen , $this->permitir , $this->dolares , $this->valorold , $this->idunicoara );
          return $this->conexionAranceles->actualizarRegistro($this->codigo,$atributos);
     }
}