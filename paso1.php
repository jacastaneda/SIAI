<?php
session_start();
include_once("clases/ClassConexion.php");
include_once("clases/ClassExpedientealumno.php");
include_once("clases/ClassCarrera.php");
include_once('clases/ClassSiaiUsuario.php');
include_once('clases/ClassSiaiControl.php');
include_once('clases/ClassObligaciones.php');
include_once('clases/ClassTipobeca.php');

if (isset($_SESSION['siai']['usuario']) && isset($_SESSION['siai']['expediente']) && isset($_SESSION['siai']['control'])) {
    $estudiante = unserialize($_SESSION['siai']['expediente']);
    $usuario_estudiante = unserialize($_SESSION['siai']['usuario']);
    $siaiControl = unserialize($_SESSION['siai']['control']);
    if ($usuario_estudiante->getTipo() == 0 && $usuario_estudiante->getActivado() == 1) {
        if ($siaiControl->getPaso() == 0) {
            $siaiControl->setPaso(1);
            $siaiControl->updateSiaiControl();
            $_SESSION['siai']['control'] = serialize($siaiControl);
        }
    } else {
        unset($_SESSION['siai']);
        header('Location: index.php');
    }
} else {
    unset($_SESSION['siai']);
    header('Location: index.php');
}

$solvencia = new Obligaciones();
if (!$solvencia->isSolvente($usuario_estudiante->getCarnet())) {
    //----------------------NO ESTA SOLVENTE------------------
    $beca = new Tipobeca();
    if ($beca->setTipobecaPorLlave($estudiante->getTipobeca())) {
        if ($beca->getVALOR() > 0) {
            //----------------------- BECAS PARCIALES---------
            header('Location: solvencia.php');
        }
    } else {
        //----------- SIN BECA-------------------------
        header('Location: solvencia.php');
    }
}

$carrera = new Carrera();
$carrera->setCarreraPorLlave($estudiante->getCodcarrera());

$_SESSION['siai']['carrera'] = serialize($carrera);
$comentario = $estudiante->getObservacio();
$comentario = explode("\n", $comentario);
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
                            <p id="estado_actualizar" class="posicion_actual">Actualización de Datos</p>
                            <p id="estado_seleccion">Selección de Asignaturas</p>
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
                                            <h1 class="section-title">Datos personales</h1>
                                            <div id="datos_personales_contenido" class="contenido form-style">
                                                <div id="formulario_activacion">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <!--Nombre-->
                                                            <input type="text" id="nombre" class="text-field form-control validate-field" placeholder="Nombre" value="<?php echo $estudiante->getNombres() . " " . $estudiante->getApellido1() . " " . $estudiante->getApellido2(); ?>" disabled="disabled"/>
                                                        </div>  
                                                        <div class="form-group">
                                                            <input type="text" id="carnet" class="text-field form-control validate-field" placeholder="Carnet" value="<?php echo $estudiante->getCarnet(); ?>" disabled="disabled"/>                        
                                                        </div>               
                                                    </div>  

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" id="telefono_casa" class="text-field form-control validate-field" placeholder="Telefono casa" value="<?php echo $estudiante->getTelefono(); ?>" maxlength="14"/>  
                                                        </div>  
                                                        <div class="form-group">
                                                            <input type="text" id="email" class="text-field form-control validate-field" placeholder="Email" value="<?php echo $usuario_estudiante->getEmail(); ?>"/>
                                                        </div>                 
                                                    </div> 
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea id="dir_casa" placeholder="Direccion" class="text-field form-control validate-field" ><?php echo $estudiante->getDireccion(); ?></textarea> 
                                                        </div>                  
                                                    </div>                                      
                                                </div>
                            <!--                    <div class="cierre"><input class="btn btn-sm btn-outline-inverse" type="button" value="Activar Cuenta" onclick="javascript: activarCuenta(document.getElementById('carnet').value,document.getElementById('pass1').value,document.getElementById('repass1').value,document.getElementById('anio').value,document.getElementById('mes').value,document.getElementById('dia').value,document.getElementById('email').value);" /></div>-->
                                            </div>                               

                                            <h1 class="section-title">Datos Laborales</h1>
                                            <div id="datos_personales_contenido" class="contenido form-style">
                                                <div id="formulario_activacion">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <!--Nombre-->
                                                            <input type="text" id="empresa" class="text-field form-control validate-field" placeholder="Empresa" value="<?php echo $estudiante->getLugartraba(); ?>"/>
                                                        </div>               
                                                    </div>  
                                                    <div class="col-md-6">
                                                        <div class="form-group">                                              
                                                            <input type="text" id="telefono_trabajo" class="text-field form-control validate-field" placeholder="Telefono trabajo" value="<?php echo $estudiante->getTeltrabajo(); ?>" maxlength="14"/>                      
                                                        </div>               
                                                    </div>                                         
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea id="dir_trabajo" placeholder="Direccion" class="text-field form-control validate-field" ><?php echo $estudiante->getDirtrabajo(); ?></textarea>
                                                        </div>                  
                                                    </div>                                      
                                                </div>
                            <!--                    <div class="cierre"><input class="btn btn-sm btn-outline-inverse" type="button" value="Activar Cuenta" onclick="javascript: activarCuenta(document.getElementById('carnet').value,document.getElementById('pass1').value,document.getElementById('repass1').value,document.getElementById('anio').value,document.getElementById('mes').value,document.getElementById('dia').value,document.getElementById('email').value);" /></div>-->
                                            </div>                                          
                                        </div>
                                        <!--                            <div id="navegacion"><a href="cerrar_sesion.php"><div id="btnSalir" ></div></a><a href="pdf/pensum.php" target="blank"><div id="btnPensum" ></div></a><div id="btnAnterior" style="opacity:0.4;" ></div><div id="btnSiguiente" onclick="javascript: actualizar();"></div></div>-->
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
            <h3>Actualización de Datos</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">El correo electrónico ingresado no es valido, verifique si el correo ingresado esta correctamente escrito e intentelo nuevamente.</p>
        </div>
        <div class="content-to-populate-in-modal" id="modal-content-2">
            <h3>Actualización de Datos</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">El teléfono ingresado no es valido, por favor ingrese nuevamente su número de teléfono</p>
        </div>
        <div class="content-to-populate-in-modal" id="modal-content-3">
            <h3>Actualización de Datos</h3>
            <p><img data-img-src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">La dirección de su lugar de residencia, teléfono y correo electronico(email) son campos requeridos para realizar el proceso de inscripción, favor actualizar como mínimo esos parametros para poder continuar.</p>
        </div>
        <div class="content-to-populate-in-modal" id="modal-content-3">
            <h3>Actualización de Datos</h3>
            <p><img data-img-src="assets/images/other_images/appbar.noentry.png" class="lazy rounded_border hover_effect pull-left">El usuario no pudo ser actualizado, favor intentar en otro momento.</p>
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
        <script type="text/javascript" src="js/Estudiante.js"></script>
        <!-- IE9 form fields placeholder fix -->
        <!--[if lt IE 9]>
        <script>contact_form_IE9_placeholder_fix();</script>
        <![endif]--> 
    </body>
</html>