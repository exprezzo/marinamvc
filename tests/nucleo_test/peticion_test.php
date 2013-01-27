<?php

require_once 'testcase_peticion.php';
require_once 'PHPUnit.php';

if (!defined('DEFAULT_APP') ) define('DEFAULT_APP','TESTS');
if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','paginas');
if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index');

$suite  = new PHPUnit_TestSuite("PeticionTestcase");
$phpunit= new PHPUnit();
$result = $phpunit->run($suite);
echo $result -> toString();

?>