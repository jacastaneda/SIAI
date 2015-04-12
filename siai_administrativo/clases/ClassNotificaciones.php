<?php 
/*
	Clase que opera con el modulo de notificaciones
	fecha de creacion: 12 de septiembre 2012
	Autor : Denys Urquilla

**/

class ClassNotificaciones{
	
	
	private $fecha1;//metodos privados
	private $fecha2;//metods privado de fecha1
	private $region;
	private $depto;
	
	public function setfecha1($fecha1){
		$this->fecha1=$fecha1;
		}
		
	public function setfecha2($fecha2){
		$this->fecha2=$fecha2;
		}
	
	
	public function getfecha1(){
		return $this->fecha1;
		}
		
		
	public function getfecha2(){
		return $this->fecha2;
		}
	
	public function setRegion($region){
		$this->region=$region;
		}
	
	public function getRegion(){
		
		return $this->region;
		
		}	
	
	public function setDepto($depto){
		$this->depto=$depto;
		}
	
	public function getDepto(){
		
		return $this->depto;
		
		}	
			
		
	public function getcapacitacion(){
			$cnx= new MySQL();
			$sql="select * from cdmp_newcapa where (ccap_fechaI BETWEEN '".$this->getfecha1()."'  and  '".$this->getfecha2()."')  
			or (ccap_fechaF BETWEEN'".$this->getfecha1()."' and   '".$this->getfecha2()."' )";
			$consulta=$cnx->consulta($sql);
			
			return $consulta;
			}
	
	
	public function getRegiones(){
			$cnx= new MySQL();
			$sql="CALL PROC_BUSQUEDA_REGIONES";
			
			$consulta=$cnx->consulta($sql);
			
			while($region=$cnx->fetch_array($consulta)){
				$regionMatriz[] = array ("zona_id"=>$region[zona_id],"zona_nombre"=>$region[zona_nombre]);
				}
			
			return $regionMatriz;
			
			}
			
			
	public function getSectores(){
		
		$cnx= new MySQL();
			$sql="CALL PROC_BUSQUEDA_SECTORES";
			
			$consulta=$cnx->consulta($sql);
			
			while($cn=$cnx->fetch_array($consulta)){
				$Matriz[] = array ("sec_id"=>$cn["sec_nombre"],"sec_nombre"=>$cn["sec_nombre"]);
				}
			
			
			return $Matriz;
			
			
		
		}		
		
		
		
	
	
	
	public function getDeptos(){
		$cnx= new MySQL();
		$sql="CALL PROC_BUSQUEDA_DEPARTAMENTOS('".$this->region."')";
		
		$consulta=$cnx->consulta($sql);
			
			while($region=$cnx->fetch_array($consulta)){
				$deptoMatriz[] = array ("depto_id"=>$region["depto_id"],"depto_nombre"=>$region["depto_nombre"]);
				}
			
			return $deptoMatriz;	
		
		}
		
	public function getMunicipios(){
		$cnx= new MySQL();
		$sql="CALL PROC_BUSQUEDA_MUNICIPIOS('".$this->depto."')";
		
		$consulta=$cnx->consulta($sql);
		
		while($depto=$cnx->fetch_array($consulta)){
				$municiMatriz[] = array ("muni_id"=>$depto["muni_nombre"],"muni_nombre"=>$depto["muni_nombre"]);
				}
			
			return $municiMatriz;
		}
		
		
		
	public function getEmpresasFiltros($zona,$depto,$municipio,$sector,$nombre,$nit,$periodos){
		
		
		$cnx= new MySQL();
		
		
		
		if($zona=="*"){
			$zona="";
			}
		
		if($depto=="*"){
			$depto="";
			}
		
		if($municipio=="*"){
			$municipio="";
			
			}
		if($sector=="*"){
			$sector="";
			}
			
			
		
			
			
			
				
		 $sql="SELECT 
		 	emp.emp_id,
			emp.emp_nit, 
			emp.emp_nombre, 
			dep.depto_nombre, 
			mun.muni_nombre, 
			sect.sec_nombre 
			FROM sig_empresas emp
			INNER JOIN erp_municipios mun
			ON emp.muni_id = mun.muni_id
			INNER JOIN erp_departamentos dep
			ON mun.depto_id = dep.depto_id
			INNER JOIN erp_zonaregion reg
			ON dep.zona_id = reg.zona_id
			INNER JOIN erp_sectorest sect
			ON emp.sector_id=sect.sec_id 
			inner join cdmp_sesion as sesion
			on emp.emp_id = sesion.emp_id
			inner join cdmp_periodos as pe
			on sesion.cper_id = pe.cper_id 
			 
			where reg.zona_id like '$zona%'
			and  (dep.depto_id like '$depto%'
			and mun.muni_nombre like '$municipio%')
			and sect.sec_nombre like '$sector%'
			and emp.emp_nombre like '$nombre%'
			and emp.emp_nit like '$nit%'
			
			"." ".$periodos;
			//$condicion;
		
		 $consulta=$cnx->consulta($sql);
		
		while($da=$cnx->fetch_array($consulta)){
				$daMatriz[] = array ("emp_id"=>$da["emp_id"],"emp_nit"=>$da["emp_nit"],"emp_nombre"=>$da["emp_nombre"],"depto_nombre"=>$da["depto_nombre"],"muni_nombre"=>$da["muni_nombre"],"sec_nombre"=>$da["sec_nombre"]);
				}  
			 
			 if(count($daMatriz)>0){
				 return $daMatriz; 
				 }
			else{
				$daMatriz[] = array ("emp_nit"=>"Sin Registros","emp_nombre"=>"Sin Registros","depto_nombre"=>"Sin Registros","muni_nombre"=>"Sin Registros","emp_telefono"=>"Sin Registros");
				return $daMatriz;
				}	 
			 
			
			//$daMatriz;
		
		}
		
		
		public function periodos(){
			
			$cnx= new MySQL();
			
			$sql="CALL PROC_Consultar_Peridodos";
			$consulta=$cnx->consulta($sql);		
			while($da=$cnx->fetch_array($consulta)){
				$daMatriz[] = array ("anio"=>$da["cper_anio"]);
				}
			return $daMatriz;
			
			}	
	
	}//fin del clase