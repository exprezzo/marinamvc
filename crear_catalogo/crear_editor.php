<?php
function crear_editor($params){
	
	$nombreModelo=$params['modelo'];
	$nombreControlador=$params['controlador'];
	$campos=$params['fields'];
	
	global $_PETICION;
	// $ruta='../'.$_PETICION->modulo.'/vistas/'.$nombreControlador.'/';	
	$ruta='../'.$params['ruta_base'].$params['modulo'].'/vistas/'.$nombreControlador.'/';	
	if ( !file_exists($ruta) ){
		mkdir($ruta, 0700, true);
	}
	
	$divs='';
	for($i=0; $i<sizeof($campos); $i++ ){
		
		$divs.=
		'<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">'.$campos[$i].':</label>
			<input type="text" name="'.$campos[$i].'" class="txt_'.$campos[$i].'" value="<?php echo $this->datos[\''.$campos[$i].'\']; ?>" style="width:500px;" />
		</div>';
	}
$contenido='
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

<script>			
	$( function(){		
		var config={
			tab:{
				id:\'<?php echo $_REQUEST[\'tabId\']; ?>\'
			},
			controlador:{
				nombre:\'<?php echo $_PETICION->controlador; ?>\'
			},
			modulo:{
				nombre:\'<?php echo $_PETICION->modulo; ?>\'
			},
			catalogo:{
				nombre:\''. $nombreModelo.'\'
			},			
			pk:"'.$params['pk_tabla'].'"
			
		};				
		 var editor=new Edicion'. $nombreControlador.'();
		 editor.init(config);		
	});
</script>

	<div class="pnlIzq">
		<?php 	
			global $_PETICION;
			$this->mostrar(\'/backend/componentes/toolbar\');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">				
			'.$divs.'
		</form>
	</div>
</div>
';
	
	
	$rutaCompleta=$ruta.'edicion.php';	
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