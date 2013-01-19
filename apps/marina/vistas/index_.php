<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html >
<head>
	<script src="/web/libs/jquery-1.8.3.js"></script>
	<script src="/web/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>
	<?php
		global $_TEMA;
		global $_PETICION;
		if ($_PETICION->accion=='xnews'){
			$_TEMA='blitzer';
		}else if ($_PETICION->accion=='proyectosx'){
			$_TEMA='le-frog';
		}
		$rutaTema=getUrlTema($_TEMA);		
	?>
	<link href="<?php echo $rutaTema; ?>" rel="stylesheet" type="text/css" />	
	
	<!--Wijmo Widgets CSS-->	
	<link href="/web/libs/Wijmo.2.3.2/Wijmo-Complete/css/jquery.wijmo-complete.2.3.2.css" rel="stylesheet" type="text/css" />
	<link href="/web/libs/Wijmo.2.3.2/Wijmo-Open/css/jquery.wijmo-open.2.3.2.css" rel="stylesheet" type="text/css" />				
	<!--Wijmo Widgets JavaScript-->
	<script src="/web/libs/Wijmo.2.3.2/Wijmo-Complete/js/jquery.wijmo-complete.all.2.3.2.min.js" type="text/javascript"></script>
	<script src="/web/libs/Wijmo.2.3.2/Wijmo-Open/js/jquery.wijmo-open.all.2.3.2.min.js" type="text/javascript"></script>	
	<!--script src="http://use.edgefonts.net/krona-one.js"></script-->			
	
	<?php echo '<link href="/web/apps/'.$_PETICION->modulo.'/css/estilos.css" rel="stylesheet" type="text/css" />'; ?>
	
	<style>
		
	</style>
	<link href="/web/apps/<?php echo $_PETICION->modulo.'/temas_mod/'.$_TEMA; ?>/mods.css" rel="stylesheet" type="text/css" />	
	<script>
		$(function(){
			var width=$('.main_header #menu_principal').width();
			var margin=width/2;
			$('.main_header ').css('left','50%');
			$('.main_header ').css('margin-left','-'+margin+'px');
			$('.main_header').width(width);
			//$('.main_header').width(width);
		
		});
		
	</script>
</head>
<body>
	<div class="header_wraper">
		<?php $this->mostrar('/header'); ?>
	</div>
	<div class="content_wraper">
		<div class="contenido">
			<div class="contenido_center ui-widget-content">
				<?php $this->mostrar(''); ?>
			</div>
			<div class="content_right" > 
				
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="footer_wraper">footer_wraper</div>
	<style>
		body{
			background-image:url('/web/apps/marina/imagenes/bg6_4.jpg');
		}
	</style>
</body>

</html>