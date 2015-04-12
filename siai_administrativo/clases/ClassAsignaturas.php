<?php

require_once("ClassConexion2.php");

class ClassAsignaturas extends Conexion {

    public function mostrarAsignaturas($CODIGO) {
        if ($CODIGO <> "") {
            $sql = "select CODIGO,NOMBRE from asignatura WHERE NOMBRE LIKE '%" . $CODIGO . "%'";
            return $this->consulta($sql);
        }
    }

    public function CodCarreras($idCatedraticos) {


        $sql = "select * from proc_coordinadorcarrera where idCatedratico='" . $idCatedraticos . "'";

        $carreras = "";
        if (is_array($this->consulta($sql))) {
            foreach ($this->consulta($sql) as $c) {

                $carreras = $c["CODIGO_CAR"] . "," . $carreras;
            }
        }
        return trim($carreras, ",");
    }

}