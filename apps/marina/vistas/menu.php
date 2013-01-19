<?php
	//Este bloque es creado para resaltar el menu de la pagina activa
	$idMenu_destinos='';
	$idMenu_index='';
	$idMenu_nosotros='';
	$idMenu_contacto='';
	 global $_PETICION;
	$menus=array();
	$menus[]=array(
		'idMenu'=>'menuHome',
		'estado'=>'',
		'text'=>'Home',
		'url'=>'/'.$_PETICION->modulo.'/paginas/home'
	);
	$menus[]=array(
		'idMenu'=>'menuProyectos',
		'estado'=>'',
		'text'=>'Proyectos',
		'url'=>'/'.$_PETICION->modulo.'/paginas/proyectos'
	);
	$menus[]=array(
		'idMenu'=>'menuNews',
		'estado'=>'',
		'text'=>'News',
		'url'=>'/'.$_PETICION->modulo.'/paginas/news'
	);
	$menus[]=array(
		'idMenu'=>'menuAbout',
		'estado'=>'',
		'text'=>'About Us',
		'url'=>'/'.$_PETICION->modulo.'/paginas/about_us'
	);
	
	
	$menus[]=array(
		'idMenu'=>'menuGuias',
		'estado'=>'',
		'text'=>'Guias',
		'url'=>'/'.$_PETICION->modulo.'/paginas/guias'
	);
	$menus[]=array(
		'idMenu'=>'menuApi',
		'estado'=>'',
		'text'=>'api',
		'url'=>'/'.$_PETICION->modulo.'/paginas/api'
	);
	$menus[]=array(
		'idMenu'=>'menuContac',
		'estado'=>'',
		'text'=>'Contact',
		'url'=>'/'.$_PETICION->modulo.'/paginas/contact'
	);
	

	
	
	$raiz= empty($_PETICION->modulo)? '/' : '/'.$_PETICION->modulo.'/';
	
	for($i=0; $i<sizeof($menus); $i++ ){
		if ( $raiz.$_PETICION->controlador.'/'.$_PETICION->accion == $menus[$i]['url'] ){
			$menus[$i]['estado']='ui-state-active';
		}
	}	
?>
<style>
	
</style>
<script>
	$(function(){
		$('#menu_principal li').mouseenter(function(){
			$(this).addClass('ui-state-hover');
		});			
		$('#menu_principal li').mouseleave(function(){
			$(this).removeClass('ui-state-hover');
		});
		
		
	});
</script>
	
	<ul  class="ui-widget">	
		<?php
		for($i=0; $i<sizeof($menus); $i++){
			echo '<li '.$menus[$i]['idMenu'].' class="ui-state-default '.$menus[$i]['estado'].'"><a href="'.$menus[$i]['url'].'">'.$menus[$i]['text'].'</a></li>';
		}
		?>
	</ul>
