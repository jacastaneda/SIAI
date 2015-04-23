<?php
require_once 'funciones/conexiones.php';
$idFranja = $_POST['txtidFranja'];
$Ciclo = $_POST['txtCiclo'];
$Anio = $_POST['Anio'];
$CODIGO_CAR = $_POST['txtCODIGO_CAR'];
$FechaHoraIni = $_POST['txtFechaHoraIni'];
$FechaHoraFin = $_POST['txtFechaHoraFin'];

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
