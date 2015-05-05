<?php
/*
* ClassControl.php
* version 1.0
*
*/
class Franjas{
    //`id_franja`, `CODIGO_CAR`, `ciclo`, `anio`, `tipo_permiso`, `fecha_hora_inicio`, `fecha_hora_fin`, `comentario`, `estado`
     private $id_franja;
     private $CODIGO_CAR;
     private $ciclo;
     private $anio;
     private $tipo_permiso;
     private $fecha_hora_inicio;
     private $fecha_hora_fin;
     private $comentario;
     private $estado;
     //Objeto gestionador de base de datos
     private $conexionControl;

     public function __construct()
     {
          $atributos= array( "CODIGO_CAR","ciclo","anio","tipo_permiso","fecha_hora_inicio","fecha_hora_fin","comentario","estado");
          $this->conexionControl = new MySQL();
          $this->conexionControl->setNombreTabla("siai_franjas_inscripcion");
          $this->conexionControl->setNombreAtributos($atributos);
          $this->conexionControl->setNombreLlavePrimaria("id_franja");
     }

     public function setControlPorLlave($llave)
     {
          if($registro=$this->conexionControl->consultarRegistro($llave))
          {
               $this->id_franja=$llave;
               $this->CODIGO_CAR=$registro[0];
               $this->ciclo=$registro[1];
               $this->anio=$registro[2];
               $this->tipo_permiso=$registro[3];
               $this->fecha_hora_inicio=$registro[4];
               $this->fecha_hora_fin=$registro[5];
               $this->comentario=$registro[6];
               $this->estado=$registro[7];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setId_franja($ID_FRANJA)
     {
          $this->id_franja=$ID_FRANJA;
     }
     public function setCodigo_car($CODIGO_CAR)
     {
          $this->CODIGO_CAR=$CODIGO_CAR;
     }
     public function setCiclo($CICLO)
     {
          $this->ciclo=$CICLO;
     }
     public function setAnio($ANIO)
     {
          $this->anio=$ANIO;
     }
     public function setTipo_pemiso($TIPO_PERMISO)
     {
          $this->tipo_permiso=$TIPO_PERMISO;
     }
     public function setFecha_hora_inicio($FECHA_HORA_INICIO)
     {
          $this->fecha_hora_inicio=$FECHA_HORA_INICIO;
     }
     public function setFecha_hora_fin($FECHA_HORA_FIN)
     {
          $this->fecha_hora_fin=$FECHA_HORA_FIN;
     }
     public function setComentario($COMENTARIO)
     {
          $this->comentario=$COMENTARIO;
     }
     public function setEstado($ESTADO)
     {
          $this->estado=$ESTADO;
     }     

     //metodos Obtener(get)
     public function getId_franja()
     {
          return $this->id_franja;
     }
     public function getCodigo_car()
     {
          return $this->CODIGO_CAR;
     }
     public function getCiclo()
     {
         return $this->ciclo;
     }
     public function getAnio()
     {
          return $this->anio;
     }
     public function getTipo_pemiso()
     {
          return $this->tipo_permiso;
     }
     public function getFecha_hora_inicio()
     {
          return $this->fecha_hora_inicio;
     }
     public function getFecha_hora_fin()
     {
          return $this->fecha_hora_fin;
     }
     public function getComentario()
     {
          return $this->comentario;
     }
     public function getEstado()
     {
          return $this->estado;
     }   
     
     //metodo generador de listado
     public function getListadoFranjas()
     {
          return $this->conexionControl->lista("fecha_hora_inicio", "ASC");
     }
     
     public function getListadoFranjasCarreras()
     {
        //Creando cadena de la consulta Select
        $query="SELECT * FROM siai_franjas_inscripcion AS f JOIN carrera AS c ON f.CODIGO_CAR=c.CODIGO_CAR WHERE estado='1'";
        $resultado=$this->conexionControl->consulta($query);
        return $resultado;			//Creando cadena de la consulta Select
     }     

     //metodo buscador de coincidencias
     public function buscarFranja($valor)
     {
          return $this->conexionControl->buscar($valor,"fecha_hora_inicio", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertFranja()
     {
           $atributos=array( $this->consecutiv , $this->valor , $this->incrementa , $this->fecha , $this->nombree , $this->fechav);
          //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->nombre , $this->consecutiv , $this->valor , $this->incrementa , $this->fecha , $this->nombree , $this->fechav );

          return $this->conexionControl->insertarRegistro($atributos);
     }
     public function updateFranja()
     {
          $atributos=array( $this->consecutiv , $this->valor , $this->incrementa , $this->fecha , $this->nombree , $this->fechav );
          return $this->conexionControl->actualizarRegistro($this->nombre,$atributos);
     }
}