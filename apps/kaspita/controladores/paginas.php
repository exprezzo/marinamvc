<?php 
class Paginas extends Controlador{
	function mostrarVista($vistaFile=''){				
		$vista= $this->getVista();					
		return $vista->mostrar( '/index' );
	}
}	
?>