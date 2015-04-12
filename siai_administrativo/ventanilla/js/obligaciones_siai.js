$(document).ready(function () {

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy/mm/dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $("#datepicker").datepicker($.datepicker.regional["es"]);
    $('#btnBuscar').click(function (e) {
        e.preventDefault();
        var criteria = $("input:radio[name='criteria']:checked").val();
        if (criteria > 0)
        {

            ajax = $.ajax({
                url: "ajax/busqueda_obligaciones_siai.php",
                type: "POST",
                data: {criterio: $('#criterioCarnet').val(), ciclo: 00, anio: 0000, opcion: criteria},
                beforeSend: function () {
                },
                success: function (response) {
                    $("#alertasAjax").html("");
                    if (response.execF) {
                        estructura = '';
                        $.each(response.obligaciones, function (i, obligacion) {
                            estructura += '<tr><td>' + obligacion.arancel + '</td><td>' + obligacion.descripcion + '</td><td>' + obligacion.emision + '</td><td>' + obligacion.nui + '</td><td><span class="btnIP" data-id="' + obligacion.id + '">Ingresar Pago</span></td></tr>'
                        });
                        $('#dataGrid').html(estructura);
                    } else {
                        $("#alertasAjax").html("No existen registros.");
                        $('#dataGrid').html("");
                    }
                },
                error: function (xhr, status, error) {
                }
            });
        }
        else {
            alert("Seleccione un criterio");
        }

    });
    $("#save").click(function (e) {
        if ($('#datepicker').val() != '' && $("#monto").val() != '' && $("#banco").val() != -1) {
            ajax = $.ajax({
                url: "ajax/actualizar_obligaciones_siai.php",
                type: "POST",
                data: {id: $("#llave").val(), banco: $("#banco").val(), monto: $("#monto").val(), fecha: $('#datepicker').val()},
                beforeSend: function () {
                },
                success: function (response) {
                    if (response.exec) {
                        $('#modal').modal('hide');
                        $('*[data-id="' + $("#llave").val() + '"]').closest("tr").remove();
                    } else {
                        $("#modalAlerts").html("Ocurrio un error mientras se guardaba el registro.");
                    }
                },
                error: function (xhr, status, error) {
                }
            });
        }
        else
        {
            $("#modalAlerts").html("*Faltan valores");
        }
    });
    $("#dataGrid").delegate('.btnIP', 'click', function () {
        $('#datepicker').datepicker('setDate', null);
        $("#monto").val("");
        $("#banco").val(-1);
        $("#llave").val($(this).closest("span").data("id"));
        $('#modal').modal('show');
    });
});