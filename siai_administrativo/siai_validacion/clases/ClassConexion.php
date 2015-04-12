<?php 
class MySQL
{
	//creando variable para almacenar objeto mysqli
	private $conexion;
	private $total_consultas;
	private $anio;
	private $cod;
	private $bd;
	// atributos que al almacenarán los nombres de la tabla a consultar, de los columnas y de la llave primaria
	private $tabla;
	private $atributos;
	private $llavePrimaria;
	
	public function conectarse()
	{
		$this->conexion=new mysqli("localhost","root","root","siai");
		/* comprueba la conexión */	
		if (mysqli_connect_errno()) {
			printf("Error en la conexión: %s\n", mysqli_connect_error());
			exit();
		}
		else
		{
			$this->ejecutarQuery("SET NAMES 'utf8'");
			return $this->conexion;
		}
	}
	
	public function desconectarse(){
		$this->conexion->close();
	}
	
	public function setNombreTabla($nombreTabla)
	{ 
		$this->tabla=$nombreTabla;
	}
	
	public function setNombreAtributos($nombreAtributos)
	{
		$this->atributos=$nombreAtributos;
	}
	
	public function setNombreLlavePrimaria($nombreLlave)
	{
		$this->llavePrimaria=$nombreLlave;
	}
	
	//metodos para escribir en base de datos	
	
	//metodo para generar query de insersion
	private function generarQueryInsert($atributos,$valores)
	{
		//Creando cadena de la consulta insert
		$query = "INSERT INTO ";
		$query .= $this->tabla;
		$query .= " (";
		for($i=0;$i<count($atributos);$i++)
		{
			$query .= $atributos[$i];
			if($i<count($atributos)-1)
			{
				$query .= ',';
			}
		}
		$query .= ") values (";
		for($i=0;$i<count($valores);$i++)
		{
			$query .= "'".$valores[$i]."'";
			if($i<count($valores)-1)
			{
				$query .= ',';
			}
		}
		$query .= ");";		
		return $query;
	}
	
	//metodo para insertar un registro en tabla
	public function insertarRegistro($atributos)
	{
		if (count($atributos)!=count($this->atributos)) {
			printf("La cantidad de atributos no coincide con los valores a registrar");
			return false;
		}
		else
		{
			$this->conectarse();
			$query=$this->generarQueryInsert($this->atributos,$atributos);
			if($this->ejecutarQuery($query))
			{
				$id=$this->conexion->insert_id;
				$this->desconectarse();	
				return $id;
			}
			else
			{
				$this->desconectarse();
				return false;
			}
		}
	}
	
	public function insertarRegistroConLlave($llave,$atributos)
	{
		if (count($atributos)!=count($this->atributos)) {
			printf("La cantidad de atributos no coincide con los valores a registrar");
			return false;
		}
		else
		{
			$this->conectarse();
			
			$valores=$atributos;
			$valores[count($valores)]=$llave;
			
			$atributos=$this->atributos;
			$atributos[count($atributos)]=$this->llavePrimaria;
	
			$query=$this->generarQueryInsert($atributos,$valores);
			if($this->ejecutarQuery($query))
			{
				$this->desconectarse();	
				return true;
			}
			else
			{
				$this->desconectarse();
				return false;
			}
		}
	}
	
	public function consultarRegistro($llave)
	{
		if(isset($this->llavePrimaria) && isset($this->tabla) && isset($this->atributos) && isset($llave))
		{
			$this->conectarse();
			//Creando cadena de la consulta Select
			$query="SELECT ";
			//concatenando nombre de atributos;
			for($i=0;$i<count($this->atributos);$i++)
			{
				$query .= $this->atributos[$i];
				if($i<count($this->atributos)-1)
				{
					$query .= ',';
				}
			}
			$query.=" FROM ".$this->tabla." WHERE ".$this->llavePrimaria." = '".$llave."'";
			//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
			$resultado= $this->ejecutarQuery($query);
			if($resultado)
			{
				if($registro=$resultado->fetch_array(MYSQLI_BOTH))
				{
					$resultado->free();
					$this->desconectarse();
					return $registro;
				}
				else
				{
					$resultado->free();
					$this->desconectarse();
					return false;
				}
			}
			else
			{
				$this->desconectarse();
				echo $query;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	//función para borrar un registro por medio de la llave primaria
	public function borrarRegistro($llave)
	{
		
		$this->conectarse();
		//Creando cadena Delete
		$query="DELETE FROM ".$this->tabla." WHERE ".$this->llavePrimaria." = '".$llave."'";
		if($this->ejecutarQuery($query))
		{
			$this->desconectarse();	
			return true;
		}
		else
		{
			$this->desconectarse();
			return false;
		}
	}
	
	//función para crear listado, parametros necesarios el atributo por el cual se quiere ordenar y el orden si es ASC o DESC
	public function listaLlaves($atributo_orden, $orden)
	{
		if(isset($this->llavePrimaria))
		{
			//Creando cadena de la consulta Select
			$query="SELECT ".$this->llavePrimaria." FROM ".$this->tabla." ORDER BY $atributo_orden $orden";
			//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
			if($resultado=$this->consulta($query))
			{
				for($i=0;$i<count($resultado);$i++)
				{
					$arreglo[$i]=$resultado[$i][0];
				}
				return $arreglo;
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
	
	//función para crear listado, parametros necesarios el atributo por el cual se quiere ordenar y el orden si es ASC o DESC
	public function lista($atributo_orden, $orden)
	{
		if(isset($this->llavePrimaria))
		{
			//Creando cadena de la consulta Select
			$query="SELECT ".$this->llavePrimaria;
			for($i=0;$i<count($this->atributos);$i++)
			{
				$query .= ',';
				$query .= $this->atributos[$i];				
			}			
			$query.=" FROM ".$this->tabla." ORDER BY $atributo_orden $orden";
			$resultado=$this->consulta($query);
			return $resultado;
			
		}
		else
		{
			return false;
		}
	}
	
	//función para crear listado, parametros necesarios el atributo por el cual se quiere ordenar y el orden si es ASC o DESC
	public function buscar($valor, $atributo_orden, $orden)
	{
		if(isset($this->llavePrimaria))
		{
			$this->conectarse();
			//Creando cadena de la consulta Select
			$query="SELECT ".$this->llavePrimaria." FROM ".$this->tabla." WHERE ";
			for($i=0;$i<count($this->atributos);$i++)
			{
				$query .= "LOWER(".$this->atributos[$i].") LIKE '%$valor%' OR ";
				$query .= "LOWER(".$this->atributos[$i].") LIKE '$valor%' OR ";
				$query .= "LOWER(".$this->atributos[$i].") LIKE '%$valor'";
				if($i<count($this->atributos)-1)
				{
					$query .= ' OR ';
				}
			}
			$query .=" ORDER BY $atributo_orden $orden";
			//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
			if($resultado=$this->consulta($query))
			{
				for($i=0;$i<count($resultado);$i++)
				{
					$arreglo[$i]=$resultado[$i][0];
				}
				return $arreglo;
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
	
	//función para hacer consultas genericas, devuelve un arreglo con el resultado
	public function consulta($query)
	{
		$this->conectarse();
		//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
		$resultado= $this->ejecutarQuery($query);
		if($resultado)
		{
			$arreglo=array();
			$i=0;
			while($registro=$resultado->fetch_array(MYSQLI_BOTH))
			{
				$arreglo[$i]=$registro;
				$i++;
			}
			if(count($arreglo)>0)
			{
				$this->desconectarse();
				return $arreglo;
			}
			else
			{
				$this->desconectarse();
				return false;
			}
		}
		else
		{
			$this->desconectarse();
			return false;
		}
	}
	
	
	public function buscarLlave($valor, $atributo_orden, $orden)
	{
		if(isset($this->llavePrimaria))
		{
			$this->conectarse();
			//Creando cadena de la consulta Select
			$query="SELECT ".$this->llavePrimaria." FROM ".$this->tabla." WHERE ";
			
			$query .= "LOWER(".$this->llavePrimaria.") LIKE '%$valor%' OR ";
			$query .= "LOWER(".$this->llavePrimaria.") LIKE '$valor%' OR ";
			$query .= "LOWER(".$this->llavePrimaria.") LIKE '%$valor'";
			
			
			$query .=" ORDER BY $atributo_orden $orden";
			//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
			$resultado= $this->ejecutarQuery($query);
			if($resultado)
			{
				$arreglo=array();
				$i=0;
				while($registro=$resultado->fetch_array())
				{
					$arreglo[$i]=$registro[0];
					$i++;
				}
				if(count($arreglo)>0)
				{
					$this->desconectarse();
					return $arreglo;
				}
				else
				{
					$this->desconectarse();
					return false;
				}
			}
			else
			{
				$this->desconectarse();
				echo $query;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function listaLlavesPorCondicion($nombreAtibuto,$condicion,$atributo_orden, $orden)
	{
		if(isset($this->llavePrimaria))
		{
			$this->conectarse();
			//Creando cadena de la consulta Select
			$query="SELECT ".$this->llavePrimaria." FROM ".$this->tabla." WHERE ".$nombreAtibuto."='".$condicion."' ORDER BY $atributo_orden $orden";
			//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
			$resultado= $this->ejecutarQuery($query);
			if($resultado)
			{
				$arreglo=array();
				$i=0;
				while($registro=$resultado->fetch_array())
				{
					$arreglo[$i]=$registro[0];
					$i++;
				}
				if(count($arreglo)>0)
				{
					$this->desconectarse();
					return $arreglo;
				}
				else
				{
					$this->desconectarse();
					return false;
				}
			}
			else
			{
				$this->desconectarse();
				echo $query;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function listaPorCondicion($nombreAtibuto,$condicion,$atributo_orden, $orden)
	{
		if(isset($this->llavePrimaria))
		{
			$this->conectarse();
			//Creando cadena de la consulta Select
			$query="SELECT ".$nombreAtibuto." FROM ".$this->tabla." WHERE ".$condicion." ORDER BY $atributo_orden $orden";
			//echo $query;
			//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
			$resultado= $this->ejecutarQuery($query);
			if($resultado)
			{
				$arreglo=array();
				$i=0;
				while($registro=$resultado->fetch_array())
				{
					$arreglo[$i]=$registro[0];
					$i++;
				}
				if(count($arreglo)>0)
				{
					$this->desconectarse();
					return $arreglo;
				}
				else
				{
					$this->desconectarse();
					return false;
				}
			}
			else
			{
				$this->desconectarse();
				echo $query;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	
	public function actualizarRegistro($llave, $atributos)
	{
		if(isset($this->llavePrimaria) && isset($this->tabla) && isset($this->atributos) && isset($llave))
		{					
			if (count($atributos)!=count($this->atributos)) {
				printf("La cantidad de atributos no coincide con los valores a registrar");
				return false;
			}
			else
			{
				$this->conectarse();
				//Creando cadena de la consulta update
				$query = "UPDATE ".$this->tabla." SET ";
				for($i=0;$i<count($this->atributos);$i++)
				{
					$query .= $this->atributos[$i]."='".$atributos[$i]."'";
					if($i<count($atributos)-1)
					{
						$query .= ',';
					}
				}
				$query.=" WHERE ".$this->llavePrimaria."='".$llave."'";
				//echo $query;
				//Ejecutando query, si falla retorna false, si la sentencia es SELECT, SHOW o DESCRIBE el resultado del query es un objeto mysqli_result
				$resultado= $this->ejecutarQuery($query);
				if($resultado)
				{
					$this->desconectarse();
					return true;
				}
				else
				{
					$this->desconectarse();
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	
	//metodos para transacciones
	//metodo para desactivar autocommit
	public function desactivarAutoCommit()
	{
		$this->conexion->autocommit(false);
	}
	
	public function setConexion($conexion)
	{
		$this->conexion=$conexion;
	}
	public function getConexion($conexion)
	{
		return $this->conexion;
	}
	
	public function insertarTransaccion($atributos)
	{
		if (count($atributos)!=count($this->atributos)) {
			printf("La cantidad de atributos no coincide con los valores a registrar");
			return false;
		}
		else
		{
			$query=generarQueryInsert($atributos);
			if($this->ejecutarQuery($query))
			{			
				return $this->conexion->insert_id;
			}
			else
			{
				return false;
			}
		}
	}
	
	public function commit()
	{
		$this->conexion->commit();
		$this->desconectarse();
	}
	
	public function rollback()
	{
		$this->conexion->rollback();
		$this->desconectarse();
	}
	
	//Ejecucion del query
	public function ejecutarQuery($consulta)
    {
		$resultado = $this->conexion->query($consulta);
        if(!$resultado)
        {
        	echo 'MySQL Error: '. $this->conexion->error;
		}
		return $resultado;		
	}
 }