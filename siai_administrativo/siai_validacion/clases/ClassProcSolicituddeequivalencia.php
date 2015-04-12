<?php
/*
* ClassProcSolicitudequivalencia.php
* version 1.0
*
*/
class ProcSolicitudequivalencia{
     private $idsolicitudequi;
     private $idestadosolicitudequi;
     private $fechaingresolicitud;
     private $numerocarne;
     private $nombressolicitante;
     private $primerapellidosolicitante;
     private $segundoapellidosolicitante;
     private $apellidocasadasolicitante;
     private $idcatedratico;
     //Objeto gestionador de base de datos
     private $conexionProcSolicitudequivalencia;

     public function __construct()
     {
          $atributos= array( "idEstadoSolicitudEqui","fechaIngreSolicitud","numeroCarne","nombresSolicitante","PrimerApellidoSolicitante","segundoApellidoSolicitante","apellidoCasadaSolicitante","idCatedratico" );
          $this->conexionProcSolicitudequivalencia = new MySQL();
          $this->conexionProcSolicitudequivalencia->setNombreTabla("proc_solicitudequivalencia");
          $this->conexionProcSolicitudequivalencia->setNombreAtributos($atributos);
          $this->conexionProcSolicitudequivalencia->setNombreLlavePrimaria("idSolicitudEqui");
     }

     public function setProcSolicitudequivalenciaPorLlave($llave)
     {
          if($registro=$this->conexionProcSolicitudequivalencia->consultarRegistro($llave))
          {
               $this->idsolicitudequi=$llave;
               $this->idestadosolicitudequi=$registro[0];
               $this->fechaingresolicitud=$registro[1];
               $this->numerocarne=$registro[2];
               $this->nombressolicitante=$registro[3];
               $this->primerapellidosolicitante=$registro[4];
               $this->segundoapellidosolicitante=$registro[5];
               $this->apellidocasadasolicitante=$registro[6];
               $this->idcatedratico=$registro[7];
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
     public function setIdestadosolicitudequi($idEstadoSolicitudEqui)
     {
          $this->idestadosolicitudequi=$idEstadoSolicitudEqui;
     }
     public function setFechaingresolicitud($fechaIngreSolicitud)
     {
          $this->fechaingresolicitud=$fechaIngreSolicitud;
     }
     public function setNumerocarne($numeroCarne)
     {
          $this->numerocarne=$numeroCarne;
     }
     public function setNombressolicitante($nombresSolicitante)
     {
          $this->nombressolicitante=$nombresSolicitante;
     }
     public function setPrimerapellidosolicitante($PrimerApellidoSolicitante)
     {
          $this->primerapellidosolicitante=$PrimerApellidoSolicitante;
     }
     public function setSegundoapellidosolicitante($segundoApellidoSolicitante)
     {
          $this->segundoapellidosolicitante=$segundoApellidoSolicitante;
     }
     public function setApellidocasadasolicitante($apellidoCasadaSolicitante)
     {
          $this->apellidocasadasolicitante=$apellidoCasadaSolicitante;
     }
     public function setIdcatedratico($idCatedratico)
     {
          $this->idcatedratico=$idCatedratico;
     }

     //metodos Obtener(get)
     public function getIdsolicitudequi()
     {
          return $this->idsolicitudequi;
     }
     public function getIdestadosolicitudequi()
     {
          return $this->idestadosolicitudequi;
     }
     public function getFechaingresolicitud()
     {
          return $this->fechaingresolicitud;
     }
     public function getNumerocarne()
     {
          return $this->numerocarne;
     }
     public function getNombressolicitante()
     {
          return $this->nombressolicitante;
     }
     public function getPrimerapellidosolicitante()
     {
          return $this->primerapellidosolicitante;
     }
     public function getSegundoapellidosolicitante()
     {
          return $this->segundoapellidosolicitante;
     }
     public function getApellidocasadasolicitante()
     {
          return $this->apellidocasadasolicitante;
     }
     public function getIdcatedratico()
     {
          return $this->idcatedratico;
     }

     //metodo generador de listado
     public function getListadoProcSolicitudequivalencias()
     {
          return $this->conexionProcSolicitudequivalencia->listaLlaves("idEstadoSolicitudEqui", "ASC");
     }

	public function getListadoEquivalenciasPropuestas($carnet)
	{
		$consulta="SELECT b.IdCodAsignaturaUPES FROM proc_solicitudequivalencia AS a
					INNER JOIN proc_analisismaterias AS b ON a.idSolicitudEqui=b.idSolicitudEqui
					WHERE a.numeroCarne='$carnet' AND b.idEstadoMateriaSoli=2";
					
		$resultado=$this->conexionProcSolicitudequivalencia->consulta($consulta);
		
		for($i=0;$i<count($resultado);$i++)
		{
			$respuesta[$i]=$resultado[$i][0];
		}
		return $respuesta;	
	}
		
     //metodo buscador de coincidencias
     public function buscarProcSolicitudequivalencia($valor)
     {
          return $this->conexionProcSolicitudequivalencia->buscar($valor,"idEstadoSolicitudEqui", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertProcSolicitudequivalencia()
     {
           $atributos=array( $this->idestadosolicitudequi , $this->fechaingresolicitud , $this->numerocarne , $this->nombressolicitante , $this->primerapellidosolicitante , $this->segundoapellidosolicitante , $this->apellidocasadasolicitante , $this->idcatedratico );
          //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->idsolicitudequi , $this->idestadosolicitudequi , $this->fechaingresolicitud , $this->numerocarne , $this->nombressolicitante , $this->primerapellidosolicitante , $this->segundoapellidosolicitante , $this->apellidocasadasolicitante , $this->idcatedratico );

          return $this->conexionProcSolicitudequivalencia->insertarRegistro($atributos);
     }
     public function updateProcSolicitudequivalencia()
     {
          $atributos=array( $this->idestadosolicitudequi , $this->fechaingresolicitud , $this->numerocarne , $this->nombressolicitante , $this->primerapellidosolicitante , $this->segundoapellidosolicitante , $this->apellidocasadasolicitante , $this->idcatedratico );
          return $this->conexionProcSolicitudequivalencia->actualizarRegistro($this->idsolicitudequi,$atributos);
     }
}