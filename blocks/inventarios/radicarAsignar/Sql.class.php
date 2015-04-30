<?php

namespace inventarios\radicarAsignar;

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

            case "tipoCargue":
                $cadenaSql = " SELECT ";
                $cadenaSql .= " id_tipo,";
                $cadenaSql .= " descripcion ";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.tipo_contrato ";
                $cadenaSql .= " WHERE descripcion in('Avances', 'Contratos(ViceRectoria)', 'Orden Compras');";
                break;

            case "buscar_entradas":
                $cadenaSql = " SELECT id_entrada valor,id_entrada descripcion  ";
                $cadenaSql.= " FROM entrada; ";
                break;

            case "vigencia_entrada" :
                $cadenaSql = " SELECT DISTINCT vigencia, vigencia ";
                $cadenaSql.= " FROM entrada ";
                break;


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
                $cadenaSql .=" compra_fechar='" . $variable ['fecha_registro'] . "', ";
                $cadenaSql .= " WHERE compra_numeroentrada='" . $variable ['numero_entrada'] . "'  ";
                $cadenaSql .= " AND compra_vigencia= '" . $variable ['vigencia_entrada'] . "'";
                $cadenaSql .= " AND compra_estado='TRUE'";
                $cadenaSql .= "RETURNING  compra_idcompra; ";
                break;

            case "insertarAsignar_compra" :
                $cadenaSql = " INSERT INTO registro_radicarasignar_compra( ";
                $cadenaSql .= " compra_fecharecibido,  ";
                $cadenaSql .= " compra_numeroentrada,  ";
                $cadenaSql .= " compra_vigencia, ";
                $cadenaSql .= " compra_fechar,   ";
                $cadenaSql .= " compra_estado)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable ['fecha'] . "',";
                $cadenaSql .= "'" . $variable ['numero_entrada'] . "',";
                $cadenaSql .= "'" . $variable ['vigencia_entrada'] . "',";
                $cadenaSql .= "'" . $variable ['fecha'] . "',";
                $cadenaSql .= "'" . $variable ['estado'] . "') ";
                $cadenaSql .= "RETURNING  compra_idcompra; ";
                break;

            case "actualizarAsignar_compra" :
                $cadenaSql = " UPDATE registro_radicarasignar_compra ";
                $cadenaSql .= " SET compra_fecharecibido='" . $variable ['fecha'] . "',  ";
                $cadenaSql .= " compra_fechar='" . $variable ['fecha'] . "'   ";
                $cadenaSql .= " WHERE compra_numeroentrada='" . $variable ['numero_entrada'] . "'  ";
                $cadenaSql .= " AND compra_vigencia= '" . $variable ['vigencia_entrada'] . "'";
                $cadenaSql .= " AND compra_estado='TRUE'";
                $cadenaSql .= "RETURNING  compra_idcompra; ";
                break;

            case "consultarAsignar_compra" :
                $cadenaSql = " SELECT compra_numeroentrada,  ";
                $cadenaSql .= " compra_vigencia ";
                $cadenaSql .= " FROM registro_radicarasignar_compra ";
                $cadenaSql .= " WHERE compra_numeroentrada='" . $variable ['numero_entrada'] . "'  ";
                $cadenaSql .= " AND compra_vigencia= '" . $variable ['vigencia_entrada'] . "'";
                $cadenaSql .= " AND compra_estado='TRUE'";
                break;

            //----------  Para registrar los items de la factura ------------//
            case "items" :
                $cadenaSql = " SELECT ";
                $cadenaSql .= " id_items,";
                $cadenaSql .= " descripcion ";
                $cadenaSql .= " FROM ";
                $cadenaSql .= " arka_inventarios.items_radfactura_temp ";
                $cadenaSql .= " WHERE seccion='" . $variable . "';";
                break;

            case "limpiar_tabla_items" :
                $cadenaSql = " DELETE FROM ";
                $cadenaSql .= " arka_inventarios.items_radfactura_temp";
                $cadenaSql .= " WHERE seccion ='" . $variable . "';";
                break;

            case "insertarItem" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " arka_inventarios.items_radfactura_temp(";
                $cadenaSql .= " id_items,descripcion,seccion)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "');";
                break;

            case "eliminarItem" :
                $cadenaSql = " DELETE FROM ";
                $cadenaSql .= " arka_inventarios.items_radfactura_temp";
                $cadenaSql .= " WHERE id_items ='" . $variable . "';";
                break;

            case "id_items_temporal" :
                $cadenaSql = " SELECT ";
                $cadenaSql .= " max(id_items)";
                $cadenaSql .= " FROM arka_inventarios.items_radfactura_temp;";
                break;

            case "insertarItems" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " arka_inventarios.items_radfactura(";
                $cadenaSql .= " id_radicarasignar, item,  descripcion, estado_registro, fecha_registro)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'1',";
                $cadenaSql .= "'" . date('Y-m-d') . "');";
                break;

            //************** Para contratos ***************//
            case "registroDocumento_Contrato":
                $cadenaSql = " INSERT INTO documento_radicarasignar_contrato( ";
                $cadenaSql .=" contrato_idunico, ";
                $cadenaSql .=" contrato_idcontrato, ";
                $cadenaSql .=" contrato_nombre, ";
                $cadenaSql .=" contrato_tipodoc,  ";
                $cadenaSql .=" contrato_ruta, ";
                $cadenaSql .=" contrato_fechar, ";
                $cadenaSql .=" contrato_estado) ";
                $cadenaSql .=" VALUES ( ";
                $cadenaSql .= "'" . $variable ['id_unico'] . "',";
                $cadenaSql .= "'" . $variable ['id_asignar'] . "',";
                $cadenaSql .= "'" . $variable ['nombre_archivo'] . "',";
                $cadenaSql .= "'" . $variable ['tipo'] . "',";
                $cadenaSql .= "'" . $variable ['ruta'] . "',";
                $cadenaSql .= "'" . $variable ['fecha_registro'] . "',";
                $cadenaSql .= "'" . $variable ['estado'] . "' ); ";
                break;

            case "insertarAsignar_Contrato" :
                $cadenaSql = " INSERT INTO registro_radicarasignar_contrato( ";
                $cadenaSql .= " contrato_fecharecibido,  ";
                $cadenaSql .= " contrato_nitproveedor,  ";
                $cadenaSql .= " contrato_valorfactura, ";
                $cadenaSql .= " contrato_fechar,   ";
                $cadenaSql .= " contrato_estado)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'" . $variable [3] . "',";
                $cadenaSql .= "'" . $variable [4] . "') ";
                $cadenaSql .= "RETURNING  contrato_idcontrato; ";
                break;

            //----------  Para registrar los items de la factura ------------//

            case "insertarItems_contrato" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " arka_inventarios.items_radfacturacontrato(";
                $cadenaSql .= " id_radicarasignar, item,  descripcion, estado_registro, fecha_registro)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'1',";
                $cadenaSql .= "'" . date('Y-m-d') . "');";
                break;

            //************** Para Avances***************//
            case "registroDocumento_Avance":
                $cadenaSql = " INSERT INTO documento_radicarasignar_avance( ";
                $cadenaSql .=" avance_idunico, ";
                $cadenaSql .=" avance_idavance, ";
                $cadenaSql .=" avance_nombre, ";
                $cadenaSql .=" avance_tipodoc,  ";
                $cadenaSql .=" avance_ruta, ";
                $cadenaSql .=" avance_fechar, ";
                $cadenaSql .=" avance_estado) ";
                $cadenaSql .=" VALUES ( ";
                $cadenaSql .= "'" . $variable ['id_unico'] . "',";
                $cadenaSql .= "'" . $variable ['id_asignar'] . "',";
                $cadenaSql .= "'" . $variable ['nombre_archivo'] . "',";
                $cadenaSql .= "'" . $variable ['tipo'] . "',";
                $cadenaSql .= "'" . $variable ['ruta'] . "',";
                $cadenaSql .= "'" . $variable ['fecha_registro'] . "',";
                $cadenaSql .= "'" . $variable ['estado'] . "' ); ";
                break;

            case "actualizarDocumento_Avance":
                $cadenaSql = " UPDATE documento_radicarasignar_avance SET ";
                $cadenaSql .=" avance_idunico='" . $variable ['id_unico'] . "', ";
                $cadenaSql .=" avance_nombre='" . $variable ['nombre_archivo'] . "', ";
                $cadenaSql .=" avance_tipodoc='" . $variable ['tipo'] . "',  ";
                $cadenaSql .=" avance_ruta='" . $variable ['ruta'] . "', ";
                $cadenaSql .=" avance_fechar='" . $variable ['fecha_registro'] . "', ";
                $cadenaSql.= " WHERE ";
                $cadenaSql.= " avance_idavance='" . $variable ['id_asignar'] . "' ";
                break;

            case "insertarAsignar_Avance" :
                $cadenaSql = " INSERT INTO registro_radicarasignar_avance( ";
                $cadenaSql .= " avance_fecharecibido,  ";
                $cadenaSql .= " avance_numeroentrada,  ";
                $cadenaSql .= " avance_vigenciaentrada, ";
                $cadenaSql .= " avance_fechar,   ";
                $cadenaSql .= " avance_estado)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable ['fecha'] . "',";
                $cadenaSql .= "'" . $variable ['numero_entrada'] . "',";
                $cadenaSql .= "'" . $variable ['vigencia_entrada'] . "',";
                $cadenaSql .= "'" . $variable ['fecha'] . "',";
                $cadenaSql .= "'" . $variable ['estado'] . "') ";
                $cadenaSql .= "RETURNING  avance_idavance; ";
                break;

            case "actualizarAsignar_Avance" :
                $cadenaSql = " UPDATE registro_radicarasignar_avance ";
                $cadenaSql.= " SET avance_fecharecibido='" . $variable ['fecha'] . "',  ";
                $cadenaSql.= " avance_fechar='" . $variable ['fecha'] . "'   ";
                $cadenaSql.= " WHERE ";
                $cadenaSql.= " avance_numeroentrada='" . $variable ['numero_entrada'] . "' ";
                $cadenaSql.= " AND avance_vigenciaentrada='" . $variable ['vigencia_entrada'] . "' ";
                $cadenaSql.= " AND avance_estado='TRUE' ";
                $cadenaSql.= "RETURNING  avance_idavance; ";
                break;

            case "consultarAsignar_Avance" :
                $cadenaSql = "  SELECT ";
                $cadenaSql.= " avance_numeroentrada,  ";
                $cadenaSql.= " avance_vigenciaentrada, ";
                $cadenaSql.= " avance_estado";
                $cadenaSql.= " FROM registro_radicarasignar_avance ";
                $cadenaSql.= " WHERE ";
                $cadenaSql.= " avance_numeroentrada='" . $variable ['numero_entrada'] . "' ";
                $cadenaSql.= " AND avance_vigenciaentrada='" . $variable ['vigencia_entrada'] . "' ";
                $cadenaSql.= " AND avance_estado='TRUE' ";
                break;

            //----------  Para registrar los items de la factura ------------//

            case "insertarItems_avance" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " arka_inventarios.items_radfacturaavance(";
                $cadenaSql .= " id_radicarasignar, item,  descripcion, estado_registro, fecha_registro)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'1',";
                $cadenaSql .= "'" . date('Y-m-d') . "');";
                break;

            // Consultas de Oracle para rescate de información de Sicapital
            /* case "dependencias":
              $cadenaSql = "SELECT DEP_IDENTIFICADOR, ";
              $cadenaSql.= " DEP_IDENTIFICADOR ||' '|| DEP_DEPENDENCIA ";
              //$cadenaSql .= " DEP_DIRECCION,DEP_TELEFONO ";F
              $cadenaSql.= " FROM DEPENDENCIAS ";
              break; */

            case "dependencias":
                $cadenaSql = "SELECT elemento_codigo, elemento_codigo || ' -  ' || elemento_nombre ";
                $cadenaSql .= "FROM dependencia.catalogo_elemento; ";
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

            case "id_contrato":
                $cadenaSql = " SELECT id_contrato, id_contrato || ' - '|| numero_contrato ";
                $cadenaSql.= " FROM contratos; ";
                break;
        }
        return $cadenaSql;
    }

}

?>
