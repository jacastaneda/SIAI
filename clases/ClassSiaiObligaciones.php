<?php

/*
 * ClassSiaiObligaciones.php
 * version 1.5
 *
 */

class SiaiObligaciones {

    private $idobligaciones;
    private $arancel;
    private $fechaemision;
    private $fechapago;
    private $nui;
    private $valor;
    private $idarancel;
    private $cuota;
    private $ciclo;
    private $anio;
    private $npe;
    private $descripcion;
    private $estado;
    private $codigobarras;
    private $banco;
    private $monto;
    private $usuario;
    //Objeto gestionador de base de datos
    private $conexionSiaiObligaciones;

    public function __construct() {
        $atributos = array("arancel", "fecha_emision", "fecha_pago", "nui", "valor", "id_arancel", "cuota", "ciclo", "anio", "npe", "descripcion", "estado", "codigo_barras", "banco", "monto", "usuario");
        $this->conexionSiaiObligaciones = new MySQL();
        $this->conexionSiaiObligaciones->setNombreTabla("siai_obligaciones");
        $this->conexionSiaiObligaciones->setNombreAtributos($atributos);
        $this->conexionSiaiObligaciones->setNombreLlavePrimaria("id_obligaciones");
    }

    public function setSiaiObligacionesPorLlave($llave) {
        if ($registro = $this->conexionSiaiObligaciones->consultarRegistro($llave)) {
            $this->idobligaciones = $llave;
            $this->arancel = $registro[0];
            $this->fechaemision = $registro[1];
            $this->fechaPago = $registro[2];
            $this->nui = $registro[3];
            $this->valor = $registro[4];
            $this->idarancel = $registro[5];
            $this->cuota = $registro[6];
            $this->ciclo = $registro[7];
            $this->anio = $registro[8];
            $this->npe = $registro[9];
            $this->descripcion = $registro[10];
            $this->estado = $registro[11];
            $this->codigobarras = $registro[12];
            $this->banco = $registro[13];
            $this->monto = $registro[14];
            $this->usuario = $registro[15];
            return true;
        } else {
            return false;
        }
    }

    //metodos Establecer(set)
    public function setIdObligaciones($id_obligaciones) {
        $this->idobligaciones = $id_obligaciones;
    }

    public function setArancel($arancel) {
        $this->arancel = $arancel;
    }

    public function setFechaEmision($fecha_emision) {
        $this->fechaemision = $fecha_emision;
    }

    public function setFechaPago($fecha_pago) {
        $this->fechapago = $fecha_pago;
    }

    public function setNui($nui) {
        $this->nui = $nui;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setIdArancel($id_arancel) {
        $caracteres = '000';
        $id_arancel = substr($caracteres, 0, strlen($caracteres) - strlen($id_arancel)) . $id_arancel;
        $this->idarancel = $id_arancel;
    }

    public function setCuota($cuota) {
        $this->cuota = $cuota;
    }

    public function setCiclo($ciclo) {
        $this->ciclo = $ciclo;
    }

    public function setAnio($anio) {
        $this->anio = $anio;
    }

    public function setNpe($npe) {
        $this->npe = $npe;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCodigoBarras($codigo_barras) {
        $this->codigobarras = $codigo_barras;
    }

    public function setBanco($banco) {
        $this->banco = $banco;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    //metodos Obtener(get)
    public function getIdObligaciones() {
        return $this->idobligaciones;
    }

    public function getArancel() {
        return $this->arancel;
    }

    public function getFechaEmision() {
        return $this->fechaemision;
    }

    public function getFechaPago() {
        return $this->fechapago;
    }

    public function getNui() {
        return $this->nui;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getIdArancel() {
        return $this->idarancel;
    }

    public function getCuota() {
        return $this->cuota;
    }

    public function getCiclo() {
        return $this->ciclo;
    }

    public function getAnio() {
        return $this->anio;
    }

    public function getNpe() {
        return $this->npe;
    }

    public function getNpeFormato() {
        $npe = '';

        for ($i = 0; $i < strlen($this->npe); $i++) {

            if ($i % 4 == 0) {
                $npe.=' ' . $this->npe[$i];
            } else {
                $npe.=$this->npe[$i];
            }
        }
        return $npe;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCodigoBarras() {
        return $this->codigobarras;
    }

    public function getBanco() {
        return $this->banco;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function generarCodigos() {
        $caracteres = '000000';
        $numero = ((int) $this->valor) . '00';
        $caracteres = substr($caracteres, 0, strlen($caracteres) - strlen($numero)) . $numero;
        $fecha = sumarDiasFecha($this->fechaemision, 3);
        $fecha = str_replace('-', '', $fecha);
        $npeMedio = $caracteres . $fecha . '00';

        $npeFinal = $this->nui . $this->idarancel . $this->cuota . $this->ciclo . substr($this->anio, 2, 2);
        $caracteres = '0000000000';
        $numero = ((int) $this->valor) . '00';
        $caracteres = substr($caracteres, 0, strlen($caracteres) - strlen($numero)) . $numero;
        //$caracteres=substr($caracteres,0,count($caracteres)-count($numero)).$numero;

        $barrasFinal = $caracteres . '(96)' . $fecha . '(8020)0' . $npeFinal;
        if ($this->cuota != 0) {
            $npeTemp = "0558" . $npeMedio . $npeFinal;
            $barras = "(415)7419700005971(3902)" . $barrasFinal;
        } else {
            $npeTemp = "0597" . $npeMedio . $npeFinal;
            $barras = "(415)7419700005582(3902)" . $barrasFinal;
        }
        $npeTemp = $npeTemp . $this->generarVerificador($npeTemp);
        $this->npe = $npeTemp;
        $this->codigobarras = $barras;
    }

    private function generarVerificador($npe) {
        $iImpares = 0;
        $iPares = 0;
        for ($i = 0; $i < strlen($npe); $i++) {
            if ($i % 2 == 0) {
                $impares[$iImpares] = (int) $npe[$i];
                $iImpares++;
            } else {
                $pares[$iPares] = (int) $npe[$i];
                $iPares++;
            }
        }
        $tImpares = 0;
        for ($i = 0; $i < count($impares); $i++) {
            $tImpares+=($impares[$i] * 2);
            if (($impares[$i] * 2) >= 10) {
                $tImpares+=1;
            }
        }
        $tPares = 0;
        for ($i = 0; $i < count($pares); $i++) {
            $tPares+=$pares[$i];
        }
        $A = (int) ($tImpares + $tPares);
        $B = (int) ($A / 10);
        $C = (int) ($B * 10);
        $D = (int) ($A - $C);
        $E = (int) (10 - $D);
        $F = (int) ($E / 10);
        $G = (int) ($F * 10);
        $VR = (int) ($E - $G);
        return $VR;
    }

    public function listaPorAtributos($ciclo, $anio, $usuario) {
        $consulta = "SELECT id_obligaciones as obligaciones FROM siai_obligaciones WHERE ciclo='$ciclo' AND anio='$anio' AND usuario='$usuario'";

        if ($registros = $this->conexionSiaiObligaciones->consulta($consulta)) {
            for ($i = 0; $i < count($registros); $i++) {
                $resultado[$i] = $registros[$i]['obligaciones'];
            }
            return $resultado;
        } else {
            return false;
        }
    }

    //metodo generador de listado
    public function getListadoSiaiObligacioness() {
        return $this->conexionSiaiObligaciones->listaLlaves("arancel", "ASC");
    }

    //metodo buscador de coincidencias
    public function buscarSiaiObligaciones($valor) {
        return $this->conexionSiaiObligaciones->buscar($valor, "arancel", "ASC");
    }

    //metodos relacionados a la base de datos
    public function insertSiaiObligaciones() {
        $atributos = array($this->arancel, $this->fechaemision, $this->fechapago, $this->nui, $this->valor, $this->idarancel, $this->cuota, $this->ciclo, $this->anio, $this->npe, $this->descripcion, $this->estado, $this->codigobarras, $this->banco, $this->monto, $this->usuario);
        //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
        //$atributos=array( $this->idobligaciones , $this->arancel , $this->fechaemision , $this->fechapago , $this->nui , $this->valor , $this->idarancel , $this->cuota , $this->ciclo , $this->anio , $this->npe , $this->descripcion , $this->estado , $this->codigobarras , $this->usuario );

        return $this->conexionSiaiObligaciones->insertarRegistro($atributos);
    }

    public function updateSiaiObligaciones() {
        $atributos = array($this->arancel, $this->fechaemision, $this->fechapago, $this->nui, $this->valor, $this->idarancel, $this->cuota, $this->ciclo, $this->anio, $this->npe, $this->descripcion, $this->estado, $this->codigobarras, $this->banco, $this->monto, $this->usuario);
        return $this->conexionSiaiObligaciones->actualizarRegistro($this->idobligaciones, $atributos);
    }

    public function buscarPorCarnet($_carnet, $_ciclo, $_anio) {
        $consulta = "SELECT * FROM siai.siai_obligaciones where usuario='" . $_carnet . "' and estado=0 and ciclo=" . $_ciclo . " and anio=" . $_anio . ";";

        if ($registros = $this->conexionSiaiObligaciones->consulta($consulta)) {
            return $registros;
        } else {
            return false;
        }
    }

    public function buscarPorNui($_nui, $_ciclo, $_anio) {
        $consulta = "SELECT * FROM siai.siai_obligaciones where nui='" . $_nui . "' and estado=0 and ciclo=" . $_ciclo . " and anio=" . $_anio . ";";

        if ($registros = $this->conexionSiaiObligaciones->consulta($consulta)) {
            return $registros;
        } else {
            return false;
        }
    }

    public function buscarPorCodigoBarras($_codigo, $_ciclo, $_anio) {
        $consulta = "SELECT * FROM siai.siai_obligaciones where codigo_barras='" . $_codigo . "' and estado=0 and ciclo=" . $_ciclo . " and anio=" . $_anio . ";";

        if ($registros = $this->conexionSiaiObligaciones->consulta($consulta)) {
            return $registros;
        } else {
            return false;
        }
    }

    public function existenObligaciones($_carnet) {
        $consulta = "SELECT count(id_obligaciones) as contador FROM siai.siai_obligaciones where usuario='" . $_carnet . "' and estado=0;";
        if ($registros = $this->conexionSiaiObligaciones->consulta($consulta)) {
            if ($registros[0]['contador'] > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
