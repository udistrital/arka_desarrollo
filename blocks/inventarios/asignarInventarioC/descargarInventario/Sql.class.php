<?php

namespace inventarios\asignarInventarioC\descargarInventario;

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
                $cadenaSql.= " WHERE identificacion='" . $variable . "';";
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
                //$cadenaSql.= " AND documento_contratista = '" . $variable[1] . "' "; corregir si se va a activar
                break;

            case "consultarElementosContratista" :
                $cadenaSql = "SELECT nivel, unidad, cantidad, marca, serie, valor, subtotal_sin_iva, total_iva, total_iva_con, identificacion, ";
                $cadenaSql.= " elemento.id_elemento,contratista, id_asignacion  ";
                $cadenaSql.= " FROM asignar_elementos, elemento, salida, contratista_servicios ";
                $cadenaSql.= " WHERE elemento.estado=TRUE  ";
                $cadenaSql.= " AND cast(contratista_servicios.id_contratista as character varying)=cast(asignar_elementos.contratista as character varying) ";
                $cadenaSql.= " AND elemento.id_elemento=asignar_elementos.id_elemento  ";
                $cadenaSql.= " AND elemento.estado_asignacion=TRUE  ";
                $cadenaSql.= " AND salida.id_entrada=elemento.id_entrada  ";
                $cadenaSql.= " AND identificacion='" . $variable . "' ";
                $cadenaSql.= " AND asignar_elementos.estado='1'  ";
                $cadenaSql.= " ORDER BY nivel ASC  ";
                break;

            case "inactivarElemento" :
                $cadenaSql = "UPDATE elemento ";
                $cadenaSql.= " SET ";
                $cadenaSql.= " estado_asignacion = FALSE, ";
                $cadenaSql.= " fecha_asignacion ='" . $variable[2] . "'";
                $cadenaSql.= " WHERE id_elemento = '" . $variable[0] . "'; ";
                break;

            case "estadoPazSalvo":
                $cadenaSql = " INSERT INTO estado_pazsalvo( ";
                $cadenaSql.= " pz_contratista, pz_estado, pz_fecha) ";
                $cadenaSql.= " VALUES ( ";
                $cadenaSql.= " '" . $variable[0] . "',";
                $cadenaSql.= " '" . $variable[1] . "',";
                $cadenaSql.= " '" . $variable[2] . "')";
                break;
            
               case "inactivarAsignacion" :
                $cadenaSql = "UPDATE asignar_elementos ";
                $cadenaSql.= " SET ";
                $cadenaSql.= " estado = " . $variable[1] . ", ";
                $cadenaSql.= " fecha_registro ='" . $variable[2] . "'";
                $cadenaSql.= " WHERE id_elemento = '" . $variable[0] . "'; ";
                break;

            /*             * ***************** */
            
                       
            
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
                $cadenaSql = "SELECT CON_IDENTIFICACION,CON_IDENTIFICACION ||' '|| CON_NOMBRE ";
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
