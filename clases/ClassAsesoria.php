<?php

/*
 * ClassAsesoria.php
 * version 1.0
 *
 */

class Asesoria {

    private $carnet;
    private $codigoasi;
    private $matricula;
    private $seccion;
    private $codigousu;
    private $fechaingr;
    private $marcar;
    private $arancel;
    private $cupo;
    private $ciclo;
    //Objeto gestionador de base de datos
    private $conexionAsesoria;

    public function __construct() {
        $atributos = array("CODIGO_ASI", "MATRICULA", "SECCION", "CODIGO_USU", "FECHA_INGR", "MARCAR", "ARANCEL", "CUPO", "CICLO");
        $this->conexionAsesoria = new MySQL();
        $this->conexionAsesoria->setNombreTabla("asesoria");
        $this->conexionAsesoria->setNombreAtributos($atributos);
        $this->conexionAsesoria->setNombreLlavePrimaria("CARNET");
    }

    public function setAsesoriaPorLlave($carnet, $asignatura, $matricula) {
        $consulta = "SELECT CARNET, CODIGO_ASI, MATRICULA, SECCION, CODIGO_USU, FECHA_INGR, MARCAR, ARANCEL, CUPO, CICLO FROM asesoria WHERE CARNET='" . $carnet . "' AND CODIGO_ASI='" . $asignatura . "' AND MATRICULA='" . $matricula . "'";
        if ($registro = $this->conexionAsesoria->consulta($consulta)) {
            $this->carnet = $registro[0][0];
            $this->codigoasi = $registro[0][1];
            $this->matricula = $registro[0][2];
            $this->seccion = $registro[0][3];
            $this->codigousu = $registro[0][4];
            $this->fechaingr = $registro[0][5];
            $this->marcar = $registro[0][6];
            $this->arancel = $registro[0][7];
            $this->cupo = $registro[0][8];
            $this->ciclo = $registro[0][9];
            return true;
        } else {
            return false;
        }
    }

    //metodos Establecer(set)
    public function setConexion($cnx) {
        $this->conexionAsesoria = $cnx;
        $atributos = array("CODIGO_ASI", "MATRICULA", "SECCION", "CODIGO_USU", "FECHA_INGR", "MARCAR", "ARANCEL", "CUPO", "CICLO");
        $this->conexionAsesoria->setNombreTabla("asesoria");
        $this->conexionAsesoria->setNombreAtributos($atributos);
        $this->conexionAsesoria->setNombreLlavePrimaria("CARNET");
    }

    public function setCarnet($CARNET) {
        $this->carnet = $CARNET;
    }

    public function setCodigoAsi($CODIGO_ASI) {
        $this->codigoasi = $CODIGO_ASI;
    }

    public function setMatricula($MATRICULA) {
        $this->matricula = $MATRICULA;
    }

    public function setSeccion($SECCION) {
        $this->seccion = $SECCION;
    }

    public function setCodigoUsu($CODIGO_USU) {
        $this->codigousu = $CODIGO_USU;
    }

    public function setFechaIngr($FECHA_INGR) {
        $this->fechaingr = $FECHA_INGR;
    }

    public function setMarcar($MARCAR) {
        $this->marcar = $MARCAR;
    }

    public function setArancel($ARANCEL) {
        $this->arancel = $ARANCEL;
    }

    public function setCupo($CUPO) {
        $this->cupo = $CUPO;
    }

    public function setCiclo($CICLO) {
        $this->ciclo = $CICLO;
    }

    public function borrarRegistros($carnet) {
        $consulta = "SELECT CARNET, CODIGO_ASI, MATRICULA, SECCION, CODIGO_USU, FECHA_INGR, MARCAR, ARANCEL, CUPO, CICLO FROM asesoria WHERE CARNET='" . $carnet . "' AND MARCAR='0'";
        if ($asesorias = $this->conexionAsesoria->consulta($consulta)) {
            $control = new Control();
            $control->setControlPorLlave('ANO_C');
            $anio = $control->getConsecutiv();
            $control->setControlPorLlave('CICLOACT');
            $ciclo_actual = $control->getConsecutiv();
            if (strlen($ciclo_actual) < 2) {
                $ciclo_actual = '0' . $ciclo_actual;
            }
            $ciclo = $ciclo_actual . '/' . $anio;
            for ($i = 0; $i < count($asesorias); $i++) {
                $consulta = "SELECT RESERVACIO, DISPONIBLE  FROM secciones WHERE CICLO='$ciclo' AND CODIGO_ASI='" . $asesorias[$i][1] . "'";
                $seccion = $this->conexionAsesoria->consulta($consulta);
                $query_update = "UPDATE secciones SET RESERVACIO='" . ($seccion[0]['RESERVACIO'] - 1) . "' AND DISPONIBLE='" . ($seccion[0]['DISPONIBLE'] + 1) . "' WHERE CICLO='$ciclo'  AND  CODIGO_ASI='" . $asesorias[$i]['CODIGO_ASI'] . "'";
                $this->conexionAsesoria->conectarse();
                $this->conexionAsesoria->ejecutarQuery($query_update);
                $this->conexionAsesoria->desconectarse();
            }

            $consulta = "DELETE FROM asesoria WHERE CARNET='$carnet' AND MARCAR='0'";
            $this->conexionAsesoria->conectarse();
            $this->conexionAsesoria->ejecutarQuery($consulta);
            $this->conexionAsesoria->desconectarse();
        }
    }

    //metodos Obtener(get)
    public function getConexion() {
        return $this->conexionAsesoria;
    }

    public function getCarnet() {
        return $this->carnet;
    }

    public function getCodigoAsi() {
        return $this->codigoasi;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getSeccion() {
        return $this->seccion;
    }

    public function getCodigoUsu() {
        return $this->codigousu;
    }

    public function getFechaIngr() {
        return $this->fechaingr;
    }

    public function getMarcar() {
        return $this->marcar;
    }

    public function getArancel() {
        return $this->arancel;
    }

    public function getCupo() {
        return $this->cupo;
    }

    public function getCiclo() {
        return $this->ciclo;
    }

    //metodo generador de listado
    public function getListadoAsignaturas($carnet, $fecha_inicio) {
        $consulta = "SELECT CODIGO_ASI, MATRICULA FROM asesoria WHERE CARNET='" . $carnet . "' AND FECHA_INGR>='" . $fecha_inicio . "'";
        return $this->conexionAsesoria->consulta($consulta);
    }

    public function getListadoAsignaturasPorInscribir($carnet) {
        $consulta = "SELECT CODIGO_ASI,SECCION FROM siai.asesoria where CARNET='" . $carnet . "';";
        return $this->conexionAsesoria->consulta($consulta);
    }

    //metodo buscador de coincidencias
    public function buscarAsesoria($valor) {
        return $this->conexionAsesoria->buscar($valor, "CODIGO_ASI", "ASC");
    }

    public function iniciarTransaccion() {
        $this->conexionAsesoria->conectarse();
        $this->conexionAsesoria->desactivarAutoCommit();
    }

    //metodos relacionados a la base de datos
    public function transaccionAsesoria() {


        $consulta = "INSERT INTO asesoria (CARNET, CODIGO_ASI, MATRICULA, SECCION, CODIGO_USU, FECHA_INGR, MARCAR, ARANCEL, CUPO, CICLO) VALUES ('" . $this->carnet . "', '" . $this->codigoasi . "', '" . $this->matricula . "', '" . $this->seccion . "', 0, '" . $this->fechaingr . "', 0, '" . $this->arancel . "', 0, '" . $this->ciclo . "');";

        //echo $consulta;
        //exit();
        return $this->conexionAsesoria->ejecutarQuery($consulta);
    }

    public function finalizarTransaccion($valor) {
        if ($valor) {
            $this->conexionAsesoria->commit();
            return true;
        } else {
            $this->conexionAsesoria->rollback();
            return false;
        }
    }

    public function insertAsesoria() {
        $atributos = array($this->codigoasi, $this->matricula, $this->seccion, $this->codigousu, $this->fechaingr, $this->marcar, $this->arancel, $this->cupo, $this->ciclo);
        //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
        //$atributos=array( $this->carnet , $this->codigoasi , $this->matricula , $this->seccion , $this->codigousu , $this->fechaingr , $this->marcar , $this->arancel , $this->cupo , $this->ciclo );

        return $this->conexionAsesoria->insertarRegistro($atributos);
    }

    public function updateAsesoria() {
        $atributos = array($this->codigoasi, $this->matricula, $this->seccion, $this->codigousu, $this->fechaingr, $this->marcar, $this->arancel, $this->cupo, $this->ciclo);
        return $this->conexionAsesoria->actualizarRegistro($this->carnet, $atributos);
    }

    public function isAprobado($_carnet) {
        $consulta = "SELECT count(CARNET) as contador FROM `siai`.`asesoria` where CARNET = '" . $_carnet . "' and MARCAR = '0' and CUPO = '0' ;";
        if ($registro = $this->conexionAsesoria->consulta($consulta)) {
            if ($registro[0]['contador'] > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

}