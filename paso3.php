<?php
session_start();
include_once("clases/ClassConexion.php");
include_once("clases/ClassAsesoria.php");
include_once("clases/ClassControl.php");
include_once("clases/ClassProcSolicituddeequivalencia.php");
include_once("clases/ClassExpedientealumno.php");
include_once("clases/ClassNotash.php");
include_once("clases/ClassHorarios.php");
include_once("clases/ClassHordetalle.php");
include_once("clases/ClassSecciones.php");
include_once("clases/ClassAsignatura.php");
include_once("clases/ClassPrerrequisitos.php");
include_once('clases/ClassSiaiControl.php');
include_once('clases/ClassSiaiUsuario.php');

if (isset($_SESSION['siai']['usuario']) && isset($_SESSION['siai']['expediente']) && isset($_SESSION['siai']['control'])) {
    $expediente = unserialize($_SESSION['siai']['expediente']);
    $usuario_estudiante = unserialize($_SESSION['siai']['usuario']);
    $siaiControl = unserialize($_SESSION['siai']['control']);
    if ($usuario_estudiante->getTipo() == 0 && $usuario_estudiante->getActivado() == 1) {
        switch ($siaiControl->getPaso()) {
            case 0:
                header('Location: paso1.php');
                break;
            case 1:
                header('Location: paso1.php');
                break;
            case 2:
                header('Location: paso2.php');
                break;
            case 3:
                if (isset($_SESSION['siai']['clases'])) {
                    $clases = unserialize($_SESSION['siai']['clases']);
                } else {

                    //header( 'Location: paso2.php' ) ;<--------------------------------AQUI
                    $notash = new Notash();
                    $control = new Control();
                    $control->setControlPorLlave('ANO_C');
                    $anio = $control->getConsecutiv();
                    $control->setControlPorLlave('CICLOACT');
                    $ciclo_actual = $control->getConsecutiv();
                    if (strlen($ciclo_actual) < 2) {
                        $ciclo_actual = '0' . $ciclo_actual;
                    }
                    $ciclo = $ciclo_actual . '/' . $anio;

                    $materias = $notash->getListadoMateriasAprobadas($expediente->getCarnet());
                    for ($i = 0; $i < count($materias); $i++) {
                        $materias_aprobadas[$materias[$i]] = true;
                    }

                    $equivalencias = new ProcSolicitudequivalencia();
                    $materias = $equivalencias->getListadoEquivalenciasPropuestas($expediente->getCarnet());
                    for ($i = 0; $i < count($materias); $i++) {
                        $materias_aprobadas[$materias[$i]] = true;
                    }

                    function validarPrerrequisitos($materia, $plan, $materias_aprobadas) {
                        //echo $materia;
                        $objetoAsignatura = new Asignatura();
                        $prerequisito = $objetoAsignatura->getPrerequisito($materia, $plan);
                        $resultado = true;
                        while ($prerequisito) {
                            if (!$materias_aprobadas[$prerequisito]) {
                                $resultado = false;
                            }
                            if ($validarCadena) {
                                $prerequisito = $objetoAsignatura->getPrerequisito($prerequisito, $plan);
                            } else {
                                $prerequisito = false;
                            }
                        }
                        return $resultado;
                    }

                    $horarioObj = new Horarios();
                    $horarios_carrera = $horarioObj->getHorarioActualPorPlan($expediente->getCodigoPla(), $ciclo);
                    $iAsignaturas = 0;
                    $iAsignaturaAnterior = 0;
                    for ($i = 0; $i < count($horarios_carrera); $i++) {
                        if (!$materias_aprobadas[$horarios_carrera[$i]['ASIGNATURA']] && validarPrerrequisitos($horarios_carrera[$i]['ASIGNATURA'], $expediente->getCodigoPla(), $materias_aprobadas)) {
                            if ($asignaturas_usadas[$horarios_carrera[$i]['ASIGNATURA']] != true) {
                                $iSeccion = 0;
                                $asignaturas_usadas[$horarios_carrera[$i]['ASIGNATURA']] = true;
                                $horarios[$iAsignaturas]['asignatura'] = new Asignatura();
                                $horarios[$iAsignaturas]['asignatura']->setAsignaturaPorLlave($horarios_carrera[$i]['ASIGNATURA']);

                                $horarios[$iAsignaturas]['detalle'][$iSeccion] = new Hordetalle();
                                $horarios[$iAsignaturas]['detalle'][$iSeccion]->setHordetallePorLlave($horarios_carrera[$i]['CODHOR'], $ciclo, $horarios_carrera[$i]['ASIGNATURA']);
                                $horarios[$iAsignaturas]['seccion'][$iSeccion] = new Secciones();
                                $horarios[$iAsignaturas]['seccion'][$iSeccion]->setSeccionesPorParametros($horarios[$iAsignaturas]['detalle'][$iSeccion]->getCiclo(), $horarios[$iAsignaturas]['detalle'][$iSeccion]->getSeccion(), $horarios[$iAsignaturas]['detalle'][$iSeccion]->getCodigo());

                                $codigo = explode('-', $horarios_carrera[$i]['CODHOR']);

                                $contador = 0;
                                for ($ii = 0; $ii < count($codigo); $ii++) {
                                    //echo ord($codigo[$ii]).'<br>';
                                    if ($codigo[$ii] != '' && $codigo[$ii] != ' ' && ord($codigo[$ii]) < 176 && ord($codigo[$ii]) != 32) {
                                        //echo ord($codigo[$ii]);
                                        //echo $contador;
                                        $horarios[$iAsignaturas]['horario'][$iSeccion][$contador] = new Horarios();
                                        $horarios[$iAsignaturas]['horario'][$iSeccion][$contador]->setHorariosPorLlave($codigo[$ii], $horarios_carrera[$i]['CODHOR'], '03/2012');
                                        $contador++;
                                    }
                                }
                                $iAsignaturaAnterior = $iAsignaturas;
                                $iAsignaturas++;
                            } else {
                                $iSeccion = count($horarios[$iAsignaturaAnterior]['detalle']);
                                $horarios[$iAsignaturaAnterior]['detalle'][$iSeccion] = new Hordetalle();
                                $horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->setHordetallePorLlave($horarios_carrera[$i]['CODHOR'], $ciclo, $horarios_carrera[$i]['ASIGNATURA']);
                                $horarios[$iAsignaturaAnterior]['seccion'][$iSeccion] = new Secciones();
                                $horarios[$iAsignaturaAnterior]['seccion'][$iSeccion]->setSeccionesPorParametros($horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->getCiclo(), $horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->getSeccion(), $horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->getCodigo());

                                $codigo = explode('-', $horarios_carrera[$i]['CODHOR']);

                                $contador = 0;
                                for ($ii = 0; $ii < count($codigo); $ii++) {
                                    $codigo[$ii] = trim($codigo[$ii]);
                                    if ($codigo[$ii] != '' && $codigo[$ii] != ' ') {
                                        //echo $contador;
                                        $horarios[$iAsignaturaAnterior]['horario'][$iSeccion][$contador] = new Horarios();
                                        $horarios[$iAsignaturaAnterior]['horario'][$iSeccion][$contador]->setHorariosPorLlave($codigo[$ii], $horarios_carrera[$i]['CODHOR'], '03/2012');
                                        $contador++;
                                    }
                                }
                            }
                        }
                    }
                    $nAsignaturas = count($horarios);
                    $contador = 0;
                    $contador2 = 0;
                    $materiasInscritas = new Asesoria();
                    $porInscribir = $materiasInscritas->getListadoAsignaturasPorInscribir($expediente->getCarnet());
                    $contador3 = 0;
                    $materiasArray = array();
                    foreach ($horarios as $item) {
                        foreach ($porInscribir as $item2) {
                            if ($item['asignatura']->getCodigo() == $item2['CODIGO_ASI']) {
                                $materiasArray['seccion' . $contador3] = (int) $item2['SECCION'] - 1;
                                //
                            }
                        }
                        $contador3++;
                    }
                    //var_dump($materiasArray);
                    for ($i = 0; $i < $nAsignaturas; $i++) {
                        $seleccion[$contador]['asignatura'] = $horarios[$i]['asignatura'];
                        $seleccion[$contador]['inscripciones'] = $notash->getNumeroInscripciones($expediente->getCarnet(), $horarios[$i]['asignatura']->getCodigo());
                        $seleccion[$contador]['detalle'] = $horarios[$i]['detalle'][$materiasArray['seccion' . $i]];
                        $seleccion[$contador]['horario'] = $horarios[$i]['horario'][$materiasArray['seccion' . $i]];
                        $seleccion[$contador]['seccion'] = $horarios[$i]['seccion'][$materiasArray['seccion' . $i]];
                        //var_dump($horarios[$i]['horario']);
                        //echo count($seleccion[$contador]['horario']).'-';

                        for ($ii = 0; $ii < count($seleccion[$contador]['horario']); $ii++) {
                            //echo $seleccion[$contador]['horario'][$ii]->getNombre();
                            $codigo = $seleccion[$contador]['horario'][$ii]->getCodigo();
                            substr($codigo, (count($codigo) - 2), 2);
                            $clases[$contador2]['asignatura'] = $seleccion[$contador]['asignatura'];
                            $clases[$contador2]['horario'] = $seleccion[$contador]['horario'][$ii];
                            $clases[$contador2]['seccion'] = $seleccion[$contador]['seccion'];
                            $clases[$contador2]['hora'] = substr($codigo, (count($codigo) - 3), 2);
                            //echo $clases[$contador2].' ';
                            $contador2++;
                        }
                        $contador++;
                    }
                    $_SESSION['siai']['clases'] = serialize($clases);
                }
                break;
            case 4:
                header('Location: paso4.php');
                break;
            case 5:
                header('Location: paso5.php');
                break;
        }
    }
} else {
    unset($_SESSION['siai']);
    header('Location: index.php');
}
//var_dump($clases);

for ($i = 0; $i <= count($clases); $i++) {
    $dia = (int) $clases[$i]['hora'][0];
    $hora = (int) $clases[$i]['hora'][1];
    $horario[$dia][$hora] = $i;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="favicon.ico">
        <title>SIAI - Sistema de Inscripción de Asignaturas vía Internet</title>

        <!-- favicon -->
        <link rel="icon" type="image/png" href="assets/images/other_images/favicon.png">

        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- owl carousel css -->
        <link href="assets/js/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="assets/js/owl-carousel/owl.theme.css" rel="stylesheet">
        <link href="assets/js/owl-carousel/owl.transitions.css" rel="stylesheet">
        <!-- intro animations -->
        <link href="assets/js/wow/animate.css" rel="stylesheet">
        <!-- font awesome -->
        <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- lightbox -->
        <link href="assets/js/lightbox/css/lightbox.css" rel="stylesheet">

        <!-- styles for this template -->
        <link href="assets/css/styles.css" rel="stylesheet">

        <!-- place your extra custom styles in this file -->
        <link href="assets/css/custom.css" rel="stylesheet">
        <link href="css/general.css" rel="stylesheet" type="text/css" />
        <link href="css/horario.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="background-image-overlay"></div>

        <div id="outer-background-container" data-default-background-img="assets/images/other_images/bg5.jpg" style="background-image:url(assets/images/other_images/bg5.jpg);"></div>
        <!-- end: #outer-background-container -->    

        <!-- Outer Container -->
        <div id="outer-container">

            <!-- Left Sidebar -->
            <section id="left-sidebar">

                <div class="logo">
                    <a href="#intro" class="link-scroll"><img src="assets/images/other_images/logo.png" alt="Twilli Air"></a>
                </div><!-- .logo -->

                <!-- Menu Icon for smaller viewports -->
                <div id="mobile-menu-icon" class="visible-xs" onClick="toggle_main_menu();"><span class="glyphicon glyphicon-th"></span></div>

                <ul id="main-menu">
                    <div id="identidad">
                        <div id="indicador_estado">
                            <div id="barra_lateral"></div>
                            <p id="estado_actualizar">Actualización de Datos</p>
                            <p id="estado_seleccion">Selección de Asignaturas</p>
                            <p id="estado_horario"  class="posicion_actual">Impresión de Horario</p>
                            <p id="estado_pagos">Mandamiento de Pagos</p>
                            <p id="estado_inscripcion">Boleta de Inscripción</p>
                        </div>
                    </div>         
                </ul><!-- #main-menu -->

            </section><!-- #left-sidebar -->
            <!-- end: Left Sidebar -->

            <section id="main-content" class="clearfix">
                <article id="intro" class="section-wrapper clearfix" data-custom-background-img="assets/images/other_images/bg5.jpg">
                    <div class="content-wrapper clearfix wow fadeInDown" data-wow-delay="0.3s">
                        <div class="col-sm-11 col-md-12 pull-right">
                            <section class="feature-text">
                                <div id="general">
                                    <div id="transaccional">
                                        <div class="row" style="background-color: black; opacity: 0.6">
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <a id="btnSalir" href="cerrar_sesion.php"><i class="fa fa-power-off fa-1x"> Salir</i></a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <a id="btnPensum" href="pdf/pensum.php" target="blank"><i class="fa fa-file-archive-o fa-1x"> Pensum</i></a>
                                            </div>     
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <div id="btnAnterior" style="opacity:0.4;" ><i class="fa fa-arrow-circle-o-left fa-1x"> Anterior</i></div>
                                            </div>  
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <div id="btnSiguiente" ><i class="fa fa-arrow-circle-o-right fa-1x"> Siguiente</i></div> 
                                            </div>                                    
                                        </div>
                                        <div id="principal">
                                            <h2>Horario de Clases Personal</h2>
                                            <br />
                                            <div id="tabla">
                                                <table width="95%" style="background:#FFFFFF;" align="center" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999"  >
                                                    <tr>
                                                        <th width="14%">Lunes</th>
                                                        <th width="14%">Martes</th>
                                                        <th width="15%">Miercoles</th>
                                                        <th width="14%">Jueves</th>
                                                        <th width="14%">Viernes</th>
                                                        <th width="14%">Sábado</th>
                                                        <th width="15%">Domingo</th>
                                                    </tr>
                                                    <?php for ($iHoras = 1; $iHoras <= 8; $iHoras++): ?>
                                                        <?php if (isset($horario[1][$iHoras]) || isset($horario[2][$iHoras]) || isset($horario[3][$iHoras]) || isset($horario[4][$iHoras]) || isset($horario[5][$iHoras]) || isset($horario[6][$iHoras]) || isset($horario[7][$iHoras])): ?>
                                                            <tr>
                                                                <?php for ($iDias = 1; $iDias <= 7; $iDias++): ?>
                                                                    <?php if (isset($horario[$iDias][$iHoras])): ?>
                                                                        <td>
                                                                            <h1><?php echo $clases[$horario[$iDias][$iHoras]]['asignatura']->getNombre(); ?></h1>
                                                                            <hr />
                                                                            <p><?php echo $clases[$horario[$iDias][$iHoras]]['horario']->getNombre(); ?></p>
                                                                            <hr />
                                                                            <p>Sección <?php echo $clases[$horario[$iDias][$iHoras]]['seccion']->getSeccion(); ?></p>
                                                                        </td>
                                                                    <?php else: ?>
                                                                        <td>&nbsp;</td>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </table>
                                            </div>
                                            <br />
                                            <a href="pdf/horariopdf.php" target="blank">descargar version pdf</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div><!-- .col-sm-10 -->
                    </div><!-- .content-wrapper -->
                </article><!-- .section-wrapper -->
            </section><!-- #main-content -->

            <!-- Footer -->
            <section id="footer">

                <!-- Go to Top -->
                <div id="go-to-top" onclick="scroll_to_top();"><span class="icon glyphicon glyphicon-chevron-up"></span></div>

                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/UPolitecnicaES" target="_blank" title="Facebook"><img src="assets/images/theme_images/social_icons/facebook.png" alt="Facebook"></a></li>
                    <li><a href="https://twitter.com/U_Politecnica" target="_blank" title="Twitter"><img src="assets/images/theme_images/social_icons/twitter.png" alt="Twitter"></a></li>
                     <!-- <li><a href="#" target="_blank" title="Google+"><img src="assets/images/theme_images/social_icons/googleplus.png" alt="Google+"></a></li>-->
                </ul>

                <!-- copyright text -->
                <div class="footer-text-line">&copy; SIAI 2.0</div>
            </section>
            <!-- end: Footer -->      

        </div><!-- #outer-container -->
        <!-- end: Outer Container -->

        <!-- Modal -->
        <!-- DO NOT MOVE, EDIT OR REMOVE - this is needed in order for popup content to be populated in it -->
        <div class="modal fade" id="common-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-body">
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->    
        <!--        ALERTAS MODALES     -->
        <div class="content-to-populate-in-modal" id="modal-content-1">
            <h3>Seleccion de Horario</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">A continuación se generarán los mandamientos de pago respectivos a su selección de asignaturas, despues de generados los mandamientos no podrá cambiar las materias seleccionadas.</p>
            <p>¿Esta seguro de querer registrar el horario seleccionado y proceder a generar los mandamientos de pago?.</p>

            <button type="button" id="btnModalAceptar" style="color: #003399" onclick="irPaso4()">Aceptar</button>
            <button type="button" data-dismiss="modal" aria-hidden="true" style="color: #600">Cancelar</button>
        </div>
        <!-- Javascripts
        ================================================== -->

        <!-- Jquery and Bootstrap JS -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Easing - for transitions and effects -->
        <script src="assets/js/jquery.easing.1.3.js"></script>

        <!-- background image strech script -->
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <!-- background image fix for IE 9 or less
           - use same background as set above to <body> -->
        <!--[if lt IE 9]>
        <script type="text/javascript">
        $(document).ready(function(){
          jQuery("#outer-background-container").backstretch("assets/images/other_images/bg5.jpg");
        });
        </script> 
        <![endif]-->  

        <!-- detect mobile browsers -->
        <script src="assets/js/detectmobilebrowser.js"></script>

        <!-- owl carousel js -->
        <script src="assets/js/owl-carousel/owl.carousel.min.js"></script>

        <!-- lightbox js -->
        <script src="assets/js/lightbox/js/lightbox.min.js"></script>

        <!-- intro animations -->
        <script src="assets/js/wow/wow.min.js"></script>

        <!-- Custom functions for this theme -->
        <script src="assets/js/functions.min.js"></script>
        <script src="assets/js/initialise-functions.js"></script>

        <script type="text/javascript" src="js/Comunes.js"></script>
        <script type="text/javascript" src="js/Validaciones.js"></script>
        <script type="text/javascript">
                $(document).ready(function () {
                    $('#btnSiguiente').click(function (e) {
                        irPaso4();
                    });
                });

                function irPaso4()
                {
                    var ajax;
                    ajax = objetoAjax();
                    ajax.open("GET", "horario/seleccionarPaso4.php", true);
                    ajax.onreadystatechange = function () {
                        if (ajax.readyState == 4) {
                            location.href = "paso4.php";
                        }
                    }
                    ajax.send(null);
                }
                function siguiente(evento)
                {
                    populate_and_open_modal(evento, 'modal-content-1');
                    //setMensaje('', '<p><div style="width:250px; margin-left:400px;"><div class="boton" onclick="javascript: ocultarVentana();">Cancelar</div><div class="boton" onclick="javascript: irPaso4();">Aceptar</div></div>');
                }
        </script>
        <!-- IE9 form fields placeholder fix -->
        <!--[if lt IE 9]>
        <script>contact_form_IE9_placeholder_fix();</script>
        <![endif]--> 
    </body>
</html>