<?php
session_start();
include '../includes/db.php';
if ( $_GET["t"] == "create" ) {
	
	$datos = $db->select("detalle_requerimiento", "*", ["id_requerimiento" => $_GET["id_req"]]);	
	foreach ( $datos as $dato ) {
		
		if ( ( $_POST["txtPrecioUnitario"][$dato["id"]] > 0 ) && ( $_POST["txtCantDispon"][$dato["id"]] > 0 ) ) {
			
				if ( $_POST["txtDescripcion"] != "" ) {
					$descripcion = $_POST["txtDescripcion"];
				} else {
					$descripcion = $dato["descripcion"];
				}
				$delete = $db->delete("detalle_oferta", ["AND" => ["id_detalle_requerimiento" => $dato["id"], "id_proveedor" => $_SESSION["usuario"]["id_proveedor"] ]]);
				$insert = $db->insert("detalle_oferta", 
									[
									"id_detalle_requerimiento" => $dato["id"],
									"id_requerimiento" => $_GET["id_req"],
									"id_proveedor" => $_SESSION["usuario"]["id_proveedor"],
									"id_usuario" => $_SESSION["usuario"]["id"],
									"cantidad" => $dato["cantidad"],
									"unidad_medida" => $dato["unidad_medida"],
									"descripcion" => $descripcion,
									"condicion_pago" => $dato["condicion_pago"],
									"precio_unitario" => $_POST["txtPrecioUnitario"][$dato["id"]],
									"cantidad_disponible" => $_POST["txtCantDispon"][$dato["id"]],
									"#fecha" => "NOW()",
									"mostrar" => 1,
									"seleccionado" => 0,
			 						]);
		} else {
			$delete = $db->delete("detalle_oferta", ["id_detalle_requerimiento" => $dato["id"]]);
		}
		
	}
	header("location: ../home.php?s=requerimientos");
} elseif ( $_GET["t"] == "no_mostrar" ) {
		$update = $db->update("detalle_oferta", 
									[
									"mostrar" => 0
			 						],
									["AND" => 
										[
										"id_requerimiento" => $_GET["id_req"],
										"id_proveedor" => $_GET["id_proveedor"],
										]
									]);
		header("location: ../home.php?s=viewoferta&id_req=" . $_GET["id_req"]);
} elseif ( $_GET["t"] == "seleccionar_proveedor" ) {
	$update = $db->update("detalle_oferta", 
									[
									"seleccionado" => 1
			 						],
									["AND" => 
										[
										"id_requerimiento" => $_GET["id_req"],
										"id_proveedor" => $_POST["txtIdProveedor"],
										]
									]);
	$update = $db->update("requerimientos", 
									[
									"estatus" => 3
			 						],
									[
									"id" => $_GET["id_req"],
									]);									
		header("location: ../home.php?s=viewoferta&id_req=" . $_GET["id_req"]);
}

?>