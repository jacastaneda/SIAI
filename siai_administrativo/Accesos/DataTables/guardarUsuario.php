<?php
require_once '../../Franjas/Datatables/funciones/conexiones.php';

//txtCODIGO,sltTipoUsuar,sltidCatedratico,txtNombre,txtClave,txtClaveConfirm,sltEstado
$CODIGO = $_POST['txtCODIGO'];
$TIPO_USUAR = $_POST['sltTipoUsuar'];
$idCatedratico = (isset($_POST['sltidCatedratico']) && ! empty($_POST['sltidCatedratico'])) ? $_POST['sltidCatedratico'] : 'null' ;
$NOMBRE=$_POST['txtNombre'];
$CLAVE = md5($_POST['txtClave']);
$CLAVE_CONFIRM=$_POST['txtClaveConfirm'];
$estado = $_POST['sltEstado'];
//print_R($_POST);
//TODO: validar si el usuario (CODIGO) esta repetido, validar si las contrasenias coinciden

    $conU = Conectar();
    
    $sqlC="SELECT CODIGO FROM usuarios WHERE LOWER(TRIM(CODIGO))='".strtolower(trim($CODIGO))."'";
    $qC = mysql_query($sqlC, $conU);
    
    
    $sqlU = "INSERT INTO usuarios (CODIGO, TIPO_USUAR, idCatedratico, NOMBRE, CLAVE, Estado) 
             VALUES ('$CODIGO',$TIPO_USUAR, $idCatedratico, '$NOMBRE', '$CLAVE', $estado)";
//    echo $sqlU;
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion ";
    }
    else
    {
        echo "El usuario ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>
