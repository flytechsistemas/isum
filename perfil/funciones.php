<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

class funciones {
	
	private $salida;
	
	public function editar( $db, $post, $id ) {
		/*
		* VALIDACIONES
		*/
		if ( $post["txtPassword"] != $post["txtRePassword"] ) {
			
			setNotificacion("Error", "Las claves no coinciden<br>Intente nuevamente", "error");

			header("location: ../home.php?s=perfil&a=editar&id=" . $_SESSION["usuario"]["id"]);
		
		} else {
		
			$salida = false;
			$dato = $db->update("s_inscripciones", 
									[ //CAMPO -> VALOR
									"CLAVE" => $post["txtPassword"],
									],
									[
									"CEDULA" => $id,
									]
								);
			setNotificacion();

			header("location: ../home.php?s=inscripciones");
		
		}
	}
	
}

$funcion = new funciones();

if ( $_GET["s"] == "editar" ) {
		
	$funcion->editar( $db, $_POST, $_GET["id"]);
	
}