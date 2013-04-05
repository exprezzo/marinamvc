<?php
function crear_editorjs($nombreControlador, $nombreModelo){
	global $_PETICION;
	$ruta='..//web/apps/'.$_PETICION->modulo.'/js/catalogos/'.$nombreControlador.'/';	
	
	
	ob_start();
	include 'edicion.js';	
	
	$out1 = ob_get_contents();
	ob_end_clean();
	
	$contenido=str_replace ('EdicionNombreDelControlador','Edicion'.$nombreControlador,$out1);
	
	$rutaCompleta=$ruta.'edicion.js';	
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