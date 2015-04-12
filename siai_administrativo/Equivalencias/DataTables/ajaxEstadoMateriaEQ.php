<?php
require_once 'funciones/conexiones.php';
session_start();    
    $idEstadoMateriaSoli=$_POST['idEstadoMateriaSoli'];
    $Accion = $_POST['Accion'];

    $con = Conectar();
    $sql = "SELECT idEstadoMateriaSoli,nombreEstadoMateria FROM proc_estadoMateria";
    $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
    echo '<option selected="selected">---Seleccione un Estado---</option>';
    while($row = mysql_fetch_array($q)){
        $id=$row['idEstadoMateriaSoli'];
        $data=$row['nombreEstadoMateria'];
        if ($Accion == 'Nuevo'){
            echo '<option value="'.$id.'">'.$data.'</option>';
        }
        elseif($Accion == 'Editar'){
            if ($idEstadoMateriaSoli == $id) {
                echo '<option selected value="'.$id.'">'.$data.'</option>';
            }
            else {
                echo '<option value="'.$id.'">'.$data.'</option>';
            }            
        }        
    }    
    desconectar();
?>