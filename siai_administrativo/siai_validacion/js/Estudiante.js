var carnet;
var contenedorDirCasa;
var contenedorTelCasa;
var contenedorCelular;
var contenedorEmail;
var contenedorEmpresa;
var contenedorDirTrabajo;
var contenedorTelTrabajo;


function setElementos()
{
	carnet=document.getElementById('carnet').value;
	contenedorDirCasa=document.getElementById('dir_casa');
	contenedorTelCasa=document.getElementById('telefono_casa');
	//contenedorCelular=document.getElementById('celular');
	contenedorEmail=document.getElementById('email');
	contenedorEmpresa=document.getElementById('empresa');
	contenedorDirTrabajo=document.getElementById('dir_trabajo');
	contenedorTelTrabajo=document.getElementById('telefono_trabajo');
}


function validarDatos()
{
	
	var valido=false;
	if(contenedorDirCasa.value!='' && contenedorTelCasa.value!='' && contenedorEmail.value!='')
	{
		if(validarTelefono(contenedorTelCasa.value))
		{
			if(validarEmail(contenedorEmail.value))
			{
				valido=true;	
			}
			else
			{
				alert("El correo electrónico ingresado no es valido, verifique si el correo ingresado esta correctamente escrito e intentelo nuevamente.");
			}		
		}
		else
		{
			alert("El teléfono ingresado no es valido, por favor ingrese nuevamente su número de teléfono 2225-7810");
		}		
	}
	else
	{
		alert("La dirección de su lugar de residencia, teléfono y correo electronico(email) son campos requeridos para realizar el proceso de inscripción, favor actualizar como mínimo esos parametros para poder continuar.");
	}
	return valido;
}



function actualizar()
{
	var direccion=encodeURIComponent(contenedorDirCasa.value);
	
	var telcasa=encodeURIComponent(contenedorTelCasa.value);
	
	var email= encodeURIComponent(contenedorEmail.value);
	
	var empresa=encodeURIComponent(contenedorEmpresa.value);
	
	var dirtrabajo=encodeURIComponent(contenedorDirTrabajo.value);
	
	var teltrabajo=encodeURIComponent(contenedorTelTrabajo.value);
	
	if(validarDatos())
	{
		var ajax;
		ajax = objetoAjax();
		//alert("estudiante/actualizar_datos.php?dircasa="+direccion+"&telcasa="+telcasa+"&email="+email+"&empresa="+empresa+"&dirtrabajo="+dirtrabajo+"&teltrabajo="+teltrabajo);
		ajax.open("GET", "estudiante/actualizar_datos.php?dircasa="+direccion+"&telcasa="+telcasa+"&email="+email+"&empresa="+empresa+"&dirtrabajo="+dirtrabajo+"&teltrabajo="+teltrabajo, true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				respuesta=ajax.responseText;
				//alert(respuesta);
				respuesta=respuesta.split("resultadosiai=");
				if(respuesta.length==2)
				{
					if(respuesta[1][0]==1)
					{
						location.href="paso2.php";
					}
					else
					{
						setMensaje('Actualización de Datos','<p>El usuario no pudo ser actualizado, favor intentar en otro momento</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
					}
				}
				else
				{
					alert(ajax.responseText);
				}
			}
		}
		ajax.send(null);		
	}
}