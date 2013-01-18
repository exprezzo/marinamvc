<?php
class VueloModel extends Modelo_PDO{
	var $tabla='vuelos';	
	
	function guardar( $params ){
		$dbh=$this->getConexion();
		
		$id=$params['id'];
		$fecha=$params['fecha'];
		$costo=$params['costo'];
		$numVuelo=$params['numVuelo'];
		//$asientos_disponibles=empty($params['asientos_disponibles'])? 0 : $params['asientos_disponibles'];
		$fk_origen=$params['fk_origen'];
		$fk_destino=$params['fk_destino'];		
		
		if ( empty($id) ){
			//           CREAR
			$sql='INSERT INTO '.$this->tabla.' SET 
			fecha=:fecha,
			 costo=:costo,
			 numVuelo=:numVuelo,			
			 fk_origen=:fk_origen,
			 fk_destino=:fk_destino';			
			$sth = $dbh->prepare($sql);							
			
			$sth->bindValue(":fecha",$fecha,PDO::PARAM_STR);					
			$sth->bindValue(":costo",$costo,PDO::PARAM_INT);					
			$sth->bindValue(":numVuelo",$numVuelo,PDO::PARAM_STR);					
			//$sth->bindValue(":asientos_disponibles",$asientos_disponibles,PDO::PARAM_INT);					
			$sth->bindValue(":fk_origen",$fk_origen,PDO::PARAM_INT);					
			$sth->bindValue(":fk_destino",$fk_destino,PDO::PARAM_INT);					
			$exito = $sth->execute();
			$id=$dbh->lastInsertId();
		}else{
			//	         ACTUALIZAR
			$sql='UPDATE '.$this->tabla.' SET 
			fecha=:fecha,
			 costo=:costo,			 			
			 fk_origen=:fk_origen,
			 fk_destino=:fk_destino WHERE id=:id';			
			$sth = $dbh->prepare($sql);										
			$sth->bindValue(":fecha",$fecha,PDO::PARAM_STR);
			$sth->bindValue(":costo",$costo,PDO::PARAM_INT);					
			//$sth->bindValue(":numVuelo",$numVuelo,PDO::PARAM_INT);					
			//$sth->bindValue(":asientos_disponibles",$asientos_disponibles,PDO::PARAM_INT);					
			$sth->bindValue(":fk_origen",$fk_origen,PDO::PARAM_INT);					
			$sth->bindValue(":fk_destino",$fk_destino,PDO::PARAM_INT);			
			$sth->bindValue(":id",$id,PDO::PARAM_INT);					
			$exito = $sth->execute();

		}
			
		
		
		if ($exito!==true){
		// error en la consulta				
			$error=$sth->errorInfo();
			$resp=array(
				'success'=>false,
				'msg'=>$error[2]
			);
			return $resp; 
		}
		
		
		$mod=$this->obtener( array('id'=>$id) );
		$resp=array(
			'success'=>true,
			'msg'=>'Vuelo guardado',
			'datos'=>$mod['datos'][0]			
		);
		return $resp; 
		
	}
	
	function obtener($params){		
		//return parent::obtener($params);
		$id=$params['id'];
		
		$sql = 'SELECT v.id,o.nombre as origen, d.nombre as destino, v.fecha,v.costo,v.numVuelo, v.asientos_disponibles,fk_origen,fk_destino,fecha as  hora
		FROM '.$this->tabla.' v 
		left join destinos o ON o.id=v.fk_origen
		left join destinos d ON d.id=v.fk_destino WHERE v.id=:id';
		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);
		$sth->bindValue(':id',$id);
		$sth->execute();
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		$exito = $sth->execute();
		
		if ( sizeof($modelos) > 1 ){
			throw new Exception("El identificador est?uplicado"); 
		}
		
		if ($exito!==true){
		// error en la consulta				
			$error=$sth->errorInfo();
			$resp=array(
				'success'=>false,
				'msg'=>$error[2]
			);
			return $resp; 
		}
		
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return array(
			'success'=>true,			
			'datos' =>$res
		);			
	}
	
	function paginar($start=0, $pageSize=9){
		$sql='select COUNT(id) as total FROM vuelos';
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$datos=$model->execute($sth);
		
		$total=$datos['datos'][0]['total'];		
		$sql='SELECT v.id,o.nombre as origen, d.nombre as destino, v.fecha,v.costo,v.numVuelo, v.asientos_disponibles From vuelos v
left join destinos o ON o.id=v.fk_origen
left join destinos d ON d.id=v.fk_destino LIMIT :start,:limit';		
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':start',$start, PDO::PARAM_INT);		
		$sth->bindValue(':limit',$pageSize, PDO::PARAM_INT);		
		$datos=$model->execute($sth);
		
		return array(
			'totalRows'=>$total,
			'rows'=>$datos['datos']
		);
	}
}
?>