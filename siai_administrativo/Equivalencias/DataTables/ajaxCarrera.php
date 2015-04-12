<?php
require_once 'funciones/conexiones.php';
session_start();
echo '<option value="0" selected>---Seleccione una Carrera---</option>';
    $idUniversidad=$_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];      
    $con = Conectar();
    $sql = "SELECT idCarrera, nombreCarreraEquivalencia FROM PROC_Carreras where idUniversidad= $idUniversidad and idFacultadEqui= $idFacultadEqui";
    $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
    
    while($row = mysql_fetch_array($q)){
        $id=$row['idCarrera'];
        $data=$row['nombreCarreraEquivalencia'];
        echo '<option value="'.$id.'">'.$data.'</option>';
    }
    desconectar();
?>