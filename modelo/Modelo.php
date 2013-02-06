<?php
require_once $CORE_PATH.'i_crud.php';
require_once $CORE_PATH.'database.php';

class Modelo implements ICrud{								
	var $pk='id';

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
				
		$sql = 'SELECT COUNT(id ) as total FROM '.$this->tabla.$filtros;		
		
		
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
		
		$id=$params[$this->pk];
				
		$sql = 'SELECT * FROM '.$this->tabla.' WHERE '.$this->pk.'=:id';		
		
		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':id',$id);		
		$sth->execute();
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if ( empty($modelos) ){
			//throw new Exception(); //TODO: agregar numero de error, crear una exception MiEscepcion
			return array();
		}
		
		if ( sizeof($modelos) > 1 ){
			throw new Exception("El identificador est� duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		return $modelos[0];			
	}
	
	function guardar( $params ){
		$dbh=$this->getConexion();
		
		$id=$params['id'];
		$nombre=$params['nombre'];
		
		if ( empty($id) ){
			//           CREAR
			$sql='INSERT INTO '.$this->tabla.' SET nombre=:nombre, fecha_de_creacion= now()';
			$sth = $dbh->prepare($sql);							
			$sth->bindValue(":nombre",$nombre,PDO::PARAM_STR);					
		}else{
			//	         ACTUALIZAR
			$sql='UPDATE '.$this->tabla.' SET nombre=:nombre WHERE id=:id, fecha_de_actualizacion=now()';
			$sth = $dbh->prepare($sql);							
			$sth->bindValue(":id",$id,PDO::PARAM_INT);			
			$sth->bindValue(":nombre",$nombre,PDO::PARAM_STR);
		}
		$success = $sth->execute();
		
		$msg='';
		if ($success != true){
			$error=$sth->errorInfo();			
			$success=false; //plionasmo aprop�sito
			$msg=$error[2];						
			$datos=array();
		}else{
			$success = rowCount();			
		}
		
		return array(
			'success'	=>$success,			
			'datos' 	=>$datos,
			'msg'		=>$msg
		);	
				
	}
		
	function borrar( $params ){
		if ( empty($params['id']) ){
			throw new Exeption("Es necesario el par�metro 'id'");
		};		
		$id=$params['id'];
		$sql = 'DELETE FROM '.$this->tabla.' WHERE id=:id';		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':id',$id,PDO::PARAM_INT);
		
		$exito = $sth->execute();					
		
		return $exito;	
	}
	
	function paginar($params){
		$con = $this->getConexion();
		
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla;
		$sth = $con->query($sql); // Simple, but has several drawbacks		
		$tot = $sth->fetchAll(PDO::FETCH_ASSOC);
		$total = $tot[0]['total'];
		
		$limit=$params['limit'];
		$start=$params['start'];		
		$sql = 'SELECT * FROM '.$this->tabla.' limit 0,:limit';
		
		$sth = $con->prepare($sql);
		$sth->bindValue(':limit',$limit,PDO::PARAM_INT);
		//$sth->bindValue(':start',$start,PDO::PARAM_STR);
		$exito = $sth->execute();

		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);				
		if ( !$exito ){
			throw new Exception("Error listando: ".$sql); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
							
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