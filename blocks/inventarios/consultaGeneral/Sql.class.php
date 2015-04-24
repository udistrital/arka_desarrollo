<?php

namespace inventarios\consultaGeneral;

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

              case "rubros" :
                $cadenaSql = " SELECT RUB_IDENTIFICADOR, RUB_RUBRO ||' - '|| RUB_NOMBRE_RUBRO ";
                $cadenaSql .= " FROM RUBROS ";

                break;

            case "dependencia" :
                $cadenaSql = " SELECT DEP_IDENTIFICADOR, DEP_IDENTIFICADOR ||' - ' ||DEP_DEPENDENCIA  ";
                $cadenaSql .= "FROM DEPENDENCIAS ";
                break;

            case "clase_entrada";
                $cadenaSql = " SELECT id_clase, descripcion ";
                $cadenaSql .= "FROM clase_entrada; ";
                break;

            case "sede":
                $cadenaSql = " SELECT DISTINCT ESF_COD_SEDE,ESF_COD_SEDE || ' - ' ||ESF_SEDE ";
                $cadenaSql.="FROM ESPACIOS_FISICOS ";
                break;

            case 'seleccion_contratista' :
                $cadenaSql = " SELECT id_contratista, ";
                $cadenaSql .= "  identificacion||' - '|| nombre_razon_social contratista ";
                $cadenaSql .= "FROM contratista_servicios;";
                break;

            case "funcionarios":
                $cadenaSql = " SELECT FUN_IDENTIFICACION, FUN_IDENTIFICACION ||' - '|| FUN_NOMBRE ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                break;

            case "tipoConsulta":
                $cadenaSql = " SELECT id_tipo_consulta, descripcion ";
                $cadenaSql .= " FROM tipo_consulta ";
                $cadenaSql .= " WHERE estado_consulta='TRUE' ";
                break;

            case "buscar_entradas":
                $cadenaSql = " SELECT id_entrada valor,id_entrada descripcion  ";
                $cadenaSql.= " FROM entrada; ";
                break;

            case "vigencia_entrada" :
                $cadenaSql = " SELECT DISTINCT vigencia, vigencia ";
                $cadenaSql.= " FROM entrada ";
                break;

            case "buscar_salidas":
                $cadenaSql = " SELECT id_salida valor,id_salida descripcion  ";
                $cadenaSql.= " FROM salida; ";
                break;

            case "vigencia_salida" :
                $cadenaSql = " SELECT DISTINCT fecha, fecha ";
                $cadenaSql.= " FROM salida ";
                break;

            case "buscar_placa":
                $cadenaSql = " SELECT id_elemento_ind, placa FROM elemento_individual;";
                break;

            case "buscar_serie":
                $cadenaSql = " SELECT id_elemento_ind, serie FROM elemento_individual; ";
                break;

            case "buscar_bajas":
                $cadenaSql = " SELECT id_baja, id_elemento_ind ";
                $cadenaSql.= " FROM baja_elemento ";
                $cadenaSql.= " WHERE estado_registro='TRUE' ";
                break;

            case "buscar_traslado":
                $cadenaSql = " SELECT id_salida valor,id_salida descripcion  ";
                $cadenaSql.= " FROM salida; ";
                break;

            case "buscar_faltante":
                $cadenaSql = " SELECT id_elemento_ind, id_faltante ";
                $cadenaSql.= " FROM estado_elemento ";
                $cadenaSql.= " WHERE estado_registro='TRUE' ";
                $cadenaSql.= " AND tipo_faltsobr='3' ";
                $cadenaSql.= " AND id_faltante !='0' ";
                break;

            case "buscar_hurto":
                $cadenaSql = " SELECT id_elemento_ind,id_hurto ";
                $cadenaSql.= " FROM estado_elemento ";
                $cadenaSql.= " WHERE estado_registro='TRUE' ";
                $cadenaSql.= " AND tipo_faltsobr='2' ";
                $cadenaSql.= " AND id_hurto !='0' ";
                break;

            case "buscar_estadobaja":
                $cadenaSql = " SELECT id_estado, descripcion FROM estado_baja; ";
                break;

            case "proveedores" :
                $cadenaSql = " SELECT PRO_IDENTIFICADOR,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor ";
                $cadenaSql .= " FROM PROVEEDORES ";
                break;

            case "consultarEntrada" :
                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "id_entrada, fecha_registro,  ";
                $cadenaSql .= " descripcion,proveedor   ";
                $cadenaSql .= "FROM entrada ";
                $cadenaSql .= "JOIN clase_entrada ON clase_entrada.id_clase = entrada.clase_entrada ";
                // $cadenaSql .= "JOIN proveedor ON proveedor.id_proveedor = entrada.proveedor ";
                $cadenaSql .= "WHERE 1=1 ";
                if ($variable [0] != '') {
                    $cadenaSql .= " AND id_entrada = '" . $variable [0] . "'";
                }

                if ($variable [1] != '') {
                    $cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [1] . "' AS DATE) ";
                    $cadenaSql .= " AND  CAST ( '" . $variable [2] . "' AS DATE)  ";
                }

                if ($variable [3] != '') {
                    $cadenaSql .= " AND clase_entrada = '" . $variable [3] . "'";
                }
                if ($variable [4] != '') {
                    $cadenaSql .= " AND entrada.proveedor = '" . $variable [4] . "'";
                }

                break;

            case "estado_entrada" :
                $cadenaSql = " SELECT id_estado, descripcion ";
                $cadenaSql .= "FROM estado_entrada;";
                break;

            case "consultarEstadoEntradas" :
                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "id_entrada, fecha_registro,descripcion ";
                $cadenaSql .= ",estado_entrada ";
                $cadenaSql .= "FROM entrada ";
                $cadenaSql .= "JOIN clase_entrada ON clase_entrada.id_clase = entrada.clase_entrada ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= " id_entrada = '" . $variable . "';";
                break;
            // ____________________________________update___________________________________________

         
        }
        return $cadenaSql;
    }

}

?>
