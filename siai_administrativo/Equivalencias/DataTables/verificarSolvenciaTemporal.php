<?php
    include_once("../../clases/ClassControl.php");
    $control = new ClassControl();
    $carnet=$_POST['carnet'];
    $ciclo_anio_actual=$control->CicloAnioActual();
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT * FROM proc_solvencia_temporal WHERE CARNET = '$carnet' AND CICLO ='$ciclo_anio_actual'";
    $q = mysql_query($sql, $con);
    echo mysql_num_rows($q);
?>
