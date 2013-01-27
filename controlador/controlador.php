<?php
require $CORE_PATH.'modelo/Modelo.php';
class Controlador{
	
	function servir(){
		//existe la funcion, la ejecuta,
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
	
	function getModel(){		
		if ( !isset($this->modObj) ){						
			$this->modObj = new Modelo();	
		}	
		return $this->modObj;
	}		
}
?>