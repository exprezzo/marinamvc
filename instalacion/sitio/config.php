<?php
//$APP_URL='http://'.$_SERVER['SERVER_NAME']; 

if (!defined('DEFAULT_APP') ) define('DEFAULT_APP','tc');
if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','sistema');
if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index');
$_LOGIN_REDIRECT_PATH = '/'.DEFAULT_APP.'/'.DEFAULT_CONTROLLER.'/'.DEFAULT_ACTION;

?>