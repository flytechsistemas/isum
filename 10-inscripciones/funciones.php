<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

class funciones {
	
	private $salida;
	
	public function crear( $db, $post ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false;

		$url = "location: ../home.php?s=emergencias&a=crear";

		validarDatosNulos( $post, $url );

		$dato = $db->insert("s_emergencias", 
								[ //CAMPO -> VALOR
								"s_nombre" => $post["txtNombre"],
								"s_descripcion" => $post["txtDescripcion"],
								"s_tipo_emergencia_id" => $post["cboTipoEmergencia"],
								"s_estatus" => 1,
								"s_empresa_id" => 1,
								]
							);
		
		setNotificacion();
		
		header("location: ../home.php?s=emergencias");
		
	}
	
	public function editar( $db, $post, $id ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false;

		$url = "location: ../home.php?s=emergencias&a=editar&id=" . $id;

		validarDatosNulos( $post, $url );

		$dato = $db->update("s_emergencias", 
								[ //CAMPO -> VALOR
								"s_nombre" => $post["txtNombre"],
								"s_descripcion" => $post["txtDescripcion"],
								"s_tipo_emergencia_id" => $post["cboTipoEmergencia"],
								"s_estatus" => $post["cboEstatus"],
								"s_empresa_id" => 1,
								],
								[
								"s_id" => $id,
								]
							);
						
		setNotificacion();
				
		header("location: ../home.php?s=emergencias");
		
	}
	
	public function eliminar( $db, $id ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false; 
		
		$datos = $db->delete("s_emergencias", 
								[ //WHERE
								"s_id" => $id,
								]
							);
		$error = $db->error();

		if ( $error[1] == "1451" ) {

			setNotificacion("Error", "No puede eliminar esta emergencia<br>Existen otros datos que lo impiden.", "error");
			
			header("location: ../home.php?s=emergencias");
			
			exit();

		}
		
		if ( $db->has("s_emergencias_acciones_usuarios", ["s_emergencia_id" => $id]) ) {

			$datos = $db->delete("s_emergencias_acciones_usuarios", 
								[ //WHERE
								"s_emergencia_id" => $id,
								]
							);
		}
		
		header("location: ../home.php?s=emergencias");
		
	}

	public function accionResponsable( $db, $post, $id ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false;

		$url = "location: ../home.php?s=emergencias&a=accion_responsable&id=" . $id;

		validarDatosNulos( $post, $url );

		$dato = $db->insert("s_emergencias_acciones_usuarios", 
								[ //CAMPO -> VALOR
								"s_emergencia_id" => $id,
								"s_accion_id" => $post["cboAccion"],
								"s_usuario_id" => $post["cboUsuario"],
								"s_empresa_id" => 1,
								]
							);
		
		setNotificacion();
		
		header("location: ../home.php?s=emergencias&a=accion_responsable&id=" . $id);

	}

	public function eliminarAccionResponsable( $db, $id, $idAccion ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false;
		
		$datos = $db->delete("s_emergencias_acciones_usuarios", 
								[ //WHERE
								"s_id" => $idAccion,
								]
							);

		setNotificacion();
				
		header("location: ../home.php?s=emergencias&a=accion_responsable&id=" . $id);
	}
	
	public function index() {
		/*
		* VALIDACIONES
		*/
		
		header("location: ../home.php?s=emergencias");
	}
}

$funcion = new funciones();

if ( $_GET["s"] == "crear" ) {
	
	$funcion->crear( $db, $_POST );
	
} else if ( $_GET["s"] == "editar" ) {
		
	$funcion->editar( $db, $_POST, $_GET["id"]);
	
} else if ( $_GET["s"] == "eliminar" ) {
		
	$funcion->eliminar($db, $_GET["id"]);
	
} else if ( $_GET["s"] == "accion_responsable" ) {
		
	$funcion->accionResponsable($db, $_POST, $_GET["id"]);
	
} else if ( $_GET["s"] == "eliminar_accion_responsable" ) {
		
	$funcion->eliminarAccionResponsable($db, $_GET["id"], $_GET["idAccion"]);
	
} else {
		
	$funcion->index();

}


