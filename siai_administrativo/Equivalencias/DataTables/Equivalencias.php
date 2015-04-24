<?php
require_once 'funciones/conexiones.php';
session_start();
if (isset($_POST["CARNET"])) {
    $_SESSION['CARNET'] = serialize($_POST["CARNET"]);
}
if (isset($_SESSION['CARNET'])) {
    $g_CARNET = unserialize($_SESSION['CARNET']);
}
if (isset($_POST["idSolicitudEqui"])) {
    $_SESSION['idSolicitudEqui'] = serialize($_POST["idSolicitudEqui"]);
}
if (isset($_SESSION['idSolicitudEqui'])) {
    $g_idSolicitud = unserialize($_SESSION['idSolicitudEqui']);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset = UTF-8" />		
        <title>Equivalencia por Alumno</title>
        <link rel="stylesheet" type="text/css" href="media/css/style4.css" />
        <style type="text/css" title="currentStyle">
            @import "media/css/demo_page.css";
            @import "media/css/demo_table.css";
            @import "funciones/formatoInput.css";
        </style>
        <script type="text/javascript" src="media/js/jquery.js"></script>
        <script src="media/js/jquery-ui-1.9.2.custom.js"></script>
        <script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>

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

            $(document).ready(function() {
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
                $('#container_buttons').click(function(){
                    //alert('di click')                    
                    $('#target').submit();
                })  
                $("#idUniversidadParam").change(function(){
                    var idUniversidad=$(this).val();
                    var dataString = 'idUniversidad='+ idUniversidad;                        
                    $.ajax({
                        type: "POST",
                        url: "ajaxFacultad.php",
                        data: dataString,
                        cache: false,
                        success: function(html){                                
                            $("#idFacultadEquiParam").html('<option selected="selected">---Seleccione una Facultad---</option>');
                            $("#idCarreraParam").html('<option selected="selected">---Seleccione una Carrera---</option>');
                            $("#idFacultadEquiParam").html(html);
                        } 
                    });
                });
                $("#idFacultadEquiParam").change(function(){
                    var idUniversidad = $('#idUniversidadParam').val();
                    var idFacultadEqui=$(this).val();
                    var dataString = {
                        "idUniversidad" : idUniversidad,
                        "idFacultadEqui": idFacultadEqui
                    }
                    $.ajax({
                        type: "POST",
                        url: "ajaxCarrera.php",
                        data: dataString,
                        cache: false,
                        success: function(html){                                
                            $("#idCarreraParam").html('<option selected="selected">---Seleccione una Carrera---</option>');
                            $("#idCarreraParam").html(html);
                        } 
                    });
                });
                $("#idCarreraParam").change(function(){
                    $("#btnAnalizar").removeAttr('disabled');
                });  
                $("#loader").hide();
                $("#formularioRegistrar").hide();
		    
                $("#btnAnalizar").attr('disabled','disabled');
                $("#btnNuevo").hide();
                $("#btnAnalizar").click(function(){
                    $("#btnAnalizar").attr('disabled','disabled');
                    var dataString = 'Accion=Nuevo';                        
                    $.ajax({
                        type: "POST",
                        url: "ajaxUniversidad.php",
                        data: dataString,
                        cache: false,
                        success: function(html){                                
                            $("#idFacultadEquiParam").html('<option selected="selected">---Seleccione una Facultad---</option>');
                            $("#idCarreraParam").html('<option selected="selected">---Seleccione una Carrera---</option>');
                            $("#idUniversidadParam").html(html);
                        } 
                    });
                        
                    //Aqui va el codigo para insertar a matriz
                    $idCarnet = $('#idCarnetParam').attr("value");
                    $idSolicitud = $('#idSolicitudParam').attr("value");
                    $idUniversidad = $("#idUniversidadParam").attr("value");
                    $idFacultad = $("#idFacultadEquiParam").attr("value");
                    $idCarrera =$("#idCarreraParam").attr("value");
                        
                    $.ajax({
                        url:"insertarEquivalencias.php",
                        data: {
                            'idSolicitud': $idSolicitud,                                    
                            'idUniversidad': $idUniversidad,
                            'idFacultad': $idFacultad,
                            'idCarrera': $idCarrera
                        },
                        type: "POST",
                        success:
                            function(respuesta){
                            alert(respuesta);
                            cargarTabla($idCarnet,$idSolicitud);                                   
                        }                        
                    })                      
                });
                $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nueva Materia");
                    procedimiento = "nuevo";

                    if ($("#btnNuevo").val()=="Agregar Materia"){ 
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
                    $idSolicitud = $('#idSolicitudParam').attr("value");
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
                                cargarTabla($idCarnet,$idSolicitud);
                            }
                        })
                    }
                    else if(procedimiento == "editar"){                        
                        $.ajax({
                            url: "editarEquivalencias.php",
                            type: "POST",
                            data: datos,
                            success:
                                function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                //location.reload(true);
                                cargarTabla($idCarnet,$idSolicitud);                                
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
                            cargarTabla(v_Carnet,v_solicitud);
                        }                        
                    })
                }
            }
            
            function cargarTabla(v_carne, v_idSolicitud){
                $.ajax({
                    url:"EquivalenciasReload.php",
                    data: {
                        'carnet': v_carne,
                        'idSolicitudEqui': v_idSolicitud
                    },
                    type: "POST",
                    success:
                        function(respuesta){
                        document.getElementById('detalle').innerHTML=respuesta;                                                
                        //$("#btnNuevo").attr("value",'Agregar Solicitud');  
                        inicio();
                    }                        
                })
                
            }
            
            function editar(v_idSolicitudEqui,v_idUniversidad,v_idFacultadEqui,v_idCarrera,v_idMateriaProcedencia,v_idCodCarreraUPES,v_IdCodAsignaturaUPES){
                $("#btnNuevo").show();
                $("#leyenda").html("Actualizar Solicitud");
                procedimiento = "editar";
                var parametros = {
                    "idSolicitud" : v_idSolicitudEqui,
                    "idUniversidad" : v_idUniversidad,
                    "idFacultadEqui" : v_idFacultadEqui,
                    "idCarrera" : v_idCarrera,
                    "idMateriaProcedencia" : v_idMateriaProcedencia,
                    "idCodCarreraUPES" : v_idCodCarreraUPES,
                    "IdCodAsignaturaUPES" : v_IdCodAsignaturaUPES
                }
                $.ajax({
                    url:"buscarEquivalencia.php",
                    data: parametros,
                    type: "POST",
                    dataType: "json",
                    success:
                        function(respuesta){
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");                                                               
                        $("#txtidSolicitudEqui").val(respuesta.idSolicitudEqui);
                        $("#txtidUniversidad").val(respuesta.idUniversidad);
                        $("#txtidFacultadEqui").val(respuesta.idFacultadEqui);
                        $("#txtidCarrera").val(respuesta.idCarrera);
                        $("#txtidMateriaProcedencia").val(respuesta.idMateriaProcedencia);
                        $("#txtidCodCarreraUPES").val(respuesta.idCodCarreraUPES);
                        $("#txtidCodAsignaturaUPES").val(respuesta.IdCodAsignaturaUPES);
                        $("#txtidEstadoMateriaSoli").val(respuesta.idEstadoMateriaSoli);
                        $("#txtobservacionMateria").val(respuesta.observacionMateria);
                                
                        $("#nomidUniversidad").val(v_idUniversidad);
                        $("#nomidFacultadEqui").val(v_idFacultadEqui);
                        $("#nomidCarrera").val(v_idCarrera);
                        $("#nomidMateriaProcedencia").val(v_idMateriaProcedencia);
                        $("#nomidCodCarreraUPES").val(v_idCodCarreraUPES);
                        $("#nomidCodAsignaturaUPES").val(v_IdCodAsignaturaUPES);
                                
                        var dataString = {                                    
                            "idEstadoMateriaSoli" : respuesta.idEstadoMateriaSoli,
                            "Accion":"Editar"
                        }                                              
                        $.ajax({
                            type: "POST",
                            url: "ajaxEstadoMateriaEQ.php",
                            data: dataString,
                            cache: false,
                            success: function(html){                                
                                $("#txtidEstadoMateriaSoli").html(html);
                            } 
                        });
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
                        <form id="target" action="SolicitudEquivalencia.php" method="post">
                            <input name="CARNET" id="CARNET" type="hidden" value= "<?php echo $g_CARNET ?> "/>   
                        </form>
                        <p><a class="a_demo_four" href="#">Volver a Solicitud</a></p>
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
                    <tr>
                        <td>Solicitud</td>
                        <td>:</td>
                        <td>
                            <select name="idSolicitud" id="idSolicitudParam">                        
                                <?php
                                $con2 = Conectar();
                                $sql2 = "select se.idSolicitudEqui,DATE_FORMAT(fechaIngreSolicitud, '%d/%m/%Y') as fechaIngreSolicitud ,es.nombreEstadoSoliEqui 
                            from proc_solicitudequivalencia se,  proc_estadosoliequivalencia es
                            where se.numeroCarne = '$g_CARNET' and es.idEstadoSolicitudEqui = se.idEstadoSolicitudEqui 
                            and se.idSolicitudEqui = '$g_idSolicitud' order by se.idSolicitudEqui";
                                $q2 = mysql_query($sql2, $con2) or die("Problemas al ejecutar la consulta");
                                while ($datos = mysql_fetch_array($q2)) {
                                    echo '<option value="' . $datos['idSolicitudEqui'] . '">' . $datos['fechaIngreSolicitud'] . ' ' . $datos['nombreEstadoSoliEqui'] . '</option>';
                                }
                                desconectar();
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="full_width big">Solicitud de Equivalencia</div>

            <div class="full_width big">
                <table>
                    <tr>
                        <td>Universidad</td>
                        <td>:</td>
                        <td>
                            <select name="idUniversidad" id="idUniversidadParam">                        
                                <?php
                                $con3 = Conectar();
                                $sql3 = "SELECT idUniversidad, nombreUniversidad FROM proc_universidades";
                                $q3 = mysql_query($sql3, $con3) or die("Problemas al ejecutar la consulta");
                                echo '<option selected value="0">Selecciones una Universidad</option>';
                                while ($datos = mysql_fetch_array($q3)) {
                                    echo '<option value="' . $datos['idUniversidad'] . '">' . $datos['nombreUniversidad'] . '</option>';
                                }
                                desconectar();
                                ?>
                            </select>
                        </td>                
                    </tr>
                <tr>
                      <td>Facultad</td>
                      <td>:</td>
                      <td><select name="idFacultadEqui" id="idFacultadEquiParam">
                        <option selected="selected">---Seleccione una Facultad---</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td>Carrera</td>
                      <td>:</td>
                      <td><select name="idCarrera" id="idCarreraParam">
                        <option selected="selected">---Seleccione una Carrera---</option>
                      </select></td>
                    </tr>
                </table>
</div>
            <div> 
                <table align="center">                
                    <tr>
                        <td >
                            <input type="button" id="btnAnalizar" name="btnAnalizar" value="Generar Matriz" /> 
                        </td>
                    </tr>
                </table>                   
            </div>        
            <h1>Informaci&oacute;n</h1>
            <div class="demo_jui" id="detalle">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
                    <thead>
                        <tr>
                            <th>Id Solicitud</th>
                            <!--<th>Id</th>--> 
                            <th>Materia Original</th>                        
                            <th>Carrera UPES</th>
                            <th>Materia UPES</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <th>Editar</th>

                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        $con = Conectar();
                        $sql = "SELECT ame.idSolicitudEqui,ame.idUniversidad, u.nombreUniversidad, ame.idFacultadEqui, f.nombreFacultadEqui,ame.idCarrera, c.nombreCarreraEquivalencia, ame.idMateriaProcedencia, m.nombreMateriaProcedencia, 
                                ame.idCodCarreraUPES, cp.NOMBRE as carreraUPES, ame.IdCodAsignaturaUPES, ap.NOMBRE as materiaUPES, ame.idCorrMateSolicitada,ame.idEstadoMateriaSoli, eme.nombreEstadoMateria, ame.observacionMateria
                                FROM proc_analisismaterias ame, PROC_Universidades U , PROC_Facultades F, PROC_Carreras C, PROC_Materias m, carrera cp, asignatura ap, planes pp, proc_estadoMateria eme, sia_planes spp
                                where ame.idSolicitudEqui ='$g_idSolicitud' and u.idUniversidad= ame.idUniversidad and f.idFacultadEqui = ame.idFacultadEqui and f.idUniversidad = ame.idUniversidad  
                                and c.idCarrera = ame.idCarrera and c.idFacultadEqui = ame.idFacultadEqui  and c.idUniversidad = ame.idUniversidad and m.idMateriaProcedencia = ame.idMateriaProcedencia  
                                and m.idCarrera = ame.idCarrera  and m.idFacultadEqui = ame.idFacultadEqui  and m.idUniversidad = ame.idUniversidad and cp.CODIGO_CAR = ame.idCodCarreraUPES 
                                and trim(pp.CODIGO_PLA) = trim(spp.planes)
                                and trim(cp.CODIGO_CAR) = trim(spp.CODIGO_CAR)
                                and spp.planes =(select max(x.planes) from sia_planes x where x.CODIGO_CAR =  ame.idCodCarreraUPES and x.estatus =1)
                                and cp.CODIGO_CAR= ame.idCodCarreraUPES and ap.CODIGO = ame.IdCodAsignaturaUPES and cp.FACULTAD = ap.FACULTAD and ap.CODIGO = pp.ASIGNATURA
                                and eme.idEstadoMateriaSoli = ame.idEstadoMateriaSoli 
                                order by idCorrMateSolicitada";
                        $q = mysql_query($sql, $con) or die("Problemas al ejecutar la consulta");
                        while ($datos = mysql_fetch_array($q)) {
                            ?>
                            <tr>    
                                <td><?php echo $datos['idSolicitudEqui']; ?></td>
                                <!--<td><?php // echo $datos['idCorrMateSolicitada']; ?></td>-->
                                <td><?php echo $datos['nombreMateriaProcedencia']; ?></td>                        
                                <td><?php echo $datos['carreraUPES']; ?></td>			
                                <td><?php echo $datos['materiaUPES']; ?></td>
                                <td><?php echo $datos['nombreEstadoMateria']; ?></td>
                                <td><?php echo $datos['observacionMateria']; ?></td>
                                <td>                          
                                    <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idSolicitudEqui']; ?>','<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>','<?php echo $datos['idCodCarreraUPES']; ?>','<?php echo $datos['IdCodAsignaturaUPES']; ?>')" />
                                </td>                        
                            </tr>
                            <?php
                        }
                        desconectar();
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <!--<th></th>-->
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
    <div class="arrastable" id="formularioRegistrar" align="center"  style='width:620px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
        <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Equivalencias</div>
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
                        <td>Universidad</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" size ="75" id="txtidUniversidad" name="txtidUniversidad" />
                            <input type="hidden" readonly="readonly"  id="nomidUniversidad" name="nomidUniversidad" />
                        </td>
                    </tr>
                    <tr>
                        <td>Facultad</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" size ="75"id="txtidFacultadEqui" name="txtidFacultadEqui" />
                            <input type="hidden" readonly="readonly" id="nomidFacultadEqui" name="nomidFacultadEqui" />
                        </td>
                    </tr>
                    <tr>
                        <td>Carrera</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" size ="75"id="txtidCarrera" name="txtidCarrera" />
                            <input type="hidden" readonly="readonly" id="nomidCarrera" name="nomidCarrera" />
                        </td>
                    </tr>
                    <tr>
                        <td>Materia Origen</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" size ="75"id="txtidMateriaProcedencia" name="txtidMateriaProcedencia" />
                            <input type="hidden" readonly="readonly" id="nomidMateriaProcedencia" name="nomidMateriaProcedencia" />
                        </td>
                    </tr>
                    <tr>
                        <td>Carrera UPES</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" size ="75" id="txtidCodCarreraUPES" name="txtidCodCarreraUPES" />
                            <input type="hidden" readonly="readonly" id="nomidCodCarreraUPES" name="nomidCodCarreraUPES" />
                        </td>
                    </tr>
                    <tr>
                        <td>Asignatura UPES</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" size ="75" id="txtidCodAsignaturaUPES" name="txtidCodAsignaturaUPES" />
                            <input type="hidden" readonly="readonly" id="nomidCodAsignaturaUPES" name="nomidCodAsignaturaUPES" />
                        </td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td>:</td>
                        <td>
                            <!--<input type="text"  id="txtidEstadoMateriaSoli" name="txtidEstadoMateriaSoli" />-->
                            <select id="txtidEstadoMateriaSoli" name="txtidEstadoMateriaSoli" />                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Observaciones</td>
                        <td>:</td>
                        <td>
                            <input type="text" size ="75" id="txtobservacionMateria" name="txtobservacionMateria" />
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