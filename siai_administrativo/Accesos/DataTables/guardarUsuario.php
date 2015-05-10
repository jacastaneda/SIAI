<?php
require_once '../../Franjas/Datatables/funciones/conexiones.php';

//txtCODIGO,sltTipoUsuar,sltidCatedratico,txtNombre,txtClave,txtClaveConfirm,sltEstado
$CODIGO = $_POST['txtCODIGO'];
$TIPO_USUAR = $_POST['sltTipoUsuar'];
$idCatedratico = (isset($_POST['sltidCatedratico']) && ! empty($_POST['sltidCatedratico'])) ? $_POST['sltidCatedratico'] : 'null' ;
$NOMBRE=$_POST['txtNombre'];
$CLAVE = md5($_POST['txtClave']);
$CLAVE_CONFIRM=md5($_POST['txtClaveConfirm']);
$estado = $_POST['sltEstado'];
//print_R($_POST);
//TODO: validar si el usuario (CODIGO) esta repetido, validar si las contrasenias coinciden

    if(trim($CLAVE) == trim($CLAVE_CONFIRM))
    {
        $conU = Conectar();

        $sqlC="SELECT CODIGO FROM usuarios WHERE LOWER(TRIM(CODIGO))='".strtolower(trim($CODIGO))."'";
        $qC = mysql_query($sqlC, $conU);
        if(mysql_num_rows($qC) > 0)
        {
            echo "0,Ya existe un usuario $CODIGO registrado en el sistema";
        }
        else
        {
            $sqlU = "INSERT INTO usuarios (CODIGO, TIPO_USUAR, idCatedratico, NOMBRE, CLAVE, Estado) 
                     VALUES ('$CODIGO',$TIPO_USUAR, $idCatedratico, '$NOMBRE', '$CLAVE', $estado)";
        //    echo $sqlU;
            $qU = mysql_query($sqlU, $conU);
            if(!$qU)
            {
                echo "0,Ha ocurrido un error en el procesamiento de la informacion ";
            }
            else
            {
                echo "1,El usuario ha sido almacenado satisfactoriamente...";
            }        
        }

        desconectar();        
    }
    else
    {
        echo '0,Las claves no coinciden';
    }
        

    
?>
