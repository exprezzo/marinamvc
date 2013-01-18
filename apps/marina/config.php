<?php
//$APP_URL='http://'.$_SERVER['SERVER_NAME']; 

$DB_CONFIG=array(
	'DB_SERVER'	=>'localhost',
	'DB_NAME'	=>'airlines',
	'DB_USER'	=>'root',
	'DB_PASS'	=>''
);


if (!defined('APP_MODULE') ) define('APP_MODULE','marina'); 
	
// Configuracion del sitio
$_TEMA='rocket';
//define ("TEMA",'south-street');
define ("NOMBRE_APL",'Marina Mvc');
define ("PASS_AES",'airA3s');
define ("PATH_MVC",'../mvc/');
define ("DEFAULT_CONTROLLER",'paginas');
define ("DEFAULT_ACTION",'home');
?>