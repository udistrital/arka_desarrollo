<?php

namespace inventarios\gestionElementos\registrarBajas;

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
            case "seleccionar_muebles" :

                $cadenaSql = "SELECT id_tipo_mueble, descripcion ";
                $cadenaSql .= "FROM tipo_mueble;  ";

                break;

            case "seleccionar_estado_baja" :

                $cadenaSql = " SELECT id_estado, descripcion ";
                $cadenaSql .= "FROM estado_baja  ";
                $cadenaSql .= " WHERE id_estado <=2;";

                break;

            case "seleccionar_estado_servible" :

                $cadenaSql = "SELECT id_estado, descripcion ";
                $cadenaSql .= "FROM estado_baja  ";
                $cadenaSql .= " WHERE id_estado >2;";

                break;

            case "max_id_baja" :

                $cadenaSql = "SELECT MAX(id_baja) ";
                $cadenaSql .= "FROM baja_elemento ";

                break;

            case "insertar_baja" :

                $cadenaSql = "INSERT INTO baja_elemento( ";
                $cadenaSql .= "dependencia_funcionario,funcionario_dependencia,  ";
                $cadenaSql .= "ruta_radicacion, nombre_radicacion, observaciones, id_elemento_ind,fecha_registro,sede, ubicacion) ";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable ['dependencia'] . "',";
                $cadenaSql .= "'" . $variable ['funcionario'] . "',";
                $cadenaSql .= "'" . $variable ['ruta'] . "',";
                $cadenaSql .= "'" . $variable ['radicado'] . "',";
                $cadenaSql .= "'" . $variable ['observaciones'] . "',";
                $cadenaSql .= "'" . $variable ['id_elemento'] . "',";
                $cadenaSql .= "'" . $variable ['fecha'] . "',";
                $cadenaSql .= "'" . $variable ['sede'] . "',";
                $cadenaSql .= "'" . $variable ['ubicacion'] . "') ";
                $cadenaSql .= "RETURNING  id_baja; ";

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
                $cadenaSql .= " FROM tipo_falt_sobr;";
                break;

            case "funcionarios" :

                $cadenaSql = "SELECT FUN_IDENTIFICACION, FUN_IDENTIFICACION ||' - '|| FUN_NOMBRE ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_ESTADO='A' ";

                break;

            case "dependencias" :
                $cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
                $cadenaSql .= " FROM ESPACIOS_FISICOS ";
                $cadenaSql .= " WHERE ESF_ID_SEDE='" . $variable . "' ";
                $cadenaSql .= " AND  ESF_ESTADO='A'";

                break;

            case "dependenciasGenerales" :
                $cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
                $cadenaSql .= " FROM ESPACIOS_FISICOS ";
                $cadenaSql .= " WHERE  ESF_ESTADO='A'";

                break;

            case "sede" :
                $cadenaSql = "SELECT DISTINCT  ESF_ID_SEDE, ESF_SEDE ";
                $cadenaSql .= " FROM ESPACIOS_FISICOS ";
                $cadenaSql .= " WHERE   ESF_ESTADO='A'";

                break;

            case "dependencia" :

                $cadenaSql = " SELECT JEF_IDENTIFICADOR,JEF_DEPENDENCIA_PERTENECIENTE ";
                $cadenaSql .= " FROM JEFES_DE_SECCION ";

                break;

            case "dependencia_dep" :
                $cadenaSql = " SELECT DEP_IDENTIFICADOR, DEP_IDENTIFICADOR ||' - ' ||DEP_DEPENDENCIA  ";
                $cadenaSql .= "FROM DEPENDENCIAS ";
                break;

            case "seleccion_funcionario" :

                $cadenaSql = "SELECT id_funcionario, identificacion ||'-'||nombre AS funcionario  ";
                $cadenaSql .= "FROM funcionario;";
                break;

            case "seleccion_info_elemento" :

                $cadenaSql = "SELECT ";
                $cadenaSql .= "id_elemento_ind, elemento_individual.placa, elemento_individual.serie,funcionario, id_elemento_gen, ";
                $cadenaSql .= "salida.consecutivo||' - ('||salida.vigencia||')' salidas ,tipo_bienes.descripcion ,salida.id_salida as salida ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
                $cadenaSql .= "JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= "JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                // $cadenaSql .= "left JOIN dependencia ON dependencia.id_dependencia = funcionario.dependencia ";
                $cadenaSql .= "WHERE 1=1 ";
                $cadenaSql .= "AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND  id_elemento_ind= '" . $variable . "'";
                $cadenaSql .= " ; ";

                break;

            case "consultarElemento" :


                $cadenaSql = " SELECT elemento_individual.id_elemento_ind, elemento_individual.placa, elemento_individual.funcionario as funcionario_encargado, ";
                $cadenaSql.= ' arka_parametros.arka_funcionarios."FUN_NOMBRE" as fun_nombre, id_elemento_gen, ';
                $cadenaSql.= ' sedes."ESF_SEDE" sede, ';
                $cadenaSql.= ' dependencias."ESF_DEP_ENCARGADA" dependencia, ';
                $cadenaSql.= ' espacios."ESF_NOMBRE_ESPACIO" ubicacion, ';
//$cadenaSql.= "  tipo_bienes.descripcion, ";
                $cadenaSql.= " elemento_nombre, elemento.descripcion descripcion_elemento, marca, elemento.serie, cantidad, valor, iva, ajuste, total_iva_con, bodega,(elemento_individual.id_salida || '-('|| salida.vigencia || ')') salidas ";

                $cadenaSql.= " FROM elemento  ";
                $cadenaSql.= " JOIN entrada ON elemento.id_entrada=entrada.id_entrada  ";
                $cadenaSql.= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
//$cadenaSql.= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes=tipo_bien  ";
                $cadenaSql.= " JOIN elemento_individual ON elemento_individual.id_elemento_gen=elemento.id_elemento  ";
                $cadenaSql.= ' JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql.= ' JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql.= ' JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql.= " JOIN salida ON elemento_individual.id_salida=salida.id_salida ";
                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios ON arka_parametros.arka_funcionarios."FUN_IDENTIFICACION" = elemento_individual.funcionario ';
                $cadenaSql .= " WHERE elemento.estado='1'  AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND id_elemento_ind NOT IN (SELECT id_elemento_ind FROM baja_elemento) ";


                if ($variable ['funcionario'] != '') {
                    $cadenaSql .= " AND elemento_individual.funcionario = '" . $variable ['funcionario'] . "'";
                }
                if ($variable ['serie'] != '') {
                    $cadenaSql .= " AND  elemento_individual.serie= '" . $variable ['serie'] . "'";
                }
                if ($variable ['placa'] != '') {
                    $cadenaSql .= " AND  elemento_individual.placa= '" . $variable ['placa'] . "'";
                }
                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND dependencia."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }
                // $cadenaSql .= " LIMIT 10 ;";

                break;

            case "consultar_informacion":

                $cadenaSql = " SELECT elemento_individual.id_elemento_ind, elemento_individual.placa, elemento_individual.funcionario as funcionario_encargado, ";
                $cadenaSql.= ' arka_parametros.arka_funcionarios."FUN_NOMBRE" as fun_nombre, id_elemento_gen, ';
                $cadenaSql.= ' sedes."ESF_SEDE" sede, ';
                $cadenaSql.= ' dependencias."ESF_DEP_ENCARGADA" dependencia, ';
                $cadenaSql.= ' espacios."ESF_NOMBRE_ESPACIO" ubicacion, ';
                $cadenaSql.= ' sedes."ESF_ID_SEDE" cod_sede, ';
                $cadenaSql.= ' dependencias."ESF_CODIGO_DEP" cod_dependencia, ';
                $cadenaSql.= ' espacios."ESF_ID_ESPACIO" cod_ubicacion ';
//$cadenaSql.= "
                $cadenaSql.= " FROM elemento  ";
                $cadenaSql.= " JOIN entrada ON elemento.id_entrada=entrada.id_entrada  ";
                $cadenaSql.= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
//$cadenaSql.= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes=tipo_bien  ";
                $cadenaSql.= " JOIN elemento_individual ON elemento_individual.id_elemento_gen=elemento.id_elemento  ";
                $cadenaSql.= ' JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql.= ' JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql.= ' JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql.= " JOIN salida ON elemento_individual.id_salida=salida.id_salida ";
                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios ON arka_parametros.arka_funcionarios."FUN_IDENTIFICACION" = elemento_individual.funcionario ';
                $cadenaSql .= " WHERE elemento.estado='1'  AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND id_elemento_ind NOT IN (SELECT id_elemento_ind FROM baja_elemento) ";
                $cadenaSql .= " AND id_elemento_ind='" . $variable . "' ";
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

            case "actualizar_asignacion_funcionario" :
                $cadenaSql = " UPDATE elemento_individual ";
                $cadenaSql .= "SET funcionario='0' ";
                $cadenaSql .= " WHERE id_elemento_ind='" . $variable ['id_elemento'] . "' ;";
                break;
            
            case "actualizar_asignacion_contratista" :
                $cadenaSql = " UPDATE asignar_elementos ";
                $cadenaSql .= "SET estado='0' ";
                $cadenaSql .= " WHERE id_elemento='" . $variable ['id_elemento'] . "' ;";
                break;

            case "funcionario_informacion" :
                $cadenaSql = "SELECT FUN_IDENTIFICACION,  FUN_NOMBRE  ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_ESTADO='A' ";

                break;

            case "dependencias_encargada" :
                $cadenaSql = 'SELECT DISTINCT "ESF_CODIGO_DEP", "ESF_DEP_ENCARGADA" ';
                $cadenaSql .= " FROM arka_parametros.arka_dependencia as dependencia ";
                $cadenaSql .= ' JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=dependencia."ESF_ID_ESPACIO" ';
                $cadenaSql .= ' JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= ' WHERE 1=1 ';
                $cadenaSql.= ' AND "ESF_ID_SEDE"=';
                $cadenaSql.= "'" . $variable . "'";
                $cadenaSql.= ' AND  dependencia."ESF_ESTADO"=';
                $cadenaSql.= "'A'";
                break;

            case "funcionario_informacion_consultada" :

                $cadenaSql = "SELECT FUN_IDENTIFICACION,  FUN_NOMBRE  ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_ESTADO='A' ";
                $cadenaSql .= "AND FUN_IDENTIFICACION='" . $variable . "' ";

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
        }
        return $cadenaSql;
    }

}

?>
