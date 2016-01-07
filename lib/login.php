<?php
include '../includes/db.php';

$seccion = isset($_GET["s"])?$_GET["s"]:"";

if ( $seccion == "cambioClave" ) {
	
	session_start();
	
	if ( $_POST["changePassword"] == $_POST["rchangePassword"] ) {

		$data = $db->update("s_usuarios", ["estatus" => 0, "s_clave" => $_POST["changePassword"]], ["s_id" => $_SESSION["usuario"]["id"]]);
		header("location: ../index.php");

	}

} elseif ( $seccion == "login" ){

	session_start();

	if ( isset( $_POST["username"] ) && isset( $_POST["password"] ) ) {

		$datos = $db->get("s_inscripciones", "*", ["AND" => ["CEDULA" => $_POST["username"], "CLAVE" => $_POST["password"]]]);

		if ( count( $datos ) > 1 ) {

			$_SESSION["usuario"]["id"] = $datos["CEDULA"];
			$_SESSION["usuario"]["cedula"] = $datos["CEDULA"];
			$_SESSION["usuario"]["nombre"] = $datos["NOMBRE"];
			$_SESSION["usuario"]["apellido"] = "";
			/*$_SESSION["usuario"]["nombre"] = $datos["s_nombre"];
			$_SESSION["usuario"]["apellido"] = $datos["s_apellido"];
			$_SESSION["usuario"]["documento_identidad"] = $datos["s_documento"];
			$_SESSION["usuario"]["email"] = $datos["s_email"];
			$_SESSION["usuario"]["telefono"] = $datos["s_telefono"];
			$_SESSION["usuario"]["estatus"] = $datos["s_estatus"];
			$_SESSION["usuario"]["empresa_id"] = $datos["s_empresa_id"];
						
			/*$priv = $db->select("usuario_privilegio", ["[>]privilegios" => ["id_privilegio" => "id"],], "id_privilegio", ["id_usuario" => $_SESSION["usuario"]["id"]]);
			$_SESSION["usuario"]["privilegios"] = $priv;*/
			
			//if ( $_SESSION["usuario"]["estatus"] == 0 ) {//LOGIN

				header("location: ../home.php?s=inscripciones");
			
			/*} elseif ( $_SESSION["usuario"]["estatus"] == 1 ) {//OBLIGAR AL CAMBIO DE CLAVE
			
				header("location: ../changepassword.php");
			
			} elseif ( $_SESSION["usuario"]["estatus"] == 2 ) {//USUARIO INACTIVO
			
				header("location: ../index.php?e=2");
			
			}*/

		} else {

			header("location: ../index.php?e=1");

		}

	} else {
	
		header("location: ../index.php?e=3");
	
	}

} else {

	header("location: ../index.php");

}
?>