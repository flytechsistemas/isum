<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

$funcion = new funciones();

if ( $_GET["s"] == "crear" ) {
		
	$funcion->crear( $db );
	
} else if ( $_GET["s"] == "editar" ) {
		
	$funcion->editar( $db, $_GET["id"]);
	
} else if ( $_GET["s"] == "eliminar" ) {
		
	$funcion->eliminar($db, $_GET["id"]);
	
} else {
		
	$funcion->index();

}



class funciones {
	
	private $salida;
	
	public function crear( $db ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false;
		$datos = $db->insert("table", 
								[ //CAMPO -> VALOR
								"" => "",
								"" => "",
								"" => "",
								]
							);
		return $salida;
	}
	
	public function editar( $db, $id ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false;
		$datos = $db->update("table", 
								[ //SET CAMPO -> VALOR
								"" => "",
								],
								[ //WHERE
								"" => "",
								]
							);
		return $salida;
	}
	
	public function eliminar( $db, $id ) {
		/*
		* VALIDACIONES
		*/
		
		$salida = false;
		$datos = $db->delete("table", 
								[ //WHERE
								"s_id" => "$id",
								]
							);
		return $salida;
	}
	
	public function index() {
		/*
		* VALIDACIONES
		*/
		
		header("location: index.php");
	}
}




