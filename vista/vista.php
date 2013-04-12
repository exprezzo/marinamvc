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
	
	
	function cargarVista($peticion){
		$modulo=$peticion->modulo;
		//busca al modulo en raiz, si no lo encuentra, lo busca en la carpeta modulos/
		// if (fi)
		//si no lo encuentra, aqui termina el asunto con un mensaje de error
		//busca el archivo iniciando en la raiz del modulo /vistas/$controlador/$accion.php
		
	}
	function mostrar($vista=''){
		global $_PETICION;
		global $APPS_PATH;
		global $APP_CONFIG;
		global $REDIRECT_URL;
		global $MOD_WEB_PATH;
		
		if ( empty($vista) ){
			$controlador=$_PETICION->controlador;
			$controlador.= !empty($_PETICION->controlador)?  '/' : '';
			$vista=$controlador.$_PETICION->accion;
			
			$modulo=$_PETICION->modulo;
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
			$msg='El recurso no ha sido encontrado: '.$rutaVista;
			
			echo $msg; exit;
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