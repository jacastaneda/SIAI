function cambiarPestana(pestana)
{
	var contenedor1=document.getElementById('inicio_sesion_contenido');
	var contenedor2=document.getElementById('activar_usuario_contenido');
	var contenedor3=document.getElementById('tutorial_contenido');
	
	var pestana1=document.getElementById('inicio_sesion_pestana');
	var pestana2=document.getElementById('activar_usuario_pestana');
	var pestana3=document.getElementById('tutorial_pestana');
	
	contenedor1.style.visibility='hidden';
	contenedor2.style.visibility='hidden';
	contenedor2.style.visibility='hidden';
	
	contenedor1.style.height="0px";
	contenedor2.style.height="0px";
	contenedor3.style.height="0px";
	
	pestana1.style.opacity="0.6";
	pestana2.style.opacity="0.6";
	pestana3.style.opacity="0.6";
	
	switch(pestana)
	{
		case 1:
			contenedor1.style.visibility='visible';
			contenedor1.style.height="100%";
			pestana1.style.opacity="1";
			break;
		case 2:
			contenedor2.style.visibility='visible';
			contenedor2.style.height="100%";
			pestana2.style.opacity="1";
			break;
		case 3:
			contenedor3.style.visibility='visible';
			contenedor3.style.height="100%";
			pestana3.style.opacity="1";
			break;
	}
}
function getDias()
{
	dia=document.getElementById('dia');
	mes=document.getElementById('mes');
	anio=document.getElementById('anio');
	if(mes.value==2)
	{
		if((anio.value%4)==0 && ((anio.value%100)!=0 || (anio.value%1000)==0))
		{
			maxdia=29;
		}
		else
		{
			maxdia=28;
		}
	}
	else if(mes.value==1 || mes.value==3 || mes.value==5 || mes.value==7 || mes.value==8 || mes.value==10 || mes.value==12)
	{
		maxdia=31;
	}
	else
	{
		maxdia=30;
	}
	var string='<select id="dia">';
	for(var i=1; i<=maxdia;i++)
	{
		string+='<option value="'+i+'"';
		if(i==dia.value)
		{
			string+='selected';
		}
		string+='>'+i+'</option>';
	}
	string+='</select>';
	dia.innerHTML=string;
}

function validarUsuario(usr,pass)
{
    if(usr=="" || usr==null || pass=="" || pass==null){		
        setMensaje('Información Incompleta','<br><p>Ingrese Usuario y Contraseña para poder iniciar sesión</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
    }else{
		usr=usr.toUpperCase()
        pass=calcMD5(pass);
        //iniciando objeto ajax
        var ajax;
        ajax = objetoAjax();	
        ajax.open("GET", "sesion/iniciar_sesion.php?usuario="+usr+"&contrasena="+pass, true);
        ajax.onreadystatechange=function() {
            if (ajax.readyState==4) {
                respuesta=ajax.responseText;
                respuesta=respuesta.split("resultadosiai=");
                if(respuesta.length==2)
                {
                    condicion=new Number(respuesta[1][0]);
                    if(condicion==0)
                    {
                        location="irpaso.php";
                    }
                    else if(condicion==1)
                    {
                        setMensaje('Error de inicio de sesion','<p>El usuario o la contraseña ingresada no son correctas</p><p><a href="">¿He olvidado mi contraseña?</a></p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
                    }
                    else if(condicion==2)
                    {
                        setMensaje('Inicio de Sesión','<p>Aun no has activado tu cuenta, busca en tu correo electrónico un mensaje con el vinculo de activación</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
                    }
                }
                else
                {
                    setMensaje('Error de inicio de sesion','<p>Ingrese Usuario y Contraseña para poder iniciar sesión</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
                }
            }
        }
        ajax.send(null);        
    }
}
function limpiarVentana()
{
	document.getElementById('carnet').value='';
	document.getElementById('usr').value='';
	document.getElementById('pass').value='';
	document.getElementById('pass1').value='';
	document.getElementById('repass1').value='';
	document.getElementById('email').value='';
	cambiarPestana(1);
}
function activarCuenta(carnet,pass, repass ,anio, mes, dia, email)
{
	var nacimiento;
	if(mes<10)
	{
		mes='0'+mes;
	}
	if(dia<10)
	{
		dia='0'+dia;
	}
	nacimiento=anio+'-'+mes+'-'+dia;
	if(pass.length>=6 && repass==pass)
	{
		if(carnet=="" || carnet==null || email=="" || email==null){
			setMensaje('Información Incompleta','<br><p>Ingrese todos los datos solicitados para poder activar su cuenta de usuario</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
		}else{
			setMensaje('Activación de Usuario','<p>Su cuenta de usuario esta siendo creada favor espere a que este proceso termine</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');	
			
			carnet=carnet.toUpperCase()
			pass=calcMD5(pass);
			//iniciando objeto ajax
			var ajax;
			ajax = objetoAjax();
			ajax.open("GET", "sesion/activador.php?carnet="+encodeURIComponent(carnet)+"&contrasena="+encodeURIComponent(pass)+"&email="+encodeURIComponent(email)+"&nacimiento="+encodeURIComponent(nacimiento), true);			
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					respuesta=ajax.responseText;
					respuesta=respuesta.split("resultadosiai=");				
					if(respuesta.length==2)
					{
						condicion=new Number(respuesta[1][0]);
						if(condicion==0)
						{
							limpiarVentana();
							setMensaje('Activación de Usuario','<p>Su cuenta de usuario ha sido creada con exito.</p><p>Se ha enviado un correo con el enlace de verificación, Usted podrá iniciar sesión despues de haber realizado la verificación</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
						}
						else if(condicion==1)
						{
							setMensaje('Activación de Usuario','<p>Error de conexion, no se puede ingresar al Sistema de Inscripción en este momento</p><p>Favor intentelo de nuevo en otro momento</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
						}
						else if(condicion==2)
						{
							setMensaje('Activación de Usuario','<p>Los datos ingresados no coinciden con los registrados por la Universidad Politécnica por lo cual no se puede confirmar su identidad</p><p>Si esta seguro que los datos ingresados son los correctos, actualice sus datos en las instalaciones de La Universidad</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
						}
						else if(condicion==3)
						{
							setMensaje('Activación de Usuario','<p>El carnet ingresado corresponde a un usuario activo en el sistema, si usted no activo esta cuenta reportelo a las autoridades de la Universidad</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
						}
					}
					else
					{
						setMensaje('Activación de Usuario','<p>Error de conexion, no se puede ingresar al Sistema de Inscripción en este momento</p><p>Favor intentelo de nuevo en otro momento</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
					}
				}
			}
			ajax.send(null);			
		}
	}else
	{
		setMensaje('Activación de Usuario','<p>La contraseña ingresada no es valida</p><p>La contraseña y la confirmación de la contraseña deben ser iguales y tener mas de 6 caracteres</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
	}
}