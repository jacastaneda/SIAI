<?php 
class MySQL
{
     private $conexion;
     private $total_consultas;
	 private $anio;
	 private $cod;
	 private $bd;
	 
	
	
 	 public function cambio_conexion(){
		
		
		 //$this->bd='robot_'.$_SESSION[empresa]."_".$_SESSION[anio];
		 return $this->bd='robot_'.$_SESSION[empresa]."_".$_SESSION[anio];
		//$this->bd="robot";
		 } 

     public function MySQL()
     {
          if(!isset($this->conexion))
          {
			
			 
              $this->conexion = (mysql_connect("localhost","root","root",true,65536)) or  die(mysql_error());
              mysql_select_db("siai",$this->conexion) or die("<font size='+1' color='#FF0000'><img src='../img/triste.png ' height='100px' width='100px' >El sistema no encontró una empresa Válida : intente accediendo desde aquí ----<a href='../empresa/cambio_empresa.php'>Cambiar de Base</a></font>".mysql_error());
          
		 }
     }


	private function desconectar(){
		mysql_close($this->conexion);
		}

     public function consulta($consulta)
     {
          
          $resultado = mysql_query($consulta,$this->conexion);
          if(!$resultado)
          {
                echo 'MySQL Error: ' . mysql_error();
                exit;
          }
          return $resultado;
		  $this->desconectar();
     }

     //Ejecucion del query


     public function fetch_array($consulta)
     {
            return mysql_fetch_array($consulta);
     }
	 
	 
	 

     //para saber si tiene resultado la consulta
     public function num_rows($consulta)
     {
            return mysql_num_rows($consulta);
     }

     public function getTotalConsultas()
     {
            return $this->total_consultas;
     }

     //para la opcion de combos
     public function fetch_row($consulta)
     {
         return mysql_fetch_row($consulta);
     }

     //Devuelve un objeto con propiedades que corresponden a la fila recuperada
     public function fetch_object($consulta)
     {
         return mysql_fetch_object($consulta);
     }

     //
     public function affected_rows($consulta)
     {
         return mysql_affected_rows();
     }

     public function insert_id()
     {
         return mysql_insert_id();
     }

 }