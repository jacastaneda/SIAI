<?php
require_once 'funciones/conexiones.php';
session_start();
$Accion = $_POST['Accion'];
$idCatedratico = $_POST['idCatedratico'];
$con = Conectar();
$sql = "select idCatedratico, Nombres, Apellidos FROM proc_catedraticos where Estado=1 and idCargo=2";
$q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
echo '<option selected="selected">---Seleccione un Coordinador---</option>';
while($row = mysql_fetch_array($q)){
    $id=$row['idCatedratico'];
    $Nombres=$row['Nombres'];
    $Apellidos=$row['Apellidos'];
    if ($Accion =='Nuevo'){
        echo '<option value="'.$id.'">'.$Nombres.' '.$Apellidos.'</option>';
    }
    elseif ($Accion =='Editar'){
        if($idCatedratico == $id){
            echo '<option selected value="'.$id.'">'.$Nombres.' '.$Apellidos.'</option>';
        }
        else{
            echo '<option value="'.$id.'">'.$Nombres.' '.$Apellidos.'</option>';
        }
    }
}    
desconectar();
?>