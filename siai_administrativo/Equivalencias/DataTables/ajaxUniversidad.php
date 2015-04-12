<?php
require_once 'funciones/conexiones.php';
session_start();

    $con = Conectar();
    $sql = "SELECT idUniversidad, nombreUniversidad FROM proc_universidades";
    $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
    echo '<option selected="selected">---Seleccione una Universidad---</option>';
    while($row = mysql_fetch_array($q)){
        $id=$row['idUniversidad'];
        $data=$row['nombreUniversidad'];
        echo '<option value="'.$id.'">'.$data.'</option>';
    }
    
    desconectar();
?>