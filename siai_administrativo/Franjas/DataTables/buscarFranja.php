<?php
    $idFranja = $_POST['idFranja'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT * FROM siai_franjas_inscripcion WHERE id_franja = '$idFranja'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $ciclo = $datos['ciclo'];
        $anio = $datos['anio'];
        $id_franja = $datos['id_franja'];
        $CODIGO_CAR = $datos['CODIGO_CAR'];
        $fecha_hora_inicio = $datos['fecha_hora_inicio'];
        $fecha_hora_fin = $datos['fecha_hora_fin'];
    }
    desconectar();
    $info['ciclo'] = $ciclo;
    $info['anio'] = $anio;
    $info['id_franja'] = $id_franja;  
    $info['CODIGO_CAR'] = $CODIGO_CAR;  
    $info['fecha_hora_inicio'] = $fecha_hora_inicio;  
    $info['fecha_hora_fin'] = $fecha_hora_fin;      
         
    echo json_encode($info);
?>
