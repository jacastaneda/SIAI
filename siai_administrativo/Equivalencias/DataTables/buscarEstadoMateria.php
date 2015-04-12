<?php

    $idEstadoMateriaSoli = $_POST['idEstadoMateriaSoli'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT idEstadoMateriaSoli, nombreEstadoMateria FROM PROC_EstadoMateria WHERE idEstadoMateriaSoli = '$idEstadoMateriaSoli'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreEstadoMateria = $datos['nombreEstadoMateria'];        
    }
    desconectar();
    $info['idEstadoMateriaSoli'] = $idEstadoMateriaSoli;
    $info['nombreEstadoMateria'] = $nombreEstadoMateria;       
    echo json_encode($info);
?>
