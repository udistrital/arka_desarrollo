<?php

namespace inventarios\gestionElementos\detalleElemento;

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

// Para evitar redefiniciones de clases el nombre de la clase del archivo sqle debe corresponder al nombre del bloque
// en camel case precedida por la palabra sql
class Sql extends \Sql {

    var $miConfigurador;

    function __construct() {
        $this->miConfigurador = \Configurador::singleton();
    }

    function getCadenaSql($tipo, $variable = "") {

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
            case "buscarUsuario" :
                $cadenaSql = "SELECT ";
                $cadenaSql .= "FECHA_CREACION, ";
                $cadenaSql .= "PRIMER_NOMBRE ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= "USUARIOS ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "`PRIMER_NOMBRE` ='" . $variable . "' ";
                break;

            case "insertarRegistro" :
                $cadenaSql = "INSERT INTO ";
                $cadenaSql .= $prefijo . "registradoConferencia ";
                $cadenaSql .= "( ";
                $cadenaSql .= "`idRegistrado`, ";
                $cadenaSql .= "`nombre`, ";
                $cadenaSql .= "`apellido`, ";
                $cadenaSql .= "`identificacion`, ";
                $cadenaSql .= "`codigo`, ";
                $cadenaSql .= "`correo`, ";
                $cadenaSql .= "`tipo`, ";
                $cadenaSql .= "`fecha` ";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";
                $cadenaSql .= "( ";
                $cadenaSql .= "NULL, ";
                $cadenaSql .= "'" . $variable ['nombre'] . "', ";
                $cadenaSql .= "'" . $variable ['apellido'] . "', ";
                $cadenaSql .= "'" . $variable ['identificacion'] . "', ";
                $cadenaSql .= "'" . $variable ['codigo'] . "', ";
                $cadenaSql .= "'" . $variable ['correo'] . "', ";
                $cadenaSql .= "'0', ";
                $cadenaSql .= "'" . time() . "' ";
                $cadenaSql .= ")";
                break;

            case "actualizarRegistro" :
                $cadenaSql = "UPDATE ";
                $cadenaSql .= $prefijo . "conductor ";
                $cadenaSql .= "SET ";
                $cadenaSql .= "`nombre` = '" . $variable ["nombre"] . "', ";
                $cadenaSql .= "`apellido` = '" . $variable ["apellido"] . "', ";
                $cadenaSql .= "`identificacion` = '" . $variable ["identificacion"] . "', ";
                $cadenaSql .= "`telefono` = '" . $variable ["telefono"] . "' ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "`idConductor` =" . $_REQUEST ["registro"] . " ";
                break;

            /**
             * Clausulas genéricas.
             * se espera que estén en todos los formularios
             * que utilicen esta plantilla
             */
            case "iniciarTransaccion" :
                $cadenaSql = "START TRANSACTION";
                break;

            case "finalizarTransaccion" :
                $cadenaSql = "COMMIT";
                break;

            case "cancelarTransaccion" :
                $cadenaSql = "ROLLBACK";
                break;

            case "eliminarTemp" :

                $cadenaSql = "DELETE ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "id_sesion = '" . $variable . "' ";
                break;

            case "insertarTemp" :
                $cadenaSql = "INSERT INTO ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "( ";
                $cadenaSql .= "id_sesion, ";
                $cadenaSql .= "formulario, ";
                $cadenaSql .= "campo, ";
                $cadenaSql .= "valor, ";
                $cadenaSql .= "fecha ";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";

                foreach ($_REQUEST as $clave => $valor) {
                    $cadenaSql .= "( ";
                    $cadenaSql .= "'" . $idSesion . "', ";
                    $cadenaSql .= "'" . $variable ['formulario'] . "', ";
                    $cadenaSql .= "'" . $clave . "', ";
                    $cadenaSql .= "'" . $valor . "', ";
                    $cadenaSql .= "'" . $variable ['fecha'] . "' ";
                    $cadenaSql .= "),";
                }

                $cadenaSql = substr($cadenaSql, 0, (strlen($cadenaSql) - 1));
                break;

            case "rescatarTemp" :
                $cadenaSql = "SELECT ";
                $cadenaSql .= "id_sesion, ";
                $cadenaSql .= "formulario, ";
                $cadenaSql .= "campo, ";
                $cadenaSql .= "valor, ";
                $cadenaSql .= "fecha ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "id_sesion='" . $idSesion . "'";
                break;

            /**
             * Clausulas Del Caso Uso.
             */
            case "buscar_placa" :
                $cadenaSql = " SELECT DISTINCT placa, placa as placas ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "ORDER BY placa DESC ";

                break;

            case "buscar_serie" :
                $cadenaSql = " SELECT DISTINCT serie, serie as series ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "WHERE  serie <> '' ";
                $cadenaSql .= "ORDER BY serie DESC ";

                break;

            case "consultarElemento" :

                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "placa,  ";
                $cadenaSql .= "elemento.serie, tipo_bienes.descripcion, elemento.fecha_registro as fecharegistro, id_elemento as idelemento, estado_entrada as estadoentrada, entrada.cierre_contable as cierrecontable ";
                $cadenaSql .= "FROM elemento ";
                $cadenaSql .= "JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= "JOIN entrada ON entrada.id_entrada = elemento.id_entrada ";
                $cadenaSql .= "JOIN elemento_individual ON elemento_individual.id_elemento_gen = elemento.id_elemento ";
                $cadenaSql .= "WHERE 1=1 AND estado='TRUE' ";
                if ($variable [0] != '') {
                    $cadenaSql .= " AND elemento.fecha_registro BETWEEN CAST ( '" . $variable [0] . "' AS DATE) ";
                    $cadenaSql .= " AND  CAST ( '" . $variable [1] . "' AS DATE)  ";
                }
                if ($variable [2] != '') {
                    $cadenaSql .= " AND elemento_individual.placa = '" . $variable [2] . "' ";
                }
                if ($variable [3] != '') {
                    $cadenaSql .= " AND  elemento.serie= '" . $variable [3] . "' ";
                }
// 				$cadenaSql .= "LIMIT 50000 ";

                break;

            case "consultarElementoParticular" :
                $cadenaSql = " SELECT DISTINCT ";
                $cadenaSql .= " placa, ";
                $cadenaSql .= " entrada.fecha_registro fecha_entrada, ";
                $cadenaSql .= " salida.fecha_registro fecha_salida, ";
                $cadenaSql .= " elemento_individual.serie, ";
                $cadenaSql .= " tipo_bienes.descripcion tipo_bien, ";
                $cadenaSql .= " catalogo.catalogo_elemento.elemento_nombre nivel, ";
                $cadenaSql .= " valor, ";
                $cadenaSql .= " CASE WHEN grupo_depreciacion=false THEN 'No Aplica' ELSE 'Si aplica' END as depreciacion, ";
                $cadenaSql .= " CASE WHEN grupo_depreciacion=false THEN 0 ELSE grupo_vidautil  END as vida_util, ";
                $cadenaSql .= " elemento_individual.funcionario as funcionario_actual, ";
                $cadenaSql .= 'arka_parametros.arka_funcionarios."FUN_NOMBRE" funcionario_actual_nombre, ';
                $cadenaSql .= 'arka_parametros.arka_dependencia."ESF_DEP_ENCARGADA" dependencia_actual';
                $cadenaSql .= " FROM arka_inventarios.elemento   ";
                $cadenaSql .= " JOIN arka_inventarios.elemento_individual ON arka_inventarios.elemento_individual.id_elemento_gen=arka_inventarios.elemento.id_elemento ";
                $cadenaSql .= " JOIN salida ON salida.id_salida=elemento_individual.id_salida ";
                $cadenaSql .= " JOIN entrada ON salida.id_entrada=entrada.id_entrada ";
                $cadenaSql .= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes=tipo_bien ";
                $cadenaSql .= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel ";
                $cadenaSql .= " JOIN grupo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_grupoc=cast(grupo.catalogo_elemento.elemento_codigo as character varying) ";
                $cadenaSql .= " JOIN grupo.grupo_descripcion ON grupo.grupo_descripcion.grupo_id=cast(grupo.catalogo_elemento.elemento_id as character varying) ";
                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios ON arka_parametros.arka_funcionarios."FUN_IDENTIFICACION"=elemento_individual.funcionario ';
                $cadenaSql .= ' JOIN arka_parametros.arka_dependencia ON substring(arka_parametros.arka_dependencia."ESF_CODIGO_DEP",4)=cast(arka_parametros.arka_funcionarios."FUN_DEP_COD_ACADEMICA" as character varying) ';
                $cadenaSql .= " WHERE 1=1 ";
                $cadenaSql .= ' AND arka_parametros.arka_dependencia."ESF_CODIGO_DEP" ';
                $cadenaSql .= " LIKE 'DEP%' ";
                $cadenaSql .= " AND elemento_individual.placa = '" . $variable . "'";
                break;

            case "consultar_tipo_bien" :

                $cadenaSql = "SELECT id_tipo_bienes, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.tipo_bienes;
            ";


                break;

            case "consultar_placa" :

                $cadenaSql = "SELECT MAX( placa) ";
                $cadenaSql .= "FROM elemento ";
                $cadenaSql .= "WHERE tipo_bien = '1';
            ";

                break;

            case "consultar_placa_actulizada" :
                $cadenaSql = " SELECT placa";
                $cadenaSql .= " FROM elemento ";
                $cadenaSql .= " WHERE id_elemento = '" . $variable . "'";

                break;

            case "estado_elemento" :

                $cadenaSql = " UPDATE ";
                $cadenaSql .= " elemento";
                $cadenaSql .= " SET ";
                $cadenaSql .= " estado = 'FALSE' ";
                $cadenaSql .= " WHERE id_elemento = '" . $variable . "';
            ";
                break;

            case "consultar_traslados" :

                $cadenaSql = " SELECT DISTINCT historial_elemento_individual.fecha_registro,";
                $cadenaSql .= " placa,";
                $cadenaSql .= ' arka_parametros.arka_dependencia."ESF_DEP_ENCARGADA" dependencia, ';
                $cadenaSql .= ' pasado."FUN_NOMBRE" as funcionario_anterior, ';
                $cadenaSql .= ' actual."FUN_NOMBRE" as funcionario_siguiente, ';
                $cadenaSql .= " historial_elemento_individual.observaciones observaciones_traslados ";
                $cadenaSql .= " FROM elemento_individual";
                $cadenaSql .= " JOIN elemento ON id_elemento_gen = elemento.id_elemento";
                $cadenaSql .= " JOIN historial_elemento_individual ON historial_elemento_individual.elemento_individual = elemento_individual.id_elemento_ind ";
                $cadenaSql .= " JOIN salida ON salida.id_salida = elemento_individual.id_salida";
                $cadenaSql .= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel";
                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios actual ON actual."FUN_IDENTIFICACION"=elemento_individual.funcionario ';
                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios pasado ON cast(pasado."FUN_IDENTIFICACION" as character varying)=historial_elemento_individual.descripcion_funcionario ';
                $cadenaSql .= ' JOIN arka_parametros.arka_dependencia ON arka_parametros.arka_dependencia."ESF_CODIGO_DEP"=salida.dependencia ';
                $cadenaSql .= " JOIN catalogo.catalogo_lista ON catalogo.catalogo_elemento.elemento_catalogo=catalogo.catalogo_lista.lista_id";
                $cadenaSql .= " WHERE elemento_individual.placa='" . $variable . "' ";
                $cadenaSql .= " ORDER BY historial_elemento_individual.fecha_registro ASC; ";
                break;

            case "consultar_estado":
                $cadenaSql = " SELECT  ";
                $cadenaSql .= " CASE WHEN id_faltante=0 THEN 'No registra faltante' ELSE 'Registra faltante' END faltante, ";
                $cadenaSql .= " CASE WHEN id_faltante=0 THEN '' ELSE cast(fecha_registro as character varying) END faltante_fecha, ";
                $cadenaSql .= " CASE WHEN id_sobrante=0 THEN 'No registra sobrante' ELSE 'Registra sobrante' END sobrante, ";
                $cadenaSql .= " CASE WHEN id_sobrante=0 THEN '' ELSE cast(fecha_registro as character varying) END sobrante_fecha, ";
                $cadenaSql .= " CASE WHEN id_hurto=0 THEN 'No registra hurto' ELSE 'Registra hurto' END hurto, ";
                $cadenaSql .= " CASE WHEN id_hurto=0 THEN '' ELSE cast(fecha_registro as character varying) END hurto_fecha ";
                $cadenaSql .= " FROM estado_elemento ";
                $cadenaSql .= " WHERE elemento_individual.placa='" . $variable . "' ";
                break;

            case "consultar_baja":
                $cadenaSql = " SELECT  ";
                $cadenaSql .= " CASE WHEN estado_registro=TRUE THEN 'Registra baja' ELSE 'No Registra baja' END baja, ";
                $cadenaSql .= " CASE WHEN estado_registro=TRUE THEN cast(fecha_registro as character varying) ELSE ''  END baja_fecha ";
                $cadenaSql .= " FROM baja_elemento ";
                $cadenaSql .= " WHERE estado_aprobacion=TRUE ";
                $cadenaSql .= " AND elemento_individual.placa='" . $variable . "' ";
                break;

//                 case "consultar_traslados" :
//
//                $cadenaSql = " SELECT DISTINCT historial_elemento_individual.fecha_registro,historial_elemento_individual.fecha_registro,";
//                $cadenaSql .= " placa,";
//                $cadenaSql .= ' arka_parametros.arka_dependencia."ESF_DEP_ENCARGADA" dependencia, ';
//                $cadenaSql .= ' pasado."FUN_NOMBRE" as funcionario_anterior, ';
//                $cadenaSql .= ' actual."FUN_NOMBRE" as funcionario_siguiente, ';
//                $cadenaSql .= " marca, ";
//                $cadenaSql .= " elemento_individual.serie,";
//                $cadenaSql .= " historial_elemento_individual.observaciones observaciones_traslados,";
//                $cadenaSql .= " elemento_nombre as nombre_nivel,";
//                $cadenaSql .= " salida.vigencia vigenciasalida,";
//                $cadenaSql .= " elemento.descripcion as descripcion_elemento";
//                $cadenaSql .= " FROM elemento_individual";
//                $cadenaSql .= " JOIN elemento ON id_elemento_gen = elemento.id_elemento";
//                $cadenaSql .= " JOIN historial_elemento_individual ON historial_elemento_individual.elemento_individual = elemento_individual.id_elemento_ind ";
//                $cadenaSql .= " JOIN salida ON salida.id_salida = elemento_individual.id_salida";
//                $cadenaSql .= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel";
//                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios actual ON actual."FUN_IDENTIFICACION"=elemento_individual.funcionario ';
//                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios pasado ON cast(pasado."FUN_IDENTIFICACION" as character varying)=historial_elemento_individual.descripcion_funcionario ';
//                $cadenaSql .= ' JOIN arka_parametros.arka_dependencia ON arka_parametros.arka_dependencia."ESF_CODIGO_DEP"=salida.dependencia ';
//                $cadenaSql .= " JOIN catalogo.catalogo_lista ON catalogo.catalogo_elemento.elemento_catalogo=catalogo.catalogo_lista.lista_id";
//                $cadenaSql .= " WHERE elemento_individual.id_elemento_ind='" . $variable . "' ";
//                $cadenaSql .= " ORDER BY historial_elemento_individual.fecha_registro ASC; ";
//                break;

            case "consultar_nivel_inventario" :

                $cadenaSql = "SELECT elemento_id, elemento_padre||''|| elemento_codigo||' - '||elemento_nombre ";
                $cadenaSql .= "FROM catalogo.catalogo_elemento ";
                $cadenaSql .= "WHERE elemento_catalogo = 1 ";
                $cadenaSql .= "ORDER BY elemento_id DESC;
                        ";

                break;
        }
        return $cadenaSql;
    }

}

?>
