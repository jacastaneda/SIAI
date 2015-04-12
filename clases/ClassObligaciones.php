<?php

/*
 * ClassObligaciones.php
 * version 1.0
 *
 */

class Obligaciones {

    private $tALONARIO;
    private $cARNET;
    private $cUOTA;
    private $vALOR;
    private $sALDOANTER;
    private $cARGOS;
    private $aBONOS;
    private $sALDOACTUA;
    private $fECHAULTI;
    private $fECHAVENC;
    private $fECHA;
    private $cORRELATIV;
    private $tIPOARANC;
    private $cICLO;
    private $iNCOR;
    private $dOLARES;
    //Objeto gestionador de base de datos
    private $conexionObligaciones;

    public function __construct() {
        $atributos = array("CARNET", "CUOTA", "VALOR", "SALDOANTER", "CARGOS", "ABONOS", "SALDOACTUA", "FECHA_ULTI", "FECHA_VENC", "FECHA", "CORRELATIV", "TIPO_ARANC", "CICLO", "INCOR", "DOLARES");
        $this->conexionObligaciones = new MySQL();
        $this->conexionObligaciones->setNombreTabla("obligaciones");
        $this->conexionObligaciones->setNombreAtributos($atributos);
        $this->conexionObligaciones->setNombreLlavePrimaria("TALONARIO");
    }

    public function setObligacionesPorLlave($llave) {
        if ($registro = $this->conexionObligaciones->consultarRegistro($llave)) {
            $this->tALONARIO = $llave;
            $this->cARNET = $registro[0];
            $this->cUOTA = $registro[1];
            $this->vALOR = $registro[2];
            $this->sALDOANTER = $registro[3];
            $this->cARGOS = $registro[4];
            $this->aBONOS = $registro[5];
            $this->sALDOACTUA = $registro[6];
            $this->fECHAULTI = $registro[7];
            $this->fECHAVENC = $registro[8];
            $this->fECHA = $registro[9];
            $this->cORRELATIV = $registro[10];
            $this->tIPOARANC = $registro[11];
            $this->cICLO = $registro[12];
            $this->iNCOR = $registro[13];
            $this->dOLARES = $registro[14];
            return true;
        } else {
            return false;
        }
    }

    //metodos Establecer(set)
    public function setTALONARIO($TALONARIO) {
        $this->tALONARIO = $TALONARIO;
    }

    public function setCARNET($CARNET) {
        $this->cARNET = $CARNET;
    }

    public function setCUOTA($CUOTA) {
        $this->cUOTA = $CUOTA;
    }

    public function setVALOR($VALOR) {
        $this->vALOR = $VALOR;
    }

    public function setSALDOANTER($SALDOANTER) {
        $this->sALDOANTER = $SALDOANTER;
    }

    public function setCARGOS($CARGOS) {
        $this->cARGOS = $CARGOS;
    }

    public function setABONOS($ABONOS) {
        $this->aBONOS = $ABONOS;
    }

    public function setSALDOACTUA($SALDOACTUA) {
        $this->sALDOACTUA = $SALDOACTUA;
    }

    public function setFECHAULTI($FECHA_ULTI) {
        $this->fECHAULTI = $FECHA_ULTI;
    }

    public function setFECHAVENC($FECHA_VENC) {
        $this->fECHAVENC = $FECHA_VENC;
    }

    public function setFECHA($FECHA) {
        $this->fECHA = $FECHA;
    }

    public function setCORRELATIV($CORRELATIV) {
        $this->cORRELATIV = $CORRELATIV;
    }

    public function setTIPOARANC($TIPO_ARANC) {
        $this->tIPOARANC = $TIPO_ARANC;
    }

    public function setCICLO($CICLO) {
        $this->cICLO = $CICLO;
    }

    public function setINCOR($INCOR) {
        $this->iNCOR = $INCOR;
    }

    public function setDOLARES($DOLARES) {
        $this->dOLARES = $DOLARES;
    }

    //metodos Obtener(get)
    public function getTALONARIO() {
        return $this->tALONARIO;
    }

    public function getCARNET() {
        return $this->cARNET;
    }

    public function getCUOTA() {
        return $this->cUOTA;
    }

    public function getVALOR() {
        return $this->vALOR;
    }

    public function getSALDOANTER() {
        return $this->sALDOANTER;
    }

    public function getCARGOS() {
        return $this->cARGOS;
    }

    public function getABONOS() {
        return $this->aBONOS;
    }

    public function getSALDOACTUA() {
        return $this->sALDOACTUA;
    }

    public function getFECHAULTI() {
        return $this->fECHAULTI;
    }

    public function getFECHAVENC() {
        return $this->fECHAVENC;
    }

    public function getFECHA() {
        return $this->fECHA;
    }

    public function getCORRELATIV() {
        return $this->cORRELATIV;
    }

    public function getTIPOARANC() {
        return $this->tIPOARANC;
    }

    public function getCICLO() {
        return $this->cICLO;
    }

    public function getINCOR() {
        return $this->iNCOR;
    }

    public function getDOLARES() {
        return $this->dOLARES;
    }

    //metodo generador de listado
    public function getListadoObligacioness() {
        return $this->conexionObligaciones->listaLlaves("CARNET", "ASC");
    }

    //metodo buscador de coincidencias
    public function buscarObligaciones($valor) {
        return $this->conexionObligaciones->buscar($valor, "CARNET", "ASC");
    }

    //metodos relacionados a la base de datos
    public function insertObligaciones() {
        $atributos = array($this->cARNET, $this->cUOTA, $this->vALOR, $this->sALDOANTER, $this->cARGOS, $this->aBONOS, $this->sALDOACTUA, $this->fECHAULTI, $this->fECHAVENC, $this->fECHA, $this->cORRELATIV, $this->tIPOARANC, $this->cICLO, $this->iNCOR, $this->dOLARES);
        //descomentarear la línea siguiente y comentarear la anterior si la llave primaria no es autoincremental
        //$atributos=array( $this->tALONARIO , $this->cARNET , $this->cUOTA , $this->vALOR , $this->sALDOANTER , $this->cARGOS , $this->aBONOS , $this->sALDOACTUA , $this->fECHAULTI , $this->fECHAVENC , $this->fECHA , $this->cORRELATIV , $this->tIPOARANC , $this->cICLO , $this->iNCOR , $this->dOLARES );

        return $this->conexionObligaciones->insertarRegistro($atributos);
    }

    public function updateObligaciones() {
        $atributos = array($this->cARNET, $this->cUOTA, $this->vALOR, $this->sALDOANTER, $this->cARGOS, $this->aBONOS, $this->sALDOACTUA, $this->fECHAULTI, $this->fECHAVENC, $this->fECHA, $this->cORRELATIV, $this->tIPOARANC, $this->cICLO, $this->iNCOR, $this->dOLARES);
        return $this->conexionObligaciones->actualizarRegistro($this->tALONARIO, $atributos);
    }

    public function isSolvente($_carnet) {
        $consulta = "SELECT count(*) as contador FROM siai.obligaciones where CARNET='" . $_carnet . "' and SALDOACTUA>0;";
        if ($registro = $this->conexionObligaciones->consulta($consulta)) {
            if ($registro[0]['contador'] > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function listaNoSolvente($_carnet) {
        $consulta = "SELECT * FROM siai.obligaciones where CARNET='" . $_carnet . "' and SALDOACTUA>0;";
        if ($registro = $this->conexionObligaciones->consulta($consulta)) {
            return $registro; 
        } else {
            return FALSE;
        }
    }

}