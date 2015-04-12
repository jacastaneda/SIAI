<?php

/*
 * ClassTipobeca.php
 * version 1.0
 *
 */

class Tipobeca {

    private $cODIGO;
    private $nOMBRE;
    private $vALOR;
    //Objeto gestionador de base de datos
    private $conexionTipobeca;

    public function __construct() {
        $atributos = array("NOMBRE", "VALOR");
        $this->conexionTipobeca = new MySQL();
        $this->conexionTipobeca->setNombreTabla("tipobeca");
        $this->conexionTipobeca->setNombreAtributos($atributos);
        $this->conexionTipobeca->setNombreLlavePrimaria("CODIGO");
    }

    public function setTipobecaPorLlave($llave) {
        if ($registro = $this->conexionTipobeca->consultarRegistro($llave)) {
            $this->cODIGO = $llave;
            $this->nOMBRE = $registro[0];
            $this->vALOR = $registro[1];
            return true;
        } else {
            return false;
        }
    }

    //metodos Establecer(set)
    public function setCODIGO($CODIGO) {
        $this->cODIGO = $CODIGO;
    }

    public function setNOMBRE($NOMBRE) {
        $this->nOMBRE = $NOMBRE;
    }

    public function setVALOR($VALOR) {
        $this->vALOR = $VALOR;
    }

    //metodos Obtener(get)
    public function getCODIGO() {
        return $this->cODIGO;
    }

    public function getNOMBRE() {
        return $this->nOMBRE;
    }

    public function getVALOR() {
        return $this->vALOR;
    }

    //metodo generador de listado
    public function getListadoTipobecas() {
        return $this->conexionTipobeca->listaLlaves("NOMBRE", "ASC");
    }

    //metodo buscador de coincidencias
    public function buscarTipobeca($valor) {
        return $this->conexionTipobeca->buscar($valor, "NOMBRE", "ASC");
    }

    //metodos relacionados a la base de datos
    public function insertTipobeca() {
        $atributos = array($this->nOMBRE, $this->vALOR);
        //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
        //$atributos=array( $this->cODIGO , $this->nOMBRE , $this->vALOR );

        return $this->conexionTipobeca->insertarRegistro($atributos);
    }

    public function updateTipobeca() {
        $atributos = array($this->nOMBRE, $this->vALOR);
        return $this->conexionTipobeca->actualizarRegistro($this->cODIGO, $atributos);
    }

}