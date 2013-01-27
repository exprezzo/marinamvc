<?php
require_once 'peticion.php';
require_once 'controlador/controlador.php';
require_once 'vista/vista.php';
class Despachador{
	var $_peticion;
	
	function despacharPeticion($peticion=null){
		global $_PETICION;		
						
		$msgExito = 'petición servida con éxito';
		$msgFalla = 'La petición no puede servirse';
		
		
		$accion=$_PETICION->accion;
		
		$ejecutar=false;
		
		//Dependiendo del analisis de la peticion, el sistema tratara de responder a la peticion con una de las siguientes maneras.
		
		// 1.- Cargar una vista.
		// 2.- Ejecutar una accion de un controlador.
		// 3.- Ejecutar una accion de un controlador de modulo.		
		$controller=new $_PETICION->controlador;
		//  Aqui se decide entre ejecutar accion o cargar vista
		$respuesta = $controller->servir();
		
		
		
		
		//------------------------------------
		//En caso de no recibir mensaje se establece uno por default
		if ( $respuesta['success'] == true ){			
			if ($respuesta['msg'] == null )	$respuesta['msg'] = $msgExito;			
		}else{			
			if ($respuesta['msg'] == null )	$respuesta['msg'] = $msgFalla;
		}
		return $respuesta;						
	}
	
}
?>