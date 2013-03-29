<?php
require $CORE_PATH.'modelo/Modelo.php';
class Controlador{
	var $modelo='Modelo';
	var $campos=array('id');
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
	
	// function nuevo(){
		// $vista=$this->getVista();	
		// global $_PETICION;
		// return $vista->mostrar('/'.$_PETICION->controlador.'/edicion');
	// }
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
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
		
		if (!empty($_GET['paging']) ){
			$paging=$_GET['paging']; //Datos de paginacion enviados por el componente js
			if ($paging['pageSize']<0) $paging['pageSize']=0;
			$params=array(	//Se traducen al lenguaje sql
				'limit'=>$pageSize=intval($paging['pageSize']),
				'start'=>intval($paging['pageIndex'])*$pageSize		
			);
		}else{
			$params=array(	);
		}
		
		
		$res=$mod->buscar($params);				
		
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
	

	function guardar(){
		
		
		if ( empty($_POST['datos']) ){
			$res=array(
				'success'=>false,
				'msg'=>'No se recibieron datos para almacenar'
			);
			echo json_encode($res); exit;
		}
		$datos= $_POST['datos'];
		
		$model=$this->getModel();				
		$res = $model->guardar($datos);
		
		if (!$res['success']) {			
			echo json_encode($res); exit;
		}
		// $pk=$res['datos']['id'];
		
		$datos=$res['datos'];
		
		//----------------
		
		$res['datos']=$datos;		
		echo json_encode($res);
		return $res;
	}
	function paginar(){
		return $this->buscar();
	}
	function eliminar(){
		$modObj= $this->getModel();
		$params=array();
		
		if ( !isset($_POST['id']) ){
			$id=$_POST['datos'];
		}else{
			$id=$_POST['id'];
		}
		$params['id']=$id;
		
		$res=$modObj->borrar($params);
		
		$response=array(
			'success'=>$res,
			'msg'=>'Registro Eliminado'
		);
		echo json_encode($response);
		exit;
	}
}
?>