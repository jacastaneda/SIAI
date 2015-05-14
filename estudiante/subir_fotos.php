<?php
	session_start();
	include_once("../clases/ClassConexion.php");
	include_once("../clases/MetodosComunes.php");
	include_once("../clases/ClassControl.php");
	include_once("../clases/ClassExpedientealumno.php");
	$control= new Control();
	$control->setControlPorLlave('ANO_C');
	$anio=$control->getConsecutiv();
	$control->setControlPorLlave('CICLOACT');
	$ciclo_actual=$control->getConsecutiv();
	if(strlen($ciclo_actual)<2)
	{
		$ciclo_actual='0'.$ciclo_actual;
	}
	
	if(isset($_SESSION['siai']['expediente']))
	{
		$expediente= unserialize($_SESSION['siai']['expediente']);	
		$status = false;
		if ($_POST["action"] == "upload") {
			// obtenemos los datos del archivo
			$tamano = $_FILES["foto"]['size'];
			$tipo = $_FILES["foto"]['type'];
			$archivo = $_FILES["foto"]['name'];
			$nombre=explode('.',$archivo);
			$extension=$nombre[(count($nombre)-1)];
			$nombre=$expediente->getCarnet().'.'.strtolower($extension);  
			if ($nombre != "") {
				// guardamos el archivo a la carpeta files
				if(!file_exists("fotos/".$anio."/".$ciclo_actual))
				{
					mkdir("fotos/".$anio."/".$ciclo_actual,0,true);
				}
				$destino =  "fotos/".$anio."/".$ciclo_actual.'/'.$nombre;
				//echo $destino;
				if (copy($_FILES['foto']['tmp_name'],$destino)) {
					$status = true;
				} else {
					$status = false;
				}
			} else {
				 $status = false;
			}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script type="text/javascript">
function validarFoto() {
    var input, file;
    // (Can't use `typeof FileReader === "function"` because apparently
    // it comes back as "object" on some browsers. So just see if it's there
    // at all.)
	input = document.getElementById('foto');
	
	var nombre=input.value;
	
	nombre=nombre.split('.');	
	
	var tamano=nombre.length;
	tamano=tamano-1;
	var extension=nombre[tamano];
	extension=extension.toLowerCase()
	
	if(extension=='jpg' || extension=='png')
	{
		if (!window.FileReader) {	
			return true;
		}
		else
		{		
			if (!input) {
				alert("No se pudo encontrar el archivo seleccionado");
				return false;		
			}
			else if (!input.files) {
				alert("This browser doesn't seem to support the `files` property of file inputs.");	
				return false;	
			}
			else if (!input.files[0]) {
				alert("Favor seleccione un archivo antes de dar click en subir foto");
				return false;
			}
			else {
				file = input.files[0];
				if(file.size<1048576)
				{
					return true;
				}
				else
				{
					alert("El archivo que intenta subir excede el peso máximo permitido.");
					return false;
				}
			}
		}
	}
	else
	{
		alert("La extensión del archivo que intenta subir no es valida, solo se aceptan archivos en formato jpg o png");
		return false;
	}
}

function enviar()
{
	
	if(validarFoto())
	{
		document.getElementById('formulario').submit();
	}
}
</script>
<body>
<div>
    <?php if($destino): ?><div id="foto" style="width:150px; height:200px;border: dashed 2px #000000; overflow:hidden;" onclick="javascrip: document.getElementById('foto').focus();">
    	<img src="<?php echo $destino; ?>" width="150" height="200" />
    </div><?php else: ?>
    <form action="subir_fotos.php" method="post" enctype="multipart/form-data" id="formulario">
        <p><input type="file" id="foto" name="foto" accept="image/*"/></p>
        <p><input type="button" onclick="javascript: enviar()" value="Subir Foto" /></p>
        <input name="action" type="hidden" value="upload" /> 
    </form>
    <?php endif; ?>
</div>
</body>
</html>