<?php
use inventarios\gestionElementos\modificarElemento\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'Consulta') {
	$arreglo = unserialize ( $_REQUEST ['arreglo'] );
	$cadenaSql = $this->sql->getCadenaSql ( 'consultarElemento', $arreglo );
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	
	$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );

	for($i = 0; $i < count ( $resultado ); $i ++) {
		$variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
		$variable .= "&id_elemento=" . $elementos [$i] [0];
		$variable .= "&opcion=modificar";
		$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable, $directorio );
	
		$variable2 = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
		$variable2 .= "&id_elemento=" . $elementos [$i] [0];
		$variable2 .= "&opcion=anular";
		$variable2 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable2, $directorio );
	
		$anulacion=($elementos[$i][5]==2)?"<a href='" . $variable2. "'>
                            <img src='" . $rutaBloque . "/css/images/anular.png' width='15px'>
                        </a>":" " ;
	
	
	
	
	
		$mostrarHtml = "<tr>
                    <td><center>" . $elementos [$i] [1] . "</center></td>
                    <td><center>" . $elementos [$i] [2] . "</center></td>
                    <td><center>" . $elementos [$i] [4] . "</center></td>
                    <td><center>" . $elementos [$i] [3] . "</center></td>";
	
		if ($elementos [$i] [6] == 'f') {
	
			$mostrarHtml .= "<td><center>
			                    	<a href='" . $variable . "'>
			                            <img src='" . $rutaBloque . "/css/images/edit.png' width='15px'>
			                        </a>
                		  			</center> </td>
			                         <td><center>
                    					".$anulacion."
                  						</center> </td>		";
		} else if ($elementos [$i] [6] == 't') {
	
			$mostrarHtml .= "<td><center>Inhabilitado por Cierre Contable</center> </td>
							         <td><center>Inhabilitado por Cierre Contable</center> </td> ";
		}
		$mostrarHtml .= "</tr>";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$total = count ( $resultado );
	
	$resultado = json_encode ( $resultado );
	
	$resultado = '{
                "recordsTotal":' . $total . ',
                "recordsFiltered":' . $total . ',
				"data":' . $resultado . '}';
	
	echo $resultado;
}

?>
