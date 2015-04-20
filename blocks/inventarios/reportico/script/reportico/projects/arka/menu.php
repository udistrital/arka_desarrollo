<?php

$menu_title = 'Gestor Reportes';
$menu = array();

$dropdown_menu = array(
    array(
        "project" => "arka",
        "title" => "Gestión de Reportes",
        "items" => array(
            array("reportfile" => "consultarEntrada.xml", "title" => "Reporte Entrada de Almacén"),
            array("reportfile" => "reporteSalidaAlmacen.xml", "title" => "Reporte Salida de Almacén"),
	    array("reportfile" => "ordenCompra.xml", "title" => "Orden de Compra"),
	    array("reportfile" => "ordenServicio.xml", "title" => "Orden de Servicio"),
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
	    array("reportfile" => "consultarInventariosFuncionarios.xml", "title" => "Consultar Inventarios Funcionarios"),
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
      array(
        "project" => "arka",
        "title" => "Gestión Depreciación",
        "items" => array(
            array("reportfile" => "consultarDepreciacion_general.xml", "title" => "Consulta Depreciación General"),
            array("reportfile" => "consultarDepreciacion_grupo.xml", "title" => "Consulta Depreciación por Grupo Contable"),
            array("reportfile" => "consultarDepreciacion_elemento.xml", "title" => "Consulta Depreciación por Elemento"),
        )
    ),
        array(
        "project" => "arka",
        "title" => "Gestión Movimientos",
        "items" => array(
            array("reportfile" => "consultar_hurtos.xml", "title" => "Consulta Faltantes por Hurto"),
            array("reportfile" => "consultar_faltante.xml", "title" => "Consulta Faltantes Dependencia"),
            array("reportfile" => "consultar_sobrante.xml", "title" => "Consulta Sobrantes"),
            array("reportfile" => "consultar_baja.xml", "title" => "Consulta Bajas"),
        )
    ),
);
?>
