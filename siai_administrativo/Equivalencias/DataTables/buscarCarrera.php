<?php
    require_once 'funciones/conexiones.php';
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarrera = $_POST['idCarrera'];
    
    
    $con = Conectar();
    $sql = "SELECT nombreCarreraEquivalencia FROM PROC_Carreras WHERE idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui' and idCarrera = '$idCarrera'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreCarreraEquivalencia = $datos['nombreCarreraEquivalencia'];        
    }
    desconectar();
    $info['idUniversidad'] = $idUniversidad;
    $info['idFacultadEqui'] = $idFacultadEqui;
    $info['idCarrera'] = $idCarrera;
    $info['nombreCarreraEquivalencia'] = $nombreCarreraEquivalencia;       
    echo json_encode($info);
    
?>

