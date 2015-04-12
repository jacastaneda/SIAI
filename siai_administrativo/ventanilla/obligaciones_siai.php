<?php
session_start();
require_once '../../clases/ClassConexion.php';
require_once '../../clases/ClassBanco.php';
if (($_SESSION["user"][0]["TIPO_USUAR"]) == "") {

    header("Location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
                <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
                <link href="jquery-ui-1.11.2.custom/jquery-ui.css" rel="stylesheet" />
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

                <script src="../bootstrap/js/jquery-1.8.3.js"></script>
                <script src="../bootstrap/js/bootstrap-collapse.js"></script> 
                <script src="../bootstrap/js/bootstrap-dropdown.js"></script> 
                <script src="../bootstrap/js/bootstrap-modal.js"></script>
                <script src="jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
                <style>
                    body {
                        padding-top: 150px;
                    }
                    #alertasAjax{
                        margin-left: 15px;
                        font-weight: bold;
                    }
                    .btnIP{
                        cursor: pointer;
                        font-weight: bold;
                        color: #006dcc;
                    }
                </style>
                <!-- InstanceBeginEditable name="doctitle" -->
                <title>SIAI</title>
                <!-- InstanceEndEditable -->
                <!-- InstanceBeginEditable name="head" -->
                <!-- InstanceEndEditable -->
                </head>

                <body>

                <?php
                include('../menu.php');
                ?>


                    <div class="container">
                        <div class=" well well-small"><!-- InstanceBeginEditable name="EditRegion3" -->
                            <h2>Obligaciones - Siai</h2>
                            <!-- InstanceEndEditable -->
                        </div>

                        <div class="well"><!-- InstanceBeginEditable name="EditRegion4" -->
                            <form class="form-inline">
                                Buscar por: <input type="radio" name="criteria" value="1" id="rb1"></input><label for="rb1">Carnet</label> &nbsp; <input type="radio" name="criteria" value="2" id="rb2"></input><label for="rb2">NUI</label> &nbsp; <input type="radio" name="criteria" value="3" id="rb3"></input><label for="rb3">Código de barras</label> &nbsp;<input type="text" id="criterioCarnet" name="criterioCarnet" placeholder="Criterio"></input><button id="btnBuscar">Buscar</button><span id="alertasAjax"></span>
                            </form>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Arancel</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Emisión</th>
                                        <th>NUI</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="dataGrid">
                                </tbody>
                            </table>
                            <!-- InstanceEndEditable -->
                        </div>
                        <div id="modal" class="modal hide fade">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3>Ingresar Pago</h3>
                            </div>
                            <div class="modal-body">
                                <span id="modalAlerts"></span>
                                <form class="form-actions">
                                    <select id="banco">
                                        <option value="-1">Seleccionar banco</option>
                                        <?php
                                        $bancos = new Bancos();
                                        $llaves = $bancos->getListadoBancos();
                                        foreach ($llaves as $llave):
                                            ?>
                                            <?php
                                            $bancos->setBancoPorLlave($llave);
                                            if ($bancos->getIdBancos() != -1):
                                                ?>
                                                <option id="<?php echo $bancos->getIdBancos(); ?>" value="<?php echo $bancos->getIdBancos(); ?>"><?php echo $bancos->getNombre(); ?></option>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                    <input type="text" id="monto" placeholder="Monto"></input>
                                    <input type="text" id="datepicker" placeholder="Fecha"></input>
                                    <input type="hidden" id="llave"></input>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</a>
                                <a href="#" id="save" class="btn btn-primary">Guardar</a>
                            </div>
                        </div>
                        <script type="text/javascript" src="js/obligaciones_siai.js"></script>
                        <footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
                    </div>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </body>
                <!-- InstanceEnd --></html>