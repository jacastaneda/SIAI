<?php
/*
* ClassProcAnalisismaterias.php
* version 1.0
*
*/
class ProcAnalisismaterias{
     private $idsolicitudequi;
     private $iduniversidad;
     private $idfacultadequi;
     private $idcarrera;
     private $idmateriaprocedencia;
     private $idcodcarreraupes;
     private $idcodasignaturaupes;
     private $idestadomateriasoli;
     private $idcorrmatesolicitada;
     private $observacionmateria;
     //Objeto gestionador de base de datos
     private $conexionProcAnalisismaterias;

     public function __construct()
     {
          $atributos= array( "idUniversidad","idFacultadEqui","idCarrera","idMateriaProcedencia","idCodCarreraUPES","IdCodAsignaturaUPES","idEstadoMateriaSoli","idCorrMateSolicitada","observacionMateria" );
          $this->conexionProcAnalisismaterias = new MySQL();
          $this->conexionProcAnalisismaterias->setNombreTabla("proc_analisismaterias");
          $this->conexionProcAnalisismaterias->setNombreAtributos($atributos);
          $this->conexionProcAnalisismaterias->setNombreLlavePrimaria("idSolicitudEqui");
     }

     public function setProcAnalisismateriasPorLlave($llave)
     {
          if($registro=$this->conexionProcAnalisismaterias->consultarRegistro($llave))
          {
               $this->idsolicitudequi=$llave;
               $this->iduniversidad=$registro[0];
               $this->idfacultadequi=$registro[1];
               $this->idcarrera=$registro[2];
               $this->idmateriaprocedencia=$registro[3];
               $this->idcodcarreraupes=$registro[4];
               $this->idcodasignaturaupes=$registro[5];
               $this->idestadomateriasoli=$registro[6];
               $this->idcorrmatesolicitada=$registro[7];
               $this->observacionmateria=$registro[8];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setIdsolicitudequi($idSolicitudEqui)
     {
          $this->idsolicitudequi=$idSolicitudEqui;
     }
     public function setIduniversidad($idUniversidad)
     {
          $this->iduniversidad=$idUniversidad;
     }
     public function setIdfacultadequi($idFacultadEqui)
     {
          $this->idfacultadequi=$idFacultadEqui;
     }
     public function setIdcarrera($idCarrera)
     {
          $this->idcarrera=$idCarrera;
     }
     public function setIdmateriaprocedencia($idMateriaProcedencia)
     {
          $this->idmateriaprocedencia=$idMateriaProcedencia;
     }
     public function setIdcodcarreraupes($idCodCarreraUPES)
     {
          $this->idcodcarreraupes=$idCodCarreraUPES;
     }
     public function setIdcodasignaturaupes($IdCodAsignaturaUPES)
     {
          $this->idcodasignaturaupes=$IdCodAsignaturaUPES;
     }
     public function setIdestadomateriasoli($idEstadoMateriaSoli)
     {
          $this->idestadomateriasoli=$idEstadoMateriaSoli;
     }
     public function setIdcorrmatesolicitada($idCorrMateSolicitada)
     {
          $this->idcorrmatesolicitada=$idCorrMateSolicitada;
     }
     public function setObservacionmateria($observacionMateria)
     {
          $this->observacionmateria=$observacionMateria;
     }

     //metodos Obtener(get)
     public function getIdsolicitudequi()
     {
          return $this->idsolicitudequi;
     }
     public function getIduniversidad()
     {
          return $this->iduniversidad;
     }
     public function getIdfacultadequi()
     {
          return $this->idfacultadequi;
     }
     public function getIdcarrera()
     {
          return $this->idcarrera;
     }
     public function getIdmateriaprocedencia()
     {
          return $this->idmateriaprocedencia;
     }
     public function getIdcodcarreraupes()
     {
          return $this->idcodcarreraupes;
     }
     public function getIdcodasignaturaupes()
     {
          return $this->idcodasignaturaupes;
     }
     public function getIdestadomateriasoli()
     {
          return $this->idestadomateriasoli;
     }
     public function getIdcorrmatesolicitada()
     {
          return $this->idcorrmatesolicitada;
     }
     public function getObservacionmateria()
     {
          return $this->observacionmateria;
     }

     //metodo generador de listado
     public function getListadoProcAnalisismateriass()
     {
          return $this->conexionProcAnalisismaterias->listaLlaves("idUniversidad", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarProcAnalisismaterias($valor)
     {
          return $this->conexionProcAnalisismaterias->buscar($valor,"idUniversidad", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertProcAnalisismaterias()
     {
           $atributos=array( $this->iduniversidad , $this->idfacultadequi , $this->idcarrera , $this->idmateriaprocedencia , $this->idcodcarreraupes , $this->idcodasignaturaupes , $this->idestadomateriasoli , $this->idcorrmatesolicitada , $this->observacionmateria );
          //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->idsolicitudequi , $this->iduniversidad , $this->idfacultadequi , $this->idcarrera , $this->idmateriaprocedencia , $this->idcodcarreraupes , $this->idcodasignaturaupes , $this->idestadomateriasoli , $this->idcorrmatesolicitada , $this->observacionmateria );

          return $this->conexionProcAnalisismaterias->insertarRegistro($atributos);
     }
     public function updateProcAnalisismaterias()
     {
          $atributos=array( $this->iduniversidad , $this->idfacultadequi , $this->idcarrera , $this->idmateriaprocedencia , $this->idcodcarreraupes , $this->idcodasignaturaupes , $this->idestadomateriasoli , $this->idcorrmatesolicitada , $this->observacionmateria );
          return $this->conexionProcAnalisismaterias->actualizarRegistro($this->idsolicitudequi,$atributos);
     }
}