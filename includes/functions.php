<?php
include 'PHPMailer/class.phpmailer.php';

function priv( $priv_search ) {
	
	if ( in_array( $priv_search, $_SESSION["usuario"]["privilegios"] ) ) {
	
		return true;
	
	} else {
	
		return false;
	
	}

}

function show_priv() {

	return $_SESSION["usuario"]["privilegios"];

}

function separar( $cadena ) {

	$salida = str_replace("_", " ", $cadena);

	return $salida;

}

function generaMenu() {

	$dir_sistema = ["assets", "Base de Datos", "includes", "lib", "plantilla", "perfil"];

	unset($_SESSION["menu"]);

	unset($_SESSION["seccionActiva"]);

	$directorio = opendir("./");

	while ( $archivo = readdir( $directorio ) ) {

	    if ( is_dir( $archivo ) ) {

	    	if ( $archivo != ".." && $archivo != "." && !in_array($archivo, $dir_sistema)) {

	        	$_SESSION["menu"][] = explode("-", $archivo);

	        }

	    }

	}
	
	return asort($_SESSION["menu"]);
	
}

function setNotificacion($titulo = null, $contenido = "Datos Actualizados con éxito.", $tipo = "success") {

	/* $tipo ("success", "info", "error")*/

	$_SESSION["notificacion"]["contenido"] = $contenido;

	$_SESSION["notificacion"]["titulo"] = $titulo;

	$_SESSION["notificacion"]["tipo"] = $tipo;

}

function unSetNotificacion() {

	unset( $_SESSION["notificacion"] );

}

function validarDatosNulos($post, $url) {
	
	$error = false;

	foreach ($post as $v) {

		if ( $v == "" ) {
					
			setNotificacion("Error", "Faltan datos<br>Intente nuevamente", "error");
		
			$error = true;
		
			break;
			
		}

	}

	if ( $error ) {

		header( $url );

		exit();

	}
	
}

function enviarNotificacion($emergencia, $accion, $responsable, $email) {

		$mail = new PHPMailer();
		$mail->Host = "localhost";
		 
		$mail->From = "jorgem_peraza@hotmail.com";
		$mail->FromName = "Sistema SECE";
		$mail->Subject = "Probando SECE";
		$mail->AddAddress($email, $responsable);
		 
		$body  = "Hola <strong>amigo</strong><br>";
		$body .= "probando <i>PHPMailer<i>.<br><br>";
		$body .= "<font color='red'>Saludos</font>";
		$mail->Body = $body;
		$mail->AltBody = "Hola amigo\nprobando PHPMailer\n\nSaludos";
		$mail->Send();
}
?>