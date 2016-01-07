<?php
session_start();
include '../includes/db.php';
if ( $_GET["t"] == "create" ) {
	$ultimoId = $db->insert("requerimientos", [
									   "descripcion" => $_POST["txtDescripcion"],
									   "fecha_inicio" => date("Y-m-d", strtotime($_POST["txtFechaInicio"])),
									   "fecha_fin" => date("Y-m-d", strtotime($_POST["txtFechaFin"])),
									   "tipo" => $_POST["cboTipo"],
									   "condicion_pago" => $_POST["cboDetCondicionPago"],
									   "estatus" => 1,
									   "#fecha" => 'NOW()',
									   "id_usuario" => $_SESSION["usuario"]["id"]
									  ]);
	$datos = $db->delete("requerimiento_clasificacion", ["id_requerimiento" => $ultimoId]);
	foreach ( $_POST["cboClasificacion"] as $clasif ) {
		$datos = $db->insert("requerimiento_clasificacion", [
									   "id_requerimiento" => $ultimoId,
									   "id_clasificacion" => $clasif
									  ]);
	}
	header("location: ../home.php?s=createdetallerequerimiento&id=" . $ultimoId);
} elseif ( $_GET["t"] == "edit") {
	$ultimoId = $db->update("requerimientos", [
									   "descripcion" => $_POST["txtDescripcion"],
									   "fecha_inicio" => date("Y-m-d", strtotime($_POST["txtFechaInicio"])),
									   "fecha_fin" => date("Y-m-d", strtotime($_POST["txtFechaFin"])),
									   "tipo" => $_POST["cboTipo"],
									   "condicion_pago" => $_POST["cboDetCondicionPago"],
									   "estatus" => 1
									  ],
									  ["id" => $_GET["id"]]);
	$datos = $db->delete("requerimiento_clasificacion", ["id_requerimiento" => $_GET["id"]]);
	foreach ( $_POST["cboClasificacion"] as $clasif ) {
		$datos = $db->insert("requerimiento_clasificacion", [
									   "id_requerimiento" => $_GET["id"],
									   "id_clasificacion" => $clasif
									  ]);
	}
	header("location: ../home.php?s=createdetallerequerimiento&id=" . $_GET["id"]);
} elseif ( $_GET["t"] == "delete") {
	$datos = $db->delete("requerimientos", ["id" => $_GET["id"]]);
	header("location: ../home.php?s=requerimientos");
} elseif ( $_GET["t"] == "createdetalle" ) {
	$ultimoId = $db->insert("detalle_requerimiento", [
									   "id_requerimiento" => $_GET["id"],
									   "descripcion" => $_POST["txtDetDescripcion"],
									   "cantidad" => $_POST["txtDetCantidad"],
									   "unidad_medida" => $_POST["txtDetUnidadMedida"]
									  ]);
	header("location: ../home.php?s=createdetallerequerimiento&id=" . $_GET["id"]);
}elseif ( $_GET["t"] == "publicarequerimiento") {
	$ultimoId = $db->update("requerimientos", ["estatus" => $_GET["action"]],
									  ["id" => $_GET["id"]]);
	header("location: ../home.php?s=createdetallerequerimiento&id=" . $_GET["id"]);
}
?>