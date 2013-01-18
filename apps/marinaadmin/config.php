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
define ("TEMA",'rocket');
define ("NOMBRE_APL",'Marina Mvc');
define ("PASS_AES",'airA3s');
//define ("PATH_MVC",'../mvc/');
define ("DEFAULT_CONTROLLER",'admin');
define ("DEFAULT_ACTION",'index');
?>