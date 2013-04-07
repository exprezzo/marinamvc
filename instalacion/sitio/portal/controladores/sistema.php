<?php
class Sistema extends Controlador{
	function index($vistaFile=''){						
		$vista= $this->getVista();					
		
		// $catMod = new CatalogoModelo();		
		
		// $params=array(
			// 'start'=>0,
			// 'limit'=>1000
		// );
		// $res=$catMod->buscar( $params );		
		// $vista->catalogos=$res['datos'];
		
		$vista->catalogos=array();
		
		return $vista->mostrar( '/index' );
	}
}
?>