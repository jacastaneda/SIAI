<?php
    require_once 'funciones/conexiones.php';
    $idCarnet = $_POST['idCarnet'];
    $con = Conectar();
    $sql = "select CARNET,NOMBRES,APELLIDO1, APELLIDO2,APELLCASAD from expedientealumno where CARNET='$idCarnet'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))    {
        $NOMBRES = $datos['NOMBRES'];
        $APELLIDO1 = $datos['APELLIDO1'];
        $APELLIDO2 = $datos['APELLIDO2'];
        $APELLCASAD = $datos['APELLCASAD'];
    }
    desconectar();
    $info['NOMBRES'] = $NOMBRES;
    $info['APELLIDO1'] = $APELLIDO1;
    $info['APELLIDO2'] = $APELLIDO2;       
    $info['APELLCASAD'] = $APELLCASAD;       
    echo json_encode($info);  
?>

