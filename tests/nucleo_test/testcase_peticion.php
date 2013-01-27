<?php
require_once '../peticion.php';
require_once 'PHPUnit.php';
class PeticionTestcase extends PHPUnit_TestCase{
	 
	 //==================================================================================
	 // constructor of the test suite
    function FCTestcase($name) {
       $this->PHPUnit_TestCase($name);
    }	
	//==================================================================================
	
	
	
	
	
	
	
	
	
	function testModuloControladorAccion1Param(){
		$modulo='modulo';
		$controlador="user";
		$accion="edit";		
		$param1=5;		
		$url='/'.$modulo."/".$controlador.'/'.$accion.'/'.$param1;
		$_SERVER['PATH_INFO'] = $url;
		$request=new Peticion();
		$this->assertTrue($controlador == $request->controlador && $accion == $request->accion && $request->modulo == $modulo && $param1 ==$request->params[0 ]);
	}
	function testModuloControladorAccion(){
		$modulo='elmodulo';
		$controlador="elcontrolador";
		$accion="laaccion";				
		$url='/'.$modulo."/".$controlador.'/'.$accion;
		$_SERVER['PATH_INFO'] = $url;
		$request=new Peticion();
		$this->assertTrue($controlador == $request->controlador && $accion == $request->accion && $request->modulo == $modulo);
	}
	function testControladorAccion(){
		$controlador="elcontrolador";
		$accion="laaccion";		
		$url="/".$controlador.'/'.$accion;
		$_SERVER['PATH_INFO'] = $url;
		$request=new Peticion();
		$this->assertTrue($controlador == $request->controlador && $accion == $request->accion && $request->modulo == DEFAULT_APP);
	}
	function testSoloAccion(){		
		$accion="elcontrolador";		
		$url="/".$accion;
		$_SERVER['PATH_INFO'] = $url;
		$request=new Peticion();		
		$this->assertTrue(DEFAULT_CONTROLLER == $request->controlador && $request->accion == $accion && $request->modulo == DEFAULT_APP);				
	}
	function testRaiz(){
		$url="";
		$_SERVER['PATH_INFO'] = $url;
		$request=new Peticion();
		$this->assertTrue(DEFAULT_CONTROLLER == $request->controlador && $request->accion == DEFAULT_ACTION && $request->modulo == DEFAULT_APP);
	}
	/*
	function testRutas(){
		// Y este que?
		//$this->assertTrue(false);
	}*/
}

?>