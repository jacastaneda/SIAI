<?php

    $idEstadoSolicitudEqui = $_POST['idEstadoSolicitudEqui'];
    
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT idEstadoSolicitudEqui, nombreEstadoSoliEqui, estadoActivado, descripcionEstado FROM PROC_EstadoSoliEquivalencia WHERE idEstadoSolicitudEqui = '$idEstadoSolicitudEqui'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreEstadoSoliEqui = $datos['nombreEstadoSoliEqui'];        
        $estadoActivado =   $datos['estadoActivado'];
        $descripcionEstado =  $datos['descripcionEstado'];
    }
    desconectar();
    $info['idEstadoSolicitudEqui'] = $idEstadoSolicitudEqui;
    $info['nombreEstadoSoliEqui'] = $nombreEstadoSoliEqui;       
    $info['estadoActivado'] = $estadoActivado;
    $info['descripcionEstado'] = $descripcionEstado;
    echo json_encode($info);
?>
