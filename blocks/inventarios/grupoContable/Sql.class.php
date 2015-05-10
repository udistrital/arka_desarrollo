<?php

namespace arka\grupoContable;

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

/**
 * IMPORTANTE: Se recomienda que no se borren registros. Utilizar mecanismos para - independiente del motor de bases de datos,
 * poder realizar rollbacks gestionados por el aplicativo.
 */
class Sql extends \Sql {

    var $miConfigurador;

    function getCadenaSql($tipo, $variable = '') {

        /**
         * 1.
         * Revisar las variables para evitar SQL Injection
         */
        $prefijo = $this->miConfigurador->getVariableConfiguracion("prefijo");
        $idSesion = $this->miConfigurador->getVariableConfiguracion("id_sesion");

        switch ($tipo) {

            /**
             * Clausulas específicas
             */
            case 'insertarRegistro' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .= $prefijo . 'pagina ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'descripcion,';
                $cadenaSql .= 'modulo,';
                $cadenaSql .= 'nivel,';
                $cadenaSql .= 'parametro';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
                $cadenaSql .= '( ';
                $cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
                $cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
                $cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
                $cadenaSql .= ') ';
                break;

            case 'actualizarRegistro' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .= $prefijo . 'pagina ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'descripcion,';
                $cadenaSql .= 'modulo,';
                $cadenaSql .= 'nivel,';
                $cadenaSql .= 'parametro';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
                $cadenaSql .= '( ';
                $cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
                $cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
                $cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
                $cadenaSql .= ') ';
                break;

            case 'buscarRegistro' :

                $cadenaSql = 'SELECT ';
                $cadenaSql .= 'id_pagina as PAGINA, ';
                $cadenaSql .= 'nombre as NOMBRE, ';
                $cadenaSql .= 'descripcion as DESCRIPCION,';
                $cadenaSql .= 'modulo as MODULO,';
                $cadenaSql .= 'nivel as NIVEL,';
                $cadenaSql .= 'parametro as PARAMETRO ';
                $cadenaSql .= 'FROM ';
                $cadenaSql .= $prefijo . 'pagina ';
                $cadenaSql .= 'WHERE ';
                $cadenaSql .= 'nombre=\'' . $_REQUEST ['nombrePagina'] . '\' ';
                break;

            case 'borrarRegistro' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .= $prefijo . 'pagina ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'descripcion,';
                $cadenaSql .= 'modulo,';
                $cadenaSql .= 'nivel,';
                $cadenaSql .= 'parametro';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
                $cadenaSql .= '( ';
                $cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
                $cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
                $cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
                $cadenaSql .= ') ';
                break;

            //**** Consultas Específicas del Caso de Uso *****//

            case 'listarCatalogos':
                $cadenaSql = ' SELECT lista_id, lista_nombre, lista_fecha_creacion  FROM grupo.catalogo_lista ORDER BY 3 DESC ';
                break;

            case 'crearCatalogo':
                $cadenaSql = 'INSERT INTO grupo.catalogo_lista( lista_nombre) VALUES (';
                $cadenaSql .= "'" . $variable . "')";
                break;

            case "buscarCatalogo":
                $cadenaSql = " SELECT lista_id , lista_nombre , lista_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_lista ";
                $cadenaSql .= " WHERE lista_nombre = '" . $variable . "' ";
                break;

            case "buscarCatalogoId":
                $cadenaSql = " SELECT lista_id , lista_nombre , lista_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_lista ";
                $cadenaSql .= " WHERE lista_id = '" . $variable . "' ";
                break;

            case "eliminarCatalogo":
                $cadenaSql = "DELETE FROM grupo.catalogo_lista WHERE lista_id =" . $variable . " ";
                break;

            case "listarElementos":
                $cadenaSql = "SELECT elemento_id, elemento_padre, elemento_codigo, elemento_catalogo, ";
                $cadenaSql .= " elemento_nombre, elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_elemento ";
                break;

            case "listarElementosID":
                $cadenaSql = "SELECT elemento_id, elemento_padre, elemento_codigo, elemento_catalogo, ";
                $cadenaSql .= " elemento_nombre, elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_elemento ";
                $cadenaSql .= " WHERE elemento_catalogo=" . $variable;
                break;

            case "buscarUltimoIdCatalogo":
                $cadenaSql = "select max(lista_id) from grupo.catalogo_lista";
                break;

            case "cambiarNombreCatalogo":
                $cadenaSql = " UPDATE grupo.catalogo_lista ";
                $cadenaSql .= " SET lista_nombre='" . $variable[0] . "' ";
                $cadenaSql .= " WHERE lista_id=" . $variable[1] . " ";
                break;

            case "crearElementoCatalogo":
                $cadenaSql = " INSERT INTO grupo.catalogo_elemento( ";
                $cadenaSql .= " elemento_padre, elemento_codigo, elemento_catalogo, ";
                $cadenaSql .= " elemento_nombre)   VALUES ( ";
                $cadenaSql .= " '" . $variable['idPadre'] . "', ";
                $cadenaSql .= " '" . $variable['id'] . "', ";
                $cadenaSql .= " '" . $variable['idCatalogo'] . "', ";
                $cadenaSql .= " '" . $variable['nombreElemento'] . "')";
                $cadenaSql .= " RETURNING elemento_id;";
                break;

            case "crearElementoCatalogoDescripcion":
                $cadenaSql = " INSERT INTO grupo.grupo_descripcion( ";
                $cadenaSql.= "  grupo_id , ";
                $cadenaSql.= "  grupo_cuentasalida, ";
                $cadenaSql.= "  grupo_cuentaentrada, ";
                $cadenaSql.= "  grupo_depreciacion, ";
                $cadenaSql.= "  grupo_vidautil, ";
                $cadenaSql.= "  grupo_dcuentadebito, ";
                $cadenaSql.= "  grupo_dcuentacredito)  VALUES ( ";
                $cadenaSql .= " '" . $variable['idCuenta'] . "', ";
                $cadenaSql .= " '" . $variable['cuentasalida'] . "', ";
                $cadenaSql .= " '" . $variable['cuentaentrada'] . "', ";
                $cadenaSql .= " '" . $variable['depreciacion'] . "', ";
                $cadenaSql .= " '" . $variable['vidautil'] . "', ";
                $cadenaSql .= " '" . $variable['cuentacredito'] . "', ";
                $cadenaSql .= " '" . $variable['cuentadebito'] . "')";
                break;

            case "buscarElementoId":
                $cadenaSql = " select max(elemento_id) from grupo.catalogo_elemento ";
                break;

            case "buscarIdPadre":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_catalogo , elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_elemento ";
                $cadenaSql .= " WHERE elemento_codigo = " . $variable[0];
                $cadenaSql .= " AND elemento_catalogo =" . $variable[1] . " ";
                break;

            case "buscarIdElemento":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_catalogo , elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_elemento ";
                $cadenaSql .= " WHERE elemento_codigo = " . $variable[0] . " ";
                $cadenaSql .= " AND elemento_padre = " . $variable[1] . " ";
                $cadenaSql .= " AND elemento_catalogo =" . $variable[2] . " ";
                break;

            case "buscarNombreElementoNivel":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_catalogo , elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_elemento ";
                $cadenaSql .= " WHERE  ";
                $cadenaSql .= " elemento_padre = " . $variable[1] . " ";
                $cadenaSql .= " AND elemento_catalogo =" . $variable[2] . " ";
                $cadenaSql .= " AND elemento_nombre ='" . $variable[3] . "' ";
                break;

            
            //--- Consultas para los elementos ----//
            case "elementosNivel":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_catalogo , upper(elemento_nombre) as elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.catalogo_elemento ";
                $cadenaSql .= " WHERE elemento_catalogo =" . $variable[0] . " ";
                $cadenaSql .= " AND elemento_padre=" . $variable[1] . " ORDER BY elemento_codigo ";
                break;

            case "eliminarElementoCatalogo":
                $cadenaSql = " DELETE FROM grupo.catalogo_elemento WHERE elemento_id = " . $variable . " ";
                break;

            case "guardarEdicionElementoCatalogo":
                $cadenaSql = " UPDATE grupo.catalogo_elemento ";
                $cadenaSql .= " SET  elemento_padre=" . $variable[0] . ", ";
                $cadenaSql .= " elemento_codigo=" . $variable[1] . ", ";
                $cadenaSql .= " elemento_catalogo=" . $variable[2] . ", ";
                $cadenaSql .= " elemento_nombre='" . $variable[3] . "' ";
                $cadenaSql .= " WHERE elemento_id=" . $variable[4] . " ";
                break;
        }
        return $cadenaSql;
    }

}

?>
