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
//var_dump($_REQUEST);

if ($_REQUEST ['funcion'] == 'Consulta') {
    //$arreglo = unserialize($_REQUEST['arreglo']);
    //$cadenaSql = $this->sql->getCadenaSql('consultarElemento', $arreglo);
    $cadenaSql = $this->sql->getCadenaSql('consultarElemento', false);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

    foreach ($resultado as $key => $values) {
        $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
        $variable .= "&opcion=detalle";
        $variable .= "&elemento=" . $resultado[$key]['id_elemento_ind'];
        $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

        $detalle = "<center><a href='" . $variable . "'><u>Ver Detalle</u></a></center> ";

        $resultadoFinal[] = array(
            'placa' => "<center>" . $resultado[$key]['placa'] . "</center>",
            'descripcion' => "<center>" . $resultado[$key]['descripcion'] . "</center>",
            'sede' => "<center>" . $resultado[$key]['sede_nombre'] . "</center>",
            'dependencia' => "<center>" . $resultado[$key]['dependencia_nombre'] . "</center>",
            'funcionario' => "<center>" . $resultado[$key]['fun_nombre'] . "</center>",
            'detalle' => "<center>" . $detalle
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

if ($_REQUEST ['funcion'] == 'placas') {
    $parametro = $_REQUEST['query'];
    $cadenaSql = $this->sql->getCadenaSql('buscar_placa', $parametro);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, 'busqueda');


    foreach ($resultadoItems as $key => $values) {
        $keys = array('value', 'data');
        $resultado[$key] = array_intersect_key($resultadoItems[$key], array_flip($keys));
    }

//    var_dump($resultado);


    echo '{"suggestions":' . json_encode($resultado) . '}';
}

if ($_REQUEST ['funcion'] == 'consultarDependencia') {




    $cadenaSql = $this->sql->getCadenaSql('dependenciasConsultadas', $_REQUEST['valor']);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


    $resultado = json_encode($resultado);

    echo $resultado;
}


if ($_REQUEST ['funcion'] == 'consultarUbicacion') {


    $cadenaSql = $this->sql->getCadenaSql('ubicacionesConsultadas', $_REQUEST['valor']);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


    $resultado = json_encode($resultado);

    echo $resultado;
}
?>
