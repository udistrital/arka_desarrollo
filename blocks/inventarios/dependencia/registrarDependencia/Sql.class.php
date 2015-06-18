<?php

namespace inventarios\dependencia\registrarDependencia;

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

            case "consultarOrden":
                $cadenaSql = " SELECT ";
                $cadenaSql .= " to_id,";
                $cadenaSql .= " to_nombre ";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.tipo_orden ";
                $cadenaSql .= " WHERE to_estado='1';";
                break;

            case "consultarOrdenCompra" :
                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "id_orden_compra, fecha_registro,  ";
                $cadenaSql .= "nit_proveedor, nombre  ";
                $cadenaSql .= "FROM orden_compra ";
                $cadenaSql .= "JOIN proveedor ON proveedor.id_proveedor = orden_compra.id_proveedor ";
                $cadenaSql .= "JOIN dependencia ON dependencia.id_dependencia = orden_compra.id_dependencia ";
                $cadenaSql .= "WHERE 1=1";
                if ($variable [0] != '') {
                    $cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [0] . "' AS DATE) ";
                    $cadenaSql .= " AND  CAST ( '" . $variable [1] . "' AS DATE)  ";
                }
                if ($variable [2] != '') {
                    $cadenaSql .= " AND id_orden_compra = '" . $variable [2] . "'";
                }

                // echo $cadenaSql;exit;
                break;

            case "consultarOrdenServicios" :
                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "id_orden_servicio, fecha_registro,  ";
                $cadenaSql .= "identificacion, dependencia  ";
                $cadenaSql .= "FROM orden_servicio ";
                $cadenaSql .= "JOIN solicitante_servicios ON solicitante_servicios.id_solicitante = orden_servicio.id_solicitante ";
                $cadenaSql .= "JOIN contratista_servicios ON contratista_servicios.id_contratista = orden_servicio.id_contratista ";
                $cadenaSql .= "WHERE 1=1";
                if ($variable [0] != '') {
                    $cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [0] . "' AS DATE) ";
                    $cadenaSql .= " AND  CAST ( '" . $variable [1] . "' AS DATE)  ";
                }
                if ($variable [2] != '') {
                    $cadenaSql .= " AND id_orden_servicio = '" . $variable [2] . "'";
                }
                // echo $cadenaSql;exit;
                break;

            case "consultarOrdenOtros" :

                $cadenaSql = "";
                // echo $cadenaSql;exit;
                break;

            case "tipoOrden":
                $cadenaSql = " SELECT ";
                $cadenaSql .= " to_id,";
                $cadenaSql .= " to_nombre ";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.tipo_orden ";
                $cadenaSql .= " WHERE to_estado='1';";
                break;

            case "tipoComprador":
                $cadenaSql = " SELECT ";
                $cadenaSql .= " tc_idcomprador,";
                $cadenaSql .= " tc_descripcion ";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.tipo_comprador ";
                $cadenaSql .= " WHERE tc_estado='1';";
                break;

            case "tipoAccion":
                $cadenaSql = " SELECT ";
                $cadenaSql .= " ta_idaccion,";
                $cadenaSql .= " ta_descripcion ";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.tipo_accion ";
                $cadenaSql .= " WHERE ta_estado='1';";
                break;

            case "tipoBien":
                $cadenaSql = " SELECT ";
                $cadenaSql .= " tb_idbien,";
                $cadenaSql .= " tb_descripcion ";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.tipo_bien ";
                $cadenaSql .= " WHERE tb_estado='1';";
                break;

//----------  Para registrar los items de la factura ------------//
            case "items" :
                $cadenaSql = " SELECT ";
                $cadenaSql .= " id_items,";
                $cadenaSql .= " item, ";
                $cadenaSql .= " cantidad, ";
                $cadenaSql .= " descripcion, ";
                $cadenaSql .= " valor_unitario, ";
                $cadenaSql .= " valor_total";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.items_actarecibido_temp ";
                $cadenaSql .= " WHERE seccion='" . $variable . "';";
                break;

            case "limpiar_tabla_items" :
                $cadenaSql = " DELETE FROM ";
                $cadenaSql .= " arka_inventarios.items_actarecibido_temp";
                $cadenaSql .= " WHERE seccion ='" . $variable . "';";
                break;

            case "insertarItem" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " arka_inventarios.items_actarecibido_temp(";
                $cadenaSql .= " id_items,item,cantidad, descripcion,";
                $cadenaSql .= " valor_unitario,valor_total,seccion)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'" . $variable [3] . "',";
                $cadenaSql .= "'" . $variable [4] . "',";
                $cadenaSql .= "'" . $variable [5] . "',";
                $cadenaSql .= "'" . $variable [6] . "');";
                break;

            case "eliminarItem" :
                $cadenaSql = " DELETE FROM ";
                $cadenaSql .= " arka_inventarios.items_actarecibido_temp";
                $cadenaSql .= " WHERE id_items ='" . $variable . "';";
                break;

            case "id_items_temporal" :
                $cadenaSql = " SELECT ";
                $cadenaSql .= " max(id_items)";
                $cadenaSql .= " FROM arka_inventarios.items_actarecibido_temp;";
                break;

            /*             * ***************** */
            case "insertarActa" :
                $cadenaSql = " INSERT INTO registro_actarecibido( ";
                $cadenaSql .= "dependencia,  ";
                $cadenaSql .= "fecha_recibido,  ";
                $cadenaSql .= "tipo_bien,  ";
                $cadenaSql .= "nitproveedor,  ";
                $cadenaSql .= "proveedor,  ";
                $cadenaSql .= "numfactura,  ";
                $cadenaSql .= "fecha_factura,  ";
                $cadenaSql .= "tipocomprador,  ";
                $cadenaSql .= "tipoaccion,  ";
                $cadenaSql .= "fecha_revision,  ";
                $cadenaSql .= "revisor,  ";
                $cadenaSql .= "observacionesacta,  ";
                $cadenaSql .= "estado_registro,  ";
                $cadenaSql .= "fecha_registro)";
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
                $cadenaSql .= "'" . $variable [11] . "',";
                $cadenaSql .= "'" . $variable [12] . "',";
                $cadenaSql .= "'" . $variable [1] . "') ";
                $cadenaSql .= "RETURNING  id_actarecibido; ";
                break;

            case "insertarItems" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " arka_inventarios.items_actarecibido(";
                $cadenaSql .= " id_acta, item,  descripcion,cantidad, ";
                $cadenaSql .= " valor_unitario, valor_total, estado_registro, fecha_registro)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'" . $variable [3] . "',";
                $cadenaSql .= "'" . $variable [4] . "',";
                $cadenaSql .= "'" . $variable [5] . "',";
                $cadenaSql .= "'1',";
                $cadenaSql .= "'" . date('Y-m-d') . "');";
                break;
            
            
            // Consultas de Oracle para rescate de información de Sicapital
            case "dependencias":
                $cadenaSql = "SELECT DEP_IDENTIFICADOR, ";
                $cadenaSql.= " DEP_IDENTIFICADOR ||' '|| DEP_DEPENDENCIA ";
                //$cadenaSql .= " DEP_DIRECCION,DEP_TELEFONO ";F
                $cadenaSql.= " FROM DEPENDENCIAS ";
                break;

            case "proveedores":
                $cadenaSql = "SELECT PRO_NIT,PRO_NIT ||' '|| PRO_RAZON_SOCIAL";
                $cadenaSql .= " FROM PROVEEDORES ";
                break;

            case "select_proveedor":
                $cadenaSql = "SELECT PRO_RAZON_SOCIAL";
                $cadenaSql .= " FROM PROVEEDORES ";
                $cadenaSql .= " WHERE PRO_NIT='" . $variable . "' ";
                break;

            case "contratistas":
                $cadenaSql = "SELECT CON_IDENTIFICACION ||' '|| CON_NOMBRE, ";
                /* $cadenaSql .= " CON_CARGO, ";
                  $cadenaSql .= " CON_DIRECCION, ";
                  $cadenaSql .= " CON_TELEFONO "; */
                $cadenaSql .= " FROM CONTRATISTAS ";
                break;
        }
        return $cadenaSql;
    }

}

?>
