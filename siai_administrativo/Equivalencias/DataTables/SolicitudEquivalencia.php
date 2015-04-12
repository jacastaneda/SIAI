<?php
require_once 'funciones/conexiones.php';
session_start();
if (isset($_POST["CARNET"])) {
    $_SESSION['CARNET'] = serialize($_POST["CARNET"]);
}
if (isset($_SESSION['CARNET'])) {
    $g_CARNET = unserialize($_SESSION['CARNET']);
}
//$g_IdUniversidad=$_POST["idUniversidad"];    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset = UTF-8" />		
        <title>Solicitud de Equivalencia</title>
        <link rel="stylesheet" type="text/css" href="media/css/style4.css" />
        <style type="text/css" title="currentStyle">
            @import "media/css/demo_page.css";
            @import "media/css/demo_table.css";
            @import "funciones/formatoInput.css";
        </style>
        <script type="text/javascript" src="media/js/jquery.js"></script>
        <script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>

        <link href="media/css/redmond/jquery-ui-1.9.2.custom.css" rel="stylesheet">                
        <script src="media/js/jquery-ui-1.9.2.custom.js"></script>                
        <script src="development-bundle/ui/i18n/jquery.ui.datepicker-es.js"></script>

        <script type="text/javascript" charset="utf-8">
            var procedimiento = "nuevo";
            function initTable (){
                return $('#example').dataTable( {
                    "oLanguage":{"sUrl": "media/language/es_ES.txt"},                                               
                    "bRetrieve": true,
                    "bDestroy": true
                } );
            }

            function tableActions (){
                var oTable = initTable();
                // perform API operations with oTable
            }
            function inicio(){  
                initTable();
                tableActions();
            }
            $(document).ready(function(){
                $(window).resize(function(){
                    $('#formularioRegistrar').css({
                        position:'absolute',
                        left: ($(window).width() - $('#formularioRegistrar').outerWidth())/2,
                        top: ($(window).height() - $('#formularioRegistrar').outerHeight())/2
                    });	  
                });
                $(window).resize();  
                inicio();
                $(".arrastable").draggable();
                $("#txtfechaIngreSolicitud").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
                $("#txtfechaIngreSolicitud" ).datepicker($.datepicker.setDefaults($.datepicker.regional['es']));  
                    
                $("#loader").hide();
                $("#formularioRegistrar").hide();
                $('#container_buttons').click(function(){
                    //alert('di click')                    
                    $('#target').submit();
                })
                $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nueva Solicitud");
                    procedimiento = "nuevo";

                    if ($("#btnNuevo").val()=="Agregar Solicitud"){ 
                        $idCarnet = $('#idCarnetParam').attr("value");
                        var parametros = {
                            "idCarnet" : $idCarnet
                        }
                        $.ajax({
                            url:"buscarCarnetUPES.php",
                            data: parametros,
                            type: "POST",
                            dataType: "json",
                            error: 
                                function(objeto, quepaso, otroobj){
                                alert("Estas viendo esto por que fallé:"+ objeto);
                                alert("Pasó lo siguiente: "+quepaso);
                                alert("Error: "+otroobj);
                            },
                            success:
                                function(respuesta){
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");                                          
                                $("#txtnombresSolicitante").val(respuesta.NOMBRES);
                                $("#txtPrimerApellidoSolicitante").val(respuesta.APELLIDO1);
                                $("#txtsegundoApellidoSolicitante").val(respuesta.APELLIDO2);
                                $("#txtapellidoCasadaSolicitante").val(respuesta.APELLCASAD);
                                        
                            }                        
                        })
                        var dataString = {                            
                            "Accion": 'Nuevo'
                        }
                        $.ajax({
                            type: "POST",
                            url: "ajaxEstadoSolicitud.php",
                            data: dataString,
                            cache: false,
                            success: function(data){
                                //$("#txtidEstadoSolicitudEqui").html('<option selected="selected">Seleccione un Estado</option>');
                                $("#txtidEstadoSolicitudEqui").html(data);
                            } 
                        });
                        $.ajax({
                            type: "POST",
                            url: "ajaxCoordinador.php",
                            data: dataString,
                            cache: false,
                            success: function(data){
                                //$("#txtidEstadoSolicitudEqui").html('<option selected="selected">Seleccione un Estado</option>');
                                $("#txtidCatedratico").html(data);
                            } 
                        });
                        $("#txtnumeroCarne").attr("value",$idCarnet);
                        $("#txtidSolicitudEqui").attr("value",'');
                        //$("#txtidEstadoSolicitudEqui").attr("value",'');
                        $("#txtfechaIngreSolicitud").attr("value",getdate());
                        //$("#txtidCatedratico").attr("value",'');
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Solicitud");
                    }
                    else{
                        alert("otro")
                    }
                })
                
                $("#btnProcesar").click(function(){
                    $idCarnet = $('#idCarnetParam').attr("value");
                    
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();
                    
                    if(procedimiento == "nuevo"){                        
                        $.ajax({
                            url: "guardarSolicitud.php",
                            type: "POST",
                            data: datos,
                            success:
                                function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                //location.reload(true);                                
                                cargarTabla($idCarnet);
                            }
                        })
                    }
                    else if(procedimiento == "editar"){                        
                        $.ajax({
                            url: "editarSolicitud.php",
                            type: "POST",
                            data: datos,
                            success:
                                function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                //location.reload(true);
                                cargarTabla($idCarnet);                                
                            }
                        })
                    }
                })                  
            });
            
            function eliminar(v_solicitud){
                if(confirm("Esta seguro que desea eliminar esta Solicitud?")){
                    $("#btnNuevo").val("Cancelar");
                    v_Carnet = $('#idCarnetParam').attr("value");
                    $.ajax({
                        url:"eliminarSolicitud.php",
                        data: {
                            'idSolicitud': v_solicitud
                        },
                        type: "POST",
                        success:
                            function(respuesta){
                            alert(respuesta);
                            cargarTabla(v_Carnet);
                            //inicio();
                        }                        
                    })
                }
            }
            
            function cargarTabla(v_carne){
                $.ajax({
                    url:"SolicitudReload.php",
                    data: {
                        'carnet': v_carne 
                    },
                    type: "POST",
                    success:
                        function(respuesta){
                        document.getElementById('detalle').innerHTML=respuesta;                                                
                        $("#btnNuevo").attr("value",'Agregar Solicitud');  
                        inicio();
                    }                        
                })
                
            }
            
            function editar(v_solicitud){
                $("#leyenda").html("Actualizar Solicitud");
                procedimiento = "editar";
                var parametros = {
                    "idSolicitud" : v_solicitud
                }
                $.ajax({
                    url:"buscarSolicitud.php",
                    data: parametros,
                    type: "POST",
                    dataType: "json",
                    success:
                        function(respuesta){
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");                                                               
                        $("#txtidSolicitudEqui").val(respuesta.idSolicitudEqui);
                        $("#txtidEstadoSolicitudEqui").val(respuesta.EstadoSolicitudEqui);
                        $("#txtfechaIngreSolicitud").val(respuesta.fechaIngreSolicitud);
                        $("#txtnumeroCarne").val(respuesta.numeroCarne);
                        $("#txtnombresSolicitante").val(respuesta.nombresSolicitante);
                        $("#txtPrimerApellidoSolicitante").val(respuesta.PrimerApellidoSolicitante);
                        $("#txtsegundoApellidoSolicitante").val(respuesta.segundoApellidoSolicitante);
                        $("#txtapellidoCasadaSolicitante").val(respuesta.apellidoCasadaSolicitante);
                        $("#txtidCatedratico").val(respuesta.idCatedratico);                                
                    }                        
                })
            }
        </script>
    </head>
    <body id="dt_example" class="ex_highlight_row">    	
        <div id="container" style="width:80%">
            <div class="container">
                <section>
                    <div id="container_buttons">
                        <form id="target" action="vistaExpedieteAlumno.php" method="post">
                           <!--<input name="idUniversidad" id="idUniversidad" type="hidden" value= "<?php echo $g_IdUniversidad ?> "/>-->   
                        </form>
                        <p><a class="a_demo_four" href="#">Volver a Expedientes</a></p>
                    </div>
                </section>
            </div>
            <div class="full_width big">
                <table>
                    <tr>
                        <td>Alumno</td>
                        <td>:</td>
                        <td>
                            <select name="idCarnet" id="idCarnetParam">                        
                                <?php
                                $con1 = Conectar();
                                $sql1 = "select ea.CARNET,ea.NOMBRES,ea.APELLIDO1,ea.APELLIDO2,ea.APELLCASAD from expedientealumno ea where ea.CARNET= '$g_CARNET' ";
                                $q1 = mysql_query($sql1, $con1) or die("Problemas al ejecutar la consulta");
                                while ($datos = mysql_fetch_array($q1)) {
                                    echo '<option value="' . $datos['CARNET'] . '">' . $datos['NOMBRES'] . ' ' . $datos['APELLIDO1'] . ' ' . $datos['APELLIDO2'] . ' ' . $datos['APELLCASAD'] . '</option>';
                                }
                                desconectar();
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="full_width big">Solicitud de Equivalencia</div>
            <h1>Informaci&oacute;n</h1>
            <div class="demo_jui" id="detalle">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
                    <thead>
                        <tr>
                            <th>Id Solicitud</th>
                            <th>Fecha Ingreso</th>                        
                            <th>Estado</th>
                            <th>Ingresada Por</th>
                            <!--<th>Editar</th>-->
                            <th>Eliminar</th>
                            <th>Equivalencias</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        $con = Conectar();
                        $sql = "select se.idSolicitudEqui,se.idEstadoSolicitudEqui,DATE_FORMAT(fechaIngreSolicitud, '%d/%m/%Y') as fechaIngreSolicitud ,se.numeroCarne,se.nombresSolicitante,
                    se.PrimerApellidoSolicitante,se.segundoApellidoSolicitante,se.apellidoCasadaSolicitante,se.idCatedratico,
                    ct.Nombres,ct.Apellidos,es.nombreEstadoSoliEqui from proc_solicitudequivalencia se, proc_catedraticos ct, proc_estadosoliequivalencia es
                    where se.numeroCarne = '$g_CARNET' and ct.idCatedratico= se.idCatedratico and es.idEstadoSolicitudEqui = se.idEstadoSolicitudEqui order by se.idSolicitudEqui";
                        $q = mysql_query($sql, $con) or die("Problemas al ejecutar la consulta");
                        while ($datos = mysql_fetch_array($q)) {
                            ?>
                            <tr>    <td><?php echo $datos['idSolicitudEqui']; ?></td>
                                <td><?php echo $datos['fechaIngreSolicitud']; ?></td>                        
                                <td><?php echo $datos['nombreEstadoSoliEqui']; ?></td>			
                                <td><?php echo $datos['Nombres'] . ' ' . $datos['Apellidos']; ?></td>                        
                                <td>                          
                                    <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idSolicitudEqui']; ?>')" />
                                </td>
                                <th>
                                    <form action="Equivalencias.php" method="post">
                                        <input name="CARNET" id="CARNET" type="hidden" value="<?php echo $datos['numeroCarne']; ?>">                                
                                        <input name="idSolicitudEqui" id="idSolicitudEqui" type="hidden" value="<?php echo $datos['idSolicitudEqui']; ?>">
                                        <input value="Equivalencias" type="submit">
                                        <form action="Carrera.php" method="post">                                
                                        </form>
                                    </form>
                                </th>
                            </tr>
                            <?php
                        }
                        desconectar();
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>                        
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="spacer"></div>			
        </div>
        <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Solicitud" />
        </div>
    <br />   
    <div class="arrastable" id="formularioRegistrar" align="center"  style='width:350px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
        <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Solicitud de Equivalencia</div>
        <form name="frmRegistrar" id="frmRegistrar">
            <fieldset style="display: inline;">
                <legend id="leyenda">Registrar Nueva Solicitud</legend>   
                <table>
                    <tr>
                        <td>Id Solicitud</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidSolicitudEqui" name="txtidSolicitudEqui" />
                        </td>
                    </tr>
                    <tr>
                        <td>F. de Ingreso</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtfechaIngreSolicitud" name="txtfechaIngreSolicitud" />
                        </td>
                    </tr>
                    <tr>
                        <td>Estado Solicitud</td>
                        <td>:</td>
                        <td>
                            <!--<input type="text"  id="txiidEstadoSolicitudEqui" name="txtidEstadoSolicitudEqui" />-->
                            <select id="txtidEstadoSolicitudEqui" name="txtidEstadoSolicitudEqui" />
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Carn&eacute;</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtnumeroCarne" name="txtnumeroCarne" />
                        </td>
                    </tr>
                    <tr>
                        <td>Nombres</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtnombresSolicitante" name="txtnombresSolicitante" />
                        </td>
                    </tr>
                    <tr>
                        <td>P. Apellido</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtPrimerApellidoSolicitante" name="txtPrimerApellidoSolicitante" />
                        </td>
                    </tr>
                    <tr>
                        <td>S. Apellido</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtsegundoApellidoSolicitante" name="txtsegundoApellidoSolicitante" />
                        </td>
                    </tr>
                    <tr>
                        <td>A. Casada</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtapellidoCasadaSolicitante" name="txtapellidoCasadaSolicitante" />
                        </td>
                    </tr>
                    <tr>
                        <td>Coordinador</td>
                        <td>:</td>
                        <td>
                            <!--<input type="text" id="txtidCatedratico" name="txtidCatedratico" />-->
                            <select id="txtidCatedratico" name="txtidCatedratico" />
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap  colspan="2" align="right" >
                            <input type="button" id="btnProcesar" name="btnProcesar" value="Agregar" />
                        </td>
                        <td align="center">
                            <input type="reset" align="center"  name="btnBorrar" id="btnBorrar" value="Limp&iacute;ar Formulario" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <div id="loader">
                                <img src="images/loader.gif" />
                            </div>
                        </td>
                    </tr>
                </table> 
            </fieldset>
        </form>

    </div>   
</body>
</html>