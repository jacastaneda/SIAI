<?php
session_start();
include_once("clases/ClassConexion.php");
include_once("clases/MetodosComunes.php");
include_once("clases/ClassControl.php");
include_once("clases/ClassExpedientealumno.php");
include_once("clases/ClassAsignatura.php");
include_once("clases/ClassAsesoria.php");
include_once("clases/ClassAranceles.php");
include_once("clases/ClassSiaiUsuario.php");
include_once("clases/ClassSiaiControl.php");
include_once("clases/ClassSiaiObligaciones.php");


if (isset($_SESSION['siai']['usuario']) && isset($_SESSION['siai']['expediente']) && isset($_SESSION['siai']['control'])) {
    $expediente = unserialize($_SESSION['siai']['expediente']);
    $siaiusuario = unserialize($_SESSION['siai']['usuario']);
    $siaiControl = unserialize($_SESSION['siai']['control']);
    if ($siaiusuario->getTipo() == 0 && $siaiusuario->getActivado() == 1) {
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
                header('Location: paso3.php');
                break;
            case 4:
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
$asesoriaObj = new Asesoria();
if (!$asesoriaObj->isAprobado($expediente->getCarnet())) {
    header('Location: no_aprobado.php');
} else {

    $control = new Control();
    $control->setControlPorLlave('ANO_C');
    $anio = $control->getConsecutiv();
    $control->setControlPorLlave('CICLOACT');
    $ciclo_actual = $control->getConsecutiv();

    $siaiobligacion = new SiaiObligaciones();
    if ($lista = $siaiobligacion->listaPorAtributos($ciclo_actual, $anio, $siaiusuario->getUsuario())) {
        for ($i = 0; $i < count($lista); $i++) {
            $siaiobligaciones[$i] = new SiaiObligaciones();
            $siaiobligaciones[$i]->setSiaiObligacionesPorLlave($lista[$i]);
            $total+=$siaiobligaciones[$i]->getValor();
        }
    } else {
        $asesoria = new Asesoria();
        $listaAsignaturas = $asesoria->getListadoAsignaturas($expediente->getCarnet(), $anio . '-01-01 00:00:00');
        for ($i = 0; $i < count($listaAsignaturas); $i++) {
            $seleccion[$i]['asesoria'] = new Asesoria();
            $seleccion[$i]['asesoria']->setAsesoriaPorLlave($expediente->getCarnet(), $listaAsignaturas[$i][0], $listaAsignaturas[$i][1]);
            $seleccion[$i]['asignatura'] = new Asignatura();
            $seleccion[$i]['asignatura']->setAsignaturaPorLlave($seleccion[$i]['asesoria']->getCodigoAsi());
            if ($seleccion[$i]['asesoria']->getArancel() != '') {
                $seleccion[$i]['arancel'] = new Aranceles();
                $seleccion[$i]['arancel']->setArancelesPorLlave($seleccion[$i]['asesoria']->getArancel());
            }
        }

        //$siaicontrol->setIdPorAtributos($siaiusuario->getUsuario(),$ciclo_actual,$anio);	

        $matricula = new Aranceles();
        $matricula->setArancelesPorLlave('MAT');

        $cuota = new Aranceles();
        $cuota->setArancelesPorLlave('CTA');

        $total = 0;

        $siaiobligaciones[0] = new SiaiObligaciones();
        $siaiobligaciones[0]->setAnio($anio);
        $siaiobligaciones[0]->setCiclo($ciclo_actual);
        $siaiobligaciones[0]->setIdArancel($matricula->getIdunicoara());
        $siaiobligaciones[0]->setArancel($matricula->getCodigo());
        $siaiobligaciones[0]->setFechaEmision(getFecha());
        $siaiobligaciones[0]->setCuota(0);
        $siaiobligaciones[0]->setNui($expediente->getNui());
        $siaiobligaciones[0]->setUsuario($siaiusuario->getUsuario());
        $siaiobligaciones[0]->setValor($matricula->getValor());
        $siaiobligaciones[0]->generarCodigos();
        $siaiobligaciones[0]->setDescripcion('Matricula');
        $siaiobligaciones[0]->setBanco(-1);
        $siaiobligaciones[0]->insertSiaiObligaciones();
        $total+=$siaiobligaciones[0]->getValor();


        $siaiobligaciones[1] = new SiaiObligaciones();
        $siaiobligaciones[1]->setAnio($anio);
        $siaiobligaciones[1]->setCiclo($ciclo_actual);
        $siaiobligaciones[1]->setIdArancel($cuota->getIdunicoara());
        $siaiobligaciones[1]->setArancel($cuota->getCodigo());
        $siaiobligaciones[1]->setFechaEmision(getFecha());
        $siaiobligaciones[1]->setCuota(1);
        $siaiobligaciones[1]->setNui($expediente->getNui());
        $siaiobligaciones[1]->setUsuario($siaiusuario->getUsuario());
        $siaiobligaciones[1]->setValor($cuota->getValor());
        $siaiobligaciones[1]->generarCodigos();
        $siaiobligaciones[1]->setDescripcion('Cuota 1');
        $siaiobligaciones[1]->setBanco(-1);
        $siaiobligaciones[1]->insertSiaiObligaciones();

        $total+=$siaiobligaciones[1]->getValor();

        $iPagos = 2;
        for ($i = 0; $i < count($seleccion); $i++) {
            if ($seleccion[$i]['arancel'] != false) {
                $siaiobligaciones[$iPagos] = new SiaiObligaciones();
                $siaiobligaciones[$iPagos]->setAnio($anio);
                $siaiobligaciones[$iPagos]->setCiclo($ciclo_actual);
                $siaiobligaciones[$iPagos]->setIdArancel($seleccion[$i]['arancel']->getIdunicoara());
                $siaiobligaciones[$iPagos]->setArancel($seleccion[$i]['arancel']->getCodigo());
                $siaiobligaciones[$iPagos]->setFechaEmision(getFecha());
                $siaiobligaciones[$iPagos]->setCuota(0);
                $siaiobligaciones[$iPagos]->setNui($expediente->getNui());
                $siaiobligaciones[$iPagos]->setUsuario($siaiusuario->getUsuario());
                $siaiobligaciones[$iPagos]->setValor($seleccion[$i]['arancel']->getValor());
                $siaiobligaciones[$iPagos]->generarCodigos();
                $siaiobligaciones[$iPagos]->setDescripcion($seleccion[$i]['arancel']->getNombre() . ' ' . $seleccion[$i]['asignatura']->getCodigo());
                $siaiobligaciones[$iPagos]->setBanco(-1);
                $siaiobligaciones[$iPagos]->insertSiaiObligaciones();
                $total+=$siaiobligaciones[$iPagos]->getValor();
                $iPagos++;
            }
        }

        $siaiControl->setSolvente(0);
        $siaiControl->setTotalPagar($total);
        $siaiControl->setSaldo($total);
        $siaiControl->updateSiaiControl();
    }
    $_SESSION['siai']['mandamientos']['obligaciones'] = serialize($siaiobligaciones);
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
        <link href="css/pagos.css" rel="stylesheet" type="text/css" />
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
                            <p id="estado_actualizar" >Actualización de Datos</p>
                            <p id="estado_seleccion">Selección de Asignaturas</p>
                            <p id="estado_horario">Impresión de Horario</p>
                            <p id="estado_pagos" class="posicion_actual">Mandamiento de Pagos</p>
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
                                    </div>
                                    <div id="principal">
                                        <h2>Resumen de Pagos</h2>
                                        <br />
                                        <div id="tabla">
                                            <table width="95%">
                                                <tr>
                                                    <th width="*">Descripción</th>
                                                    <th width="155">Valor</th>
                                                </tr>
                                                <?php for ($i = 0; $i < count($siaiobligaciones); $i++): ?>                        
                                                    <tr>
                                                        <td><?php echo $siaiobligaciones[$i]->getDescripcion(); ?></td>
                                                        <td align="right">USD$ <?php echo number_format($siaiobligaciones[$i]->getValor(), 2); ?></td>
                                                    </tr>                     
                                                <?php endfor; ?>
                                                <tr>
                                                    <th align="right">TOTAL</th>
                                                    <td align="right">USD$ <?php echo number_format($total, 2); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <p><a href="pdf/mandamientos.php" target="blank">Descargar Mandamientos de Pago PDF</a>
                                        </p>
                                        <p>Podras imprimir tu hoja de inscripción hasta dentro de un máximo de 72 horas despues de realizado tu pago.</p>
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
            <h3>Suspensión del proceso</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">Realice el pago en los bancos correspondientes y espere un máximo de 72 horas para continuar con el proceso.</p>
            <button id="btnfin" style="color: #003399" onclick="javascript:location.href = 'cerrar_sesion.php';">Aceptar</button>
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
                        suspension(e);
                    });
                    $("#btnfin").click(function () {
                        alert(1);
                    });
                });
                function suspension(evento)
                {
                    populate_and_open_modal(evento, 'modal-content-1');
                }

        </script>
        <!-- IE9 form fields placeholder fix -->
        <!--[if lt IE 9]>
        <script>contact_form_IE9_placeholder_fix();</script>
        <![endif]--> 
    </body>
</html>