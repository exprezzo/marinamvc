<?php
$CORE_PATH='../';
$APPS_PATH='nucleo_test/';
require_once $CORE_PATH.'controlador/controlador.php';
require_once $CORE_PATH.'peticion.php';
require_once 'PHPUnit.php';
class ControladorTestcase extends PHPUnit_TestCase{
	 
	 //==================================================================================
	 // constructor of the test suite
    /*function FCTestcase($name) {
       $this->PHPUnit_TestCase($name);
    }*/
	
	// override sobre PHPUnit_TestCase 
	// called before the test functions
    function setUp() {
		// if (!defined("PATH_NUCLEO") ) define ("PATH_NUCLEO",'../mvc_core/');
		// if (!defined('VISTAS_PATH') ) define ('VISTAS_PATH','nucleo_test/');
		if (!defined('DEFAULT_APP') ) define('DEFAULT_APP','app_test');
		if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','controladortest');
		if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index');
		$_SERVER['PATH_INFO']="";
		
		global $_PETICION;
		$_PETICION=new Peticion();
    }
   
	//==================================================================================
	function testGetVista(){
		$controlador = new Controlador();
		$vista=$controlador->getVista();		
		$this->assertTrue($vista instanceof Vista);
	}	
	
	function testGetModel(){
		$controlador = new Controlador();
		$model=$controlador->getModel();				
		$this->assertTrue($model instanceof Modelo);
	}
	function testMostrarVistaDefault(){
		$controlador = new Controlador();
		$res=$controlador->mostrarVista();		
		$this->assertTrue( $res['success']==true );
	}
	
	function testMostrarVista(){
		$controlador = new Controlador();
		$res=$controlador->mostrarVista('layout');		
		$this->assertTrue( $res['success']==true );
	}
	
	function testServirAccion(){
		global $_PETICION;
		$_PETICION->accion='init';
		$controlador = new Controlador();
		$res=$controlador->servir();		
		$this->assertTrue( $res['success']==true );
	}
	
	function testServirError(){
		global $_PETICION;
		$_PETICION->accion='accionTestFail';
		
		$controlador = new Controlador();
		$res=$controlador->servir();		
		$this->assertTrue( $res['success']==false );
	}
	
	function testServirVista(){
		$controlador = new Controlador();
		global $_PETICION;
		$_PETICION->accion='index2';		
		$res=$controlador->servir();		
		$this->assertTrue( $res['success']==true );
	}
	
	// function testProcesarPeticion(){
		// global $CORE_PATH;
		// require_once($CORE_PATH.'peticion.php');
		
		// $peticion=new Peticion();
		// $peticion->controlador='Controlador';
		// $peticion->accion='index_test';
		// $controlador = new Controlador();
		// ob_start();
		// $resp=$controlador->procesarPeticion($peticion);
		// ob_end_clean();
		// $this->assertTrue($resp['success']);
	// }
	

	
	
}
?>