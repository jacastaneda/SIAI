// JavaScript Document

function seleccionAsignatura(contenedor,indice)
{
	var secciones=document.getElementById('secciones'+indice);
	if(contenedor.checked)
	{
		secciones.style.visibility="visible";
		secciones.style.height="auto";			
	}
	else
	{
		secciones.style.visibility="hidden";
		secciones.style.height="0px";	
	}
}
function informacionAsignatura(indice)
{
	var horarios=document.getElementById('horarios');
	var ajax;
	ajax = objetoAjax();
	
	ajax.open("GET", "horario/detalle_horario.php?indice="+indice, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			horarios.innerHTML=ajax.responseText;
		}
	}
	ajax.send(null);
}

var iAsignaturas=new Array();

function validarSeleccion()
{
	var url='seleccion/validar.php?nasignaturas='+iAsignaturas.length;
	var seccion;
	var iSeleccion=0;
	for(var i=0; i<iAsignaturas.length; i++)
	{
		if(document.getElementById('asignatura'+i).checked)
		{
			secciones=document.getElementsByName('seccion'+i);
			for(var ii=0; ii<secciones.length;ii++)
			{
				if(secciones[ii].checked)
				{
					seccion=secciones[ii].value;
				}
			}
			url=url+'&seccion'+i+'='+seccion;
			iSeleccion++;
		}
	}
	if(iSeleccion!=0)
	{	
		var ajax;
		ajax = objetoAjax();
		ajax.open("GET", url, true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				respuesta=ajax.responseText;
				respuesta=respuesta.split("resultadosiai=");
				if(respuesta.length==2)
				{
					condicion=new Number(respuesta[1][0]);
					if(condicion==0)
					{
						location.href="paso3.php";
					}
					else if(condicion==3)
					{
						setMensaje('Cupo Agotado','<p>No se puede continuar el proceso de inscripción debido a que una o más de las secciones seleccionadas, ha agotado sus cupos disponibles</p><p>Seleccione otra sección o deseleccione la materia para poder continuar con el proceso de inscripción</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
					}
					else
					{
						var ajax2;
						ajax2 = objetoAjax();
						ajax2.open("GET", 'seleccion/mensaje_choque.php', true);
						ajax2.onreadystatechange=function() {
							if (ajax2.readyState==4) {
								respuesta=ajax2.responseText;
								setMensaje('Choqhe de Horario',respuesta);							
							}
						}
						ajax2.send(null);
					}
				}
				else
				{
					setMensaje('Error de Selección de Materias','<p>Se ha detectado un error al intentar de registrar su selección</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
				}
			}
		}
		ajax.send(null);
	}
	else
	{
		setMensaje('Error de Selección de Materias','<p>No se detecta ninguna asignatura seleccionada, favor seleccione las asignaturas que desea inscribir y vuelva a intentar</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
	}
}
function verFormularioChoque()
{
	var ajax;
	ajax = objetoAjax();
	ajax.open("GET", 'seleccion/formulario_choque.php', true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			respuesta=ajax.responseText;
			setMensaje('Formulario para inscripción de asignaturas con choqhe de horario',respuesta);							
		}
	}
	ajax.send(null);
}

