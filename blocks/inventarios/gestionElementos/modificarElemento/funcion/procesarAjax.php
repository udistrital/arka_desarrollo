<?php
use inventarios\gestionElementos\modificarElemento\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'Consulta') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'consultarElemento' );
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$total = count ( $resultado );
	
	$resultado = json_encode ( $resultado );
	
	$resultado = '{
			"aaData":' . $resultado . '}';
	
	echo $resultado;
}

?>
