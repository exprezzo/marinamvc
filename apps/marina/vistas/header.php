<style>
	
</style>
<div class="main_header" >
	<div id="menu_principal">
		<?php $this->mostrar('/menu');	?>
		<div class="user-box">
			<a href="/<?php echo $_PETICION->modulo; ?>/user/login">entrar</a>
			<a href="/<?php echo $_PETICION->modulo; ?>/user/signup">registrarse</a>
		</div>
	</div>
	
	<div class="logo">
		<img  src="/web/apps/<?php echo APP_MODULE; ?>/imagenes/logo2.png" />
		<div class="titulo">
			<span>Marina</span>
			<span>...
		</div>
	</div>
	
	
	<div class="seach-box">
		<form class="searchform">
			<input class="searchfield" type="text" value="Search..." onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}">
			<input class="searchbutton" type="button" value="Go">
		</form>
	</div>
	
	
	
</div>