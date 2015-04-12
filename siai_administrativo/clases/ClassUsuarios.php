<?php 

class ClassUsuario{
	
	private $Usuario;
	private $Password;
	
	
	
	public function setUsuario($Usuario){
		
		$this->Usuario=$Usuario;
		
		}
	
	
	public function setPassword($Password){
		
		$this->Password=md5($Password);
		
		}
		
		
			
	public function Login(){
		
		$cnx= new MySQL();
		
		$sql="select * from usuarios where CODIGO='".$this->Usuario."' and CLAVE='".$this->Password."'";
		$consulta=$cnx->consulta($sql);
		
		while($cn=$cnx->fetch_array($consulta)){
				$Matriz[0] = array ("CODIGO"=>$cn["CODIGO"],"TIPO_USUAR"=>$cn["TIPO_USUAR"],"idCatedratico"=>$cn["idCatedratico"]);
				}
		
		return $Matriz;
		
		}

	}//fin de la clase
