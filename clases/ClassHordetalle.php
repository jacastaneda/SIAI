<?php

/*
 * ClassHordetalle.php
 * version 1.0
 *
 */

class Hordetalle {

    private $ciclo;
    private $seccion;
    private $codigo;
    private $codhor;
    //Objeto gestionador de base de datos
    private $conexionHordetalle;

    public function __construct() {
        $atributos = array("CICLO", "SECCION", "CODIGO");
        $this->conexionHordetalle = new MySQL();
        $this->conexionHordetalle->setNombreTabla("hordetalle");
        $this->conexionHordetalle->setNombreAtributos($atributos);
        $this->conexionHordetalle->setNombreLlavePrimaria("CODHOR");
    }

    public function setHordetallePorLlave($llave, $ciclo, $codigo) {
        $query = "SELECT * FROM hordetalle WHERE CICLO='$ciclo' AND CODHOR='$llave' AND CODIGO='$codigo'";
        //echo $query;
        if ($registro = $this->conexionHordetalle->consulta($query)) {
            $this->ciclo = $registro[0]['CICLO'];
            $this->seccion = $registro[0]['SECCION'];
            $this->codigo = $registro[0]['CODIGO'];
            $this->codhor = $registro[0]['CODHOR'];
            return true;
        } else {
            return false;
        }
    }

    public function setHordetallePorLlave2($llave, $ciclo, $codigo,$seccion) {
        $query = "SELECT * FROM hordetalle WHERE CICLO='$ciclo' AND CODHOR='$llave' AND CODIGO='$codigo' AND SECCION='$seccion'";
        //echo $query;
        if ($registro = $this->conexionHordetalle->consulta($query)) {
            $this->ciclo = $registro[0]['CICLO'];
            $this->seccion = $registro[0]['SECCION'];
            $this->codigo = $registro[0]['CODIGO'];
            $this->codhor = $registro[0]['CODHOR'];
            return true;
        } else {
            return false;
        }
    }

    //metodos Establecer(set)
    public function setCiclo($CICLO) {
        $this->ciclo = $CICLO;
    }

    public function setSeccion($SECCION) {
        $this->seccion = $SECCION;
    }

    public function setCodigo($CODIGO) {
        $this->codigo = $CODIGO;
    }

    public function setCodhor($CODHOR) {
        $this->codhor = $CODHOR;
    }

    //metodos Obtener(get)
    public function getCiclo() {
        return $this->ciclo;
    }

    public function getSeccion() {
        return $this->seccion;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getCodhor() {
        return $this->codhor;
    }

    //metodo generador de listado
    public function getListadoHordetalles() {
        return $this->conexionHordetalle->listaLlaves("SECCION", "ASC");
    }

    //metodo buscador de coincidencias
    public function buscarHordetalle($valor) {
        return $this->conexionHordetalle->buscar($valor, "SECCION", "ASC");
    }

    //metodos relacionados a la base de datos
    public function insertHordetalle() {
        $atributos = array($this->seccion, $this->codigo, $this->codhor);
        //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
        //$atributos=array( $this->ciclo , $this->seccion , $this->codigo , $this->codhor );

        return $this->conexionHordetalle->insertarRegistro($atributos);
    }

    public function updateHordetalle() {
        $atributos = array($this->seccion, $this->codigo, $this->codhor);
        return $this->conexionHordetalle->actualizarRegistro($this->ciclo, $atributos);
    }

}
