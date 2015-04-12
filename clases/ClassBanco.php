<?php

class Bancos{
     private $idBancos;
     private $nombre;
     //Objeto gestionador de base de datos
     private $conexionBancos;

     public function __construct()
     {
          $atributos= array( "nombre" );
          $this->conexionBancos = new MySQL();
          $this->conexionBancos->setNombreTabla("bancos");
          $this->conexionBancos->setNombreAtributos($atributos);
          $this->conexionBancos->setNombreLlavePrimaria("id_bancos");
     }

     public function setBancoPorLlave($llave)
     {
          if($registro=$this->conexionBancos->consultarRegistro($llave))
          {
               $this->idBancos=$llave;
               $this->nombre=$registro[0];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setIdBancos($id_bancos)
     {
          $this->idBancos=$id_bancos;
     }
     public function setNombre($nombre)
     {
          $this->nombre=$nombre;
     }

     //metodos Obtener(get)
     public function getIdBancos()
     {
          return $this->idBancos;
     }
     public function getNombre()
     {
          return $this->nombre;
     }

     //metodo generador de listado
     public function getListadoBancos()
     {
          return $this->conexionBancos->listaLlaves("nombre", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarBancos($valor)
     {
          return $this->conexionBancos->buscar($valor,"nombre", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertBancos()
     {
           $atributos=array( $this->nombre );
          //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->idBancos , $this->nombre );

          return $this->conexionBancos->insertarRegistro($atributos);
     }
     public function updateBancos()
     {
          $atributos=array( $this->nombre );
          return $this->conexionBancos->actualizarRegistro($this->idBancos,$atributos);
     }
}
?> 