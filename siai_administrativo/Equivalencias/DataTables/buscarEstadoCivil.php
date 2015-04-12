<?php

    $idEstadoCivil = $_POST['idEstadoCivil'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT idEstadoCivil, nombreEstadoCivil FROM PROC_EstadoCivil WHERE idEstadoCivil = '$idEstadoCivil'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreEstadoCivil = $datos['nombreEstadoCivil'];        
    }
    desconectar();
    $info['idEstadoCivil'] = $idEstadoCivil;
    $info['nombreEstadoCivil'] = $nombreEstadoCivil;       
    echo json_encode($info);
?>
