<?php
require_once '../../Franjas/Datatables/funciones/conexiones.php';
//txtCODIGO,sltTipoUsuar,sltidCatedratico,txtNombre,txtClave,txtClaveConfirm,sltEstado
$CODIGO = $_POST['paramCODIGO'];
$id_catedratico = $_POST['paramIdCatedratico'];
$NOMBRE=$_POST['txtNombre'];
$CLAVE = (isset($_POST['txtClave']) && ! empty($_POST['txtClave'])) ? md5($_POST['txtClave']) : '' ;
$CLAVE_CONFIRM=md5(isset($_POST['txtClaveConfirm']) && ! empty($_POST['txtClaveConfirm'])) ? md5($_POST['txtClaveConfirm']) : '' ;
$email = $_POST['txtEmail'];

    if(trim($CLAVE) !== trim($CLAVE_CONFIRM) && trim($CLAVE) !='')
    {
        die('0,Las claves no coinciden');
    }
    
    $con = Conectar();
    $sql = "UPDATE usuarios SET NOMBRE='$NOMBRE' ";
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
        if(trim($id_catedratico) !== '')
        {
            $sqlUC="UPDATE proc_catedraticos SET email='$email' WHERE idCatedratico=$id_catedratico";
            $q = mysql_query($sqlUC, $con);
        }
        
        echo "1,Su usuario ha sido actualizado satisfactoriamente...";
    }
    desconectar();        


?>
