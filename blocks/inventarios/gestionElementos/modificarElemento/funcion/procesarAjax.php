<?php
use inventarios\gestionElementos\modificarElemento\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );

$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] .'/'. $esteBloque ['nombre'];

$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );


if ($_REQUEST ['funcion'] == 'Consulta') {
	$arreglo = unserialize ( $_REQUEST ['arreglo'] );
	$cadenaSql = $this->sql->getCadenaSql ( 'consultarElemento', $arreglo );
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	

	
	for($i = 0; $i < count ( $resultado ); $i ++) {
		$variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
		$variable .= "&id_elemento=" . $resultado [$i] ['idelemento'];
		$variable .= "&opcion=modificar";
		$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable, $directorio );
		
		$variable2 = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
		$variable2 .= "&id_elemento=" . $resultado [$i] ['idelemento'];
		$variable2 .= "&opcion=anular";
		$variable2 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable2, $directorio );
		

		
		if ($resultado [$i] ['cierrecontable'] == 'f') {
			
			$cierreContable = "<center><a href='" . $variable . "'><u>modificar</u></a></center> ";
			$anulacion = ($resultado [$i] ['estadoentrada'] == 2) ? "<center><a href='" . $variable2 . "'><u>anular</u></a></center>" : " ";
		}
		if ($resultado [$i] ['cierrecontable'] == 't') {
			
			$cierreContable = "<center>Inhabilitado por Cierre Contable</center>";
			
			$anulacion = "<center>Inhabilitado por Cierre Contable</center>";
		}
		
		
		$resultadoFinal[]=array(
				'placa' =>"<center>".$resultado[$i]['placa']."</center>",
				'serie'=>"<center>".$resultado[$i]['serie']."</center>",
				'descripcion'=>"<center>".$resultado[$i]['descripcion']."</center>",
				'fecharegistro'=>"<center>".$resultado[$i]['fecharegistro']."</center>",
				'modificar'=>"<center>".$cierreContable,
				'anular'=>"<center>".$anulacion
					
		);
	}
		
	
	$total = count ( $resultadoFinal );
	
	$resultado = json_encode ( $resultadoFinal );
	
	$resultado = '{
                "recordsTotal":' . $total . ',
                "recordsFiltered":' . $total . ',
				"data":' . $resultado . '}';
	
	echo $resultado;
}

?>
