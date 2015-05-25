<?php

namespace inventarios\cierreContable;

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
//**************** Para Compras *******************//
            case "registroDocumento_compra":
                $cadenaSql = " INSERT INTO documento_radicarasignar_compra( ";
                $cadenaSql .=" compra_idunico, ";
                $cadenaSql .=" compra_idcompra, ";
                $cadenaSql .=" compra_nombre, ";
                $cadenaSql .=" compra_tipodoc,  ";
                $cadenaSql .=" compra_ruta, ";
                $cadenaSql .=" compra_fechar, ";
                $cadenaSql .=" compra_estado) ";
                $cadenaSql .=" VALUES ( ";
                $cadenaSql .= "'" . $variable ['id_unico'] . "',";
                $cadenaSql .= "'" . $variable ['id_asignar'] . "',";
                $cadenaSql .= "'" . $variable ['nombre_archivo'] . "',";
                $cadenaSql .= "'" . $variable ['tipo'] . "',";
                $cadenaSql .= "'" . $variable ['ruta'] . "',";
                $cadenaSql .= "'" . $variable ['fecha_registro'] . "',";
                $cadenaSql .= "'" . $variable ['estado'] . "' ); ";
                break;

            case "actualizarDocumento_compra":
                $cadenaSql = " UPDATE documento_radicarasignar_compra ";
                $cadenaSql .=" SET compra_idunico='" . $variable ['id_unico'] . "', ";
                $cadenaSql .=" compra_idcompra='" . $variable ['id_asignar'] . "', ";
                $cadenaSql .=" compra_nombre='" . $variable ['nombre_archivo'] . "', ";
                $cadenaSql .=" compra_tipodoc='" . $variable ['tipo'] . "',  ";
                $cadenaSql .=" compra_ruta='" . $variable ['ruta'] . "', ";
                $cadenaSql .=" compra_fechar='" . $variable ['fecha_registro'] . "' ";
                $cadenaSql .= " WHERE  ";
                $cadenaSql.= " compra_idcompra='" . $variable ['id_asignar'] . "' ";
                $cadenaSql .= "RETURNING  compra_idcompra; ";
                break;

            case "registrarCierre":
                $cadenaSql = " INSERT INTO cierre_contable( ";
                $cadenaSql.= "vigencia_cierre, cierre_fecha_inicio, cierre_fecha_final,  ";
                $cadenaSql.= "aprobacion, cierre_observaciones, estado_registro, fecha_cierre) ";
                $cadenaSql.= "VALUES ( ";
                $cadenaSql.= " '" . $variable['vigencia'] . "',";
                $cadenaSql.= " '" . $variable['fecha_inicio'] . "',";
                $cadenaSql.= " '" . $variable['fecha_final'] . "',";
                $cadenaSql.= " '" . $variable['aprobacion'] . "',";
                $cadenaSql.= " '" . $variable['observaciones'] . "',";
                $cadenaSql.= " '" . $variable['estado'] . "',";
                $cadenaSql.= " '" . $variable['fechaRegistro'] . "')";
                break;

            case "actualizarEntrada":
                $cadenaSql = " UPDATE entrada ";
                $cadenaSql.= " SET cierre_contable='TRUE' ";
                $cadenaSql.= " AND fecha_registro BETWEEN CAST ( '" . $variable ['fecha_inicio'] . "' AS DATE) ";
                $cadenaSql.= " AND  CAST ( '" . $variable ['fecha_final'] . "' AS DATE)  ";

            case "vigencia":
                $cadenaSql = " SELECT DISTINCT vigencia, vigencia as nombrevigencia ";
                $cadenaSql.= "FROM entrada; ";
                break;
        }
        return $cadenaSql;
    }

}

?>
