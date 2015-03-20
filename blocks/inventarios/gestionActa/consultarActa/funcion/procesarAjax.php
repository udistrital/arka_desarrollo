<?php
use inventarios\gestionActa\consultarActa\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);


if ($_REQUEST ['funcion'] == 'tablaItems') {
    $tabla = new stdClass ();
    $page = $_GET ['page'];
    $limit = $_GET ['rows'];
    $sidx = $_GET ['sidx'];
    $sord = $_GET ['sord'];

    if (!$sidx)
        $sidx = 1;

    // ------------------

    $cadenaSql = $this->sql->getCadenaSql('items', $_REQUEST['tiempo']);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

    // ---------------------
    $filas = count($resultadoItems);

    if ($filas > 0 && $limit > 0) {
        $total_pages = ceil($filas / $limit);
    } else {
        $total_pages = 0;
    }

    if ($page > $total_pages) {
        $page = $total_pages;
    }

    $start = $limit * $page - $limit;

    if ($resultadoItems != false) {
        $tabla->page = $page;
        $tabla->total = $total_pages;
        $tabla->records = $filas;

        $i = 0;

        foreach ($resultadoItems as $row) {
            $tabla->rows [$i] ['id'] = $row ['id_items'];
            $tabla->rows [$i] ['cell'] = array(
                $row ['item'],
                $row ['cantidad'],
                $row ['descripcion'],
                $row ['valor_unitario'],
                $row ['valor_total']
            );
            $i ++;
        }

        $tabla = json_encode($tabla);

        echo $tabla;
    } else {

        $tabla->page = $page;
        $tabla->total = $total_pages;
        $tabla->records = $filas;

        $i = 0;

        $tabla->rows [0] ['id'] = '0';
        $tabla->rows [0] ['cell'] = array(
            ' ',
            '0.00',
            ' ',
            '0.00',
            '0.00'
        );

        $tabla = json_encode($tabla);

        echo $tabla;
    }
}
if ($_REQUEST ['funcion'] == 'AgregarItem') {

    $cadenaSql = $this->sql->getCadenaSql('id_items_temporal');
    $idItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    $id = $idItems [0][0] + 1;

    if ($idItems [0] [0] != null) {

        $datos = array(
            $id,
            $_GET ['item'],
            $_GET ['cantidad'],
            $_GET ['descripcion'],
            $_GET ['valor_unitario'],
            $_GET ['valor_total'],
            $_REQUEST ['tiempo']
        );
    } else {
        $datos = array(
            '1',
            $_GET ['item'],
            $_GET ['cantidad'],
            $_GET ['descripcion'],
            $_GET ['valor_unitario'],
            $_GET ['valor_total'],
            $_REQUEST ['tiempo']
        );
    }

    // ------------------

    $cadenaSql = $this->sql->getCadenaSql('insertarItem', $datos);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
    echo $resultadoItems;
    // ---------------------
}

if ($_REQUEST ['funcion'] == 'EliminarItem') {

    $cadenaSql = $this->sql->getCadenaSql('eliminarItem', $_GET ['id']);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");

    echo $resultadoItems;
}


$conexion2 = "sicapital";
$esteRecursoDB2 = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion2);

if ($_REQUEST ['funcion'] == 'proveedor') {
    $cadenaSql = $this->sql->getCadenaSql('select_proveedor', $_REQUEST['proveedor']);
    $resultadoItems = $esteRecursoDB2->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultadoItems[0]);
    echo $resultado;
}
?>