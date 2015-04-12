<?php
    require_once 'funciones/conexiones.php';
    session_start();     
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Matriz de Equivalencias</title>
                
                <link href="media/css/redmond/jquery-ui-1.9.2.custom.css" type="text/css" rel="stylesheet" />                
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
                        @import "funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
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
                    inicio();                    
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
                                cargarTabla(idUniversidad,0,0,1);
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
                                $("#idCarreraParam").html('<option value="0" selected>---Seleccione una Carrera---</option>');
                                $("#idCarreraParam").html(html);
                                cargarTabla(idUniversidad,idFacultadEqui,0,2);
                            } 
                        });
                    });
                    $("#idCarreraParam").change(function(){
                        var idUniversidad = $('#idUniversidadParam').val();
                        var idFacultadEqui=$('#idFacultadEquiParam').val();                      
                        var idCarrera = $(this).val();
                        	
//                        var dataString = {
//                            "idUniversidad" : idUniversidad,
//                            "idFacultadEqui": idFacultadEqui,
//                            "idCarrera":idCarrera
//                        }
//                        $.ajax({
//                            type: "POST",
//                            url: "ajaxMatriz.php",
//                            data: dataString,
//                            cache: false,
//                            success: function(data){
                                cargarTabla(idUniversidad,idFacultadEqui,idCarrera,3);
//                                $('<p>').text('soy el mensaje de error').appendTo('#error-list').asError();
//                            } 
//                        });
                    });
               });
            function cargarTabla(v_idUniversidad,v_idFacultadEqui,v_idCarrera, v_Parametro){
                $.ajax({
                        url:"ajaxMatriz.php",
                        data: {
                                idUniversidad: v_idUniversidad,
                                idFacultadEqui: v_idFacultadEqui,
                                idCarrera: v_idCarrera,
                                Parametro: v_Parametro
                              },
                        type: "POST",
                        success:
                            function(respuesta){
                                document.getElementById('detalle').innerHTML=respuesta;                                                
                                //$("#btnNuevo").attr("value",'Agregar Materia');    
                                inicio();
                            }                        
                    })                
                }            
		</script>
	</head>
	<body id="dt_example" class="ex_highlight_row">    	
	<div id="container" style="width:80%">
        <div class="full_width big">
            <table>
                <tr>
                    <td>Instituci&oacute;n</td>
                    <td>:</td>
                    <td>
                        <select name="idUniversidad" id="idUniversidadParam">
                        <option selected="selected">---Seleccione una Instituci&oacute;n---</option>    
                        <?php
                            $con1 = Conectar();
                            $sql1 = "SELECT idUniversidad, nombreUniversidad FROM proc_universidades order by idUniversidad";
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
                            <option selected="selected">---Seleccione una Facultad---</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Carrera</td>
                    <td>:</td>
                    <td>
                        <select name="idCarrera" id="idCarreraParam">
                            <option selected="selected">---Seleccione una Carrera---</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>            
    
	<div class="full_width big">Matriz de Equivalencia</div>
        <h1>Informaci&oacute;n</h1>
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong>Atenci&oacute;n!</strong> La aprobaci&oacute;n de cualquier materia esta sujeta a su previo an&aacute;lisis.
            </p>
        </div>        
	<div class="demo_jui" id="detalle">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
<!--			<th>Id Universidad</th>
                        <th>Id Facultad</th>
                        <th>Id Carrera</th>-->
                        <th>Id</th>
                        <th>Materia Procedencia</th>
                        <th>UV Procedencia</th>
                        <th>Carrera UPES</th>
                        <th>Asignatura UPES</th>
                        <th>Ciclo</th>
                        <th>UV UPES</th>
<!--                        <th></th>
                        <th></th>-->
		</tr>
	</thead>
	<tbody name="idMatrizParam" id="idMatrizParam"> 
	</tbody>
	<tfoot>
		<tr>
<!--			<th></th>
                        <th></th>
                        <th></th>-->
                        <th></th>
			<th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
<!--                        <th></th>
                        <th></th>-->
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>
        </div>
</body>
</html>