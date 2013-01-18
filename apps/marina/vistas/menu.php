<?php
	//Este bloque es creado para resaltar el menu de la pagina activa
	$idMenu_destinos='';
	$idMenu_index='';
	$idMenu_nosotros='';
	$idMenu_contacto='';
	 
	$menus=array();
	$menus[]=array(
		'idMenu'=>'menuHome',
		'estado'=>'',
		'text'=>'Home',
		'url'=>'/'.APP_MODULE.'/paginas/home'
	);
	$menus[]=array(
		'idMenu'=>'menuAbout',
		'estado'=>'',
		'text'=>'About Us',
		'url'=>'/'.APP_MODULE.'/paginas/about_us'
	);
	$menus[]=array(
		'idMenu'=>'menuNews',
		'estado'=>'',
		'text'=>'News',
		'url'=>'/'.APP_MODULE.'/paginas/news'
	);
	$menus[]=array(
		'idMenu'=>'menuGallery',
		'estado'=>'',
		'text'=>'Gallery',
		'url'=>'/'.APP_MODULE.'/paginas/gallery'
	);
	$menus[]=array(
		'idMenu'=>'menuVideoGallery',
		'estado'=>'',
		'text'=>'Video Gallery',
		'url'=>'/'.APP_MODULE.'/paginas/video_gallery'
	);
	$menus[]=array(
		'idMenu'=>'menuContac',
		'estado'=>'',
		'text'=>'Contact',
		'url'=>'/'.APP_MODULE.'/paginas/contact'
	);

	
	
	$raiz= empty($_PETICION->modulo)? '/' : '/'.$_PETICION->modulo.'/';
	
	for($i=0; $i<sizeof($menus); $i++ ){
		if ( $raiz.$_PETICION->controlador.'/'.$_PETICION->accion == $menus[$i]['url'] ){
			$menus[$i]['estado']='ui-state-active';
		}
	}	
?>
<style>
	#menu_principal li:first-child{	border-radius:45px 0 0 45px;}
	#menu_principal li:last-child{border-radius:0 45px  45px 0 ;}
	#menu_principal{position:absolute; margin-top:131px; left:42px;}
	
	#menu_principal li a{
		-webkit-transition:background .5s;
		-webkit-transition:background-color .5s;
		-webkit-transition:color .2s;
	}
	#menu_principal li{ display:inline-block;margin-right:-5px;
	}
	#menu_principal li a{ padding:12px 24px 11px 24px; display:inline-block;
	
	}
	#menu_principal li:ui-state-hover a{ } 
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
<ul id="menu_principal" class="ui-widget">	
	<?php
	for($i=0; $i<sizeof($menus); $i++){
		echo '<li '.$menus[$i]['idMenu'].' class="ui-state-default '.$menus[$i]['estado'].'"><a href="'.$menus[$i]['url'].'">'.$menus[$i]['text'].'</a></li>';
	}
	?>
</ul>