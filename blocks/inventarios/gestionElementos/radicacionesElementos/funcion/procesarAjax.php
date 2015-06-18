<?php
use inventarios\gestionElementos\radicacionesElementos\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );



if ($_REQUEST ['funcion'] == 'placas') {

	

	$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );


	$cadenaSql = $this->sql->getCadenaSql ( 'buscar_placa');
	$resultadoItems = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );


	$resultado = json_encode ( $resultadoItems);

	echo $resultado;
}





?>