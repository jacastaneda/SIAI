<?php
require_once 'funciones/conexiones.php';
$idFranja = $_POST['txtidFranja'];
$Ciclo = $_POST['txtCiclo'];
$Anio = $_POST['Anio'];
$CODIGO_CAR = $_POST['sltCODIGO_CAR'];
$PartesFechaHoraIni = explode('/', $_POST['txtFechaHoraIni']);
$PartesFechaHoraFin = explode('/', $_POST['txtFechaHoraFin']);
$FechaHoraIni = $PartesFechaHoraIni[2].'/'.$PartesFechaHoraIni[1].'/'.$PartesFechaHoraIni[0];
$FechaHoraFin = $PartesFechaHoraFin[2].'/'.$PartesFechaHoraFin[1].'/'.$PartesFechaHoraFin[0];

    $con = Conectar();
    $sql = "UPDATE siai_franjas_inscripcion SET CODIGO_CAR = '$CODIGO_CAR', fecha_hora_inicio = '$FechaHoraIni', fecha_hora_fin = '$FechaHoraFin' WHERE id_franja = '$idFranja'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "La Franja horaria ha sido actualizada satisfactoriamente...";
   }
   desconectar();
?>
