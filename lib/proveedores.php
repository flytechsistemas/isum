<?php
session_start();
include '../includes/db.php';
if ( $_GET["t"] == "create" ) {
	$ultimoId = $db->insert("proveedores", [
									   "codigo" => $_POST["txtCodigo"],
									   "razon_social" => $_POST["txtRazonSocial"],
									   "rif" => $_POST["txtRif"],
									   "email" => $_POST["txtEmail"],
									   "direccion" => $_POST["txtDireccion"],
									   "ciudad" => $_POST["txtCiudad"],
									   "pais" => $_POST["txtPais"],
									   "telefono" => $_POST["txtTelefono"]
									  ]);
	
	foreach ( $_POST["cboClasificacion"] as $clasif ) {
		$datos = $db->insert("proveedores_clasificacion", [
									   "id_clasificacion" => $clasif,
									   "id_proveedor" => $ultimoId
									  ]);
	}
	header("location: ../home.php?s=proveedores");
} elseif ( $_GET["t"] == "edit") {
	$ultimoId = $db->update("proveedores", [
									   "codigo" => $_POST["txtCodigo"],
									   "razon_social" => $_POST["txtRazonSocial"],
									   "rif" => $_POST["txtRif"],
									   "email" => $_POST["txtEmail"],
									   "direccion" => $_POST["txtDireccion"],
									   "ciudad" => $_POST["txtCiudad"],
									   "pais" => $_POST["txtPais"],
									   "telefono" => $_POST["txtTelefono"]
									  ],
									  ["id" => $_GET["id"]]);
	$datos = $db->delete("proveedores_clasificacion", [
									   "id_proveedor" => $_GET["id"]
									  ]);
	foreach ( $_POST["cboClasificacion"] as $clasif ) {
		$datos = $db->insert("proveedores_clasificacion", [
									   "id_clasificacion" => $clasif,
									   "id_proveedor" => $_GET["id"]
									  ]);
	}
	header("location: ../home.php?s=proveedores");
} elseif ( $_GET["t"] == "delete") {
	$datos = $db->delete("proveedores", ["id" => $_GET["id"]]);
	$datos = $db->delete("proveedores_clasificacion", ["id_proveedor" => $_GET["id"]]);
	header("location: ../home.php?s=proveedores");
}
?>