<?php

use inventarios\gestionElementos\registrarReposicion\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

if ($_REQUEST ['funcion'] == 'consultarDependencia') {

    $conexion = "inventarios";

    $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);


    $cadenaSql = $this->sql->getCadenaSql('dependencias_encargada', $_REQUEST['valor']);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


    $resultado = json_encode($resultado);

    echo $resultado;
}



if ($_REQUEST ['funcion'] == 'SeleccionOrdenador') {



    $cadenaSql = $this->sql->getCadenaSql('informacion_ordenadorConsultados', $_REQUEST ['ordenador']);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

    $resultado = json_encode($resultadoItems [0]);

    echo $resultado;
}



if ($_REQUEST ['funcion'] == 'consultarUbicacion') {


    $cadenaSql = $this->sql->getCadenaSql('ubicacionesConsultadas', $_REQUEST['valor']);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


    $resultado = json_encode($resultado);

    echo $resultado;
}
?>

