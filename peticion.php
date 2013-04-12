<?php
class Peticion{
	function Peticion( $url ){
		// Ruta relativa    http://localhost/lego_mvc/controlador/vista?foo=bar
		//  [PATH_INFO] => /controlador/vista
		
		// Ruta Absoluta    http://lego/controlador/vista?foo=bar 
		//  [PATH_INFO] => /controlador/vista		
		
		//-------------------------------------------------------------------------------
		$arrAppPath = explode('/',$_SERVER['SCRIPT_NAME']) ;		
		//no nos interesa el primero ni los ultimos dos
		$app_path='/';		
		
		$arrCount=sizeof($arrAppPath);
		for( $i=1;  $i<$arrCount-2; $i++ ){		
			$app_path.=''.$arrAppPath[$i].'/';			
		}
		
		global $APP_CONFIG;		
		$APP_CONFIG['url_base_path']=$app_path;				
		//-------------------------------------------------------------------------------

		
		$xp = explode( '/', $url);
		$size=sizeof($xp);
		$modulo='';
		global $_DEFAULT_APP,$_DEFAULT_CONTROLLER,$_DEFAULT_ACTION;
		switch($size){
			case 1:		//  raiz (modulo y controlador y accion por default)
				@include '../config.php';
				$modulo		=$_DEFAULT_APP;
				$controlador=$_DEFAULT_CONTROLLER;
				$accion=$_DEFAULT_ACTION;
			break;
			case 2:	// solo escribió un parametro, la accion (modulo y controlador default)
				@include '../config.php';
				$modulo		=$_DEFAULT_APP;
				$controlador=$_DEFAULT_CONTROLLER;
				$accion		=$xp[1];
			break;			
			case 3:	// escribió el controlador y la accion, (modulo default)
				@include '../config.php';
				$modulo		=$_DEFAULT_APP;
				$controlador=$xp[1];
				
				$accion		=$xp[2];
			break;
			case 4:	// escribió el modulo, controlador y la accion
				$modulo		=$xp[1];
				$controlador=$xp[2];
				$accion		=$xp[3];				
			break;			
			default:
				$modulo		=$xp[1];
				$controlador=$xp[2];
				$accion		=$xp[3];				
				$params=array();
				$params[]=$xp[4];
				$this->params=$params;
				//throw new Exception($url. " No reconocida" );
				//header("HTTP/1.0 404 ".$url. " No reconocida");
				// escribió algo incomprensible, en este caso deberia lanzar una pagina de error
		}
		
		$this->controlador = $controlador;
		$this->accion 	   = $accion;		
		$this->modulo 	   = $modulo;				
	}
}
?>