<?php
require $CORE_PATH.'modelo/Modelo.php';
class Controlador{
	var $modelo='Modelo';
	
	function servir(){
		//existe la funcion, la ejecuta,
		
		// checknivel( $_PETICION->controlador );
		
		global $_PETICION;
		$accion = $_PETICION->accion;
		if (method_exists($this, $accion )){
			$respuesta = $this->$accion();
			if ($respuesta==null){
				$respuesta=array(
					'success'=>true
				);
			}
		}else{
			// no existe? muestra la vista
			$respuesta = $this->mostrarVista();				
		}
		return $respuesta;
	}	
	function init(){
		return array('success'=>true);
	}
	function mostrarVista($vistaFile=''){		
		$vista= $this->getVista(); //El manejador de vistas		
		return $vista->mostrar( $vistaFile );
	}
	
	function getVista(){
		if ( !isset($this->vistaObj) ){
			global $CORE_PATH;
			require_once $CORE_PATH.'vista/vista.php';
			$this->vistaObj = new Vista();
		}
		return $this->vistaObj;
	}
	
	// function mostrarErrores($errores){
		// $vista		= $this->getVista();
		// $vista->errores	= $errores;
		// return $this->mostrarVista();
	// }			
	
	// function mostrarError($errores){
		// return $this->mostrarErrores($errores);		
	// }				
	
	function nuevo(){
		$vista=$this->getVista();				
		return $vista->mostrar('/'.$_PETICION->controlador.'/edicion');
	}
	function guardar(){
	}
	function borrar(){
	}
	function editar(){
		// header("Content-Type: text/html;charset=utf-8");
		
		$id=empty( $_REQUEST['id'])? 0 : $_REQUEST['id'];
		$model=$this->getModel();
		$params=array(
			'id'=>$id
		);		
		$obj=$model->obtener( $params );		
		$vista=$this->getVista();				
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		// print_r($obj);
	}
	
	function buscar(){
		$mod=$this->getModel();
				
		$paging=$_GET['paging']; //Datos de paginacion enviados por el componente js
		if ($paging['pageSize']<0) $paging['pageSize']=0;
		$params=array(	//Se traducen al lenguaje sql
			'limit'=>$pageSize=intval($paging['pageSize']),
			'start'=>intval($paging['pageIndex'])*$pageSize		
		);
		
		$res=$mod->paginar($params);				
		
		$respuesta=array(
			'rows'=>$res['datos'],
			'totalRows'=> $res['total']
		);
		echo json_encode($respuesta);
	}
	
	function getModel(){		
		if ( !isset($this->modObj) ){				
			$clase=$this->modelo.'Modelo';
			$this->modObj = new $clase();	
		}	
		return $this->modObj;
	}		
}
?>