<?php 
class ClassPagoAlumnos{
	
	
	public function VerificacionPagos(){
		
		$cnx= new  DBmodel();
		$con=$cnx->Open_conexion();
		
		$sql="SELECT o.arancel, o.nui,o.id_arancel,o.usuario
  			  FROM    siai_obligaciones AS o
       		  INNER JOIN siai_control AS c
       		  ON o.usuario = c.usuario
 			  WHERE c.solvente = 0;";
		$consulta=$consulta=$con->query($sql);
		
		while($pago=$consulta->fetch_assoc()){
			
		
			
			$this->valor($pago["nui"],$pago["id_arancel"],$pago["usuario"]);
			
			$sql="update asesoria set MARCAR='0' , CUPO='1' where CARNET='".$pago["usuario"]."'";
			$con->query($sql);	   
	   
			   
			}//fin del while
		
		$con->next_result();/*libero la consulta*/ 
		
		
		
		}//fin de la funcion verificacion
	
	
	
	
	
	public function valor($nui,$id_arancel,$usuario){
		
			$cnx= new  DBmodel();
			$con=$cnx->Open_conexion();
		
		
		
		/*reviso si ya pago en la tabla de pagosalumnos */
		 $sql="SELECT valor FROM pagosalumnos WHERE nui='".$nui."' AND cod_arancel='".$id_arancel."'";
		 $consulta=$con->query($sql);
		 
		 while($row=$consulta->fetch_assoc()){
			 
			 
			 	/*Realizo el update al campo estado de la tabla sia_sobligaciones*/
			$sql_actualizar="UPDATE siai_obligaciones SET estado=1 
			WHERE nui='".$nui."' AND id_arancel='".$id_arancel."' AND estado=0";
			$con->query($sql_actualizar);
			
			 
			 
			 /*oBTENGO EL SALDO ACTUAL DE LA TABLA CONTROL*/
       $sql_saldo1="SELECT saldo FROM siai_control WHERE usuario='".$usuario."'";
	   $consulta_saldo1=$con->query($sql_saldo1);
	   
			   while($saldo1=$consulta_saldo1->fetch_assoc()){
				   $saldo1_1=$saldo1["saldo"];
				   
				   }//fin del while
			 
			$saldo_Actal=$saldo1_1-$row["valor"];
			/*ACTUALIZO LA  EL SALDO DE LA TABLA*/
        $sql="UPDATE siai_control SET saldo='".($saldo_Actal)."' WHERE usuario='".$usuario."'"; 
		$con->query($sql);
		
		
		
			 
			 
			 }// fin del while
			 
			/*consulto el total a pagar para compararlos actual */
         $sql_Total_pagar1="SELECT saldo FROM siai_control WHERE usuario='".$usuario."'";
		 $consulta_Total_pagar1=$con->query($sql_Total_pagar1);
		  while($Total_pagar1=$consulta_Total_pagar1->fetch_assoc()){
				   $Saldo_alumno=$Total_pagar1["saldo"];
				   
				   }//fin del while
		  
		   /*si el saldo_actual es igual a total a pagar entonces el alumno queda solvente
            actualizo el campo solvente a 1*/
			
			if($Saldo_alumno==0){
				$sql="UPDATE siai_control SET solvente=1 WHERE usuario='".$usuario."'";
				$con->query($sql);
				}
		  
		  
		
		$con->next_result();/*libero la consulta*/ 
		}
	
	
	
	
	
	public function envio_email(){
		
			$cnx= new  DBmodel();
			$con=$cnx->Open_conexion();
		
		//query para el envio de correo
		
		$sql='SELECT control.usuario,
       		  ex.CODCARRERA,
       		 cat.email,
       		concat(cat.Nombres, " ", cat.Apellidos) AS catedratico,
       		concat(ex.NOMBRES, " ",ex.APELLIDO1," ",ex.APELLIDO2) AS alumno,
       		cat.Titulo,
       		c.NOMBRE
		  FROM siai_control AS control
			   INNER JOIN expedientealumno AS ex
				  ON control.usuario = ex.CARNET
			   INNER JOIN carrera AS c
				  ON ex.CODCARRERA = c.CODIGO_CAR
			   INNER JOIN proc_coordinadorcarrera AS coor
				  ON coor.CODIGO_CAR = c.CODIGO_CAR
			   INNER JOIN proc_catedraticos cat
				  ON coor.idCatedratico = cat.idCatedratico
		 WHERE paso = 4 AND solvente = 1';
			
				
		
		 $consulta_coordinadores=$con->query($sql);
		
		/****************************************************************
			Rutina para el envio de email
		*****************************************************************/
		
		$mail = new phpmailer();
		$config=new ClassConfiguracion();
		
		
		
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
		  
		 //$mail->Host = "mail.conamype.gob.sv";
		$mail->Host=$config->getHost();
		  //Le indicamos que el servidor smtp requiere autenticación
		  
		  $mail->SMTPAuth = true;
		  //$mail->Port=587;
		  $mail->Port=$config->getPuerto();
		  //Le decimos cual es nuestro nombre de usuario y password
		 
		 
		 //$mail->Username = "prueba_outstanding@conamype.gob.sv"; 
		 //$mail->Password = "Prueb@2012";
		  $mail->Username=$config->getUsuario();
		  $mail->Password=$config->getPasword();
		  //Indicamos cual es nuestra dirección de correo y el nombre que 
		  //queremos que vea el usuario que lee nuestro correo
  
	 $mail->From = "denysurquilla@grupopabe.com";
    //$mail->From="sistema@politecnica.edu.sv";
	$mail->FromName = utf8_decode("SIAI(Sistema de Inscripción de Asignaturas via Internet)");
	
	$mail->Timeout=30;
	
	
	
	
	while($row= $consulta_coordinadores->fetch_assoc()){
	
	$mail->AddBCC($row["email"]);
  
   //$mail->AddBCC("denysurquillam@gmail.com");
  $fecha="Fecha :".date("d-m-Y")." Hora: ".date("h:i:s");
  
   //$mail->AddBCC("robert.programer@gmail.com");
   
     $mail->Subject = utf8_decode("Incripcion Realizada");
	 
	 $mail->Body = utf8_decode("Buen día <b>".$row["Titulo"]." ".$row["catedratico"]. "</b> <br> Tiene una inscripción de asignaturas perteneciente al alumno <b>".$row["alumno"]. " </b> de la carrera de <b> ".$row["NOMBRE"]." </b> favor validar las asignaturas inscritas  <br> 
	 ".$fecha."
	 <br><br>Gracias.<br>
Sistema de Información SIAI. <br>
<a href='http://www.upes.edu.sv'>Universidad Politécnica de El Salvador</a>");

//Definimos AltBody por si el destinatario del correo no admite email con formato html 
   $mail->AltBody = "SIAI  http://www.upes.edu.sv"; 
   
     //se envia el mensaje, si no ha habido problemas 
  //la variable $exito tendra el valor true
   $exito = $mail->Send(); 
				}//fin del while
		
		$con->next_result();/*libero la consulta*/ 
		
		}// frin de la funcion
	
	
	
	}// fin de la clase
