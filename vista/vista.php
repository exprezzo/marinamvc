<?php
class  Vista{		
	var $errores=array();
	var $valores=array();
	
	//TOD: Documentar estas dos funciones.
	// function mostrarError($campo){
		// if ( !empty($this->errores[$campo]) ){
			// echo $this->errores[$campo];
		// }
	// } 
	
	// function mostrarValor($campo){
		// if ( !empty($this->valores[$campo]) ){
			// echo $this->valores[$campo];
		// }
	// }
	
	//abre un archivo php, a partir de  $APPS_PATH.$_PETICION->modulo.'/vistas/'	
	function getRutaBase(){
		global $_PETICION;
		return '/web/apps/'.$_PETICION->modulo.'/';
	}
	
	function cargarJs($ruta){
		global $_PETICION;
		echo '<script src="/web/apps/'.$_PETICION->modulo.'/'.$ruta.'" type="text/javascript"></script>';		
	}
	
	function mostrar($vista=''){
		global $_PETICION;
		global $APPS_PATH;
		if ( empty($vista) ){
			$controlador=$_PETICION->controlador;
			$controlador.= !empty($_PETICION->controlador)?  '/' : '';
			$vista=$controlador.$_PETICION->accion;
		}
		$rutaVista=$APPS_PATH.$_PETICION->modulo.'/vistas/'.$vista.'.php';
		$vista_existe = ( file_exists($rutaVista) ) ? true : false;
		
		if ($vista_existe) {
			//$this->antesdeMostrar($vista);
			require_once($rutaVista);
			//$this->despuesdeMostrar($vista);
			$success=true;
			$msg='accion render ejecutada con éxito';
		}else{
			$success=false;
			$msg='El recurso no ha sido encontrado: '.$_PETICION->modulo.'/'.$_PETICION->controlador.'/'.$_PETICION->accion;
			//echo $msg;
			//header("HTTP/1.0 404".$msg);
		}
		
		return array(
			'success'=>$success,
			'msg'=>$msg
		);
	}
			
	
	function render(){	
		return $this->mostrar();
	} 
	
	function setRutaContenido($rutaContenido){
		$this->rutaContenido=$rutaContenido;
	}
}
?>