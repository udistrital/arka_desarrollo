<?php
use inventarios\gestionElementos\impresionPlacas\Sql;


$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'buscarPlaca') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'buscarMaxPlacas', $_REQUEST['valor'] );
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	$resultado=json_encode($resultado);
	echo $resultado;
}

?>
