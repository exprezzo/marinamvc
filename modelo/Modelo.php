<?php
require_once $CORE_PATH.'i_crud.php';
require_once $CORE_PATH.'database.php';

class Modelo implements ICrud{								
	var $pk='id';
	var $nombre='';

	function getError($sth){
		$resp=array();
		$error=$sth->errorInfo();
		
		$resp['success']=false;			
		$resp['msg']=$error[2];
		return $resp;
	}
	
	function getPdo(){
		$db=Database::getInstance();
		return $db->pdo;
	}
	function getConexion(){
		return $this->getPdo();
	}
	
	public function ejecutarSql($sql){
		$pdo = $this->getPdo();
		$sth = $pdo->prepare($sql);						
		return $this->execute($sth);		
	}
	
	function execute($sth){
		//Ejecuta el statement y revisa errores
		$exito = $sth->execute();
			
		$msg='';
		if ($exito!==true){
			$error=$sth->errorInfo();			
			$success=false;
			$msg=$error[2];						
			$datos=array();
		}else{
			$datos = $sth->fetchAll(PDO::FETCH_ASSOC);
			$success=true;
		}
		
		return array(
			'success'	=>$success,			
			'datos' 	=>$datos,
			'msg'		=>$msg
		);			
	}
/*	===============================================================================
		ICrud
	=============================================================================== */	
	var $tabla='modelo_test';
	
	public function contar($filtros=''){
		if (!empty ($filtros) ){
		$filtros=' WHERE '.$filtros;
		}
				
		$sql = 'SELECT COUNT('.$this->pk.' ) as total FROM '.$this->tabla.$filtros;		
		
		
		$pdo = $this->getConexion();
		$sth = $con->prepare($sql);				
		$sth->execute();
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if ( empty($modelos) ){
			throw new Exception('La informacion buscada no fue encontrada. <br>Consulta:'.$sql.' '.$id); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		if ( sizeof($modelos) > 1 ){
			throw new Exception("El identificador est� duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		return $modelos[0]['total'];			
	}
	
	
	function obtener($params){
		// print_r($params); exit;
		
		$id=$params[$this->pk];			
		$sql = 'SELECT * FROM '.$this->tabla.' WHERE '.$this->pk.'=:id';				
		
		// echo $sql; exit;
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':id',$id);		
		$sth->execute();
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if ( empty($modelos) ){
			//throw new Exception(); //TODO: agregar numero de error, crear una exception MiEscepcion
			
			return array('success'=>false,'error'=>'no encontrado','msg'=>'no encontrado '.$this->pk.':'.$id);
		}
		
		if ( sizeof($modelos) > 1 ){
			throw new Exception("El identificador est� duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		return $modelos[0];			
	}
	
	function guardar( $params ){
		$dbh=$this->getConexion();
		
		$id=$params[$this->pk];
		// $nombre=$params['nombre'];
		
		if ( empty($id) ){
			//           CREAR
			// $sql='INSERT INTO '.$this->tabla.' SET nombre=:nombre, fecha_de_creacion= now()';
			$sql='INSERT INTO '.$this->tabla.' SET ';
			foreach($params as $key=>$val){
				$sql.="$key=:$key, ";
			}
			$sql=substr($sql, 0, strlen($sql)-2 );
			
			// nombre=:nombre';
			$sth = $dbh->prepare($sql);							
			foreach($params as $key=>$val){
				$bind=":$key";
				$sth->bindValue($bind, $val,PDO::PARAM_STR);					
			}
			// $sth->bindValue(":nombre",$nombre,PDO::PARAM_STR);					
			$msg=$this->nombre.' Creado';	
		}else{
			//	         ACTUALIZAR
			
			$sql='UPDATE '.$this->tabla.' SET ';
			foreach($params as $key=>$val){
				if ($key==$this->pk ) continue;
				$sql.="$key=:$key, ";
			}
			$sql=substr($sql, 0, strlen($sql)-2 );
			$sql.=' WHERE '.$this->pk.'=:'.$this->pk;
			// nombre=:nombre';
			$sth = $dbh->prepare($sql);							
			foreach($params as $key=>$val){
				$bind=":$key";
				$sth->bindValue($bind, $val,PDO::PARAM_STR);					
			}
			
			$msg=$this->nombre.' Actualizado';	
		}
		$success = $sth->execute();
		
		
		if ($success != true){
			$error=$sth->errorInfo();			
			$success=false; //plionasmo aprop�sito
			$msg=$error[2];						
			$datos=array();
		}else{
			// $success = rowCount();			
			if ( empty( $id) ){
				$id=$dbh->lastInsertId();
			}
			$datos=$this->obtener(
				array( $this->pk =>$id )
			);
		}
		
		return array(
			'success'	=>$success,			
			'datos' 	=>$datos,
			'msg'		=>$msg
		);	
				
	}
	
	function eliminar($params){
		return $this->borrar($params);
	}
	function borrar( $params ){
		if ( empty($params[$this->pk]) ){
			throw new Exception("Es necesario el par�metro '".$this->pk."'");
		};		
		$id=$params[$this->pk];
		$sql = 'DELETE FROM '.$this->tabla.' WHERE '.$this->pk.'=:id';		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':id',$id,PDO::PARAM_INT);
		
		$exito = $sth->execute();					
		
		return $exito;	
	}
	
	function paginar($params){
		return $this->buscar($params);
	}
	
	
	
	function cadenaDeFiltros($filtros){
		$cadena=' WHERE ';
		foreach($filtros as $filtro){
			switch( strtolower( $filtro['filterOperator'] ) ){
				case 'equals':				
				case 'contains':				
				case 'beginswith':					
				case 'endswith':
					$cadena.=' '.$filtro['dataKey'].' LIKE :'.$filtro['dataKey'].' AND ';
				break;
				case 'greater':				
					$cadena.=' '.$filtro['dataKey'].' > :'.$filtro['dataKey'].' AND ';
				break;
				case 'greaterorequal':
					$cadena.=' '.$filtro['dataKey'].' >= :'.$filtro['dataKey'].' AND ';
				break;
				case 'isempty':
					$cadena.=' '.$filtro['dataKey'].' = "" AND ';
				break;
			}
		}
		
		$cadena = substr($cadena, 0,-4);
		// echo $cadena ; exit;
		return $cadena;
	}
	
	function bindFiltros($sth,$filtros){
		foreach($filtros as $filtro){
			switch( strtolower( $filtro['filterOperator'] ) ){
				case 'equals':									
					$sth->bindValue(':'.$filtro['dataKey'], $filtro['filterValue'], PDO::PARAM_STR);
				break;
				case 'contains':				
					$sth->bindValue(':'.$filtro['dataKey'], '%'.$filtro['filterValue'].'%', PDO::PARAM_STR);
				break;
				case 'beginswith':					
					$sth->bindValue(':'.$filtro['dataKey'], $filtro['filterValue'].'%', PDO::PARAM_STR);
				break;
				case 'endswith':
					$sth->bindValue(':'.$filtro['dataKey'], '%'.$filtro['filterValue'], PDO::PARAM_STR);
				break;
				case 'greater':
					$sth->bindValue(':'.$filtro['dataKey'], floatval( $filtro['filterValue'] ), PDO::PARAM_STR);
				break;
				case 'greaterorequal':				
					$sth->bindValue(':'.$filtro['dataKey'], floatval( $filtro['filterValue'] ), PDO::PARAM_STR);
				break;
				case 'isempty':				
					// aqui no se usan parametros (se usa campo='' ) 
				break;
			}
			
		}
	}
	
	function buscar($params){
		
		$con = $this->getConexion();
		
		$filtros='';
		if ( isset($params['filtros']) )
			$filtros=$this->cadenaDeFiltros($params['filtros']);
			
			// echo '<pre>';
		// print_r($params['filtros']);
		// echo $filtros; 
		// echo '</pre>';
		// exit;
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.$filtros;				
		$sth = $con->prepare($sql);
		
		if ( isset($params['filtros']) ){
			$this->bindFiltros($sth, $params['filtros']);
		}
		
		
		
		$exito = $sth->execute();
		if ( !$exito ){
			return $this->getError( $sth );
			throw new Exception("Error listando: ".$sql); //TODO: agregar numero de error, crear una exception MiEscepcion
		}		
		// $sth = $con->query($sql); // Simple, but has several drawbacks		
		
		
		$tot = $sth->fetchAll(PDO::FETCH_ASSOC);
		$total = $tot[0]['total'];
		
		$paginar=false;
		if ( isset($params['limit']) && isset($params['start']) ){
			$paginar=true;
		}
		
		
		
		
		if ($paginar){
			$limit=$params['limit'];
			$start=$params['start'];		
			$sql = 'SELECT * FROM '.$this->tabla.$filtros.' limit :start,:limit';
		}else{			
			$sql = 'SELECT * FROM '.$this->tabla.$filtros;
		}
		
		$sth = $con->prepare($sql);
		if ($paginar){
			$sth->bindValue(':limit',$limit,PDO::PARAM_INT);
			$sth->bindValue(':start',$start,PDO::PARAM_INT);
		}
				
		if ( isset($params['filtros']) ){
			$this->bindFiltros($sth, $params['filtros']);
		}
		
		$exito = $sth->execute();

		
		if ( !$exito ){
		
			return $this->getError( $sth );
			// throw new Exception("Error listando: ".$sql); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);				
		
		return array(
			'success'=>true,
			'total'=>$total,
			'datos'=>$modelos
		);
	}
	
	function crearFiltrosOr($texto, $campos){
		$texto=trim($texto);
		if ($texto=='') return '';
		$pieces = explode(" ", $texto);
		$or='';
		foreach($pieces as $palabra){
			foreach($campos as $campo){
				$or.=' OR '.$campo.' like "%'.$palabra.'%"';
			}
		}
		$or = substr($or, 4);
		return $or;
	}
/*  ===============================================================================
		fin de ICrud
	=============================================================================== */
		
}
?>