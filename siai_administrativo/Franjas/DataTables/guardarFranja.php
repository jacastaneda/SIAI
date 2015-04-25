<?php
require_once 'funciones/conexiones.php';
$Ciclo = $_POST['txtCiclo'];
$Anio = $_POST['txtAnio'];
$CODIGO_CAR = $_POST['sltCODIGO_CAR'];
$PartesFechaHoraIni = explode('/', $_POST['txtFechaHoraIni']);
$PartesFechaHoraFin = explode('/', $_POST['txtFechaHoraFin']);
$FechaHoraIni = $PartesFechaHoraIni[2].'/'.$PartesFechaHoraIni[1].'/'.$PartesFechaHoraIni[0];
$FechaHoraFin = $PartesFechaHoraFin[2].'/'.$PartesFechaHoraFin[1].'/'.$PartesFechaHoraFin[0];

    $conF = Conectar();
    $sqlF = "INSERT INTO siai_franjas_inscripcion (ciclo, anio, CODIGO_CAR, fecha_hora_inicio, fecha_hora_fin) VALUES ($Ciclo,$Anio,'$CODIGO_CAR','$FechaHoraIni','$FechaHoraFin')";
//    echo $sqlF;
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
