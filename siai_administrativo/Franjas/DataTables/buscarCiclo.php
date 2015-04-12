<?php

    $idCiclo = $_POST['idCiclo'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT id_ciclo, anio, num_ciclo, ciclo, activo FROM siai_ciclos WHERE id_ciclo = '$idCiclo'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $ciclo = $datos['ciclo'];
        $anio = $datos['anio'];
        $num_ciclo = $datos['num_ciclo'];
        $activo = $datos['activo'];
    }
    desconectar();
    $info['id_ciclo'] = $idCiclo;
    $info['ciclo'] = $ciclo;  
    $info['anio'] = $anio;  
    $info['num_ciclo'] = $num_ciclo;    
    $info['activo'] = $activo;  
    echo json_encode($info);
?>
