<?php
    require_once 'funciones/conexiones.php';
    session_start();     
    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Matriz de Equivalencias</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
                        @import "funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
                  $(document).ready(function() {                   
                      
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
                                $("#idUniversidad").attr("value", idUniversidad);
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
                                $("#idFacultad").attr("value", idFacultadEqui);
                            } 
                        });
                    });
                    $("#idCarreraParam").change(function(){
                        var idUniversidad = $('#idUniversidadParam').val();
                        var idFacultadEqui=$('#idFacultadEquiParam').val();
                        var idCarrera = $(this).val();
                        	
                        var dataString = {
                            "idUniversidad" : idUniversidad,
                            "idFacultadEqui": idFacultadEqui,
                            "idCarrera":idCarrera
                        }
                        $.ajax({
                            type: "POST",
                            url: "ajaxMatriz.php",
                            data: dataString,
                            cache: false,
                            success: function(data){
                                $("#idCarrera").attr("value", idCarrera);
                            } 
                        });
                    });                    
               });
            
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

        <div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
                <form action="Matriz.php" method="post">
                     <input name="idUniversidad" id="idUniversidad" type="hidden" value="">
                     <input name="idFacultad" id="idFacultad" type="hidden" value="">
                     <input name="idCarrera" id="idCarrera" type="hidden" value="">                     
                     <input type="submit" id="btnVerMatriz" name="btnVerMatriz" value="Ver Matriz" />
                 </form>
            
        </div>
        <br />
<?php 
//echo "</div></div>";
?>
</body>
</html>