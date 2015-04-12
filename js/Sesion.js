$(document).ready(function () {
    $('#btnSesion').click(function (e) {
        validarUsuario($('#login #form-usuario').val(), $('#login #form-contrasena').val(), e);
    });
    $('#btnSignin').click(function (e) {
        activarCuenta($('#registro #form-carnet').val(), $('#registro #form-contrasena').val(), $('#registro #form-contrasena2').val(), $('#registro #anio').val(), $('#registro #mes').val(), $('#registro #dia').val(), $('#registro #form-email').val(), e);
    });

})
function cambiarPestana(pestana)
{
    var contenedor1 = document.getElementById('inicio_sesion_contenido');
    var contenedor2 = document.getElementById('activar_usuario_contenido');
    var contenedor3 = document.getElementById('tutorial_contenido');

    var pestana1 = document.getElementById('inicio_sesion_pestana');
    var pestana2 = document.getElementById('activar_usuario_pestana');
    var pestana3 = document.getElementById('tutorial_pestana');

    contenedor1.style.visibility = 'hidden';
    contenedor2.style.visibility = 'hidden';
    contenedor2.style.visibility = 'hidden';

    contenedor1.style.height = "0px";
    contenedor2.style.height = "0px";
    contenedor3.style.height = "0px";

    pestana1.style.opacity = "0.6";
    pestana2.style.opacity = "0.6";
    pestana3.style.opacity = "0.6";

    switch (pestana)
    {
        case 1:
            contenedor1.style.visibility = 'visible';
            contenedor1.style.height = "100%";
            pestana1.style.opacity = "1";
            break;
        case 2:
            contenedor2.style.visibility = 'visible';
            contenedor2.style.height = "100%";
            pestana2.style.opacity = "1";
            break;
        case 3:
            contenedor3.style.visibility = 'visible';
            contenedor3.style.height = "100%";
            pestana3.style.opacity = "1";
            break;
    }
}
function getDias()
{
    dia = document.getElementById('dia');
    mes = document.getElementById('mes');
    anio = document.getElementById('anio');
    if (mes.value == 2)
    {
        if ((anio.value % 4) == 0 && ((anio.value % 100) != 0 || (anio.value % 1000) == 0))
        {
            maxdia = 29;
        }
        else
        {
            maxdia = 28;
        }
    }
    else if (mes.value == 1 || mes.value == 3 || mes.value == 5 || mes.value == 7 || mes.value == 8 || mes.value == 10 || mes.value == 12)
    {
        maxdia = 31;
    }
    else
    {
        maxdia = 30;
    }
    var string = '';
    for (var i = 1; i <= maxdia; i++)
    {
        string += '<option value="' + i + '"';
        if (i == dia.value)
        {
            string += 'selected';
        }
        string += '>' + i + '</option>';
    }
    string += '';
    dia.innerHTML = string;
}

function validarUsuario(usr, pass, evento)
{
    if (usr == "" || usr == null || pass == "" || pass == null) {
        populate_and_open_modal(evento, 'modal-content-log-1');
    } else {
        usr = usr.toUpperCase();
        pass = calcMD5(pass);
        //iniciando objeto ajax
        var ajax;
        ajax = objetoAjax();
        ajax.open("GET", "sesion/iniciar_sesion.php?usuario=" + usr + "&contrasena=" + pass, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                respuesta = ajax.responseText;
                respuesta = respuesta.split("resultadosiai=");
                if (respuesta.length == 2)
                {
                    condicion = new Number(respuesta[1][0]);
                    if (condicion == 0)
                    {
                        location = "irpaso.php";
                    }
                    else if (condicion == 1)
                    {
                        populate_and_open_modal(evento, 'modal-content-log-2');
                    }
                    else if (condicion == 2)
                    {
                        populate_and_open_modal(evento, 'modal-content-log-3');
                    }
                }
                else
                {
                    populate_and_open_modal(evento, 'modal-content-log-4');
                }
            }
        }
        ajax.send(null);
    }
}
function limpiarVentana()
{
    $('#registro #form-carnet').val('');
    $('#registro #form-contrasena').val('');
    $('#registro #form-contrasena2').val('');
    $('#registro #anio').val('');
    $('#registro #mes').val('');
    $('#registro #dia').val('');
    $('#registro #form-email').val('');
}
function activarCuenta(carnet, pass, repass, anio, mes, dia, email, evento)
{
    var nacimiento;
    if (mes < 10)
    {
        mes = '0' + mes;
    }
    if (dia < 10)
    {
        dia = '0' + dia;
    }
    nacimiento = anio + '-' + mes + '-' + dia;
    if (pass.length >= 6 && repass == pass)
    {
        if (carnet == "" || carnet == null || email == "" || email == null || !validarEmail(email)) {
            populate_and_open_modal(evento, 'modal-content-sign-6');
        } else {
            //setMensaje('Activación de Usuario', '<p>Su cuenta de usuario esta siendo creada favor espere a que este proceso termine</p><div style="width:150px; margin-left:500px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>');
            carnet = carnet.toUpperCase()
            pass = calcMD5(pass);
            //iniciando objeto ajax
            var ajax;
            ajax = objetoAjax();
            ajax.open("GET", "sesion/activador.php?carnet=" + encodeURIComponent(carnet) + "&contrasena=" + encodeURIComponent(pass) + "&email=" + encodeURIComponent(email) + "&nacimiento=" + encodeURIComponent(nacimiento), true);
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4) {
                    respuesta = ajax.responseText;
                    respuesta = respuesta.split("resultadosiai=");

                    if (respuesta.length == 2)
                    {
                        condicion = new Number(respuesta[1][0]);
                        if (condicion == 0)
                        {
                            limpiarVentana();
                            populate_and_open_modal(evento, 'modal-content-sign-2');
                        }
                        else if (condicion == 1)
                        {
                            populate_and_open_modal(evento, 'modal-content-sign-3');
                        }
                        else if (condicion == 2)
                        {
                            populate_and_open_modal(evento, 'modal-content-sign-4');
                        }
                        else if (condicion == 3)
                        {
                            populate_and_open_modal(evento, 'modal-content-sign-5');
                        }
                        else if (condicion == 4)
                        {
                            populate_and_open_modal(evento, 'modal-content-sign-7');
                        }
                    }
                    else
                    {
                        populate_and_open_modal(evento, 'modal-content-sign-3');
                    }
                }
            }
            ajax.send(null);
        }
    } else
    {
        populate_and_open_modal(evento, 'modal-content-sign-1');
    }
}