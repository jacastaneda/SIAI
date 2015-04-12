<?php
require_once 'funciones/conexiones.php';
session_start();
echo '<option selected >---Seleccione una Facultad---</option>';
if($_POST['idUniversidad']){
    $idUniversidad=$_POST['idUniversidad'];
    $con = Conectar();
    $sql = "SELECT idFacultadEqui, nombreFacultadEqui FROM PROC_Facultades where idUniversidad= $idUniversidad";
    $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
    
    while($row = mysql_fetch_array($q)){
        $id=$row['idFacultadEqui'];
        $data=$row['nombreFacultadEqui'];
        echo '<option value="'.$id.'">'.$data.'</option>';
    }
    
    desconectar();
}
?>