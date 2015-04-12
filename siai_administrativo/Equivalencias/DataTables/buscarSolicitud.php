<?php
    require_once 'funciones/conexiones.php';
    $idSolicitud = $_POST['idSolicitud'];
    
    
    $con = Conectar();
    $sql = "SELECT nombreFacultadEqui , idFacultadUPES FROM PROC_Facultades WHERE idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreFacultadEqui = $datos['nombreFacultadEqui'];
        $idFacultadUPES = $datos['idFacultadUPES'];
    }
    desconectar();
    $info['idUniversidad'] = $idUniversidad;
    $info['idFacultadEqui'] = $idFacultadEqui;
    $info['nombreFacultadEqui'] = $nombreFacultadEqui;       
    $info['idFacultadUPES'] = $idFacultadUPES;       
    echo json_encode($info);
    
?>

