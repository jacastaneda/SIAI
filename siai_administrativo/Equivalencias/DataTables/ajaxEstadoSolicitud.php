<?php
require_once 'funciones/conexiones.php';
session_start();
$Accion = $_POST['Accion'];
$idEstado = $_POST['idEstado'];
$con = Conectar();
$sql = "select idEstadoSolicitudEqui, nombreEstadoSoliEqui FROM proc_estadosoliequivalencia where estadoActivado= 1";
$q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
echo '<option selected="selected">---Seleccione un Estado---</option>';
while($row = mysql_fetch_array($q)){
    $id=$row['idEstadoSolicitudEqui'];
    $data=$row['nombreEstadoSoliEqui'];
    if ($Accion =='Nuevo'){
        echo '<option value="'.$id.'">'.$data.'</option>';
    }
    elseif ($Accion =='Editar'){
        if($idEstado == $id){
            echo '<option selected value="'.$id.'">'.$data.'</option>';
        }
        else{
            echo '<option value="'.$id.'">'.$data.'</option>';
        }
    }
}    
desconectar();
?>