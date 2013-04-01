<?php
function crear_modelo($nombreModelo, $tabla, $fields){
	$ruta='../apps/'.$_PETICION->modulo.'/modelos/';	
	
	$fieldsStr='array(';
	for($i=0; $i<sizeof($fields); $i++ ){
		$fieldsStr.='\''.$fields[$i].'\',';
	}
	
	$fieldsStr=$sql=substr($fieldsStr, 0, strlen($fieldsStr)-1 );
	$fieldsStr.=')';
	
$contenido='<?php
class '.$nombreModelo.'Modelo extends Modelo{
	var $tabla="'.$tabla.'";
	var $campos='.$fieldsStr.';
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		return parent::guardar($params);
	}
	function borrar($params){
		return parent::borrar($params);
	}
	function editar($params){
		return parent::obtener($params);
	}
	function buscar($params){
		return parent::buscar($params);
	}
}
?>';
	
	
	$rutaCompleta=$ruta.$nombreModelo.'_modelo.php';
	
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