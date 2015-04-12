<?php session_start();
include('../../Mail_Notify/security/cnx.php');
$link=Conectarse();
$var_id=$_GET['id'];
if($var_id!=NULL){
	
	if($_SESSION[user_assets]!=NULL){
		//echo $var_id.'-'.$_SESSION[user_assets][id];
		$querySoluciones=mysql_query("SELECT count(*) as c FROM soluciones WHERE id_usuario='".$_SESSION[user_assets][id]."' and cod_problema='".$var_id."'") or die("Error: ".mysql_error());
		$rowSoluciones=mysql_fetch_array($querySoluciones);
		
		//echo $rowSoluciones[c];		
		if($rowSoluciones[c]>0){
			$queryCorreo=mysql_query("SELECT b.nombre1,b.apellido1,b.correo FROM usuarios as a inner join perfiles as b on a.id_perfil=b.id_perfil WHERE id_usuario='".$_SESSION[user_assets][id]."'") or die("Error: ".mysql_error());
			$rowCorreo=mysql_fetch_array($queryCorreo);
			//echo $rowCorreo[correo];
			$queryProblema=mysql_query("SELECT url_solucion FROM `problemas` WHERE `cod_problema`='".$var_id."'") or die("Error: ".mysql_error());
			$rowProblemas=mysql_fetch_array($queryProblema);
			
			//echo $rowProblemas[url_solucion];
			
			if($rowProblemas[url_solucion]!=NULL){
			
				//------------------------------------------------------correo
			
			
			require("../../Mail_Notify/sendmail/PHPMailer/class.phpmailer.php");
		
  //instanciamos un objeto de la clase phpmailer al que llamamos 
  //por ejemplo mail
  $mail = new phpmailer();

  //Definimos las propiedades y llamamos a los métodos 
  //correspondientes del objeto mail

  //Con PluginDir le indicamos a la clase phpmailer donde se 
  //encuentra la clase smtp que como he comentado al principio de 
  //este ejemplo va a estar en el subdirectorio includes
  $mail->PluginDir = "includes/";

  //Con la propiedad Mailer le indicamos que vamos a usar un 
  //servidor smtp
  $mail->Mailer = "smtp";

  //Asignamos a Host el nombre de nuestro servidor smtp
  $mail->Host = "mail.politecnica.edu.sv";

  //Le indicamos que el servidor smtp requiere autenticación
  $mail->SMTPAuth = true;

  //Le decimos cual es nuestro nombre de usuario y password
  $mail->Username = "desafiopolitecnica@politecnica.edu.sv"; 
  $mail->Password = "poli2011";

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = "desafiopolitecnica@politecnica.edu.sv";
  $mail->FromName = utf8_decode("Desafío Politécnica");

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
  //una cuenta gratuita, por tanto lo pongo a 30  
  $mail->Timeout=10;

  //Indicamos cual es la dirección de destino del correo
  $mail->AddAddress("$rowCorreo[correo]");

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = utf8_decode("Solicitud de resolución de problema.");
  $mail->Body = utf8_decode("<b>Distinguido usuario:</b><br><br>
Le adjuntamos el archivo con la solución del problema solicitado.<br>
Le animamos a que continúe participando en el Desafío Politécnico.
");

  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
  $mail->AltBody = "Distinguido usuario:
Le adjuntamos el archivo con la solución del problema solicitado.
Le animamos a que continúe participando en el Desafío Politécnico.
";
  
  $mail->AddAttachment('../upload_archivos/archivo/'.$rowProblemas[url_solucion],$rowProblemas[url_solucion]);

  //se envia el mensaje, si no ha habido problemas 
  //la variable $exito tendra el valor true
  $exito = $mail->Send();

  //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
  //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
  //del anterior, para ello se usa la funcion sleep	

			
			
			
			//----------------------------------------------------fin correo
			
			
			
			
			
			$varMensaje='Se a enviado la solución a tu correo.';
			echo "<script>parent.location.href='../index.php?err=solv';</script>";}
			
			else{ $varMensaje='<b>Distinguido usuario:</b><br>
			En este momento aún no está preparado el archivo con el desarrollo de la solución para este problema.<br>
			Le pedimos disculpas por el inconveniente y le animamos a solicitar esta solución en fecha posterior.<br>
			Le animamos a que continúe participando en el Desafío Politécnica.
			
			';}
			
			
			}
		else{$varMensaje='Aun no has participado en este problema, no puedes solicitar la solución a este problema.';}
		
		
	}

	else{$varMensaje=' Para poder solicitar una respuesta, necesitas hacer login.<br>Si posees una cuenta ingresa <a href="../signin/index.php">"AQUI"</a>.<br>Para crear una cuenta ingresa al siguiente vinculo <a href="../signup"> "Crear Cuenta"</a>'; 
			
	}
	
	
}	
else{
	echo "<script>parent.location.href='../index.php';</script>";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template_izquierda.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="../../Mail_Notify/css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#botones span,p,font,td{
	font-family: Comfortaar;
}
#botones h1,h2,h3 {
	font-family: Lithos;
}
#botones table tr td table tr td div font {
	font-family: Comfortaar;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>DESAFIO</title>

<script src="../../Mail_Notify/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../Mail_Notify/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../Mail_Notify/js/jQueryUI/development-bundle/themes/start/jquery.ui.all.css">
<script type="text/javascript" src="../../Mail_Notify/js/jQueryUI/js/jquery-1.4.4.min.js"></script>
<script src="../../Mail_Notify/js/jQueryUI/development-bundle/ui/jquery.ui.core.js"></script>
<script src="../../Mail_Notify/js/jQueryUI/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="../../Mail_Notify/js/jQueryUI/development-bundle/ui/jquery.ui.button.js"></script>
<link rel="stylesheet" href="../../Mail_Notify/js/jQueryUI/development-bundle/themes/start/jquery.ui.all.css">
<script>

  curvyCorners.addEvent(window, 'load', initCorners);

  function initCorners() {
    var settings = {
      tl: { radius: 15 },
      tr: { radius: 15 },
      bl: { radius: 15 },
      br: { radius: 15 },
      antiAlias: true
    }
    curvyCorners(settings, "#content,#leftbar,#showcontent");
  }

</script>

<script type='text/javascript'>
jQuery(document).ready(function($){
	// set up the options to be used for jqDock...
	var dockOptions =
		{ align: 'left' // vertical menu, with expansion RIGHT from a fixed LEFT edge
		, size: 150// set the maximum minor axis (horizontal) image dimension to 60px
		,distance: 65
		, fadeIn: 1000
		};
	// ...and apply...
	$('#menu').jqDock(dockOptions);
});
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<script>
	$(function() {
		$( ".demox2 button:first" ).button({
            icons: {
                primary: "ui-icon-power",
 
            }
        });
	});
	</script>


<!-- InstanceEndEditable -->
<style type="text/css">
body {
	background-image: url();
	background-repeat: no-repeat;
}
</style>
<script src="../../Mail_Notify/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<link href="../../Mail_Notify/css/menu_vertical.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
#apDiv1 {
	position:absolute;
	left:698px;
	top:20px;
	width:149px;
	height:39px;
	z-index:1;
}
</style>
</head>

<body onload="MM_preloadImages('../../Mail_Notify/img/botones_historia_1_roll.png','../../Mail_Notify/img/botones_ganadores_1_roll.png','../../Mail_Notify/img/botones_gana_premio_1_roll.png','../../Mail_Notify/img/botones_problemas_actuales_1_roll.png')">
<div  align="center">
  <table width="965" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td><div id="encabezado" align="center" style="width:967px; height:100px; background-image:url(../../Mail_Notify/img/barra.png)" >
    <table cellpadding="5px">
    	<tr><td align="left" valign="bottom" width="967" height="100"><font color="#FFFFFF"><?php 
		if($_SESSION[user_assets]!=NULL){
		echo "Bienvenido: ".$_SESSION[user_assets][nombre].' '.$_SESSION[user_assets][apellido].'('.$_SESSION[user_assets][alias].')';
		}
		?></font></td></tr>
    </table>
    
    </div></td>
  </tr>
</table>


<div id="botones" align="left">
  <table width="970" border="0" align="center">
    <tr>
    
      <td width="149" bgcolor="#003366" valign="top">
      <div><a href="../../Mail_Notify/index.php"><img src="../../Mail_Notify/img/matriz_pequeño.png" width="242" height="179" border="0"/></a></div>
      
<div class="main_cont">

<div class="sub_menu">
<ul >
<li><a href="../../Mail_Notify/video.php" >• Video </a></li>
<li><a href="../../Mail_Notify/poblemas_actuales.php">• Problemas Actuales</a></li>
<li ><a href="../../Mail_Notify/modo_desafio.php">• Modo Desafío</a></li>
<li><a href="../../Mail_Notify/reglas_soluciones.php"> • Reglas y Soluciones</a></li>
<li><a href="../../Mail_Notify/gana_premio.php">• Gana un Premio </a></li>
<li><a href="../../Mail_Notify/ganadores.php">• Ganadores</a></li>
<li><a href="../../Mail_Notify/historia.php">• Historia</a></li>
<li><a href="../../Mail_Notify/enlaces.php">• Enlaces de Interés</a></li>
<li><?php if(isset($_SESSION[user_assets][id])){echo '<a href="security/logout.php">• Cerrar Sesión</a>';} else{
?><a href="../../Mail_Notify/signin/index.php">• Iniciar Sesión</a><?php echo $_SESSION[user_assets][id_usuario]; }?></li>
<li><?php if(!isset($_SESSION[user_assets][id])){?><a href="../../Mail_Notify/signup/index.php">• Regístrate</a><?php }?></li>
        </ul>
 </div>
</div>

      </td>
      <td width="811"  valign="top" bgcolor="#FFFFCC"><!-- InstanceBeginEditable name="EditRegion3" --><div style="margin:8px">
      <?php
	  echo $varMensaje;
	   ?>
       
       
       </div>
      <!-- InstanceEndEditable --></td>
    </tr>
  </table>
</div>
<div align="center"></div>
</div>

</body>
<!-- InstanceEnd --></html>