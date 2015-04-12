<?php

/*
 * ClassSiaiControl.php
 * version 1.0
 *
 */

class SiaiControl {

    private $idcontrol;
    private $paso;
    private $solvente;
    private $ciclo;
    private $anio;
    private $totalpagar;
    private $saldo;
    private $usuario;
    //Objeto gestionador de base de datos
    private $conexionSiaiControl;

    public function __construct() {
        $atributos = array("paso", "solvente", "ciclo", "anio", "total_pagar", "saldo", "usuario");
        $this->conexionSiaiControl = new MySQL();
        $this->conexionSiaiControl->setNombreTabla("siai_control");
        $this->conexionSiaiControl->setNombreAtributos($atributos);
        $this->conexionSiaiControl->setNombreLlavePrimaria("id_control");
    }

    public function setSiaiControlPorLlave($llave) {
        if ($registro = $this->conexionSiaiControl->consultarRegistro($llave)) {
            //echo 'si';
            $this->idcontrol = $llave;
            $this->paso = $registro[0];
            $this->solvente = $registro[1];
            $this->ciclo = $registro[2];
            $this->anio = $registro[3];
            $this->totalpagar = $registro[4];
            $this->saldo = $registro[5];
            $this->usuario = $registro[6];
            return true;
        } else {
            //echo 'no';
            return false;
        }
    }

    public function setPorAtributos($usuario, $ciclo, $anio) {
        $consulta = "SELECT id_control FROM siai_control WHERE usuario='$usuario' AND ciclo='$ciclo' AND anio='$anio'";
        //echo $consulta;
        if ($resultado = $this->conexionSiaiControl->consulta($consulta)) {
            return $this->setSiaiControlPorLlave($resultado[0]['id_control']);
        } else {
            return false;
        }
    }

    //metodos Establecer(set)
    public function setIdControl($id_control) {
        $this->idcontrol = $id_control;
    }

    public function setPaso($paso) {
        $this->paso = $paso;
    }

    public function setSolvente($solvente) {
        $this->solvente = $solvente;
    }

    public function setCiclo($ciclo) {
        $this->ciclo = $ciclo;
    }

    public function setAnio($anio) {
        $this->anio = $anio;
    }

    public function setTotalPagar($total_pagar) {
        $this->totalpagar = $total_pagar;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    //metodos Obtener(get)
    public function getIdControl() {
        return $this->idcontrol;
    }

    public function getPaso() {
        return $this->paso;
    }

    public function getSolvente() {
        return $this->solvente;
    }

    public function getCiclo() {
        return $this->ciclo;
    }

    public function getAnio() {
        return $this->anio;
    }

    public function getTotalPagar() {
        return $this->totalpagar;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    //metodo generador de listado
    public function getListadoSiaiControls() {
        return $this->conexionSiaiControl->listaLlaves("paso", "ASC");
    }

    //metodo buscador de coincidencias
    public function buscarSiaiControl($valor) {
        return $this->conexionSiaiControl->buscar($valor, "paso", "ASC");
    }

    //metodos relacionados a la base de datos
    public function insertSiaiControl() {
        $atributos = array($this->paso, $this->solvente, $this->ciclo, $this->anio, $this->totalpagar, $this->saldo, $this->usuario);
        //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
        //$atributos=array( $this->idcontrol , $this->paso , $this->solvente , $this->ciclo , $this->anio , $this->totalpagar , $this->saldo , $this->usuario );

        return $this->conexionSiaiControl->insertarRegistro($atributos);
    }

    public function updateSiaiControl() {
        $atributos = array($this->paso, $this->solvente, $this->ciclo, $this->anio, $this->totalpagar, $this->saldo, $this->usuario);
        return $this->conexionSiaiControl->actualizarRegistro($this->idcontrol, $atributos);
    }

}