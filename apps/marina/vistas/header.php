<style>
	.main_header{height:202px; width:800px;left:50%;margin-left:-400px;position:relative;}
	.main_header .logo img{position:absolute; position: absolute;width: 151px;left: -44px;top: 23px; }
	.main_header .logo .titulo {position:absolute; color: white;left: 107px;margin-top: 28px;}
	.main_header .logo .titulo span:first-child{ font-family:krona-one, serif; font-size: 33px;display:block; text-shadow: 4px 4px 2px rgba(150, 150, 150, 1);padding-right:35px; }
	.main_header .logo .titulo span:last-child{right: 0;position: absolute; margin-top:-2px; }
	.main_header  .seach-box{position:absolute; right:0; top:70px}
	.main_header  .user-box{position:absolute;top:0;right:0; font-size:18px;}
	.main_header  .user-box a{color:white; text-decoration:none; margin-right:10px;}per{background:blue;}
	
	/* search form 
	-------------------------------------- */
	.searchform {
		display: inline-block;zoom: 1; border: solid 1px #d2d2d2;padding: 3px 5px;-webkit-border-radius: 2em;-moz-border-radius: 2em;border-radius: 2em;
		*display: inline;			
		-webkit-box-shadow: 0 1px 0px rgba(0,0,0,.1);-moz-box-shadow: 0 1px 0px rgba(0,0,0,.1);box-shadow: 0 1px 0px rgba(0,0,0,.1);background: #f1f1f1;
		background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));
		background: -moz-linear-gradient(top,  #fff,  #ededed);
		filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed'); /* ie7 */
		-ms-filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed'); /* ie8 */
	}
	.searchform input { font: normal 12px/100% Arial, Helvetica, sans-serif;}
	.searchform .searchfield { background: #fff;padding: 6px 6px 6px 8px;width: 202px;border: solid 1px #bcbbbb;outline: none;
		-webkit-border-radius: 2em;-moz-border-radius: 2em;border-radius: 2em;
		-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,.2); -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.2); box-shadow: inset 0 1px 2px rgba(0,0,0,.2);
	}
	.searchform .searchbutton { color: #fff;border: solid 1px #494949;font-size: 11px;height: 27px;width: 27px;text-shadow: 0 1px 1px rgba(0,0,0,.6);
		-webkit-border-radius: 2em;-moz-border-radius: 2em;border-radius: 2em;background: #5f5f5f;
		background: -webkit-gradient(linear, left top, left bottom, from(#9e9e9e), to(#454545)); 
		background: -moz-linear-gradient(top,  #9e9e9e,  #454545);filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#9e9e9e', endColorstr='#454545'); -ms-filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#9e9e9e', endColorstr='#454545'); /* ie8 */
	}
</style>
<div class="main_header" >
	<div class="logo">
		<img  src="/web/apps/<?php echo APP_MODULE; ?>/imagenes/logo2.png" />
		<div class="titulo">
			<span>Marina MVC</span>
			<span>un framework ligero para php
		</div>
	</div>
	
	<div class="user-box">
		<a href="/<?php echo APP_MODULE; ?>/user/login">entrar</a>
		<a href="/<?php echo APP_MODULE; ?>/user/signup">registrarse</a>
	</div>
	<div class="seach-box">
		<form class="searchform">
			<input class="searchfield" type="text" value="Search..." onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}">
			<input class="searchbutton" type="button" value="Go">
		</form>
	</div>
	
	
	<?php $this->mostrar('/menu');	?>
</div>