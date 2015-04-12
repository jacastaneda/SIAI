var carnet;
var contenedorDirCasa;
var contenedorTelCasa;
var contenedorCelular;
var contenedorEmail;
var contenedorEmpresa;
var contenedorDirTrabajo;
var contenedorTelTrabajo;
$(document).ready(function () {
    setElementos();
    $("#btnSiguiente").click(function (e) {
        actualizar(e);
    });
});
function setElementos()
{
    carnet = document.getElementById('carnet').value;
    contenedorDirCasa = document.getElementById('dir_casa');
    contenedorTelCasa = document.getElementById('telefono_casa');
    //contenedorCelular=document.getElementById('celular');
    contenedorEmail = document.getElementById('email');
    contenedorEmpresa = document.getElementById('empresa');
    contenedorDirTrabajo = document.getElementById('dir_trabajo');
    contenedorTelTrabajo = document.getElementById('telefono_trabajo');
}


function validarDatos(evento)
{

    var valido = false;
    if (contenedorDirCasa.value != '' && contenedorTelCasa.value != '' && contenedorEmail.value != '')
    {
        if (validarTelefono(contenedorTelCasa.value))
        {
            if (validarEmail(contenedorEmail.value))
            {
                valido = true;
            }
            else
            {
                populate_and_open_modal(evento, 'modal-content-1');
            }
        }
        else
        {
            populate_and_open_modal(evento, 'modal-content-2');
        }
    }
    else
    {
        populate_and_open_modal(evento, 'modal-content-3');
    }
    return valido;
}



function actualizar(evento) {
    var direccion = encodeURIComponent(contenedorDirCasa.value);

    var telcasa = encodeURIComponent(contenedorTelCasa.value);

    var email = encodeURIComponent(contenedorEmail.value);

    var empresa = encodeURIComponent(contenedorEmpresa.value);

    var dirtrabajo = encodeURIComponent(contenedorDirTrabajo.value);

    var teltrabajo = encodeURIComponent(contenedorTelTrabajo.value);

    if (validarDatos(evento))
    {
        var ajax;
        ajax = objetoAjax();
        //alert("estudiante/actualizar_datos.php?dircasa="+direccion+"&telcasa="+telcasa+"&email="+email+"&empresa="+empresa+"&dirtrabajo="+dirtrabajo+"&teltrabajo="+teltrabajo);
        ajax.open("GET", "estudiante/actualizar_datos.php?dircasa=" + direccion + "&telcasa=" + telcasa + "&email=" + email + "&empresa=" + empresa + "&dirtrabajo=" + dirtrabajo + "&teltrabajo=" + teltrabajo, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                respuesta = ajax.responseText;
                respuesta = respuesta.split("resultadosiai=");
                if (respuesta.length == 2)
                {
                    if (respuesta[1][0] == 1)
                    {
                        location.href = "paso2.php";
                    }
                    else
                    {
                        populate_and_open_modal(evento, 'modal-content-4');                        
                    }
                }
                else
                {
                    populate_and_open_modal(evento, 'modal-content-4');//alert(ajax.responseText);
                }
            }
        }
        ajax.send(null);
    }
}