<?php

namespace inventarios\gestionDocumento\radicacionDocumento;

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
            case "buscar_Proveedores" :
                $cadenaSql = " SELECT \"PRO_NIT\"||' - ('||\"PRO_RAZON_SOCIAL\"||')' AS  value,\"PRO_NIT\"  AS data  ";
                $cadenaSql .= " FROM arka_parametros.arka_proveedor  ";
                $cadenaSql .= "WHERE cast(\"PRO_NIT\" as text) LIKE '%" . $variable . "%' ";
                $cadenaSql .= "OR \"PRO_RAZON_SOCIAL\" LIKE '%" . $variable . "%' LIMIT 10; ";
                break;
            case "buscar_Nombre_Proveedor" :
                $cadenaSql = " SELECT \"PRO_NIT\"||' - ('||\"PRO_RAZON_SOCIAL\"||')' AS  value,\"PRO_NIT\"  AS data  ";
                $cadenaSql .= " FROM arka_parametros.arka_proveedor  ";
                $cadenaSql .= "WHERE cast(\"PRO_NIT\" as text) = '" . $variable . "' ";
                break;
            case "consultarNombreTipoDocumento" :
                $cadenaSql = " SELECT descripcion  ";
                $cadenaSql .= " FROM tipo_documento  ";
                $cadenaSql .= " WHERE id_tipo_documento =".$variable;
                break;
            case "consultarTipoDocumento" :
                $cadenaSql = " SELECT id_tipo_documento, descripcion  ";
                $cadenaSql .= " FROM tipo_documento  ";
                break;
            case "consultarRadicados" :
                $cadenaSql = " SELECT id_radicado, tipo_documento,td.descripcion, enlace_soporte, serial_documento, proveedor, ap.\"PRO_RAZON_SOCIAL\"  nombre_proveedor, radicado_documento.fecha_registro, nombre_soporte  ";
                $cadenaSql .= " FROM radicado_documento  ";
                $cadenaSql .= " JOIN arka_parametros.arka_proveedor as ap ON ap.\"PRO_NIT\"= CAST(radicado_documento.proveedor as character varying)  ";
                $cadenaSql .= " JOIN tipo_documento as td ON td.id_tipo_documento=tipo_documento ";
                $cadenaSql .= " WHERE 1=1  ";
                if (isset($variable ['proveedor']) && $variable ['proveedor'] != '') {
                    $cadenaSql .= " AND proveedor=" . $variable['proveedor'];
                }
                if (isset($variable ['tipoDocumento']) && $variable ['tipoDocumento'] != '') {
                    $cadenaSql .= " AND tipo_documento=" . $variable['tipoDocumento'];
                }
                if (isset($variable ['fecha_registro']) && $variable ['fecha_registro'] != '') {
                    $cadenaSql .= " AND extract(year from radicado_documento.fecha_registro)='" . $variable['fecha_registro'] . "' ";
                }
                if (isset($variable ['serial']) && $variable ['serial'] != '') {
                    $cadenaSql .= " AND serial_documento='" . $variable['serial'] . "' ";
                }
                if (isset($variable ['fecha_inicial']) && isset($variable ['fecha_final']) && $variable ['fecha_inicial'] != '' && $variable ['fecha_final'] != '') {
                    $cadenaSql .= " AND fecha_registro BETWEEN '" . $variable ['fecha_inicial'] . "' AND '" . $variable ['fecha_inicial'] . "'";
                }
                if (isset($variable ['id_radicado']) && $variable ['id_radicado'] != '') {
                    $cadenaSql .= " AND id_radicado=" . $variable['id_radicado'];
                }

                break;
            case "registrarRadicacion" :
                $cadenaSql = " INSERT INTO radicado_documento (";
                $cadenaSql .= " tipo_documento, ";
                $cadenaSql .= " enlace_soporte, ";
                $cadenaSql .= " nombre_soporte, ";
                $cadenaSql .= " serial_documento, ";
                $cadenaSql .= " proveedor, ";
                $cadenaSql .= " fecha_registro) ";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= $variable['tipoDocumento'] . ", ";
                $cadenaSql .= "'" . $variable['enlace'] . "', ";
                $cadenaSql .= "'" . $variable['nombre_enlace'] . "', ";
                $cadenaSql .= "'" . $variable['serial'] . "', ";
                $cadenaSql .= $variable['proveedor'] . ", ";
                $cadenaSql .= "'" . $variable['fecha_registro'] . "' ) RETURNING id_radicado; ";
                break;
            
            case "actualizarRadicacion" :
                $cadenaSql = " UPDATE radicado_documento SET ";
                $cadenaSql .= " tipo_documento=" . $variable['tipoDocumento'];
                if (isset($variable ['enlace']) && $variable ['enlace'] != '') {
                    $cadenaSql .= " ,enlace_soporte='" . $variable['enlace'] . "'";
                }
                if (isset($variable ['nombre_enlace']) && $variable ['nombre_enlace'] != '') {
                    $cadenaSql .= " ,nombre_soporte='" . $variable['nombre_enlace'] . "'";
                }
                $cadenaSql .= " ,serial_documento='" . $variable['serial']."' ";
                $cadenaSql .= " ,proveedor=" . $variable['proveedor'];
                 $cadenaSql .= " WHERE id_radicado=".$variable['id_radicado'];
                 $cadenaSql .= " RETURNING id_radicado";
             
                break;
        }
        return $cadenaSql;
    }

}

?>
