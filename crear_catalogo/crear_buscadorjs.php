<?php
function crear_buscadorjs($nombreControlador, $nombreModelo){
	global $_PETICION;
	$ruta='..//web/apps/'.$_PETICION->modulo.'/js/catalogos/'.$nombreControlador.'/';	
	
	if ( !file_exists($ruta) ){
		mkdir($ruta, 0700);
	}
	ob_start();
	include 'busqueda.js';	
	
	$out1 = ob_get_contents();
	ob_end_clean();
	
	
	
	
	
	$contenido=str_replace ('BusquedaNombreDelControlador','Busqueda'.$nombreControlador,$out1);
	
	$rutaCompleta=$ruta.'busqueda.js';	
	if ( file_exists($rutaCompleta) ){
		// echo 'El archivo '.$rutaCompleta.' ya existe;<br/> ';
		return array(
			'success'=>false,
			'msg'=>'El archivo '.$rutaCompleta.' ya existe;<br/> '
		);
	}else{
		file_put_contents($rutaCompleta, $contenido);
		if ( file_exists($rutaCompleta) ){
			// echo 'archivo creado: '.$rutaCompleta.' ;<br/> ';
			return array(
				'success'=>true,
				'msg'=>'archivo creado: '.$rutaCompleta.' ;<br/> '
			);
		}else{
			// echo 'el archivo no pudo crearse: '.$rutaCompleta.'<br/> ';
			return array(
				'success'=>false,
				'msg'=>'el archivo no pudo crearse: '.$rutaCompleta.'<br/> '
			);
		}
		
	}
	
}
?>