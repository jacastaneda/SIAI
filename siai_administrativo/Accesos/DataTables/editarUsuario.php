<?php
require_once '../../Franjas/Datatables/funciones/conexiones.php';
//txtCODIGO,sltTipoUsuar,sltidCatedratico,txtNombre,txtClave,txtClaveConfirm,sltEstado
$CODIGO = $_POST['txtCODIGO'];
$TIPO_USUAR = $_POST['sltTipoUsuar'];
$idCatedratico = (isset($_POST['sltidCatedratico']) && ! empty($_POST['sltidCatedratico'])) ? $_POST['sltidCatedratico'] : 'null' ;
$NOMBRE=$_POST['txtNombre'];
$CLAVE = (isset($_POST['txtClave']) && ! empty($_POST['txtClave'])) ? md5($_POST['txtClave']) : '' ;
$CLAVE_CONFIRM=md5(isset($_POST['txtClaveConfirm']) && ! empty($_POST['txtClaveConfirm'])) ? md5($_POST['txtClaveConfirm']) : '' ;
$estado = $_POST['sltEstado'];

    if(trim($CLAVE) !== trim($CLAVE_CONFIRM) && trim($CLAVE) !='')
    {
        die('0,Las claves no coinciden');
    }
    
    $con = Conectar();
    $sql = "UPDATE usuarios SET TIPO_USUAR=$TIPO_USUAR, idCatedratico=$idCatedratico, NOMBRE='$NOMBRE', Estado='$estado'";
    if(trim($CLAVE) != '')
    {
        $sql.=" ,CLAVE='".$CLAVE."'";
    }
    $sql.=" WHERE CODIGO='$CODIGO'";

    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "0,Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "1,El Usuario ha sido actualizado satisfactoriamente...";
    }
    desconectar();        


?>
