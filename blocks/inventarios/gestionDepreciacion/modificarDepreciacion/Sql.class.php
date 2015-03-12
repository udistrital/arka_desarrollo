<?php

namespace inventarios\gestionDepreciacion\modificarDepreciacion;

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

//-----------------------------** Cláusulas del caso de uso**----------------------------------//

            case "consultar_nivel_inventario" :
                $cadenaSql = "SELECT codigo,(codigo||' - '||nombre) AS nivel ";
                $cadenaSql .= "FROM catalogo_elemento ;";
                break;

            case "consultar_grupo_contable" :
                $cadenaSql = "SELECT grupo_numcuenta, (grupo_numcuenta||' - '||grupo_descripcion) as grupo,grupo_mesdepreciacion as meses_depreciar ";
                $cadenaSql.= " FROM grupo_contable  ";
                $cadenaSql.= " WHERE grupo_estado=TRUE";
                break;

            case "consultar_meses" :
                $cadenaSql = "SELECT grupo_mesdepreciacion ";
                $cadenaSql.= " FROM grupo_contable  ";
                $cadenaSql.= " WHERE grupo_estado=TRUE ";
                $cadenaSql.= " AND grupo_numcuenta='" . $variable . "'; ";
                break;

            case "consultarElementos_depreciados" :
                $cadenaSql = " SELECT dep_idelementogen, ";
                $cadenaSql.= " dep_grupocontable,  ";
                $cadenaSql.= " dep_meses,  ";
                $cadenaSql.= " dep_fechasalida,  ";
                $cadenaSql.= " dep_fechacorte,  ";
                $cadenaSql.= " dep_cantidad,  ";
                $cadenaSql.= " dep_precio, ";
                $cadenaSql.= " dep_libros ";
                $cadenaSql.= " FROM registro_depreciacion ";
                $cadenaSql.= " WHERE dep_estado = TRUE ";
                break;

            case "consultarElemento_especifico" :
                $cadenaSql = "SELECT ";
                $cadenaSql.= " dep_id, dep_idelementogen, dep_grupocontable as grupo_contable, ";
                $cadenaSql.= " dep_meses as meses_depreciar, ";
                $cadenaSql.= " dep_fechasalida as fechaSalida, ";
                $cadenaSql.= " dep_fechacorte as fechaCorte, ";
                $cadenaSql.= " dep_cantidad as cantidad, ";
                $cadenaSql.= " dep_precio as precio, ";
                $cadenaSql.= " dep_valorhistorico as valor_historico, ";
                $cadenaSql.= " dep_valorajustado as valor_ajustado, ";
                $cadenaSql.= " dep_cuota as cuota, ";
                $cadenaSql.= " dep_periodo as periodos_fecha, ";
                $cadenaSql.= " dep_depacumulada as depreciacion_acumulada, ";
                $cadenaSql.= " dep_circular56 as circular_56, ";
                $cadenaSql.= " dep_cuotainflacion as cuota_inflacion, ";
                $cadenaSql.= " dep_apicacumulada as api_acumulada, ";
                $cadenaSql.= " dep_circulardeprecia as circular_depreciacion, ";
                $cadenaSql.= " dep_libros as valor_libros";
                $cadenaSql.= " FROM registro_depreciacion ";
                $cadenaSql.= " WHERE dep_estado = TRUE";
                $cadenaSql.= " AND dep_idelementogen = '" . $variable . "'";
                break;

            case "registrarDepreciacion":
                $cadenaSql = " INSERT INTO registro_depreciacion( ";
                $cadenaSql.= " dep_idelementogen, ";
                $cadenaSql.= " dep_grupocontable, ";
                $cadenaSql.= " dep_meses, ";
                $cadenaSql.= " dep_fechasalida, ";
                $cadenaSql.= " dep_fechacorte, ";
                $cadenaSql.= " dep_cantidad, ";
                $cadenaSql.= " dep_precio, ";
                $cadenaSql.= " dep_valorhistorico, ";
                $cadenaSql.= " dep_valorajustado, ";
                $cadenaSql.= " dep_cuota, ";
                $cadenaSql.= " dep_periodo, ";
                $cadenaSql.= " dep_depacumulada, ";
                $cadenaSql.= " dep_circular56, ";
                $cadenaSql.= " dep_cuotainflacion, ";
                $cadenaSql.= " dep_apicacumulada, ";
                $cadenaSql.= " dep_circulardeprecia, ";
                $cadenaSql.= " dep_libros, ";
                $cadenaSql.= " dep_estado, ";
                $cadenaSql.= " dep_registro) ";
                $cadenaSql.= " VALUES ( ";
                $cadenaSql.= "'" . $variable['elemento_general'] . "', ";
                $cadenaSql.= "'" . $variable['grupo_contable'] . "', ";
                $cadenaSql.= "'" . $variable['meses_depreciar'] . "', ";
                $cadenaSql.= "'" . $variable['fechaSalida'] . "', ";
                $cadenaSql.= "'" . $variable['fechaCorte'] . "', ";
                $cadenaSql.= "'" . $variable['cantidad'] . "', ";
                $cadenaSql.= "'" . $variable['precio'] . "', ";
                $cadenaSql.= "'" . $variable['valor_historico'] . "', ";
                $cadenaSql.= "'" . $variable['valor_ajustado'] . "', ";
                $cadenaSql.= "'" . $variable['cuota'] . "', ";
                $cadenaSql.= "'" . $variable['periodos_fecha'] . "', ";
                $cadenaSql.= "'" . $variable['depreciacion_acumulada'] . "', ";
                $cadenaSql.= "'" . $variable['circular_56'] . "', ";
                $cadenaSql.= "'" . $variable['cuota_inflacion'] . "', ";
                $cadenaSql.= "'" . $variable['api_acumulada'] . "', ";
                $cadenaSql.= "'" . $variable['circular_depreciacion'] . "', ";
                $cadenaSql.= "'" . $variable['valor_libros'] . "', ";
                $cadenaSql.= "'" . $variable['estado'] . "', ";
                $cadenaSql.= "'" . $variable['fregistro'] . "' ) ";
                $cadenaSql.= ";
                        ";
                break;
            /*             * ***************** */
        }
        return $cadenaSql;
    }

}

?>
