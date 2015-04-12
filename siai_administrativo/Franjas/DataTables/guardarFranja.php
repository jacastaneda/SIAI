<?php
require_once 'funciones/conexiones.php';
$idCiclo = $_POST['txtidCiclo'];
$CODIGO_CAR = $_POST['sltCODIGO_CAR'];
$FechaHoraIni = $_POST['txtFechaHoraIni'];
$FechaHoraFin = $_POST['txtFechaHoraFin'];

    $conF = Conectar();
    $sqlF = "INSERT INTO siai_franjas_inscripcion (id_ciclo, CODIGO_CAR, fecha_hora_inicio, fecha_hora_fin) VALUES ('$idCiclo','$CODIGO_CAR','$FechaHoraIni','$FechaHoraFin')";
    $qF = mysql_query($sqlF, $conF);
    if(!$qF){
        echo "Ha ocurrido un error en el procesamiento de la informacion";
        //echo mysql_errno($conF) . ": " . mysql_error($conF) . "\n";
    }
    else{
        echo "La Franja horaria ha sido almacenada satisfactoriamente...";
    }
    desconectar();    
    
?>
