<?php
require_once 'funciones/conexiones.php';
$idSolicitudEqui = $_POST['txtidSolicitudEqui'];
$fechaIngreSolicitud = $_POST['txtfechaIngreSolicitud'];
$idEstadoSolicitudEqui = $_POST['txtidEstadoSolicitudEqui'];
$numeroCarne = $_POST['txtnumeroCarne'];
$nombresSolicitante = $_POST['txtnombresSolicitante'];
$PrimerApellidoSolicitante = $_POST['txtPrimerApellidoSolicitante'];
$segundoApellidoSolicitante = $_POST['txtsegundoApellidoSolicitante'];
$apellidoCasadaSolicitante = $_POST['txtapellidoCasadaSolicitante'];
$idCatedratico = $_POST['txtidCatedratico'];
$fecha_cast=date("Y-m-d",strtotime($fechaIngreSolicitud));


    $conF = Conectar();
    $sqlF = "insert into proc_solicitudequivalencia (
            idSolicitudEqui,idEstadoSolicitudEqui,fechaIngreSolicitud,
            numeroCarne,nombresSolicitante,PrimerApellidoSolicitante,
            segundoApellidoSolicitante,apellidoCasadaSolicitante,idCatedratico) values('$idSolicitudEqui','$idEstadoSolicitudEqui','$fecha_cast',
            '$numeroCarne','$nombresSolicitante','$PrimerApellidoSolicitante','$segundoApellidoSolicitante','$apellidoCasadaSolicitante','$idCatedratico')";
    $qF = mysql_query($sqlF, $conF);
    if(!$qF){
        echo "Ha ocurrido un error en el procesamiento de la informacion";
        //echo mysql_errno($conF) . ": " . mysql_error($conF) . "\n";
    }
    else{
        echo "La Solicitud ha sido almacenada satisfactoriamente...";
    }
    desconectar();    
    
?>
