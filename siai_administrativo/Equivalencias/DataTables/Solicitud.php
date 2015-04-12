<?php
    require_once 'funciones/conexiones.php';
    if(isset($_POST["CARNET"])) { 
        $_SESSION['CARNET'] = serialize($_POST["CARNET"]); 
    } 
    if(isset($_SESSION['CARNET'])) { 
        $g_CARNET = unserialize($_SESSION['CARNET']); 
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Solicitud de Equivalencia</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
                        @import "funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
                  var procedimiento = "nuevo";            
                  $(document).ready(function() {                     
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();
		    var oTable = $('#example').dataTable({"oLanguage":{"sUrl": "media/language/es_ES.txt"}} );               
                    $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nuevo Estado Civil");
                    procedimiento = "nuevo";
                                      
                    if ($("#btnNuevo").val()=="Agregar Estado Civil"){
                        $("#txtidEstadoCivil").attr("value",'');
                        $("#txtnombreEstadoCivil").attr("value",'');
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Estado Civil");
                    }
                    else{
                        alert("otro")
                    }
                })
                
                $("#btnProcesar").click(function(){
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();
                    
                    if(procedimiento == "nuevo")
                    {
                        $.ajax({
                        url: "guardarEstadoCivil.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r)
                            {
                                alert(r);
                                $("#loader").hide();
                                location.reload(true);
                            }
                        })
                    }
                    else if(procedimiento == "editar")
                    {
                        $.ajax({
                        url: "editarEstadoCivil.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r)
                            {
                                alert(r);
                                $("#loader").hide();
                                location.reload(true);
                            }
                    })
                    }
                  })
               });
            
            function eliminar(idEstadoCivil)
            {
                if(confirm("Esta seguro que desea eliminar el estado Civil?"))
                {
                    //cedula=85150447
                    var v_idEstadoCivil = "idEstadoCivil="+idEstadoCivil;                    
                    $.ajax({
                        url:"eliminarEstadoCivil.php",
                        data: v_idEstadoCivil,
                        type: "POST",
                        success:
                            function(respuesta)
                            {
                                alert(respuesta);
                                location.reload(true);
                            }                        
                    })
                }
            }
            
            function editar(idEstadoCivil)
            {
                $("#leyenda").html("Actualizar Estado Civil");
                procedimiento = "editar";
                var v_idEstadoCivil = "idEstadoCivil="+idEstadoCivil;                    
                    $.ajax({
                        url:"buscarEstadoCivil.php",
                        data: v_idEstadoCivil,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidEstadoCivil").val(respuesta.idEstadoCivil);
                                $("#txtnombreEstadoCivil").val(respuesta.nombreEstadoCivil);                                  
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
                    <td>Alumno</td>
                    <td>:</td>
                    <td>
                        <select name="idCarnet" id="idCarnetParam">                        
                        <?php
                            $con1 = Conectar();
                            $sql1 = "select ea.CARNET,ea.NOMBRES,ea.APELLIDO1,ea.APELLIDO2,ea.APELLCASAD from expedientealumno ea where ea.CARNET= '$g_CARNET' ";
                            $q1 = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta");                
                            while($datos = mysql_fetch_array($q1)){
                                echo '<option value="'.$datos['CARNET'].'">'.$datos['NOMBRES'].' ' .$datos['APELLIDO1'].' '.$datos['APELLIDO2'].' '.$datos['APELLCASAD'].'</option>';
                            }   
                            desconectar();
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>                    
			<div class="full_width big">
				Estado Civil
			</div>
                    <h1>Informaci&oacute;n</h1>
			
                        <div class="demo_jui">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<th>Fecha Ingreso</th>
                        <th>Id Solicitud</th>
			<th>Estado</th>
                        <th>Ingresada Por</th>
                        <th></th>
                        <th></th>
                        <th></th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "select se.idSolicitudEqui,se.idEstadoSolicitudEqui,se.fechaIngreSolicitud,se.numeroCarne,se.nombresSolicitante,
                    se.PrimerApellidoSolicitante,se.segundoApellidoSolicitante,se.apellidoCasadaSolicitante,se.idCatedratico,
                    ct.Nombres,ct.Apellidos,es.nombreEstadoSoliEqui from proc_solicitudequivalencia se, proc_catedraticos ct, proc_estadosoliequivalencia es
                    where idCatedratico = $g_CARNET and ct.idCatedratico= se.idCatedratico and es.idEstadoSolicitudEqui = se.idEstadoSolicitudEqui";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['fechaIngreSolicitud']; ?></td>
                        <td><?php echo $datos['idSolicitudEqui']; ?></td>
                        <td><?php echo $datos['nombreEstadoSoliEqui']; ?></td>			
                        <td><?php echo $datos['Nombres'].' '.$datos['Apellidos'] ; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idSolicitudEqui']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idSolicitudEqui']; ?>')" />
                        </td>
                        <th>
                            <form action="Carrera.php" method="post">
                                <input name="CARNET" id="CARNET" type="text" value="<?php echo $datos['numeroCarne']; ?>">                                
                                <input name="idSolicitudEqui" id="idSolicitudEqui" type="text" value="<?php echo $datos['idSolicitudEqui']; ?>">                                
                                <input value="Carreras" type="submit">
                            </form>
                        </th>
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
                        <th></th>
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Estado Civil" />
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
        <div id="formularioRegistrar" align="center"  style='position:absolute; left: 35%; top:0px;  width:300px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:justify; border-radius:8px;box-shadow: 1px 1px 12px #555;'>
            <div id="procedimiento"></div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nuevo Estado Civil</legend>   
                <table>
                    <tr>
                        <td>Id Estado Civil</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidEstadoCivil" name="txtidEstadoCivil" />
                        </td>
                    </tr>
                    <tr>
                        <td>Estado Civil</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtnombreEstadoCivil" name="txtnombreEstadoCivil"/>
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