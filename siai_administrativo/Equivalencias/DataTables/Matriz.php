<?php
    require_once 'funciones/conexiones.php';
    session_start();     
    if(isset($_POST["idUniversidad"])) { 
        $_SESSION['idUniversidad'] = serialize($_POST["idUniversidad"]); 
    } 
    if(isset($_SESSION['idUniversidad'])) { 
        $g_IdUniversidad = unserialize($_SESSION['idUniversidad']); 
    }
    if(isset($_POST["idFacultad"])) { 
        $_SESSION['idFacultadEqui'] = serialize($_POST["idFacultad"]); 
    } 
    if(isset($_SESSION['idFacultadEqui'])) { 
        $g_idFacultadEqui = unserialize($_SESSION['idFacultadEqui']); 
    }
    if(isset($_POST["idCarrera"])) { 
        $_SESSION['idCarrera'] = serialize($_POST["idCarrera"]); 
    } 
    if(isset($_SESSION['idCarrera'])) { 
        $g_idCarrera = unserialize($_SESSION['idCarrera']); 
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Matriz de Equivalencias</title>
                <link rel="stylesheet" type="text/css" href="media/css/style4.css" />
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
                        @import "funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>
                <script src="media/js/jquery-ui-1.9.2.custom.js"></script>
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
                     $("#idCodCarreraUPES").change(function(){
                        var idUniversidad = $('#idUniversidadParam').val();
                        var idFacultadEqui=$('#idFacultadEquiParam').val();
                        var idCarreraUPES = $(this).val();
                        	
                        var dataString = {
                            "idUniversidad" : idUniversidad,
                            "idFacultadEqui": idFacultadEqui,
                            "idCarreraUPES":idCarreraUPES,
                            "Accion":"Nuevo"
                        }
                        $.ajax({
                            type: "POST",
                            url: "ajaxMateriaUPES.php",
                            data: dataString,
                            cache: false,
                            success: function(data){
                                $("#IdCodAsignaturaUPES").html(data);
                            } 
                        });
                    });
                    $('#container_buttons').click(function(){
                        //alert('di click')
                        $('#target').submit();
                    })
                    $("#IdCodAsignaturaUPES").change(function(){
                    
                        var idUniversidad = $('#idUniversidadParam').val();
                        var idFacultadEqui=$('#idFacultadEquiParam').val();
                        var idCarreraUPES = $('#idCodCarreraUPES').val();
                        var idMateriaUPES= $(this).val();
                        //alert('entre '+ idCarreraUPES+ '   ---<<'+idMateriaUPES+'--');                        
                        var parametros = {
                            "idUniversidad" : idUniversidad,
                            "idFacultadEqui": idFacultadEqui,
                            "idCarreraUPES": idCarreraUPES,
                            "idMateriaUPES":idMateriaUPES
                        }
                        $.ajax({
                            url:"buscarMateriaUPES.php",
                            data: parametros,
                            type: "POST",
                            dataType: "json",
                            success:
                                function(respuesta){
                                    $("#cicloPlan").val(respuesta.ciclo);
                                    $("#UV_upes").val(respuesta.UVUPES);                                     
                                }                        
                        })
                    });
                    
                    
                    $("#idMateriaProcedencia").change(function(){
                        var idUniversidad = $('#idUniversidadParam').val();
                        var idFacultadEqui=$('#idFacultadEquiParam').val();
                        var idCarrera = $('#idCarreraParam').val();
                        var idMateriaProcedencia = $(this).val();
                        //var Accion = "CicloUV";	
                        var parametros = {
                            "idUniversidad" : idUniversidad,
                            "idFacultadEqui": idFacultadEqui,
                            "idCarrera": idCarrera,
                            "idMateriaProcedencia":idMateriaProcedencia
                        }
                        $.ajax({
                            url:"buscarMateria.php",
                            data: parametros,
                            type: "POST",
                            dataType: "json",
                            success:
                                function(respuesta){                                    
                                    $("#UV_procedencia").val(respuesta.UV);                                     
                                }                        
                        })
                    });
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();
                    $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nueva Materia");
                    procedimiento = "nuevo";
                    if ($("#btnNuevo").val()=="Agregar Materia"){
                        $("#idUniversidad").attr("value", $('#idUniversidadParam').attr("value"));
                        $("#idFacultadEqui").attr("value", $('#idFacultadEquiParam').attr("value"));
                        $("#idCarrera").attr("value", $('#idCarreraParam').attr("value"))
                        $("#idCorrMateria").attr("value", "");
                        $("#idMateriaProcedencia").attr("value", '');                        
                        $("#UV_procedencia").attr("value", "");
                        $("#idCodCarreraUPES").attr("value", "");
                        $("#IdCodAsignaturaUPES").attr("value", ''); 
                        $("#cicloPlan").attr("value", "");
                        $("#UV_upes").attr("value", '');                        
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                        
                        var idUniversidad = $('#idUniversidadParam').val();
                        var idFacultadEqui=$('#idFacultadEquiParam').val();
                        var idCarrera = $('#idCarreraParam').val();
                        var Accion = "idNombre";
                        
                        var dataString = {
                            "idUniversidad" : idUniversidad,
                            "idFacultadEqui": idFacultadEqui,
                            "idCarrera":idCarrera,
                            "Accion": Accion
                        }
                        $.ajax({
                            type: "POST",
                            url: "ajaxMateria.php",
                            data: dataString,
                            cache: false,
                            success: function(data){
                                $("#idMateriaProcedencia").html('<option selected="selected">Seleccione una Materia</option>');
                                $("#idMateriaProcedencia").html(data);
                            } 
                        });
                        
                        var dataString = {
                            "idUniversidad" : idUniversidad,
                            "idFacultadEqui": idFacultadEqui,
                            "Accion":"Nuevo"
                        }                                              
                       $.ajax({
                            type: "POST",
                            url: "ajaxCarreraUPES.php",
                            data: dataString,
                            cache: false,
                            success: function(html){                                
                                $("#idCodCarreraUPES").html('<option selected="selected">---Seleccione una Carrera---</option>');
                                $("#idCodCarreraUPES").html(html);
                            } 
                        });
                        $("#IdCodAsignaturaUPES").html('<option selected="selected">---Seleccione una Asignatura---</option>');
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Materia");
                    }
                    else{
                        alert("otro")
                    }
                                      
                })
                
                $("#btnProcesar").click(function(){
                    v_idUniversidad = $("#idUniversidadParam").attr("value");                            
                    v_idFacultadEqui = $("#idFacultadEquiParam").attr("value");
                    v_idCarrera = $("#idCarreraParam").attr("value");
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();                    
                    if(procedimiento == "nuevo"){
                        $.ajax({
                        url: "guardarMatriz.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                cargarTabla(v_idUniversidad,v_idFacultadEqui,v_idCarrera);
                            }
                        })
                    }
                    else if(procedimiento == "editar") {
                        $.ajax({
                        url: "editarMatriz.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();                                
                                cargarTabla(v_idUniversidad,v_idFacultadEqui,v_idCarrera);
                            }
                    })
                    }
                  })
               });
            
            function eliminar(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES){
                if(confirm("Esta seguro que desea eliminar esta Matriz?")){
                    //cedula=85150447
                    var v_idUniversidad = idUniversidad;                    
                    var v_idFacultadEqui = idFacultadEqui;
                    var v_idCarrera = idCarrera;                    
                    var v_idMateriaProcedencia = idMateriaProcedencia;
                    var v_idCodCarreraUPES = idCodCarreraUPES;
                    var v_IdCodAsignaturaUPES = IdCodAsignaturaUPES;
                    $.ajax({
                        url:"eliminarMatriz.php",
                        data: {
                                idUniversidad: v_idUniversidad,
                                idFacultadEqui: v_idFacultadEqui,
                                idCarrera: v_idCarrera,
                                idMateriaProcedencia: v_idMateriaProcedencia,
                                idCodCarreraUPES: v_idCodCarreraUPES,
                                IdCodAsignaturaUPES: v_IdCodAsignaturaUPES
                              },
                        type: "POST",
                        success:
                            function(respuesta){
                                alert(respuesta);
                                cargarTabla(v_idUniversidad,v_idFacultadEqui,v_idCarrera);
                            }                        
                    })
                }
            }
            function cargarTabla(v_idUniversidad,v_idFacultadEqui,v_idCarrera){
                $.ajax({
                        url:"MatrizReload.php",
                        data: {
                                idUniversidad: v_idUniversidad,
                                idFacultadEqui: v_idFacultadEqui,
                                idCarrera: v_idCarrera
                              },
                        type: "POST",
                        success:
                            function(respuesta){
                                document.getElementById('detalle').innerHTML=respuesta;                                                
                                $("#btnNuevo").attr("value",'Agregar Materia');    
                                inicio();
                            }                        
                    })                
                }
            
            function editar(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES){
                $("#leyenda").html("Actualizar Materia");
                procedimiento = "editar";
                    var parametros = {
                        "idUniversidad" : idUniversidad,
                        "idFacultadEqui": idFacultadEqui,
                        "idCarrera": idCarrera,
                        "idMateriaProcedencia": idMateriaProcedencia,
                        "idCodCarreraUPES": idCodCarreraUPES, 
                        "IdCodAsignaturaUPES": IdCodAsignaturaUPES
                    }
                    $.ajax({
                        url:"buscarMatriz.php",
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
                                $("#idUniversidad").val(respuesta.idUniversidad);
                                $("#idFacultadEqui").val(respuesta.idFacultadEqui);
                                $("#idCarrera").val(respuesta.idCarrera);
                                $("#idMateriaProcedencia").val(respuesta.idMateriaProcedencia);                                
                                $("#idCodCarreraUPES").val(respuesta.idCodCarreraUPES);
                                $("#IdCodAsignaturaUPES").val(respuesta.IdCodAsignaturaUPES);
                                $("#idCorrMateria").val(respuesta.idCorrMateria);
                                $("#UV_upes").val(respuesta.UV_upes);
                                $("#cicloPlan").val(respuesta.cicloPlan);
                                $("#UV_procedencia").val(respuesta.UV_procedencia);                                
                                var idUniversidad = $('#idUniversidadParam').val();
                                var idFacultadEqui=$('#idFacultadEquiParam').val();
                                var idCarrera = $('#idCarreraParam').val();
                                var Accion = "Editar";
                                var dataString = {
                                    "idUniversidad" : idUniversidad,
                                    "idFacultadEqui": idFacultadEqui,
                                    "idCarrera":idCarrera,
                                    "idMateriaProcedencia":respuesta.idMateriaProcedencia,
                                    "Accion": Accion
                                }
                                $.ajax({
                                    type: "POST",
                                    url: "ajaxMateria.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(data){
                                        $("#idMateriaProcedencia").html(data);
                                    } 
                                });
                               
                                var idCarreraUPES = respuesta.idCodCarreraUPES;
                                var IdCodAsignaturaUPES = respuesta.IdCodAsignaturaUPES;    
                                var dataString = {
                                    "idUniversidad" : idUniversidad,
                                    "idFacultadEqui": idFacultadEqui,
                                    "idCarreraUPES": idCarreraUPES,
                                    "Accion":"Editar"
                                }                                              
                               $.ajax({
                                    type: "POST",
                                    url: "ajaxCarreraUPES.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(html){                                
                                        $("#idCodCarreraUPES").html(html);
                                    } 
                                });
                                var dataString = {
                                    "idUniversidad" : idUniversidad,
                                    "idFacultadEqui": idFacultadEqui,
                                    "idCarreraUPES":idCarreraUPES,
                                    "IdCodAsignaturaUPES":IdCodAsignaturaUPES,
                                    "Accion": 'Editar'
                                }
                                $.ajax({
                                    type: "POST",
                                    url: "ajaxMateriaUPES.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(data){
                                        $("#IdCodAsignaturaUPES").html(data);
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
              <form id="target" action="MatrizParam.php" method="post">
                 <!--<input name="idUniversidad" id="idUniversidad" type="hidden" value= "<?php echo $g_IdUniversidad ?> "/>-->   
              </form>
            <p><a class="a_demo_four" href="#">Volver Principal</a></p>
          </div>
	</section>
        </div>    
        <div class="full_width big">
            <table>
                <tr>
                    <td>Instituci&oacute;n</td>
                    <td>:</td>
                    <td>
                        <select name="idUniversidad" id="idUniversidadParam">                        
                        <?php
                            $con1 = Conectar();
                            $sql1 = "SELECT idUniversidad, nombreUniversidad FROM proc_universidades where idUniversidad= $g_IdUniversidad";
                            $q1 = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta");                
                            while($datos = mysql_fetch_array($q1)){
                                echo '<option value="'.$datos['idUniversidad'].'">'.$datos['nombreUniversidad'].'</option>';
                            }   
                            desconectar();
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Facultad</td>
                    <td>:</td>
                    <td>
                        <select name="idFacultadEqui" id="idFacultadEquiParam">                        
                        <?php
                            $con2 = Conectar();
                            $sql2 = "SELECT idFacultadEqui, nombreFacultadEqui FROM PROC_Facultades where idUniversidad= $g_IdUniversidad and idFacultadEqui = $g_idFacultadEqui";
                            $q2 = mysql_query($sql2, $con2) or die ("Problemas al ejecutar la consulta");                
                            while($datos2 = mysql_fetch_array($q2)){
                                echo '<option value="'.$datos2['idFacultadEqui'].'">'.$datos2['nombreFacultadEqui'].'</option>';
                            }   
                            desconectar();
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Carrera</td>
                    <td>:</td>
                    <td>
                        <select name="idCarrera" id="idCarreraParam">                        
                        <?php
                            $con3 = Conectar();
                            $sql3 = "SELECT idCarrera, nombreCarreraEquivalencia FROM PROC_Carreras where idUniversidad= $g_IdUniversidad and idFacultadEqui = $g_idFacultadEqui and idCarrera = $g_idCarrera";
                            $q3 = mysql_query($sql3, $con3) or die ("Problemas al ejecutar la consulta");                
                            while($datos3 = mysql_fetch_array($q3)){
                                echo '<option value="'.$datos3['idCarrera'].'">'.$datos3['nombreCarreraEquivalencia'].'</option>';
                            }   
                            desconectar();
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>            
    
	<div class="full_width big">Matriz de Equivalencia</div>
        <h1>Informaci&oacute;n</h1>
	<div class="demo_jui" id="detalle">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
<!--			<th>Id Universidad</th>
                        <th>Id Facultad</th>
                        <th>Id Carrera</th>
                        <th>Id</th>-->
                        <th>Materia Procedencia</th>
                        <th>UV Procedencia</th>
                        <th>Carrera UPES</th>
                        <th>Asignatura UPES</th>
                        <th>Ciclo</th>
                        <th>UV UPES</th>
                        <th>Eliminar</th>
		</tr>
	</thead>	
	</tbody>
        <tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT trim(spp.planes), me.idUniversidad, u.nombreUniversidad, me.idFacultadEqui, f.nombreFacultadEqui,
                    me.idCarrera, c.nombreCarreraEquivalencia, me.idMateriaProcedencia, m.nombreMateriaProcedencia, me.idCodCarreraUPES, cp.NOMBRE as carreraUPES, me.IdCodAsignaturaUPES, ap.NOMBRE as materiaUPES, me.idCorrMateria,
                    me.UV_upes, me.cicloPlan, me.UV_procedencia
                    FROM PROC_MatrizEquivalencias me, PROC_Universidades U , PROC_Facultades F, PROC_Carreras C, PROC_Materias m, carrera cp, asignatura ap, planes pp, sia_planes spp
                    where me.idUniversidad= $g_IdUniversidad and me.idFacultadEqui = $g_idFacultadEqui  and me.idCarrera = $g_idCarrera and u.idUniversidad= me.idUniversidad 
                    and f.idFacultadEqui = me.idFacultadEqui 
                    and f.idUniversidad = me.idUniversidad  
                    and c.idCarrera = me.idCarrera
                    and c.idFacultadEqui = me.idFacultadEqui  
                    and c.idUniversidad = me.idUniversidad  
                    and m.idMateriaProcedencia = me.idMateriaProcedencia  
                    and m.idCarrera = me.idCarrera  
                    and m.idFacultadEqui = me.idFacultadEqui  
                    and m.idUniversidad = me.idUniversidad
                    and cp.CODIGO_CAR = me.idCodCarreraUPES 
                    and trim(pp.CODIGO_PLA) = trim(spp.planes)
                    and trim(cp.CODIGO_CAR) = trim(spp.CODIGO_CAR)
                    and trim(cp.CODIGO_CAR) = trim(me.idCodCarreraUPES) 
                    and trim(ap.CODIGO) = trim(me.IdCodAsignaturaUPES )
                    and cp.FACULTAD = ap.FACULTAD 
                    and ap.CODIGO = pp.ASIGNATURA
                    and spp.planes =(select max(x.planes) from sia_planes x where x.CODIGO_CAR =  me.idCodCarreraUPES and x.estatus =1)";
                    
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
<!--			<td><?php echo $datos['nombreUniversidad']; ?></td>
                        <td><?php echo $datos['nombreFacultadEqui']; ?></td>
                        <td><?php echo $datos['nombreCarreraEquivalencia']; ?></td>
                        <td><?php echo $datos['idCorrMateria']; ?></td>            -->            
                        <td><?php echo $datos['nombreMateriaProcedencia']; ?></td>
                        <td><?php echo $datos['UV_procedencia']; ?></td>
                        <td><?php echo $datos['carreraUPES']; ?></td>
                        <td><?php echo $datos['materiaUPES']; ?></td>
                        <td><?php echo $datos['cicloPlan']; ?></td>
                        <td><?php echo $datos['UV_upes']; ?></td>                        
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>','<?php echo $datos['idCodCarreraUPES']; ?>','<?php echo $datos['IdCodAsignaturaUPES']; ?>')" />
                        </td>                        
		</tr>
                <?php
            }
            ?>
	</tbody>
	<tfoot>
		<tr>
<!--			<th></th>
                        <th></th>
                        <th></th>
                        <th></th>-->
			<th></th>
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
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Materia" />
        </div>
        <br />
         <div class="arrastable" id="formularioRegistrar" align="center"  style='width:510px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Matriz de Equivalencia</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Materia</legend>   
                <table>
<!--                    <tr>
                        <td>id Universidad</td>
                        <td>:</td>
                        <td>-->
                            <input type="hidden" readonly="readonly" id="idUniversidad" name="txtidUniversidad" />
<!--                        </td>
                    </tr>
                    <tr>
                        <td>Id Facultad</td>
                        <td>:</td>
                        <td>-->
                            <input type="hidden" readonly="readonly" id="idFacultadEqui" name="txtidFacultadEqui" />
<!--                        </td>
                    </tr>
                    <tr>
                        <td>Id Carrera</td>
                        <td>:</td>
                        <td>-->
                            <input type="hidden" readonly="readonly" id="idCarrera" name="txtidCarrera" />
<!--                        </td>
                    </tr>-->
                    <tr>
                        <td>id </td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="idCorrMateria" name="txtidCorrMateria" />
                        </td>
                    </tr>
                    <tr>
                        <td>Materia Procedencia</td>
                        <td>:</td>
                        <td>
                             <!--<input type="text" id="idMateriaProcedencia" name="txtidMateriaProcedencia" />-->
                            <select id="idMateriaProcedencia" name="txtidMateriaProcedencia" />
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <td>UV procedencia</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="UV_procedencia" name="txtUV_procedencia" />
                        </td>
                    </tr>
                    <tr>
                        <td>Carrera UPES</td>
                        <td>:</td>
                        <td>
                            <!--<input type="text"  id="idCodCarreraUPES" name="txtidCodCarreraUPES" />-->
                            <select id="idCodCarreraUPES" name="txtidCodCarreraUPES" />
                                <option selected="selected">---Seleccione una Carrera---</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Asignatura UPES</td>
                        <td>:</td>
                        <td>
                            <!--<input type="text" id="IdCodAsignaturaUPES" name="txtIdCodAsignaturaUPES" />-->
                            <select id="IdCodAsignaturaUPES" name="txtIdCodAsignaturaUPES" />
                                <option selected="selected">---Seleccione una Asignatura---</option>
                            </select>
                        </td>
                    </tr>                        
                    <tr>
                        <td>Ciclo Plan Estudio</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="cicloPlan" name="txtcicloPlan" />
                        </td>
                    </tr>                                        
                    <tr>
                        <td>UV upes</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly"  id="UV_upes" name="txtUV_upes" />
                        </td>
                    </tr>                                            
                    <tr>
                        <td>
                            <input type="button" id="btnProcesar" name="btnProcesar" value="Agregar" />
                        </td>
                        <td></td>
                        <td>
                            <input type="reset" name="btnBorrar" id="btnBorrar" value="Limp&iacute;ar Formulario" />
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