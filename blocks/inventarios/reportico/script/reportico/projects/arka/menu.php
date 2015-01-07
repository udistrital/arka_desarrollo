<?php

$menu_title = 'Gestor Reportes Sistema Gestión de Inventarios';
$menu = array();

$dropdown_menu = array(
    array(
        "project" => "arka",
        "title" => "Gestión de Reportes",
        "items" => array(
            array("reportfile" => "consultarEntrada.xml", "title" => "Reporte Entrada de Almacén"),
            array("reportfile" => "reporteSalidaAlmacen.xml", "title" => "Reporte Salida de Almacén"),
            array("reportfile" => "actaRecibido.xml", "title" => "Acta Recibido del Bien"),
            array("reportfile" => "consultarElemento.xml", "title" => "Consulte Elementos"),
            array("reportfile" => "contabilidadEntradas.xml", "title" => "Informe Contabilidad Entradas"),
            array("reportfile" => "contabilidadSalidas.xml", "title" => "Informe Contabilidad Salidas"),
        )
    ),
    array(
        "project" => "arka",
        "title" => "Gestión Asignación de Inventarios a Contratistas",
        "items" => array(
            array("reportfile" => "consultarInventariosContratistas.xml", "title" => "Consultar Inventarios de Contratistas"),
            array("reportfile" => "pazysalvo.xml", "title" => "Generar Paz y Salvo Contratistas"),
        )
    ),
    array(
        "project" => "arka",
        "title" => "Gestión Radicación de Documentos",
        "items" => array(
            array("reportfile" => "consultarRadicacion_avance.xml", "title" => "Consulta de Radicación por Avance"),
            array("reportfile" => "consultarRadicacion_compra.xml", "title" => "Consulta de Radicación por Compra"),
            array("reportfile" => "consultarRadicacion_contrato.xml", "title" => "Consulta de Radicación por Contrato"),
        )
    ),
);
?>
