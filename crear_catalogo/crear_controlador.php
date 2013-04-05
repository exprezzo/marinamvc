<?php
function crear_controlador($nombreControlador, $nombreModelo,$fields){
	global $_PETICION;
	$ruta='..//apps/'.$_PETICION->modulo.'/controladores/';	
	
	$fieldsStr='array(';
	for($i=0; $i<sizeof($fields); $i++ ){
		$fieldsStr.='\''.$fields[$i].'\',';
	}
	
	$fieldsStr=$sql=substr($fieldsStr, 0, strlen($fieldsStr)-1 );
	$fieldsStr.=')';
	
$contenido='<?php
require_once \'../apps/\'.$_PETICION->modulo.\'/modelos/'.$nombreModelo.'_modelo.php\';
class '.$nombreControlador.' extends Controlador{
	var $modelo="'.$nombreModelo.'";
	var $campos='.$fieldsStr.';
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]=\'\';
		}
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar(\'/\'.$_PETICION->controlador.\'/edicion\');
		
		
	}
	
	function guardar(){
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>';
	
	
	$rutaCompleta=$ruta.$nombreControlador.'.php';
	
	// if ( file_exists($rutaCompleta) ){
		// echo 'Ek archivo '.$rutaCompleta.' ya existe;<br/> ';
	// }else{
		// file_put_contents($rutaCompleta, $contenido);
		// if ( file_exists($rutaCompleta) ){
			// echo 'archivo creado: '.$rutaCompleta.' ;<br/> ';
		// }else{
			// echo 'el archivo no pudo crearse: '.$rutaCompleta.'<br/> ';
		// }		
	// }
	
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