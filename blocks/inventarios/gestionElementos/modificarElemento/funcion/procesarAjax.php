<?php
use inventarios\gestionElementos\modificarElemento\Sql;

$ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );

$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/plugin/html2pfd/";

include ($ruta . "/plugin/scripts/javascript/dataTable/ssp.class.php");

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );

$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] . '/' . $esteBloque ['nombre'];

$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );

if ($_REQUEST ['funcion'] == 'Consulta') {
	
	/*
	 * DataTables example server-side processing script.
	 *
	 * Please note that this script is intentionally extremely simply to show how
	 * server-side processing can be implemented, and probably shouldn't be used as
	 * the basis for a large complex system. It is suitable for simple use cases as
	 * for learning.
	 *
	 * See http://datatables.net/usage/server-side for full details on the server-
	 * side processing requirements of DataTables.
	 *
	 * @license MIT - http://datatables.net/license_mit
	 */
	
	/*
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	// DB table to use
	$table = 'arka_inventarios.elemento el';
	
	// DB table to use
	$join1 = "JOIN arka_inventarios.tipo_bienes tb ON tb.id_tipo_bienes = el.tipo_bien ";
	$join2 = "JOIN arka_inventarios.entrada en ON en.id_entrada = el.id_entrada ";
	$join3 = "JOIN arka_inventarios.elemento_individual ei ON ei.id_elemento_gen = el.id_elemento ";
	
	$joins = array (
			$join1,
			$join2,
			$join3 
	);
	
	// Table's primary key
	$primaryKey = 'id_elemento';
	
	// Array of database columns which should be read and sent back to DataTables.
	// The `db` parameter represents the column name in the database, while the `dt`
	// parameter represents the DataTables column identifier. In this case simple
	// indexes
	$columns = array (
			array (
					'db' => 'ei.placa',
					'dt' => 'placa' 
			),
			array (
					'db' => 'el.serie',
					'dt' => 'serie' 
			),
			array (
					'db' => 'tb.descripcion',
					'dt' => 'descripcion' 
			),
			array (
					'db' => 'el.fecha_registro',
					'dt' => 'fecha_registro' 
			),
			array (
					'db' => 'el.id_elemento',
					'dt' => 'id_elemento' 
			),
			array (
					'db' => 'en.estado_entrada',
					'dt' => 'estado_entrada' 
			),
			array (
					'db' => 'en.cierre_contable',
					'dt' => 'cierre_contable' 
			) 
	);
	
	// SQL server connection information
	$sql_details = array (
			'user' => $esteRecursoDB ['usuario'],
			'pass' => $esteRecursoDB ['clave'],
			'db' => $esteRecursoDB ['db'],
			'host' => $esteRecursoDB ['servidor'] 
	);
	
	/*
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP
	 * server-side, there is no need to edit below this line.
	 */
	
	echo json_encode ( SSP::simple ( $_GET, $sql_details, $table, $primaryKey, $columns ) );
}

?>
