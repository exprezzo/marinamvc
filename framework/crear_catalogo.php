<?php
//revisar que la carpeta no exista.
$config=array(
	'modulo'=>'modulo',
	'nombre'=>'nombre',
	'icon'=>'icon',
	'tabla'=>'articulos'
);
crear_catalogo($config);


function crearControlador($destino,$nombreClase{
	$contenido='<?php
class '.$nombreClase.' extends Controlador{

}
?>
	';
	file_put_contents($destino, $contenido);
}

function crearModelo($destino,$nombreClase{
	$contenido='<?php
class '.$nombreClase.' extends Modelo{

}
?>
	';
	file_put_contents($destino, $contenido);
}

?>