<?php
include 'controlador/user_controller.php';
Class User extends UserController{
	function mostrarVista($vistaFile=''){				
		$vista= $this->getVista();					
		return $vista->mostrar( '/index' );
	}
}
?>