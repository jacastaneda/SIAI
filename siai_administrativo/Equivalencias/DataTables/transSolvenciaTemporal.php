<?php
    include_once("../../clases/ClassControl.php");
    $control = new ClassControl();
    $carnet=$_POST['carnet'];
    $trans=$_POST['trans'];
    $ciclo_anio_actual=$control->CicloAnioActual();
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    if($trans == 'ins')
    {
        $sql = "INSERT INTO proc_solvencia_temporal(CARNET, CICLO) VALUES('$carnet', '$ciclo_anio_actual')";
        $msj="Solvencia temporal guardada correctamente";
    }
    elseif($trans == 'del')
    {
       $sql = "DELETE FROM proc_solvencia_temporal WHERE CARNET = '$carnet' AND CICLO ='$ciclo_anio_actual'"; 
       $msj="Solvencia temporal eliminada";
    }
    
    if(mysql_query($sql, $con))
    {
        echo $msj;
    }
    else
    {
        echo 'No se pudo realizar la transaccion';
    }
?>
