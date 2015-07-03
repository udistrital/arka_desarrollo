<?php

use inventarios\gestionElementos\detalleElemento\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

$esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");
$directorio = $this->miConfigurador->getVariableConfiguracion("host");
$directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");

$rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] . '/' . $esteBloque ['nombre'];

$miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');


if ($_REQUEST ['funcion'] == 'Consulta') {
    $arreglo = unserialize($_REQUEST ['arreglo']);
    $cadenaSql = $this->sql->getCadenaSql('consultarElemento', $arreglo);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");



    for ($i = 0; $i < count($resultado); $i ++) {
        $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
        $variable .= "&id_elemento=" . $resultado [$i] ['idelemento'];
        $variable .= "&opcion=detalle";
        $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

        $variable2 = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
        $variable2 .= "&id_elemento=" . $resultado [$i] ['idelemento'];
        $variable2 .= "&opcion=anular";
        $variable2 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable2, $directorio);

        $cierreContable = "<center><a href='" . $variable . "'><u>Ver Detalle</u></a></center> ";

        $resultadoFinal[] = array(
            'placa' => "<center>" . $resultado[$i]['placa'] . "</center>",
            'serie' => "<center>" . $resultado[$i]['serie'] . "</center>",
            'descripcion' => "<center>" . $resultado[$i]['descripcion'] . "</center>",
            'fecharegistro' => "<center>" . $resultado[$i]['fecharegistro'] . "</center>",
            'detalle' => "<center>" . $cierreContable,
        );
    }


    $total = count($resultadoFinal);

    $resultado = json_encode($resultadoFinal);

    $resultado = '{
                "recordsTotal":' . $total . ',
                "recordsFiltered":' . $total . ',
				"data":' . $resultado . '}';

    echo $resultado;
}
?>
