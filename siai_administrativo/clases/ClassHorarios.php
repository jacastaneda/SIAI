<?php require_once("ClassConexion2.php");
class ClassHorarios extends Conexion
{
	public function MostrarHorarios()
		{
			$sql="select * from horarios";
			return $this->consulta($sql);
		}
}