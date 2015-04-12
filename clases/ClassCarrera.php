<?php

/*
 * ClassCarrera.php
 * version 1.0
 *
 */

class Carrera {

    private $codigocar;
    private $nombre;
    private $plandefec;
    private $facultad;
    private $escuela;
    private $coordinado;
    private $depto;
    private $abrevia;
    //Objeto gestionador de base de datos
    private $conexionCarrera;

    public function __construct() {
        $atributos = array("NOMBRE", "PLAN_DEFEC", "FACULTAD", "ESCUELA", "COORDINADO", "DEPTO", "ABREVIA");
        $this->conexionCarrera = new MySQL();
        $this->conexionCarrera->setNombreTabla("carrera");
        $this->conexionCarrera->setNombreAtributos($atributos);
        $this->conexionCarrera->setNombreLlavePrimaria("CODIGO_CAR");
    }

    public function setCarreraPorLlave($llave) {
        if ($registro = $this->conexionCarrera->consultarRegistro($llave)) {
            $this->codigocar = $llave;
            $this->nombre = $registro[0];
            $this->plandefec = $registro[1];
            $this->facultad = $registro[2];
            $this->escuela = $registro[3];
            $this->coordinado = $registro[4];
            $this->depto = $registro[5];
            $this->abrevia = $registro[6];
            return true;
        } else {
            return false;
        }
    }

    //metodos Establecer(set)
    public function setCodigoCar($CODIGO_CAR) {
        $this->codigocar = $CODIGO_CAR;
    }

    public function setNombre($NOMBRE) {
        $this->nombre = $NOMBRE;
    }

    public function setPlanDefec($PLAN_DEFEC) {
        $this->plandefec = $PLAN_DEFEC;
    }

    public function setFacultad($FACULTAD) {
        $this->facultad = $FACULTAD;
    }

    public function setEscuela($ESCUELA) {
        $this->escuela = $ESCUELA;
    }

    public function setCoordinado($COORDINADO) {
        $this->coordinado = $COORDINADO;
    }

    public function setDepto($DEPTO) {
        $this->depto = $DEPTO;
    }

    public function setAbrevia($ABREVIA) {
        $this->abrevia = $ABREVIA;
    }

    //metodos Obtener(get)
    public function getCodigoCar() {
        return $this->codigocar;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPlanDefec() {
        return $this->plandefec;
    }

    public function getFacultad() {
        return $this->facultad;
    }

    public function getEscuela() {
        return $this->escuela;
    }

    public function getCoordinado() {
        return $this->coordinado;
    }

    public function getDepto() {
        return $this->depto;
    }

    public function getAbrevia() {
        return $this->abrevia;
    }

    //metodo generador de listado
    public function getListadoCarreras() {
        return $this->conexionCarrera->listaLlaves("NOMBRE", "ASC");
    }

    //metodo buscador de coincidencias
    public function buscarCarrera($valor) {
        return $this->conexionCarrera->buscar($valor, "NOMBRE", "ASC");
    }

    //metodos relacionados a la base de datos
    public function insertCarrera() {
        $atributos = array($this->nombre, $this->plandefec, $this->facultad, $this->escuela, $this->coordinado, $this->depto, $this->abrevia);
        //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
        //$atributos=array( $this->codigocar , $this->nombre , $this->plandefec , $this->facultad , $this->escuela , $this->coordinado , $this->depto , $this->abrevia );

        return $this->conexionCarrera->insertarRegistro($atributos);
    }

    public function updateCarrera() {
        $atributos = array($this->nombre, $this->plandefec, $this->facultad, $this->escuela, $this->coordinado, $this->depto, $this->abrevia);
        return $this->conexionCarrera->actualizarRegistro($this->codigocar, $atributos);
    }

    public function getCorreoCoordinador($carrera_id) {
        $query = "SELECT c.email FROM siai.carrera as a inner join proc_coordinadorcarrera as b on a.CODIGO_CAR=b.CODIGO_CAR inner join proc_catedraticos as c on b.idCatedratico=c.idCatedratico where a.CODIGO_CAR = '" . $carrera_id . "';";
        if ($registro = $this->conexionCarrera->consulta($query)) {
            return $registro[0]['email'];
        }
    }

}
