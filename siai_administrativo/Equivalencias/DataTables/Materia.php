<?php
    require_once 'funciones/conexiones.php';
    session_start(); 
    if(isset($_POST["idUniversidad"])) { 
        $_SESSION['idUniversidad'] = serialize($_POST["idUniversidad"]); 
    } 
    if(isset($_SESSION['idUniversidad'])) { 
        $g_IdUniversidad = unserialize($_SESSION['idUniversidad']); 
    }
    if(isset($_POST["idFacultadEqui"])) { 
        $_SESSION['idFacultadEqui'] = serialize($_POST["idFacultadEqui"]); 
    } 
    if(isset($_SESSION['idFacultadEqui'])) { 
        $g_idFacultadEqui = unserialize($_SESSION['idFacultadEqui']); 
    }
    if(isset($_POST["idCarrera"])) { 
        $_SESSION['idCarrera'] = serialize($_POST["idCarrera"]); 
    } 
    if(isset($_SESSION['idFacultadEqui'])) { 
        $g_idCarrera = unserialize($_SESSION['idCarrera']); 
    }
    //$g_IdUniversidad=$_POST["idUniversidad"];    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Materias</title>
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
                    $(".arrastable").draggable();  
                    $(window).resize(function(){
                        $('#formularioRegistrar').css({
                            position:'absolute',
                            left: ($(window).width() - $('#formularioRegistrar').outerWidth())/2,
                            top: ($(window).height() - $('#formularioRegistrar').outerHeight())/2
                        });	  
                    });
                    $(window).resize();
                    inicio();
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();		    
                    $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nueva Materia");
                    procedimiento = "nuevo";
                                        
                    if ($("#btnNuevo").val()=="Agregar Materia"){
                        
                        $("#txtidUniversidad").attr("value", $('#idUniversidadParam').attr("value"));
                        $("#txtidFacultadEqui").attr("value",$('#idFacultadEquiParam').attr("value"));                        
                        $("#txtidCarrera").attr("value",$('#idCarreraParam').attr("value"));
                        $("#txtidMateriaProcedencia").attr("value",'');
                        $("#txtnombreMateriaProcedencia").attr("value",'');
                        $("#txtidCiclo").attr("value",'');
                        $("#txtUV").attr("value",'');
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Materia");
                    }
                    else{
                        alert("otro")
                    }                                      
                })
                $('#container_buttons').click(function(){
                    //alert('di click')                    
                    $('#target').submit();
                })

                $("#btnProcesar").click(function(){
                    v_idUniversidad = $("#idUniversidadParam").attr("value");                            
                    v_idFacultadEqui = $("#idFacultadParam").attr("value");
                    v_idCarrera = $("#idCarreraParam").attr("value");
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();                    
                    if(procedimiento == "nuevo"){
                        $.ajax({
                        url: "guardarMateria.php",
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
                    else if(procedimiento == "editar"){
                        $.ajax({
                        url: "editarMateria.php",
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
            
            function eliminar(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia){
                if(confirm("Esta seguro que desea eliminar esta Materia?")){
                    //cedula=85150447
                    var v_idUniversidad = idUniversidad;                    
                    var v_idFacultadEqui = idFacultadEqui;
                    var v_idCarrera = idCarrera;                    
                    var v_idMateriaProcedencia = idMateriaProcedencia;
                    $.ajax({
                        url:"eliminarMateria.php",
                        data: {
                                idUniversidad: v_idUniversidad,
                                idFacultadEqui: v_idFacultadEqui,
                                idCarrera: v_idCarrera,
                                idMateriaProcedencia: v_idMateriaProcedencia
                              },
                        type: "POST",
                        success:
                            function(respuesta){
                                alert(respuesta);
                                cargarTabla(idUniversidad,idFacultadEqui,idCarrera);
                            }                        
                    })
                }
            }
            function cargarTabla(v_idUniversidad,v_idFacultadEqui,v_idCarrera){
                $.ajax({
                        url:"MateriaReload.php",
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
            
            function editar(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia){
                $("#leyenda").html("Actualizar Materia");
                procedimiento = "editar";
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
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidUniversidad").val(respuesta.idUniversidad);
                                $("#txtidFacultadEqui").val(respuesta.idFacultadEqui);
                                $("#txtidCarrera").val(respuesta.idCarrera);
                                $("#txtidMateriaProcedencia").val(respuesta.idMateriaProcedencia);                                
                                $("#txtnombreMateriaProcedencia").val(respuesta.nombreMateriaProcedencia);                                  
                                $("#txtidCiclo").val(respuesta.idCiclo);
                                $("#txtUV").val(respuesta.UV);
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
              <form id="target" action="Carrera.php" method="post">
                 <input name="idUniversidad" id="idUniversidad" type="hidden" value= "<?php echo $g_IdUniversidad ?> "/>   
                 <input name="idFacultadEqui " id="idFacultadEqui " type="hidden" value= "<?php echo $g_idFacultadEqui ?> "/>                 
              </form>
            <p><a class="a_demo_four" href="#">Volver Carreras</a></p>
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
    
	<div class="full_width big">Materias</div>
        <h1>Informaci&oacute;n</h1>
	<div class="demo_jui" id="detalle">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			 <th>Id Materia</th>
			<th>Materia</th>
                        <th>Ciclo</th>
                        <th>Unidades Valorativas</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia,UV FROM PROC_Materias where idUniversidad= $g_IdUniversidad and idFacultadEqui = $g_idFacultadEqui and idCarrera = $g_idCarrera";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['idMateriaProcedencia']; ?></td>
			<td><?php echo $datos['nombreMateriaProcedencia']; ?></td>
                        <td><?php echo $datos['idCiclo']; ?></td>
                        <td><?php echo $datos['UV']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>')" />
                        </td>
		</tr>
                <?php
            }
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
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Materia" />
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:550px ; margin: 0 auto 100px ;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:justify; border-radius:8px;box-shadow: 1px 1px 12px #555;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Materia</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Materia</legend>   
                <table>
<!--                    <tr>
                        <td>id Universidad</td>
                        <td>:</td>
                        <td>-->
                            <input type="hidden" readonly="readonly" id="txtidUniversidad" name="txtidUniversidad" />
<!--                        </td>
                    </tr>
                    <tr>
                        <td>Id Facultad</td>
                        <td>:</td>
                        <td>-->
                            <input type="hidden" readonly="readonly" id="txtidFacultadEqui" name="txtidFacultadEqui" />
<!--                        </td>
                    </tr>
                    <tr>
                        <td>Id Carrera</td>
                        <td>:</td>
                        <td>-->
                            <input type="hidden" readonly="readonly" id="txtidCarrera" name="txtidCarrera" />
<!--                        </td>
                    </tr>-->
                    <tr>
                        <td>Id Materia</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidMateriaProcedencia" name="txtidMateriaProcedencia" />
                        </td>
                    </tr>
                    <tr>
                        <td>Materia</td>
                        <td>:</td>
                        <td>
                            <input required class="awesome-text-box" type="text" size="70" id="txtnombreMateriaProcedencia" name="txtnombreMateriaProcedencia"/>
                        </td>
                    </tr>                     
                    <tr>
                        <td>Ciclo</td>
                        <td>:</td>
                        <td>
                            <input required class="awesome-text-box"  type="text" id="txtidCiclo" name="txtidCiclo"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Unidades Valorativas</td>
                        <td>:</td>
                        <td>
                            <input required class="awesome-text-box" type="text" id="txtUV" name="txtUV"/>
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
<?php 
//echo "</div></div>";
?>
</body>
</html>