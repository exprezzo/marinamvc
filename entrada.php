<?php	
	
	//  AQUI INICIA EL PROCESO
	session_start();	
	ini_set('date.timezone', 'America/Mazatlan');
	
	require_once '../config.php';		
	
	
	$_DEFAULT_APP='paginas';
	
	if (!isset($_DEFAULT_CONTROLLER) ) $_DEFAULT_CONTROLLER='paginas';
	if (!isset($_DEFAULT_ACTION) ) $_DEFAULT_ACTION='inicio';
	
	// $DEFAULT_APP=$APP_CONFIG['nombre'];
	
	
	if (!isset($_LOGIN_REDIRECT_PATH) )  $_LOGIN_REDIRECT_PATH= '/'.$_DEFAULT_APP.'/'.$_DEFAULT_CONTROLLER.'/'.$_DEFAULT_ACTION;
	
	$APPS_PATH='../';
	if (!isset($CORE_PATH)) $CORE_PATH='';
	require_once $CORE_PATH.'despachador.php';		
	
	// if (!defined('DEFAULT_APP') ) define('DEFAULT_APP','portal');
	// if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','paginas');
	// if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index');
	
	// if (!defined('DEFAULT_MODULE') ) define('DEFAULT_MODULE','default'); 
	// if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','paginas'); 
	// if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index'); 
	
	
	// define ("VISTAS_PATH",		 PATH_MVC.'vistas/');
	// define ("PATH_CONTROLADORES",PATH_MVC.'controladores/');

	$despachador = new Despachador();
	// $_PETICION=new Peticion(); //Analiza el url
	// $despachador->despachar();
	
	try{		
		$_PETICION=new Peticion(); //Analiza el url
	//	print_r($_PETICION); 
		$configPath=$APPS_PATH.$_PETICION->modulo.'/config.php';
		if ( !file_exists($configPath) ){
			// echo $configPath;exit;
			header("HTTP/1.0 404 Not Found".'El recurso no existe');
			exit;
		}
		require_once $APPS_PATH.$_PETICION->modulo.'/config.php';	
		
		// $APPS_PATH='../'.$APPS_PATH.'apps/';
		// require_once $APPS_PATH.$_PETICION->modulo.'/config.php';	
		
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
			header("HTTP/1.0 404 Not Found".'El controlador '.$_PETICION->controlador.' no existe');
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
