<?php require_once("ClassConexion2.php");
class ClassControl extends Conexion
{
	
	public function CicloAnioActual()
		{
			$sql="select CONSECUTIV from control
					where nombre ='ANO_C' ";
			$anio="";		
			foreach($this->consulta($sql) as $c)
			
				{
					$anio=$c["CONSECUTIV"];
				}		
		
		
			$sql="select CONSECUTIV from control
					where nombre ='CICLOACT' ";
			$ciclo="";		
			foreach($this->consulta($sql) as $c)
			
				{
					$ciclo=$c["CONSECUTIV"];
				}
		
			 $ret=(strlen($ciclo) == 1) ? "0".$ciclo."/".$anio : $ciclo."/".$anio ;
			return $ret;
		}
                
	public function CicloAnioActual2()
		{
			$sql="select CONSECUTIV from control
					where nombre ='ANO_C' ";
			$anio="";		
			foreach($this->consulta($sql) as $c)
			
				{
					$anio=$c["CONSECUTIV"];
				}		
		
		
			$sql="select CONSECUTIV from control
					where nombre ='CICLOACT' ";
			$ciclo="";		
			foreach($this->consulta($sql) as $c)
			
				{
					$ciclo=$c["CONSECUTIV"];
				}
		
			
			return Array('ciclo'=>$ciclo, 'anio'=>$anio);
		}                
}