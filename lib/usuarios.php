<?php
session_start();
include '../includes/db.php';
if ( $_GET["t"] == "create" ) {
	$ultimoId = $db->insert("usuarios", [
									   "nombre" => $_POST["txtNombre"],
									   "apellido" => $_POST["txtApellido"],
									   "usuario" => $_POST["txtUsuario"],
									   "clave" => $_POST["txtClave"],
									   "tipo" => $_POST["cboTipo"],
									   "id_proveedor" => $_POST["cboProveedor"],
									   "estatus" => 1
									  ]);
	foreach ( $_POST["cboPrivilegio"] as $priv ) {
		$datos = $db->insert("usuario_privilegio", [
									   "id_privilegio" => $priv,
									   "id_usuario" => $ultimoId
									  ]);
	}
	header("location: ../home.php?s=usuarios");
} elseif ( $_GET["t"] == "edit") {
	$ultimoId = $db->update("usuarios", [
									   "nombre" => $_POST["txtNombre"],
									   "apellido" => $_POST["txtApellido"],
									   "usuario" => $_POST["txtUsuario"],
									   "clave" => $_POST["txtClave"],
									   "tipo" => $_POST["cboTipo"],
									   "id_proveedor" => $_POST["cboProveedor"],
									   "estatus" => 1
									  ],
									  ["id" => $_GET["id"]]);
	$datos = $db->delete("usuario_privilegio", [
									   "id_usuario" => $_GET["id"]
									  ]);
	foreach ( $_POST["cboPrivilegio"] as $priv ) {
		$datos = $db->insert("usuario_privilegio", [
									   "id_privilegio" => $priv,
									   "id_usuario" => $_GET["id"]
									  ]);
	}
	header("location: ../home.php?s=usuarios");
} elseif ( $_GET["t"] == "delete" ) {
	$datos = $db->delete("usuarios", ["id" => $_GET["id"]]);
	header("location: ../home.php?s=usuarios");
}

?>