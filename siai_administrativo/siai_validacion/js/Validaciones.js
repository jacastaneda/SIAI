// JavaScript Document
function validarNombre(contrasena)
{
	var formato=/^([a-zA-Z\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1\u00FC\u00DC\s])+$/;
	return validarFormato(contrasena,formato);
}
function validarContrasena(contrasena)
{
	var formato=/^([a-zA-Z0-9\$_.\-@])+$/;
	return validarFormato(contrasena,formato);
}
function validarURL(url)
{
	var formato=/^https?:+([\/]{2})+([a-zA-Z0-9_.\/\?&\=-]{1,})+$/;
	return validarFormato(url,formato);
}
function validarTelefono(telefono)
{
	var formato=/^([0-9\-\(\)])+$/;
	return validarFormato(telefono,formato);
}
function validarNumero(telefono)
{
	var formato=/^([0-9.])+$/;
	return validarFormato(telefono,formato);
}
function validarEmail(email)
{
	var formato=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9-])+(\W[a-zA-Z0-9]{2,4})+$/;
	return validarFormato(email, formato);
}
function validarFormato(valor, formato)
{	
	if(valor!="" && valor!=null)
	{
		if(formato.test(valor))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}
function validarFecha(fecha)
{
	var formato = /^([0-9]{4})+\-([0-9]{1,2})+\-([0-9]{1,2})+$/;
	if(fecha!="" && fecha!=null)
	{
		if(formato.test(fecha))
		{
			var arreglo_fecha =fecha.split("-");
			arreglo_fecha[1]=Number(arreglo_fecha[1])-1;
			var formato_fecha=new Date(arreglo_fecha[0],arreglo_fecha[1],arreglo_fecha[2]);
			if(formato_fecha.getMonth()==Number(arreglo_fecha[1]))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}
