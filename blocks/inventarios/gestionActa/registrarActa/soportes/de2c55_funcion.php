<?php
require 'conexion.php';
function gethelloworld($name) {
	$myname = $name;
	return $myname;
}
function login($usuario, $contrasenna) {
	$con = conectar ();
	$query = "SELECT nombre FROM arka_usuario WHERE clave = '$contrasenna'" . " AND id_usuario=" . $usuario;
	$result = pg_query ( $con, $query ) or die ( 'Query failed: ' . pg_last_error () );
	if (pg_num_rows ( $result ) == 1) {
		return "true";
	} else {
		return "false";
	}
	pg_FreeResult ( $result );
	pg_close($con);
}
function consultar_dependencias() {
	$con = conectar ();
	$query = "SELECT nombre FROM arka_inventarios.dependencia";
	$result = pg_query ( $con, $query ) or die ( 'Query failed: ' . pg_last_error () );
	
	$filas = pg_numrows ( $result );
	$contador = 0;
	$dependencia = array ();
	while ( $dependencia = pg_fetch_row ( $result ) ) {
		$result_dependencia [] = $dependencia [0];		
	}
	
	pg_FreeResult ( $result );
	
        pg_close($con);

	return $result_dependencia;
}

function consultar_funcionarios($dependencia) {
	$con = conectar ();
	$query = "SELECT nombre FROM arka_inventarios.funcionario Where dependencia = ".$dependencia;
	$result = pg_query ( $con, $query ) or die ( 'Query failed: ' . pg_last_error () );

	$filas = pg_numrows ( $result );
	$contador = 0;
	$funcionario = array ();
	while ( $funcionario = pg_fetch_row ( $result ) ) {
		$result_funcionario [] = $funcionario [0];
	}

	pg_FreeResult ( $result );

	pg_close($con);

	return $result_funcionario;
}

function consultar_elementos($funcionario) {
	$con = conectar ();
	//Queda pendiente realizar la consulta deacuerdo a lo brindado por violete
	$query = "SELECT id_elemento, descripcion, marca, nivel, serie, valor, subtotal_sin_iva, total_iva, total_iva_con  FROM arka_inventarios.elemento";
	$result = pg_query ( $con, $query ) or die ( 'Query failed: ' . pg_last_error () );
	
	$arr = array();
		
 	while ($row = pg_fetch_array($result)) {
      	//$arr[] = $row;
 		$id_elemento=$row['id_elemento'];
 		$descripcion=$row['descripcion']; 	
 		$marca=$row['marca'];
 		$nivel=$row['nivel'];
 		$placa=$row['placa'];
 		$serie=$row['serie'];
 		$valor=$row['valor'];
 		$subtotal_sin_iva=$row['subtotal_sin_iva'];
 		$total_iva=$row['total_iva'];
 		$total_iva_con=$row['total_iva_con'];
 		 		
 		//cada registro de información se introduce en un arreglo asociativo
 		$elementos[] = array('id_elemento'=>$id_elemento, 'descripcion'=>$descripcion, 'marca'=>$marca, 'nivel'=>$nivel,
 				'placa'=>$placa,'serie'=>$serie,'valor'=>$valor,'subtotal_sin_iva'=>$subtotal_sin_iva,
 				'total_iva'=>$total_iva, 'total_iva_con'=>$total_iva_con
 		);
    }
	
	return $elementos;
	
}

?>
