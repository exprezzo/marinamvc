<?php
class  Vista{		
	var $errores=array();
	var $valores=array();
		
	function cargarJs($ruta){
		global $_PETICION;
		echo '<script src="/web/apps/'.$_PETICION->modulo.'/'.$ruta.'" type="text/javascript"></script>';		
	}
	
	
	function cargarDesdeRuta($ruta){
		global $_PETICION;
		global $APPS_PATH;
		global $APP_CONFIG;
		global $REDIRECT_URL;
		$vista_existe = ( file_exists($ruta) ) ? true : false;
		
		if ($vista_existe) {
			//$this->antesdeMostrar($vista);
			require_once($ruta);
			//$this->despuesdeMostrar($vista);
			$success=true;
			$msg='accion render ejecutada con éxito';
		}else{
			
			$success=false;
			$msg='El recurso no ha sido encontrado: '.$ruta;			
			header("HTTP/1.0 404".$msg);
		}
		
		return array(
			'success'=>$success,
			'msg'=>$msg
		);
	}
	
	function mostrar($vista=''){
		global $_PETICION;
		global $APPS_PATH;
		global $APP_CONFIG;
		global $REDIRECT_URL;
		
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