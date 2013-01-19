<style>
.loginForm{
	display:inline-block;
	padding:10px;
	border:#d4cfcf 1px solid; border-radius: 20px; background:white; 
	webkit-box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.75);-moz-box-shadow:    7px 7px 5px rgba(50, 50, 50, 0.75);box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.75);
}
</style>
<form class="loginForm" action="/<?php echo $_PETICION->modulo; ?>/user/login" METHOD="POST" style="text-align:center">
	<?
	if  ( !empty($this->errores) ){
		print_r ($this->errores);
	}
	?>
	<h2>Login</h2>
	<input name="username" placeholder="nick">
	<br>
	<input name="pass" placeholder="pass">
	<br>
	<input type="submit">
</form>