<?php		
	//  AQUI INICIA EL PROCESO
	session_start();	
	//-------------------------------------------------------------------------------
	/* INIT -> Se configuran las variables del framework
	$_Peticion: La interpretacion del url se almacena en esta variable, el url trata de convertirse en Modulo, controlador y accion.
	
	
	*/
	ini_set('date.timezone', 'America/Mazatlan');
	
	//carga el archivo de configuracion por default
	require_once '../config.php';		
	
	$_DEFAULT_APP='portal';	
	if (!isset($_DEFAULT_CONTROLLER) ) $_DEFAULT_CONTROLLER='paginas';
	if (!isset($_DEFAULT_ACTION) ) $_DEFAULT_ACTION='inicio';		
	
	$APPS_PATH='../';
	if (!isset($CORE_PATH)) $CORE_PATH='';
	require_once $CORE_PATH.'despachador.php';		
		
	
	// para cargar los archivos css y otros recursos, usamos esta ruta como base 
	$arrAppPath = explode('/',$_SERVER['SCRIPT_NAME']) ;				
	$app_path='/';			


	$arrCount=sizeof($arrAppPath);
	for( $i=1;  $i<$arrCount-2; $i++ ){		//no nos interesa el primero ni los ultimos dos
		$app_path.=''.$arrAppPath[$i].'/';			
	}	

	$_APP_PATH = $app_path;
	$APP_PATH = $app_path;
	$APP_CONFIG['WEB_BASE']=$app_path.'web/';
	
	$APP_URL_BASE=$app_path;
	
	$APP_CONFIG['MOD_WEB_BASE']=$app_path.'web/';
	//-------------------------------------------------------------------------------		
	$despachador = new Despachador();	
	
	try{		
		if ( isset($_SERVER['ORIG_PATH_INFO']) ){
			$_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
		}		
		$_PETICION=new Peticion( $_SERVER['PATH_INFO'] ); //Analiza el url

		
		$_LOGIN_REDIRECT_PATH= (!isset($_LOGIN_REDIRECT_PATH) )?   $APP_URL_BASE.$_PETICION->modulo.'/'.$_DEFAULT_CONTROLLER.'/'.$_DEFAULT_ACTION :$APP_URL_BASE.$_LOGIN_REDIRECT_PATH;
		
		$WEB_BASE=$app_path.'web/';
		$MOD_WEB_PATH=$WEB_BASE.$_PETICION->modulo.'/';					
		
		if ( !file_exists($APPS_PATH.$_PETICION->modulo) ){
			$APPS_PATH='../modulos/';			
			$MOD_WEB_PATH=$WEB_BASE.'modulos/'.$_PETICION->modulo.'/';			
			
			
			
			if ( file_exists($APPS_PATH.$_PETICION->modulo) ){
			}
			
		}
		
		$configPath=$APPS_PATH.$_PETICION->modulo.'/config.php';
		if ( !file_exists($configPath) ){
			// echo $configPath;exit;
			// header("HTTP/1.0 404 Not Found".' El recurso no existe '.$configPath);
			// exit;
		}else{
			require_once $APPS_PATH.$_PETICION->modulo.'/config.php';	
		}
		
		if ( !empty($_PETICION->modulo) ){
			$rutaControlador=$APPS_PATH.$_PETICION->modulo.'/controladores/'.$_PETICION->controlador.'.php';			
			$_PETICION->basePath=$APPS_PATH.$_PETICION->modulo.'/';
		}
						
		if ( file_exists($rutaControlador) ){
			require_once ($rutaControlador);
		}else{
			$respuesta=array(
				'success'=>false,
				'msg'	 =>'El controlador '.$_PETICION->controlador.' no existe',
			);				
			header("HTTP/1.0 404 Not Found".'El controlador '.$_PETICION->controlador.' no existe'.$rutaControlador);
		}
				
		$despachador->despacharPeticion($_PETICION);
	}catch(Exception $e){
		//echo 'Ups. <br>';
		echo 'Exception: '.$e->getMessage();
		//echo "El sistema ha sufrido un fallo, consulte con el administrador del sistema";
		//PENDIENTE: registrar la exception   -------		
	}
	
function getUrlTema($tema){
	$_TEMAS=array();
	$_TEMAS['artic']="http://cdn.wijmo.com/themes/arctic/jquery-wijmo.css";
	$_TEMAS['midnight']="http://cdn.wijmo.com/themes/midnight/jquery-wijmo.css";
	$_TEMAS['aristo']="http://cdn.wijmo.com/themes/aristo/jquery-wijmo.css";
	$_TEMAS['rocket']="http://cdn.wijmo.com/themes/rocket/jquery-wijmo.css";
	$_TEMAS['cobalt']="http://cdn.wijmo.com/themes/cobalt/jquery-wijmo.css";
	$_TEMAS['sterling']="http://cdn.wijmo.com/themes/sterling/jquery-wijmo.css";
	$_TEMAS['black-tie']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/black-tie/jquery-ui.css";
	$_TEMAS['blitzer']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/blitzer/jquery-ui.css";
	$_TEMAS['cupertino']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/cupertino/jquery-ui.css";
	$_TEMAS['dark-hive']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/dark-hive/jquery-ui.css";
	$_TEMAS['dot-luv']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/dot-luv/jquery-ui.css";
	$_TEMAS['eggplant']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/eggplant/jquery-ui.css";
	$_TEMAS['excite-bike']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/excite-bike/jquery-ui.css";
	$_TEMAS['flick']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/flick/jquery-ui.css";
	$_TEMAS['hot-sneaks']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/hot-sneaks/jquery-ui.css";
	$_TEMAS['humanity']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/humanity/jquery-ui.css";
	$_TEMAS['le-frog']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/le-frog/jquery-ui.css";
	$_TEMAS['mint-choc']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/mint-choc/jquery-ui.css";
	$_TEMAS['vader']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/vader/jquery-ui.css";
	$_TEMAS['ui-lightness']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/ui-lightness/jquery-ui.css";
	$_TEMAS['ui-darkness']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/ui-darkness/jquery-ui.css";
	$_TEMAS['trontastic']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/trontastic/jquery-ui.css";
	$_TEMAS['swanky-purse']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/swanky-purse/jquery-ui.css";
	$_TEMAS['sunny']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/sunny/jquery-ui.css";
	$_TEMAS['start']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/start/jquery-ui.css";
	$_TEMAS['south-street']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/south-street/jquery-ui.css";
	$_TEMAS['smoothness']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/smoothness/jquery-ui.css";
	$_TEMAS['redmond']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/redmond/jquery-ui.css";
	$_TEMAS['pepper-grinder']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/pepper-grinder/jquery-ui.css";
	$_TEMAS['overcast']="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/overcast/jquery-ui.css";
	return $_TEMAS[$tema];
}
?>
