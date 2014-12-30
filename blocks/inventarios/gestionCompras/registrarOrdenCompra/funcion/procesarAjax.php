<?php
use inventarios\gestionCompras\registrarOrdenCompra\Sql;


$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'tablaItems') {
	$tabla = new stdClass ();
	
	$page = $_GET ['page'];
	
	$limit = $_GET ['rows'];
	
	$sidx = $_GET ['sidx'];
	
	$sord = $_GET ['sord'];
	
	if (! $sidx)
		$sidx = 1;
		
		// ------------------
	
	$cadenaSql = $this->sql->getCadenaSql ( 'items', $_REQUEST ['tiempo'] );
	// echo $cadenaSql;
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	// var_dump($resultadoItems);
	// ---------------------
	$filas = count ( $resultadoItems );
	
	if ($filas > 0 && $limit > 0) {
		$total_pages = ceil ( $filas / $limit );
	} else {
		$total_pages = 0;
	}
	
	if ($page > $total_pages)
		$page = $total_pages;
	
	$start = $limit * $page - $limit;
	
	if ($resultadoItems != false) {
		$tabla->page = $page;
		$tabla->total = $total_pages;
		$tabla->records = $filas;
		
		$i = 0;
		
		foreach ( $resultadoItems as $row ) {
			$tabla->rows [$i] ['id'] = $row ['id_items'];
			$tabla->rows [$i] ['cell'] = array (
					$row ['item'],
					$row ['unidad_medida'],
					$row ['cantidad'],
					$row ['descripcion'],
					$row ['valor_unitario'],
					$row ['valor_total'] 
			);
			$i ++;
		}
		
		$tabla = json_encode ( $tabla );
		
		echo $tabla;
	} else {
		
		$tabla->page = $page;
		$tabla->total = $total_pages;
		$tabla->records = $filas;
		
		$i = 0;
		
		$tabla->rows [0] ['id'] = '0';
		$tabla->rows [0] ['cell'] = array (
				' ',
				' ',
				'0.00',
				' ',
				'0.00',
				'0.00' 
		);
		
		$tabla = json_encode ( $tabla );
		
		echo $tabla;
	}
}
if ($_REQUEST ['funcion'] == 'AgregarItem') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'id_items_temporal' );
	$idItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$id = $idItems [0] [0] + 1;
	
	if ($idItems [0] [0] != null) {
		
		$datos = array (
				$id,
				$_GET ['item'],
				$_GET ['unidad_medida'],
				$_GET ['cantidad'],
				$_GET ['descripcion'],
				$_GET ['valor_unitario'],
				$_GET ['cantidad']*$_GET ['valor_unitario'],
				$_REQUEST ['tiempo'] 
		);
	} else {
		$datos = array (
				'1',
				$_GET ['item'],
				$_GET ['unidad_medida'],
				$_GET ['cantidad'],
				$_GET ['descripcion'],
				$_GET ['valor_unitario'],
				$_GET ['cantidad']*$_GET ['valor_unitario'],
				$_REQUEST ['tiempo'] 
		);
	}
	
	// ------------------
	
	$cadenaSql = $this->sql->getCadenaSql ( 'insertarItem', $datos );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
	echo $resultadoItems;
	// ---------------------
}

if ($_REQUEST ['funcion'] == 'EliminarItem') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'eliminarItem', $_GET ['id'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
	
	echo $resultadoItems;
}

if ($_REQUEST ['funcion'] == 'SeleccionProveedor') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'informacion_proveedor', $_REQUEST ['personaje'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	$resultado =json_encode($resultadoItems [0])  ;

	echo $resultado;
}



if ($_REQUEST ['funcion'] == 'SeleccionDependencia') {

	$cadenaSql = $this->sql->getCadenaSql ( 'informacion_dependencia', $_REQUEST ['dependencia'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

	$resultado =json_encode($resultadoItems [0])  ;

	echo $resultado;
}



if ($_REQUEST ['funcion'] == 'SeleccionOrdenador') {

	$cadenaSql = $this->sql->getCadenaSql ( 'informacion_ordenador', $_REQUEST ['ordenador'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

	$resultado =json_encode($resultadoItems [0])  ;

	echo $resultado;
}



if ($_REQUEST ['funcion'] == 'SeleccionCargo') {

	$cadenaSql = $this->sql->getCadenaSql ( 'informacion_cargo_jefe', $_REQUEST ['cargo'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

	$resultado =json_encode($resultadoItems [0])  ;

	echo $resultado;
}
?>