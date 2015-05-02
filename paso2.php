<?php
session_start();
include_once("clases/ClassConexion.php");
include_once("clases/ClassControl.php");
include_once("clases/ClassExpedientealumno.php");
include_once("clases/ClassNotash.php");
include_once("clases/ClassHorarios.php");
include_once("clases/ClassHordetalle.php");
include_once("clases/ClassSecciones.php");
include_once("clases/ClassAsignatura.php");
include_once("clases/ClassPrerrequisitos.php");
include_once('clases/ClassSiaiControl.php');
include_once('clases/ClassSiaiUsuario.php');
include_once("clases/ClassProcSolicituddeequivalencia.php");
include_once('clases/ClassObligaciones.php');
include_once('clases/ClassTipobeca.php');

//Haga true el campo $validarCadena si desea que se valide toda la cadena de prerrequisitos, hagalo false si desea que solo se valide el ultimo 
$validarCadena = false;

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
                break;
            case 3:
                header('Location: paso3.php');
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

$control= new Control();
$control->setControlPorLlave('ANO_C');
$anio=$control->getConsecutiv();
$control->setControlPorLlave('CICLOACT');
$ciclo_actual=$control->getConsecutiv();
$ciclo_anio_actual='0'.$ciclo_actual.'/'.$anio;

$solvencia = new Obligaciones();
$solvenciaCicloActual=($solvencia->isSolventeCicloActual($usuario_estudiante->getCarnet(), $ciclo_anio_actual)) ? '1' : '0';
$solvenciaHistorico=($solvencia->isSolventeHistorico($usuario_estudiante->getCarnet(), $ciclo_anio_actual)) ? '1' : '0';
if (!$solvencia->isSolvente($usuario_estudiante->getCarnet(), $ciclo_anio_actual)) {
    //----------------------NO ESTA SOLVENTE------------------
    $beca = new Tipobeca();
    if ($beca->setTipobecaPorLlave($expediente->getTipobeca())) {
        if ($beca->getVALOR() > 0) {
            //----------------------- BECAS PARCIALES---------
            header('Location: solvencia.php?sa='.$solvenciaCicloActual.'&sh='.$solvenciaHistorico);
        }
    } else {
        //----------- SIN BECA-------------------------
        header('Location: solvencia.php?sa='.$solvenciaCicloActual.'&sh='.$solvenciaHistorico);
    }
}

$control = new Control();
$control->setControlPorLlave('ANO_C');
$anio = $control->getConsecutiv();
$control->setControlPorLlave('CICLOACT');
$ciclo_actual = $control->getConsecutiv();
if (strlen($ciclo_actual) < 2) {
    $ciclo_actual = '0' . $ciclo_actual;
}
$ciclo = $ciclo_actual . '/' . $anio;
$notash = new Notash();
$_SESSION['siai']['ciclo'] = $ciclo_actual;
$_SESSION['siai']['anio'] = $anio;
//echo $ciclo;
$materias = $notash->getListadoMateriasAprobadas($expediente->getCarnet());
for ($i = 0; $i < count($materias); $i++) {
    $materias_aprobadas[$materias[$i]] = true;
}
//var_dump($materias_aprobadas);
$equivalencias = new ProcSolicitudequivalencia();
$materias = $equivalencias->getListadoEquivalenciasPropuestas($expediente->getCarnet());
for ($i = 0; $i < count($materias); $i++) {
    $materias_aprobadas[$materias[$i]] = true;
}

//var_dump($materias_aprobadas);
//Pendiente de terminar
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

$horario = new Horarios();
$horarios_carrera = $horario->getHorarioActualPorPlan($expediente->getCodigoPla(), $ciclo);
$iAsignaturas = 0;
$iAsignaturaAnterior = 0;
//var_dump($horarios_carrera);
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
            //var_dump($horarios[$iAsignaturas]['seccion'][$iSeccion]);
            $codigo = explode('-', $horarios_carrera[$i]['CODHOR']);
            //var_dump($codigo);
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
            $horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->setHordetallePorLlave2($horarios_carrera[$i]['CODHOR'], $ciclo, $horarios_carrera[$i]['ASIGNATURA'],$horarios_carrera[$i]['SECCION']);
            $horarios[$iAsignaturaAnterior]['seccion'][$iSeccion] = new Secciones();
            $horarios[$iAsignaturaAnterior]['seccion'][$iSeccion]->setSeccionesPorParametros($horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->getCiclo(), $horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->getSeccion(), $horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]->getCodigo());
            //var_dump($horarios[$iAsignaturaAnterior]['detalle'][$iSeccion]);
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
unset($_SESSION['siai']['choque']);
unset($_SESSION['siai']['clases']);
unset($_SESSION['siai']['seleccion']);
$_SESSION['siai']['horarios'] = serialize($horarios);
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
        <link href="css/asignaturas.css" rel="stylesheet" type="text/css" />

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
                            <p id="estado_seleccion" class="posicion_actual">Selección de Asignaturas</p>
                            <p id="estado_horario">Impresión de Horario</p>
                            <p id="estado_pagos">Mandamiento de Pagos</p>
                            <p id="estado_inscripcion">Hoja de Inscripción</p>
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
                                        <div class="row" style="background-color: black; opacity: 0.6;margin-top: 38px">
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <a id="btnSalir" href="cerrar_sesion.php"><i class="fa fa-power-off fa-1x"> Salir</i></a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <a id="btnPensum" href="pdf/pensum.php" target="blank"><i class="fa fa-file-archive-o fa-1x"> Pensum</i></a>
                                            </div>     
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <a id="btnAnterior" href="paso1.php"><i class="fa fa-arrow-circle-o-left fa-1x"> Anterior</i></a>
                                            </div>  
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <div id="btnSiguiente" ><i class="fa fa-arrow-circle-o-right fa-1x"> Siguiente</i></div> 
                                            </div>                                    
                                        </div>
                                        <div class="col-md-12">     
                                            <div id="asignaturas" class="col-md-6">
                                                <h3>Selección de Asignaturas</h3> 
                                                <script type="text/javascript">iAsignaturas = new Array(<?php echo count($horarios); ?>);</script>					
                                                <?php for ($i = 0; $i < count($horarios); $i++): ?>
                                                    <div class="asignaturas"  onclick="javascript: informacionAsignatura(<?php echo $i; ?>)"><input type="checkbox" onchange="javascript: seleccionAsignatura(this,<?php echo $i; ?>);
                                                                                                                                                    " id="asignatura<?php echo $i; ?>" value="<?php echo $i; ?>" /><?php echo $horarios[$i]['asignatura']->getNombre(); ?></div>
                                                    <div id="secciones<?php echo $i; ?>" class="secciones">
                                                        <table width="370" border="0" cellpadding="0" cellspacing="5">
                                                            <script type="text/javascript">iAsignaturas[<?php echo $i; ?>] =<?php echo count($horarios[$i]['seccion']); ?>;</script>
                                                            <?php for ($ii = 0; $ii < count($horarios[$i]['seccion']); $ii++): ?>
                                                                <?php if ($ii == 0): ?>                        		
                                                                    <tr>
                                                                    <?php elseif ($ii % 3 == 0): ?>
                                                                    </tr>  
                                                                    <tr>                 
                                                                    <?php endif; ?>
                                                                    <?php if (isset($horarios[$i]['seccion'][$ii])): ?>
                                                                        <td width="33%"><input type="radio" id="seccion<?php echo $i; ?>" name="seccion<?php echo $i; ?>" value="<?php echo $ii; ?>" onchange="javascript: seleccionSeccion(<?php echo $i; ?>,<?php echo $ii; ?>)" <?php
                                                                            if ($ii == 0) {
                                                                                echo 'checked';
                                                                            }
                                                                            ?> /> Sección <?php echo $horarios[$i]['seccion'][$ii]->getSeccion(); ?></td>
                                                                        <?php endif; ?>
                                                                    <?php endfor; ?>
                                                            </tr>
                                                        </table></div>                    	
                                                <?php endfor; ?>
                                            </div>
                                            <div id="horarios" class="col-md-6"><h2>Haga click en el nombre de una asignatura para poder ver su horario</h2></div>  
                                        </div>
                                    </div>
                                    <!--                            <div id="navegacion"><a href="cerrar_sesion.php"><div id="btnSalir" ></div></a><a href="pdf/pensum.php" target="blank"><div id="btnPensum" ></div></a><div id="btnAnterior" style="opacity:0.4;" ></div><div id="btnSiguiente" onclick="javascript: actualizar();"></div></div>-->
                                </div>
                        </div>
                        </section>
                    </div><!-- .col-sm-10 -->
                    </div><!-- .content-wrapper -->
                </article><!-- .section-wrapper -->
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
            <h3>Choque de horarios</h3>
            <p id="mnsgChoque"></p>
        </div>
        <div class="content-to-populate-in-modal" id="modal-content-2">
            <h3>Cupo Agotado</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">No se puede continuar el proceso de inscripción debido a que una o más de las secciones seleccionadas, ha agotado sus cupos disponibles</p>
            <p>Seleccione otra sección o deseleccione la materia para poder continuar con el proceso de inscripción</p>
        </div>
        <div class="content-to-populate-in-modal" id="modal-content-3">
            <h3>Error de Selección de Materias</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">Se ha detectado un error al intentar de registrar su selección.</p>
        </div>
        <div class="content-to-populate-in-modal" id="modal-content-4">
            <h3>Error de Selección de Materias</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">No se detecta ninguna asignatura seleccionada, favor seleccione las asignaturas que desea inscribir y vuelva a intentar.</p>
        </div>
        <div class="content-to-populate-in-modal" id="modal-content-5">
            <h3>Seleccion de Horario</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">¿Está seguro de su selección de materias y horarios?</p>
            <p>si es así, haga clic en el botón “Aceptar”, de lo contrario, haga clic en el botón “Cancelar” y cambie su selección ya que este paso es irreversible.</p>

            <button type="button" id="btnModalAceptar" style="color: #003399" onclick="nextTask(event)">Aceptar</button>
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
        <script type="text/javascript" src="js/Seleccion.js"></script>
        <script type="text/javascript">
                function seleccionSeccion(asignatura, seccion)
                {
                    var ajax;
                    ajax = objetoAjax();
                    ajax.open("GET", 'seleccion/cupo_seccion.php?asignatura=' + asignatura + '&seccion=' + seccion, true);
                    ajax.onreadystatechange = function () {
                        if (ajax.readyState == 4) {
                            respuesta = ajax.responseText;
                            respuesta = respuesta.split("resultadosiai=");
                            if (respuesta.length == 2)
                            {
                                condicion = new Number(respuesta[1][0]);
                                if (condicion == 0)
                                {
                                    setMensaje('Cupo Agotado', '<p>La sección seleccionada no tiene capacidad para mas estudiantes, seleccione otra sección para poder continuar con el proceso de inscripción</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
                                }
                            }
                            else
                            {
                                setMensaje('Error de Selección de Materias', '<p>Se ha detectado un error al intentar de registrar su selección</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
                            }
                        }
                    }
                    ajax.send(null);
                }
        </script>
        <!-- IE9 form fields placeholder fix -->
        <!--[if lt IE 9]>
        <script>contact_form_IE9_placeholder_fix();</script>
        <![endif]--> 
    </body>
</html>