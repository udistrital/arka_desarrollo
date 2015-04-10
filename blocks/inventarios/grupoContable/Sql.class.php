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

            case 'listarGrupos':
                $cadenaSql = ' SELECT lista_id, lista_nombre, lista_fecha_creacion  FROM grupo.grupo_lista ORDER BY 3 DESC ';
                break;

            case 'crearGrupo':
                $cadenaSql = 'INSERT INTO grupo.grupo_lista( lista_nombre) VALUES (';
                $cadenaSql .= "'" . $variable . "')";
                break;

            case "buscarGrupo":
                $cadenaSql = " SELECT lista_id , lista_nombre , lista_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_lista ";
                $cadenaSql .= " WHERE lista_nombre = '" . $variable . "' ";
                break;

            case "buscarGrupoId":
                $cadenaSql = " SELECT lista_id , lista_nombre , lista_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_lista ";
                $cadenaSql .= " WHERE lista_id = '" . $variable . "' ";
                break;

            case "eliminarGrupo":
                $cadenaSql = "DELETE FROM grupo.grupo_lista WHERE lista_id =" . $variable . " ";
                break;

            case "listarElementos":
                $cadenaSql = "SELECT elemento_id, elemento_padre, elemento_codigo, elemento_grupo, ";
                $cadenaSql .= " elemento_nombre, elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_elemento ";
                break;

            case "listarElementosID":
                $cadenaSql = "SELECT elemento_id, elemento_padre, elemento_codigo, elemento_grupo, ";
                $cadenaSql .= " elemento_nombre, elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_elemento ";
                $cadenaSql .= " WHERE elemento_grupo=" . $variable;
                break;

            case "buscarUltimoIdGrupo":
                $cadenaSql = "select max(lista_id) from grupo.grupo_lista";
                break;

            case "cambiarNombreGrupo":
                $cadenaSql = " UPDATE grupo.grupo_lista ";
                $cadenaSql .= " SET lista_nombre='" . $variable[0] . "' ";
                $cadenaSql .= " WHERE lista_id=" . $variable[1] . " ";

                break;

            case "crearElementoGrupo":

                $cadenaSql = " INSERT INTO grupo.grupo_elemento( ";
                $cadenaSql .= " elemento_padre, elemento_codigo, elemento_grupo, ";
                $cadenaSql .= " elemento_nombre)   VALUES ( ";
                $cadenaSql .= " " . $variable[0] . ", ";
                $cadenaSql .= " " . $variable[1] . ", ";
                $cadenaSql .= " " . $variable[2] . ", ";
                $cadenaSql .= " '" . $variable[3] . "')";
                break;

            case "buscarElementoId":
                $cadenaSql = " select max(elemento_id) from grupo.grupo_elemento ";
                break;

            case "buscarIdPadre":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_grupo , elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_elemento ";
                $cadenaSql .= " WHERE elemento_codigo = " . $variable[0];
                $cadenaSql .= " AND elemento_grupo =" . $variable[1] . " ";
                break;

            case "buscarIdElemento":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_grupo , elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_elemento ";
                $cadenaSql .= " WHERE elemento_codigo = " . $variable[0] . " ";
                $cadenaSql .= " AND elemento_padre = " . $variable[1] . " ";
                $cadenaSql .= " AND elemento_grupo =" . $variable[2] . " ";
                break;

            case "buscarNombreElementoNivel":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_grupo , elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_elemento ";
                $cadenaSql .= " WHERE  ";
                $cadenaSql .= " elemento_padre = " . $variable[1] . " ";
                $cadenaSql .= " AND elemento_grupo =" . $variable[2] . " ";
                $cadenaSql .= " AND elemento_nombre ='" . $variable[3] . "' ";
                break;

            case "elementosNivel":
                $cadenaSql = " SELECT elemento_id , elemento_padre , elemento_codigo, elemento_grupo , upper(elemento_nombre) as elemento_nombre , elemento_fecha_creacion ";
                $cadenaSql .= " FROM grupo.grupo_elemento ";
                $cadenaSql .= " WHERE elemento_grupo =" . $variable[0] . " ";
                $cadenaSql .= " AND elemento_padre=" . $variable[1] . " ORDER BY elemento_codigo ";
                break;

            case "eliminarElementoGrupo":
                $cadenaSql = " DELETE FROM grupo.grupo_elemento WHERE elemento_id = " . $variable . " ";
                break;

            case "guardarEdicionElementoGrupo":
                $cadenaSql = " UPDATE grupo.grupo_elemento ";
                $cadenaSql .= " SET  elemento_padre=" . $variable[0] . ", ";
                $cadenaSql .= " elemento_codigo=" . $variable[1] . ", ";
                $cadenaSql .= " elemento_grupo=" . $variable[2] . ", ";
                $cadenaSql .= " elemento_nombre='" . $variable[3] . "' ";
                $cadenaSql .= " WHERE elemento_id=" . $variable[4] . " ";
                break;
        }

        return $cadenaSql;
    }

}

?>