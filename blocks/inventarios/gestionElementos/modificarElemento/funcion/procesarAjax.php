<?php
use inventarios\gestionElementos\modificarElemento\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'Consulta') {
	$arreglo = unserialize ( $_REQUEST ['arreglo'] );
	$cadenaSql = $this->sql->getCadenaSql ( 'consultarElemento', $arreglo );
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$total = count ( $resultado );
	
	$resultado = json_encode ( $resultado );
	
	$resultado = '{
                "recordsTotal":' . $total . ',
                "recordsFiltered":' . $total . ',
				"data":' . $resultado . '}';
	
	echo $resultado;
}

?>
