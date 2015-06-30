<?php

namespace inventarios\gestionElementos\registrarFaltantesSobrantes;

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
            case "actualizacion_estado_elemento" :

                $cadenaSql = " UPDATE elemento_individual ";
                $cadenaSql .= "SET estado_elemento='" . $variable [1] . "' ";
                $cadenaSql .= " WHERE id_elemento_ind='" . $variable [0] . "';";

                break;

            case "max_estado_elemento" :

                $cadenaSql = "SELECT MAX(id_estado_elemento) ";
                $cadenaSql .= "FROM estado_elemento ";

                break;

            case "insertar_faltante_sobrante" :

                $cadenaSql = "INSERT INTO estado_elemento( ";
                $cadenaSql .= "id_elemento_ind,id_faltante, id_sobrante, id_hurto, observaciones,  ";
                $cadenaSql .= "ruta_denuncia, nombre_denuncia, fecha_denuncia, fecha_hurto, fecha_registro,tipo_faltsobr, id_estado_elemento) ";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'" . $variable [3] . "',";
                $cadenaSql .= "'" . $variable [4] . "',";
                $cadenaSql .= "'" . $variable [5] . "',";
                $cadenaSql .= "'" . $variable [6] . "',";
                $cadenaSql .= "'" . $variable [7] . "',";
                $cadenaSql .= "'" . $variable [8] . "',";
                $cadenaSql .= "'" . $variable [9] . "',";
                $cadenaSql .= "'" . $variable [10] . "',";
                $cadenaSql .= "'" . $variable [11] . "') ";
                $cadenaSql .= "RETURNING  id_faltante,id_sobrante,id_hurto,id_estado_elemento; ";

                break;

            case "id_sobrante" :
                $cadenaSql = " SELECT MAX(id_sobrante) ";
                $cadenaSql .= " FROM estado_elemento;";
                break;

            case "id_hurto" :
                $cadenaSql = " SELECT MAX(id_hurto) ";
                $cadenaSql .= " FROM estado_elemento;";
                break;

            case "id_faltante" :
                $cadenaSql = " SELECT MAX(id_faltante) ";
                $cadenaSql .= " FROM estado_elemento;";
                break;
            case "tipo_faltante" :
                $cadenaSql = " SELECT id_tipo_falt_sobr, descripcion ";
                $cadenaSql .= " FROM tipo_falt_sobr ";
                $cadenaSql .= " WHERE  id_tipo_falt_sobr < 4";
                break;

            // case "funcionarios" :
            // $cadenaSql = "SELECT JEF_IDENTIFICADOR,JEF_INDENTIFICACION ||' - '|| JEF_NOMBRE ";
            // $cadenaSql .= "FROM JEFES_DE_SECCION ";
            // break;

            case "dependencia" :

                $cadenaSql = " SELECT JEF_IDENTIFICADOR,JEF_DEPENDENCIA_PERTENECIENTE ";
                $cadenaSql .= " FROM JEFES_DE_SECCION ";

                break;

            case "seleccion_funcionario" :

                $cadenaSql = "SELECT id_funcionario, identificacion ||'-'||nombre AS funcionario  ";
                $cadenaSql .= "FROM funcionario;";
                break;

            case "seleccion_info_elemento" :

                $cadenaSql = "SELECT ";
                $cadenaSql .= "id_elemento_ind, elemento_individual.placa, elemento_individual.serie,funcionario, id_elemento_gen, ";
                $cadenaSql .= "salida.consecutivo||' - ('||salida.vigencia||')' salidas,tipo_bienes.descripcion ,salida.id_salida as salida, ";
                $cadenaSql .= ' "ESF_NOMBRE_ESPACIO" dependencia ';
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
                $cadenaSql .= "JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien  ";
                $cadenaSql.= ' JOIN arka_parametros.arka_espaciosfisicos ON arka_parametros.arka_espaciosfisicos."ESF_ID_ESPACIO"=dependencia ';
                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                // $cadenaSql .= "left JOIN dependencia ON dependencia.id_dependencia = funcionario.dependencia ";
                $cadenaSql .= "WHERE 1=1 ";
                $cadenaSql .= "AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND  id_elemento_ind= '" . $variable . "'";
                $cadenaSql .= " ; ";

                break;

            case "consultarElemento" :

                $cadenaSql = "SELECT * FROM ((SELECT elemento_individual.id_elemento_ind, elemento_individual.placa,";
                $cadenaSql .= " elemento_individual.serie,funcionario, id_elemento_gen, salida.consecutivo||' - ('||salida.vigencia||')' salidas ,";
                $cadenaSql .= ' tipo_bienes.descripcion ,"ESF_NOMBRE_ESPACIO" dependencia ,salida.id_salida as salida, ';
                $cadenaSql .= " '' descripcion_estado";
                $cadenaSql .= " FROM elemento_individual ";
                $cadenaSql .= " JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
                $cadenaSql .= " JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= ' JOIN arka_parametros.arka_espaciosfisicos ON arka_parametros.arka_espaciosfisicos."ESF_ID_ESPACIO"=dependencia ';
                $cadenaSql .= " WHERE 1=1 AND elemento.tipo_bien <> 1 )";
                $cadenaSql .= " UNION";
                $cadenaSql .= " (SELECT elemento_individual.id_elemento_ind, elemento_individual.placa,";
                $cadenaSql .= " elemento_individual.serie,funcionario, id_elemento_gen, salida.consecutivo||' - ('||salida.vigencia||')' salidas ,";
                $cadenaSql .= " tipo_bienes.descripcion ,dependencia ,salida.id_salida as salida,";
                $cadenaSql .= " tipo_falt_sobr.descripcion as descripcion_estado";
                $cadenaSql .= "  FROM elemento_individual ";
                $cadenaSql .= "  JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
                $cadenaSql .= "  JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= " JOIN estado_elemento on estado_elemento.id_elemento_ind=elemento_individual.id_elemento_ind";
                $cadenaSql .= " JOIN tipo_falt_sobr ON tipo_falt_sobr.id_tipo_falt_sobr=tipo_faltsobr";
                $cadenaSql .= ' JOIN arka_parametros.arka_espaciosfisicos ON arka_parametros.arka_espaciosfisicos."ESF_ID_ESPACIO"=dependencia ';
                $cadenaSql .= " WHERE 1=1 AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " )) consulta ";
                $cadenaSql .= " WHERE 1=1 ";

                if ($variable [0] != '') {
                    $cadenaSql .= " AND funcionario = '" . $variable [0] . "'";
                }
                if ($variable [1] != '') {
                    $cadenaSql .= " AND  serie= '" . $variable [1] . "'";
                }
                if ($variable [2] != '') {
                    $cadenaSql .= " AND  placa= '" . $variable [2] . "'";
                }
                if ($variable [3] != '') {
                    $cadenaSql .= " AND  dependencia= '" . $variable [3] . "'";
                }
                break;

            case "seleccion_funcionario_anterior" :

                $cadenaSql = "SELECT id_elemento_ind,identificacion ||'  -  '||nombre AS funcionario ,id_funcionario ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= "JOIN funcionario  ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql .= "WHERE  id_elemento_ind='" . $variable . "';";

                break;

            case "insertar_historico" :

                $cadenaSql = " INSERT INTO historial_elemento_individual( ";
                $cadenaSql .= "fecha_registro, elemento_individual, funcionario,descripcion_funcionario)  ";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'" . $variable [3] . "') ";
                $cadenaSql .= "RETURNING  id_evento; ";

                break;

            case "actualizar_salida" :

                $cadenaSql = " UPDATE salida ";
                $cadenaSql .= "SET funcionario='" . $variable [1] . "',";
                $cadenaSql .= " observaciones='" . $variable [2] . "' ";
                $cadenaSql .= " WHERE id_salida=(SELECT id_salida FROM elemento_individual WHERE id_elemento_ind='" . $variable [0] . "' ) ;";

                break;

            case "funcionarios" :

                $cadenaSql = "SELECT FUN_IDENTIFICACION, FUN_IDENTIFICACION ||' - '|| FUN_NOMBRE ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_ESTADO='A' ";

                break;
            case "funcionario_informacion" :

                $cadenaSql = "SELECT FUN_IDENTIFICACION,  FUN_NOMBRE  ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_ESTADO='A' ";

                break;

            case "dependencias" :
                $cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
                $cadenaSql .= " FROM ESPACIOS_FISICOS ";
                $cadenaSql .= " WHERE ESF_ID_SEDE='" . $variable . "' ";
                $cadenaSql .= " AND  ESF_ESTADO='A'";

                break;

            case "sede" :
                $cadenaSql = "SELECT DISTINCT  ESF_ID_SEDE, ESF_SEDE ";
                $cadenaSql .= " FROM ESPACIOS_FISICOS ";
                $cadenaSql .= " WHERE   ESF_ESTADO='A'";
                break;

            case "buscar_serie" :
                $cadenaSql = " SELECT DISTINCT serie, serie as series ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "WHERE  serie <> '' ";
                $cadenaSql .= "ORDER BY serie DESC ";

                break;

            case "buscar_placa" :
                $cadenaSql = " SELECT DISTINCT placa, placa as placas ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "ORDER BY placa DESC ";

                break;

            case "funcionario_informacion_consultada" :

                $cadenaSql = "SELECT FUN_IDENTIFICACION,  FUN_NOMBRE  ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_ESTADO='A' ";
                $cadenaSql .= "AND FUN_IDENTIFICACION='" . $variable . "' ";

                break;
        }
        return $cadenaSql;
    }

}

?>
