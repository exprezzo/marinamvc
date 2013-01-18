<html>
<head>
	<script src="/web/libs/jquery-1.8.3.js"></script>
	<script src="/web/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>
	<?php 		
		global $_TEMA;
		global $_PETICION;
		if ($_PETICION->accion=='news'){
			$_TEMA='blitzer';
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
	
	<script src="http://use.edgefonts.net/krona-one.js"></script>			
	<style>
		body{
			background-image:url('/web/apps/marina/imagenes/bg6_1.jpg');
			/*
			background-image:url('http://s.ngm.com/2005/05/coral-reefs/img/coral-color-615.jpg');
			*/
			background-repeat:no-repeat;
			padding:0;
			margin:0;
		}
		.header_wraper{}		
		.content_wraper{}
		
		.main_content { positon:relative; width:800px; overflow:hidden; }
		.main_content .pantalla{width:5000px; }
		.main_content .contenido{background:white;width:800px; float:left;display:block; margin-right:20px; position:absolute; padding:10px;}
		
		.footer_wraper{background:black;height:100px;}
		.header{width:800px;position:relative;left:50%; margin-left:-400px;border:black 1px solid;}
	</style>
	<link href="/web/apps/<?php echo APP_MODULE.'/mods/'.$_TEMA; ?>/mods.css" rel="stylesheet" type="text/css" />	
</head>
<body>
	<div class="header_wraper">
		<?php $this->mostrar('/header'); ?>
	</div>
	<div class="content_wraper">
		<div class="contenido">
			<?php $this->mostrar(''); ?>
		</div>
	</div>
	<div class="footer_wraper">footer_wraper</div>
</body>

</html>