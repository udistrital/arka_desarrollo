<?php

use inventarios\gestionDepreciacion\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);


if ($_REQUEST ['funcion'] == 'SeleccionMeses') {

    $cadenaSql = $this->sql->getCadenaSql('consultar_meses', $_REQUEST ['personaje']);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultadoItems[0]);

    echo $resultado;
}
?>