                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php 
include_once("clases/MetodosComunes.php");

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Inscripción vía Internet</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico">
<script type="text/javascript" src="js/Comunes.js"></script>
<script type="text/javascript" src="js/Sesion.js"></script>
<script type="text/javascript" src="js/Validaciones.js"></script>
<script type="text/javascript" src="js/md5.js"></script>
</head>
<body onresize="javascript: onResize();" onload="javascript: onResize();">
	<div id="general">
    	<div id="encabezado">
      		<div id="logo"></div>
        </div>
        <div id="contenido">
        	<div id="inicio_sesion" class="contenedor">
            	<div class="pestana" id="inicio_sesion_pestana"  onclick="javascript: cambiarPestana(1);">Iniciar Sesión</div>
                <div class="contenido" id="inicio_sesion_contenido" >
                	<div id="formulario_ingreso" style=" padding-left:10px;">
                        <p>Usuario:</p>
                        <input type="text" id="usr" maxlength="50" class="caja_texto" onkeyup="enterKey(event);"/>
                        <p>Contraseña:</p>
                        <input type="password" id="pass" maxlength="50" class="caja_texto" onkeyup="enterKey(event);" />
                        
                	</div>
                    <div class="cierre"><input type="button" value="Iniciar Sesión" onclick="javascript: validarUsuario(document.getElementById('usr').value,document.getElementById('pass').value);" /></div>
                </div>                
            </div>
            <div id="activar_usuario"  class="contenedor" >
            	<div class="pestana" id="activar_usuario_pestana"  onclick="javascript: cambiarPestana(2);">Activar Cuenta</div>
                <div id="activar_usuario_contenido" class="contenido">
                	<div id="formulario_activacion" style=" padding-left:15px;">
                    	<table width="100%" cellpadding="15">
                        	<tr>
                            	<td width="140" valign="top">
                                	<p>Carné:</p>
		                        	<input type="text" id="carnet" maxlength="8" class="caja_texto" />
                                    <p>Contraseña:</p>
		                        	<input type="password" id="pass1" maxlength="23" class="caja_texto" />
                                    <p>Repetir Contraseña:</p>
		                        	<input type="password" id="repass1" maxlength="23" class="caja_texto" />
                                </td>
                                <td width="*" valign="top">
                                	<p>Fecha de Nacimiento</p>
                                    <b>Día:</b> <select id="dia">
                                        <?php for($i=1;$i<=31;$i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>                      
                                    </select> <b>Mes:</b> <select id="mes" onchange="javascript: getDias();">
                                        <?php 
                                            $meses= Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                            for($i=1;$i<=12;$i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $meses[$i-1]; ?></option>
                                        <?php endfor; ?> 
                                    </select> <b>Año:</b> <select id="anio" onchange="javascript: getDias();">
                                        <?php for($i=getAnio()-100;$i<=getAnio();$i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>   
                                    </select>
                                    <p>Correo Electrónico</p>
                                    <input type="text" id="email" maxlength="100" class="caja_texto" onkeyup="enterKey(event);" size="30"/>                                
                                </td>
                            </tr>
                        </table>
                	</div>
                    <div class="cierre"><input type="button" value="Activar Cuenta" onclick="javascript: activarCuenta(document.getElementById('carnet').value,document.getElementById('pass1').value,document.getElementById('repass1').value,document.getElementById('anio').value,document.getElementById('mes').value,document.getElementById('dia').value,document.getElementById('email').value);" /></div>
                </div>
            </div>
            <div id="tutorial"  class="contenedor" ><div class="pestana" id="tutorial_pestana"  onclick="javascript: cambiarPestana(3);">Tutorial</div><div class="contenido" id="tutorial_contenido"><div class="cierre"></div></div>
        </div>
    </div>
    <div id="ventana_emergente">
    	<div id="fondo"></div>
      	<div id="ventana">
        	<div id="barra_superior"><div id="mensaje_titulo"></div><div id="cerrar_ventana" onclick="javascript: ocultarVentana();"></div></div>
        	<div id="mensaje_texto">
            	<div class="boton">prueba</div>
            </div>
      	</div>    	
    </div>
</body>
</html>