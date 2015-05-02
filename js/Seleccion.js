// JavaScript Document
$(document).ready(function (ev) {
    $("#btnSiguiente").click(function (e) {
        populate_and_open_modal(e, 'modal-content-5');
    });


    var iAsignaturas = new Array();
});
function nextTask(e) {
    //alert(1);
    $('#btnModalAceptar').attr('disabled','disabled');
    validarSeleccion(e);
}
function seleccionAsignatura(contenedor, indice)
{
    var secciones = document.getElementById('secciones' + indice);
    if (contenedor.checked)
    {
        secciones.style.visibility = "visible";
        secciones.style.height = "auto";
    }
    else
    {
        secciones.style.visibility = "hidden";
        secciones.style.height = "0px";
    }
}
function informacionAsignatura(indice)
{
    var horarios = document.getElementById('horarios');
    var ajax;
    ajax = objetoAjax();

    ajax.open("GET", "horario/detalle_horario.php?indice=" + indice, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            horarios.innerHTML = ajax.responseText;
        }
    }
    ajax.send(null);
}


function validarSeleccion(evento)
{
    var url = 'seleccion/validar.php?nasignaturas=' + iAsignaturas.length;
    var seccion;
    var iSeleccion = 0;
    for (var i = 0; i < iAsignaturas.length; i++)
    {
        if (document.getElementById('asignatura' + i).checked)
        {
            secciones = document.getElementsByName('seccion' + i);
            for (var ii = 0; ii < secciones.length; ii++)
            {
                if (secciones[ii].checked)
                {
                    seccion = secciones[ii].value;
                }
            }
            url = url + '&seccion' + i + '=' + seccion;
            iSeleccion++;
        }
    }
    //alert(url)
    if (iSeleccion != 0)
    {
        var ajax;
        ajax = objetoAjax();
        ajax.open("GET", url, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                respuesta = ajax.responseText;
                respuesta = respuesta.split("resultadosiai=");
                if (respuesta.length == 2)
                {
                    condicion = new Number(respuesta[1][0]);
                    if (condicion == 0)
                    {
                        location.href = "paso3.php";
                    }
                    else if (condicion == 3)
                    {
                        populate_and_open_modal(evento, 'modal-content-2');
                    }
                    else
                    {
                        var ajax2;
                        ajax2 = objetoAjax();
                        ajax2.open("GET", 'seleccion/mensaje_choque.php', true);
                        ajax2.onreadystatechange = function () {
                            if (ajax2.readyState == 4) {
                                respuesta = ajax2.responseText;
                                $("#mnsgChoque").html(respuesta);
                                populate_and_open_modal(evento, 'modal-content-1');
                            }
                        }
                        ajax2.send(null);
                    }
                }
                else
                {
                    populate_and_open_modal(evento, 'modal-content-3');
                }
                
                $('#btnModalAceptar').removeAttr('disabled');
            }
        }
        ajax.send(null);
    }
    else
    {
        populate_and_open_modal(evento, 'modal-content-4');
    }
}
function verFormularioChoque()
{
    var ajax;
    ajax = objetoAjax();
    ajax.open("GET", 'seleccion/formulario_choque.php', true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            respuesta = ajax.responseText;
            alert(respuesta);
            //setMensaje('Formulario para inscripción de asignaturas con choqhe de horario',respuesta);							
        }
    }
    ajax.send(null);
}

