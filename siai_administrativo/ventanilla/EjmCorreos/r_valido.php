<?php include('../../Mail_Notify/security/cnx.php');
$link=Conectarse();

"codigo de problema : ".$_REQUEST[cod]."<br>";
 "codigo de user : ".$_REQUEST[user]."<br>";

$cod_problema=$_REQUEST[cod];
$cod_user=$_REQUEST[user];
$id=$_REQUEST[id];


//buscado al usuario para le envio del correo
$query_user=mysql_query("select correo from usuarios as a inner join perfiles as b on a.id_perfil=b.id_perfil  where id_usuario='$cod_user'") or die ("query_usuario".mysql_error());

$correo_user=mysql_fetch_array($query_user);

$var_email=$correo_user[correo];

//este query hace la consulta de las soluciones que estan validas porque asi sabemos el rango que asignamos
$query_con=mysql_query("select * from soluciones where cod_problema='$_REQUEST[cod]' and valida='1'") or die ("query_con".mysql_error());

$cantidad_b=mysql_num_rows($query_con);

"CANTIDAD de respuestas validas : ".$cantidad_b."<br>";

//primer condicion 
if($cantidad_b==0 ){
	
	 "Puntaje de 5 <br>";
	
	$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	echo $puntaje[puntaje];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[puntaje]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die ("error de update".mysql_error()); 
	
	}
//segunda condicion	
elseif($cantidad_b>=1 and $cantidad_b<=5){
	
	
		 "Puntaje de 4 <br>";
		
		$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	echo $puntaje[intervalo1];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo1]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
		}

//terce condicion
elseif($cantidad_b>=6 and $cantidad_b<=10){
	 "Puntaje de 3 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	$puntaje[intervalo2];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo2]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}
	
	
	//CUARTA CALIFICACION
	
	elseif($cantidad_b>=11 and $cantidad_b<=20){
	"Puntaje de 3 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	 $puntaje[intervalo2];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo3]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}
	
	//QUINTA EVALUCION
	
	elseif($cantidad_b>=21 and $cantidad_b<=40){
	 "Puntaje de 3 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	 $puntaje[intervalo2];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo4]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}
	
	//SEXTA EVALUCION
	
	elseif($cantidad_b>=41 and $cantidad_b<=60){
	"Puntaje de 3 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	echo $puntaje[intervalo2];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo5]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}
	
	//SEPTIMA EVALUCION
	
	elseif($cantidad_b>=61 and $cantidad_b<=80){
	 "Puntaje de 3 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	$puntaje[intervalo2];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo6]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}
	
	//OCTAVA EVALUCION
	
	elseif($cantidad_b>=81 and $cantidad_b<=99){
	 "Puntaje de 3 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	 $puntaje[intervalo2];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo7]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}
	
	//NOVENA CALIFICACION
	
	elseif($cantidad_b>=100 and $cantidad_b<=199){
	 "Puntaje de 3 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	 $puntaje[intervalo2];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo8]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}
	
	//DECIMA CALIFICAION
	
	

//cuarta condicion
elseif($cantidad_b>=200){
	
	
	 "Puntaje de 2 <br>";
	
			$query_consulta=mysql_query("select * from problemas where cod_problema='$cod_problema' ") or die (mysql_error());
	
	$puntaje=mysql_fetch_array($query_consulta);
	$puntaje[intervalo3];
	//haciendo update de calificacion
	mysql_query("update soluciones set valida='1' , puntaje='$puntaje[intervalo9]',estatus=0 where cod_problema='$cod_problema' and id_usuario='$cod_user' and id_solucion='$id' ") or die (mysql_error()); 
	
	
	}

//borrar registro cuando el usuario haya contestado correctamente 

$query_solu=mysql_query("select * from soluciones where cod_problema='$_REQUEST[cod]' and valida='1' and 	id_usuario='$cod_user'") or die (mysql_error());

$cantidad_solu=mysql_num_rows($query_solu);
	
	 "usuario: ".$cantidad_solu;
//si es mayor sigbifica que hay mas rrespuestas de parte del usuario	
if($cantidad_solu >= 1){
	
	mysql_query("UPDATE   soluciones set estatus=0 where cod_problema='$_REQUEST[cod]'  and 	id_usuario='$cod_user' and valida=0")  or die (mysql_error());
	}	
	
	
	
//query para saber cuantospuntos Gano
$query_puntos=mysql_query("select puntaje  from soluciones where cod_problema='$_REQUEST[cod]' and valida='1' and id_usuario=$cod_user") or die (mysql_error());	

$pun=mysql_fetch_array($query_puntos);
$puntos=$pun[puntaje];
//envio de correo cuando la resuesta este correta


		
		//-----------------------------------------------------------envio de correo----------------------
		
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
  $mail->Timeout=30;

  //Indicamos cual es la dirección de destino del correo
  $mail->AddAddress("$var_email");

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = utf8_decode("Tu respuesta ha sido correcta");
  $mail->Body = $var_usuario.utf8_decode("La Universidad Politécnica felicita tu esfuerzo, tu respuesta ha sido correcta has ganado $puntos puntos:<br> <a href='http://www.upes.edu.sv/desafio/'>http://www.upes.edu.sv/desafio/</a><br>Gracias.<br>
El equipo de Desafío Politécnica. ");

  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
  $mail->AltBody = "La Universidad Politécnica felicita tu esfuerzo, tu respuesta ha sido correcta has ganado $puntos puntos: http://www.upes.edu.sv/desafio/";
  
  //$mail->AddAttachment('../img/icon.modificar.gif','h.png');

  //se envia el mensaje, si no ha habido problemas 
  //la variable $exito tendra el valor true
  $exito = $mail->Send();

  //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
  //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
  //del anterior, para ello se usa la funcion sleep	
  



//fin del envio del correo 	
	
	
	//redireccionando si es 1 es porque vieene de la pantalla cliente
	if($_REQUEST[url]==1){
		print("<script> parent.location.href='../index.php'; </script>");
		}
		else{
	print("<script> parent.location.href='../preguntas/soluciones_enviadas.php?cod_preg=$cod_problema'; </script>"); 
		}
?>