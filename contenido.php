<?php

$seccion = isset($_GET["s"])?$_GET["s"]:"";

$accion = isset($_GET["a"])?$_GET["a"]:"index";

$seccionesPrincipales = array("changepassword");

$seccionCompleta = false;

foreach ($_SESSION["menu"] as $value) {

	if ( $value[1] == $seccion ) {
	
		$seccionCompleta = $value[0] . "-" . $value[1];

		$_SESSION["seccionActiva"] = $seccionCompleta;
	
	}

}

if ( $seccionCompleta == false ) {

	$seccionCompleta = $seccion;

	$_SESSION["seccionActiva"] = $seccion;

}

if ( in_array($seccion, $seccionesPrincipales) ) {
		
	include $seccion.'.php';

} else {

	include $seccionCompleta.'/'.$accion.'.php';

}


include 'notificacion.php';

?>