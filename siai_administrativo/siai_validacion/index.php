<?php
session_start();
include_once("clases/ClassConexion.php");

include_once("clases/ClassControl.php");
include_once("clases/ClassExpedientealumno.php");
include_once("clases/ClassAsesoria.php");
include_once("clases/ClassCarrera.php");
require_once("../clases/ClassAsignaturas.php");

/*
  if(($_SESSION["user"][0]["TIPO_USUAR"])==""){
  header ("Location: index.php");
  }
 */
$Asignaturas = new ClassAsignaturas();
$control = new Control();
$control->setControlPorLlave('ANO_C');
$anio = $control->getConsecutiv();
$control->setControlPorLlave('CICLOACT');
$ciclo_actual = $control->getConsecutiv();
//var_dump($_SESSION["user"]);
$carrerasCodigos = $Asignaturas->CodCarreras($_SESSION["user"][0]["idCatedratico"]);
//echo $carrerasCodigos;
$asesoria = new Asesoria();
$carnets = $asesoria->getPendientesAprobacion(0, $carrerasCodigos);
$pendientes;
for ($i = 0; $i < count($carnets); $i++) {
    $expediente = new Expedientealumno();
    $expediente->setExpedientealumnoPorLlave($carnets[$i]['CARNET']);
    $carrera = new Carrera();
    $carrera->setCarreraPorLlave($expediente->getCodcarrera());
    $pendientes[$i][0] = $expediente->getCarnet();
    $pendientes[$i][1] = $expediente->getNombres() . ' ' . $expediente->getApellido1() . ' ' . $expediente->getApellido2();
    $pendientes[$i][2] = $carrera->getNombre();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
                <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


                <script src="../bootstrap/js/jquery-1.8.3.js"></script>
                <script src="../bootstrap/js/bootstrap-collapse.js"></script> 
                <script src="../bootstrap/js/bootstrap-dropdown.js"></script> 
                <script src="../bootstrap/js/bootstrap-modal.js"></script> 
                <style>
                    body {
                        padding-top: 150px;
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
                            <h3>Validación de Inscripción</h3>
                            <!-- InstanceEndEditable --></div>

                        <div class="well"><!-- InstanceBeginEditable name="EditRegion4" -->
                            <div style="background-color:#FFF">
                                <table width="800"  align="center" class="table table-bordered table-hover" >
                                    <tr>
                                        <th width="10%"><div align="center">Carné</div></th>
                                        <th width="40%"><div align="center">Nombre Completo</div></th>
                                        <th width="30%"><div align="center">Carrera</div></th>
                                        <th width="20%"><div align="center">Opciones</div></th>
                                    </tr>
                                    <?php
                                    $fill = true;
                                    for ($i = 0; $i < count($pendientes); $i++):
                                        ?>
                                        <tr <?php
                                        if ($fill) {
                                            echo 'class="fill"';
                                            $fill = false;
                                        } else {
                                            $fill = true;
                                        }
                                        ?>>
                                            <td><?php echo $pendientes[$i][0]; ?></td>
                                            <td><?php echo $pendientes[$i][1]; ?></td>
                                            <td><?php echo $pendientes[$i][2]; ?></td>
                                            <td class="opciones"><a href="detalle_inscripcionN.php?estudiante=<?php echo $pendientes[$i][0]; ?>" class="btn "><!--<img src="imagenes/btn_detalle.png" class="opcion" title="Ver detalle de inscripción" border="0"/> --><span class=" icon-edit"></span>  Validar</a>  <a href="pdf/pensum.php?estudiante=<?php echo $pendientes[$i][0]; ?>" target="_blank" class="btn"> <!--<img src="imagenes/btn_pensum_mini.png" class="opcion" title="Ver pensum del alumno" /> --> <span class="icon-eye-open "></span> Pensum</a></td>
                                        </tr>
<?php endfor; ?>
                                </table>
                            </div>
                            <!-- InstanceEndEditable --></div>
                        <footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
                    </div>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </body>
                <!-- InstanceEnd --></html>
