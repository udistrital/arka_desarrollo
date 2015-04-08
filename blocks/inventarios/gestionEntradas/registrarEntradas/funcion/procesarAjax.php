<?php
use inventarios\gestionEntradas\registrarEntradas\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if (isset ( $_REQUEST ['funcion'] ) && $_REQUEST ['funcion'] == 'estado') {
	
	switch ($_REQUEST ['cls_entr']) {
		
		case '1' :
			
			$cadenaSql = $this->sql->getCadenaSql ( 'tipo_contrato_avance' );
			$datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			$datos = json_encode ( $datos );
			break;
		
		case '' :
			
			$datos = 'Error';
			
			break;
		
		default :
			$cadenaSql = $this->sql->getCadenaSql ( 'tipo_contrato' );
			$datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			$datos = json_encode ( $datos );
			break;
	}
	
	echo $datos;
}

?>
