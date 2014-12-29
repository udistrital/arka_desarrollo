<?php

namespace inventarios\asignarInventarioC\consultarAsignacion;

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

            case "consultarContratista":
                $cadenaSql = " SELECT id_contratista, identificacion ";
                $cadenaSql.= " FROM contratista_servicios ";
                $cadenaSql.= " ORDER BY id_contratista ASC ";
                break;

            case "consultarID":
                $cadenaSql = " SELECT id_contratista ";
                $cadenaSql.= " FROM contratista_servicios ";
                $cadenaSql.= " WHERE identificacion='" . $variable . "' ";
                break;

            case "consultarElementosSupervisor" :
                $cadenaSql = "SELECT  ";
                $cadenaSql.= " id_elemento,  ";
                $cadenaSql.= " nivel,  ";
                $cadenaSql.= " unidad, ";
                $cadenaSql.= " cantidad,  ";
                $cadenaSql.= " marca,  ";
                $cadenaSql.= " serie, ";
                $cadenaSql.= " valor, ";
                $cadenaSql.= " subtotal_sin_iva,  ";
                $cadenaSql.= " total_iva, ";
                $cadenaSql.= " total_iva_con, ";
                $cadenaSql.= " identificacion ";
                $cadenaSql.= " FROM elemento, salida ";
                $cadenaSql.= " JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql.= " WHERE elemento.estado=TRUE ";
                $cadenaSql.= " AND elemento.estado_asignacion=FALSE ";
                $cadenaSql.= " AND salida.id_entrada=elemento.id_entrada ";
                $cadenaSql.= " AND identificacion='" . $variable[0] . "' ";
                $cadenaSql.= " ORDER BY nivel ASC ";
                break;

            case "consultarElementosContratista" :
                $cadenaSql = "SELECT ";
                $cadenaSql.= " nivel,  ";
                $cadenaSql.= " unidad, ";
                $cadenaSql.= " cantidad,  ";
                $cadenaSql.= " marca,  ";
                $cadenaSql.= " serie, ";
                $cadenaSql.= " valor, ";
                $cadenaSql.= " subtotal_sin_iva,  ";
                $cadenaSql.= " total_iva, ";
                $cadenaSql.= " total_iva_con, ";
                $cadenaSql.= " identificacion, ";
                $cadenaSql.= " elemento.id_elemento,contratista ";
                $cadenaSql.= " FROM elemento, asignar_elementos, salida ";
                $cadenaSql.= " JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql.= " WHERE elemento.estado=TRUE ";
                $cadenaSql.= " AND elemento.id_elemento=asignar_elementos.id_elemento ";
                $cadenaSql.= " AND elemento.estado_asignacion=TRUE ";
                $cadenaSql.= " AND salida.id_entrada=elemento.id_entrada ";
                $cadenaSql.= " AND supervisor='" . $variable[0] . "' ";
                $cadenaSql.= " AND contratista='" . $variable[1] . "' ";
                $cadenaSql.= " ORDER BY nivel ASC ";
                break;

            case "asignarElemento" :
                $cadenaSql = "INSERT INTO asignar_elementos( ";
                $cadenaSql.= " supervisor, ";
                $cadenaSql.= " contratista, ";
                $cadenaSql.= " id_elemento, ";
                $cadenaSql.= " estado, ";
                $cadenaSql.= " fecha_registro) ";
                $cadenaSql.= " VALUES ( ";
                $cadenaSql.= " '" . $variable[0] . "', ";
                $cadenaSql.= " '" . $variable[1] . "', ";
                $cadenaSql.= " '" . $variable[2] . "', ";
                $cadenaSql.= " '" . $variable[3] . "', ";
                $cadenaSql.= " '" . $variable[4] . "'";
                $cadenaSql.= " ); ";
                break;

            case "inactivarElemento" :
                $cadenaSql = "UPDATE elemento";
                $cadenaSql.= " SET ";
                $cadenaSql.= " estado_asignacion= '" . $variable[1] . "', ";
                $cadenaSql.= " fecha_asignacion = '" . $variable[2] . "'";
                $cadenaSql.= " WHERE id_elemento = '" . $variable[0] . "'; ";
                break;

            case "asignarElemento_sup" :
                $cadenaSql = "UPDATE asignar_elementos ";
                $cadenaSql.= " SET ";
                $cadenaSql.= " estado='" . $variable[1] . "' ";
                //$cadenaSql.= " fecha_registro='" . $variable[2] . "', ";
                $cadenaSql.= " WHERE id_elemento= '" . $variable[0] . "'; ";
                break;

            case "inactivarElemento_sup" :
                $cadenaSql = "UPDATE elemento";
                $cadenaSql.= " SET ";
                $cadenaSql.= " estado_asignacion= '" . $variable[1] . "', ";
                $cadenaSql.= " fecha_asignacion = '" . $variable[2] . "'";
                $cadenaSql.= " WHERE id_elemento = '" . $variable[0] . "'; ";
                break;

            case "activarElemento" :
                $cadenaSql = "UPDATE elemento";
                $cadenaSql.= " SET ";
                $cadenaSql.= " estado_asignacion= '" . $variable[1] . "', ";
                $cadenaSql.= " fecha_asignacion = '" . $variable[2] . "'";
                $cadenaSql.= " WHERE id_elemento = '" . $variable[0] . "'; ";
                break;

            case "inactivarAsignacion" :
                $cadenaSql = "UPDATE asignar_elementos ";
                $cadenaSql.= " SET ";
                $cadenaSql.= " estado='" . $variable[1] . "' ";
                //$cadenaSql.= " fecha_registro='" . $variable[2] . "', ";
                $cadenaSql.= " WHERE id_elemento= '" . $variable[0] . "'; ";
                break;
        }
        return $cadenaSql;
    }

}

?>
