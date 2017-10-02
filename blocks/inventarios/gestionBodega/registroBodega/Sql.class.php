<?php

namespace inventarios\gestionBodega\registroBodega;

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

    function getCadenaSql($tipo, $variable = "", $auxiliar = "") {

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
            case "funcionarios" :
                $cadenaSql = "SELECT DISTINCT \"FUN_IDENTIFICACION\", \"FUN_IDENTIFICACION\" ||' - '||  \"FUN_NOMBRE\" ";
                $cadenaSql .= "FROM  arka_parametros.arka_funcionarios ";
                break;

            case "sede" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_ID_SEDE\", \"ESF_SEDE\" ";
                $cadenaSql .= " FROM arka_parametros.arka_sedes ";
                $cadenaSql .= " WHERE   \"ESF_ESTADO\"='A' ";
                $cadenaSql .= " AND    \"ESF_COD_SEDE\" >  0 ";
                break;

            case "dependencias" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_CODIGO_DEP\" , \"ESF_DEP_ENCARGADA\" ";
                $cadenaSql .= " FROM arka_parametros.arka_dependencia ad ";
                $cadenaSql .= " JOIN  arka_parametros.arka_espaciosfisicos ef ON  ef.\"ESF_ID_ESPACIO\"=ad.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " JOIN  arka_parametros.arka_sedes sa ON sa.\"ESF_COD_SEDE\"=ef.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " WHERE ad.\"ESF_ESTADO\"='A'";
                break;

            case "ubicaciones" :
                $cadenaSql = "SELECT DISTINCT  ef.\"ESF_ID_ESPACIO\" , ef.\"ESF_NOMBRE_ESPACIO\" ";
                $cadenaSql .= " FROM arka_parametros.arka_espaciosfisicos ef  ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia ad ON ad.\"ESF_ID_ESPACIO\"=ef.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " WHERE  ef.\"ESF_ESTADO\"='A'";
                break;



            case "consultarElementoBodega" :

                $cadenaSql = "   SELECT DISTINCT ON (entrada.consecutivo,entrada.vigencia) entrada.consecutivo as con,entrada.vigencia as vig,entrada.consecutivo||' - ('||entrada.vigencia||')' consecutivo, entrada.proveedor, pro.\"PRO_RAZON_SOCIAL\" nombre_proveedor, ";
                $cadenaSql .= " entrada.supervisor, fun.\"FUN_NOMBRE\" as nombre_supervisor, sedes.\"ESF_SEDE\" sede, dependencias.\"ESF_DEP_ENCARGADA\" dependencia ";
                $cadenaSql .= " FROM arka_inventarios.elemento  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.elemento_individual as eli ON eli.id_elemento_gen=elemento.id_elemento ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_CODIGO_DEP"=entrada.dependencia ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_ID_SEDE"=entrada.sede ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios as fun ON fun."FUN_IDENTIFICACION" = CAST(entrada.supervisor AS numeric) ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_proveedor as pro ON pro."PRO_NIT" = CAST(entrada.proveedor AS character varying) ';
                $cadenaSql .= ' LEFT JOIN arka_inventarios.estado_elemento ON arka_inventarios.estado_elemento.id_elemento_ind=eli.id_elemento_ind ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_falt_sobr ON tipo_falt_sobr.id_tipo_falt_sobr=estado_elemento.tipo_faltsobr ";
                $cadenaSql .= " WHERE elemento.estado='TRUE' AND elemento.tipo_bien = 1 ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3)) ";
                $cadenaSql .= " AND entrada.vigencia >= CAST((extract(year from now()))-1 as character varying) ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.baja_elemento) ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.bodega_elemento) ";

                if (isset($variable ['funcionario']) && $variable ['funcionario'] != '') {
                    $cadenaSql .= " AND entrada.supervisor = '" . $variable ['funcionario'] . "'";
                }
                if (isset($variable ['sede']) && $variable ['sede'] != '') {
                    $cadenaSql .= ' AND sedes."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if (isset($variable ['dependencia']) && $variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND dependencias."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }

                if (isset($variable ['numeroEntrada']) && $variable ['numeroEntrada'] != '') {
                    $cadenaSql .= " AND  entrada.consecutivo= " . $variable ['numeroEntrada'] ;
                }
                if (isset($variable ['numeroVigencia'])) {
                    if ($variable ['numeroVigencia'] != '') {
                        $cadenaSql .= " AND  entrada.vigencia= '" . $variable ['numeroVigencia'] . "'";
                    }
                }

                if (isset($variable ['proveedor']) && $variable ['proveedor'] != '') {
                    $cadenaSql .= " AND  entrada.proveedor= '" . $variable ['proveedor'] . "'";
                }
                $cadenaSql .= ' GROUP BY con, vig , consecutivo, proveedor, entrada.supervisor, nombre_supervisor, sedes."ESF_SEDE", dependencias."ESF_DEP_ENCARGADA", pro."PRO_RAZON_SOCIAL" ';
             
                
                break;
            case "consultarElementoIdBodega" :

                $cadenaSql = " SELECT DISTINCT ON (entrada.consecutivo,entrada.vigencia,elemento.id_elemento) entrada.consecutivo as con,entrada.vigencia as vig,entrada.consecutivo||' - ('||entrada.vigencia||')' consecutivo, ";
                $cadenaSql .= " entrada.proveedor, elemento.descripcion,elemento.id_elemento, eli.id_elemento_ind,eli.serie||' - ('||elemento.marca||')' info_elemento, ";
                $cadenaSql .= " entrada.supervisor, fun.\"FUN_NOMBRE\" as nombre_supervisor, elemento.valor, sedes.\"ESF_SEDE\" sede, dependencias.\"ESF_DEP_ENCARGADA\" dependencia";
                $cadenaSql .= " FROM arka_inventarios.elemento  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.elemento_individual as eli ON eli.id_elemento_gen=elemento.id_elemento ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_CODIGO_DEP"=entrada.dependencia ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_ID_SEDE"=entrada.sede ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios as fun ON fun."FUN_IDENTIFICACION" = CAST(entrada.supervisor AS numeric) ';
                $cadenaSql .= ' LEFT JOIN arka_inventarios.estado_elemento ON arka_inventarios.estado_elemento.id_elemento_ind=eli.id_elemento_ind ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_falt_sobr ON tipo_falt_sobr.id_tipo_falt_sobr=estado_elemento.tipo_faltsobr ";
                $cadenaSql .= " WHERE elemento.estado='TRUE' AND elemento.tipo_bien = 1 ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3)) ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.baja_elemento) ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.bodega_elemento) ";

                if ($variable != '') {
                    $cadenaSql .= ' AND elemento.id_elemento = ';
                    $cadenaSql .= $variable;
                }
                break;


            case "consultarProveedor" :
                $cadenaSql = "SELECT \"PRO_RAZON_SOCIAL\"";
                $cadenaSql .= " FROM arka_parametros.arka_proveedor ";
                $cadenaSql .= " WHERE  \"PRO_NIT\"='" . $variable . "'";
                break;

            case "sedesConsultadas" :
                $cadenaSql = "SELECT DISTINCT  sas.\"ESF_ID_SEDE\" , sas.\"ESF_SEDE\" ";
                $cadenaSql .= " FROM elemento_individual eli ";
                $cadenaSql .= " JOIN arka_parametros.arka_funcionarios fun ON fun.\"FUN_IDENTIFICACION\"=eli.funcionario ";
                $cadenaSql .= " JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " JOIN arka_inventarios.elemento as ele ON ele.id_elemento=eli.id_elemento_gen  ";
                $cadenaSql .= "  WHERE fun.\"FUN_IDENTIFICACION\"=" . $variable . " AND ele.tipo_bien=1 ";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A' ORDER BY sas.\"ESF_SEDE\"";
                break;

            case "dependenciasConsultadas" :
                $cadenaSql = "SELECT DISTINCT  ad.\"ESF_CODIGO_DEP\" , ad.\"ESF_DEP_ENCARGADA\"";
                $cadenaSql .= " FROM elemento_individual eli  ";
                $cadenaSql .= " JOIN arka_parametros.arka_funcionarios fun ON fun.\"FUN_IDENTIFICACION\"=eli.funcionario ";
                $cadenaSql .= " JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " JOIN arka_inventarios.elemento as ele ON ele.id_elemento=eli.id_elemento_gen  ";
                $cadenaSql .= " WHERE sas.\"ESF_ID_SEDE\"='" . $variable['valor'] . "'";
                if ($variable['funcionario'] != null || $variable['funcionario'] != '') {
                    $cadenaSql .= " AND fun.\"FUN_IDENTIFICACION\"=" . $variable['funcionario'] . " ";
                }

                $cadenaSql .= "AND ele.tipo_bien=1";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A' ORDER BY ad.\"ESF_DEP_ENCARGADA\" ";
                break;

            case "UbicacionesConsultadas" :
                $cadenaSql = "SELECT DISTINCT  espacios.\"ESF_ID_ESPACIO\" , espacios.\"ESF_NOMBRE_ESPACIO\"";
                $cadenaSql .= " FROM elemento_individual eli  ";
                $cadenaSql .= " JOIN arka_parametros.arka_funcionarios fun ON fun.\"FUN_IDENTIFICACION\"=eli.funcionario ";
                $cadenaSql .= " JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " JOIN arka_inventarios.elemento as ele ON ele.id_elemento=eli.id_elemento_gen  ";
                $cadenaSql .= " WHERE ad.\"ESF_CODIGO_DEP\"='" . $variable['dependencia'] . "' ";
                if ($variable['funcionario'] != null || $variable['funcionario'] != '') {
                    $cadenaSql .= " AND fun.\"FUN_IDENTIFICACION\"=" . $variable['funcionario'] . "";
                }
                $cadenaSql .= "  AND ele.tipo_bien=1";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A' ORDER BY espacios.\"ESF_NOMBRE_ESPACIO\" ";
                break;

            case "buscar_entradas" :
                $cadenaSql = " SELECT DISTINCT ON (entrada.consecutivo,entrada.vigencia) entrada.consecutivo as valor, entrada.consecutivo||' - ('||entrada.vigencia||')' descripcion_entrada  ";
                $cadenaSql .= " FROM arka_inventarios.elemento ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.elemento_individual as eli ON eli.id_elemento_gen=elemento.id_elemento ";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_dependencia as dependencias ON dependencias.\"ESF_CODIGO_DEP\"=entrada.dependencia ";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_sedes as sedes ON sedes.\"ESF_ID_SEDE\"=entrada.sede";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_funcionarios as fun ON fun.\"FUN_IDENTIFICACION\" = CAST(entrada.supervisor AS numeric)  ";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_proveedor as pro ON pro.\"PRO_NIT\" = CAST(entrada.proveedor AS character varying)  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.estado_elemento ON arka_inventarios.estado_elemento.id_elemento_ind=eli.id_elemento_ind";
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_falt_sobr ON tipo_falt_sobr.id_tipo_falt_sobr=estado_elemento.tipo_faltsobr ";
                $cadenaSql .= " WHERE elemento.estado='TRUE' AND elemento.tipo_bien = 1 AND eli.id_elemento_ind ";
                $cadenaSql .= " NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3)) AND entrada.vigencia >= CAST((extract(year from now()))-1 as character varying) ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.baja_elemento) AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.bodega_elemento) ";
                $cadenaSql .= " GROUP BY entrada.consecutivo,entrada.vigencia,descripcion_entrada ";

                break;

            case "buscar_Proveedores" :
                $cadenaSql = " SELECT \"PRO_NIT\"||' - ('||\"PRO_RAZON_SOCIAL\"||')' AS  value,\"PRO_NIT\"  AS data  ";
                $cadenaSql .= " FROM arka_parametros.arka_proveedor  ";
                $cadenaSql .= "WHERE cast(\"PRO_NIT\" as text) LIKE '%" . $variable . "%' ";
                $cadenaSql .= "OR \"PRO_RAZON_SOCIAL\" LIKE '%" . $variable . "%' LIMIT 10; ";
                break;

            case "consultarElementos" :
                $cadenaSql = " SELECT DISTINCT ON (entrada.consecutivo,entrada.vigencia,elemento.id_elemento) entrada.consecutivo as con,entrada.vigencia as vig, ";
                $cadenaSql .= " elemento.id_elemento, eli.id_elemento_ind ";
                $cadenaSql .= " FROM arka_inventarios.elemento  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.elemento_individual as eli ON eli.id_elemento_gen=elemento.id_elemento ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_CODIGO_DEP"=entrada.dependencia ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_ID_SEDE"=entrada.sede ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios as fun ON fun."FUN_IDENTIFICACION" = CAST(entrada.supervisor AS numeric) ';
                $cadenaSql .= ' LEFT JOIN arka_inventarios.estado_elemento ON arka_inventarios.estado_elemento.id_elemento_ind=eli.id_elemento_ind ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_falt_sobr ON tipo_falt_sobr.id_tipo_falt_sobr=estado_elemento.tipo_faltsobr ";
                $cadenaSql .= " WHERE elemento.estado='TRUE' AND elemento.tipo_bien = 1 ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3)) ";
                $cadenaSql .= " AND entrada.vigencia >= CAST((extract(year from now()))-1 as character varying) ";   
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.baja_elemento) ";
                $cadenaSql .= " AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.bodega_elemento) ";

                if ($variable ['entrada'] != '') {
                    $cadenaSql .= " AND entrada.consecutivo = " . $variable ['entrada'] ;
                }

                if ($variable ['vigencia'] != '') {
                    $cadenaSql .= ' AND entrada.vigencia = ';
                    $cadenaSql .= " '" . $variable ['vigencia'] . "' ";
                }

              
                break;
            
            case "consultarElementosIndividuales" :
                $cadenaSql = " SELECT id_elemento_ind, cantidad_asignada  ";
                $cadenaSql .= " FROM arka_inventarios.elemento_individual  ";
                $cadenaSql .= "WHERE id_elemento_gen=" . $variable;
                break;

            case "insertarElementosBodega" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " arka_inventarios.bodega_elemento ";
                $cadenaSql .= "( ";
                $cadenaSql .= "id_elemento_ind, ";
                $cadenaSql .= "id_elemento_gen, ";
                $cadenaSql .= "cantidad, ";
                $cadenaSql .= "fecha_registro, ";
                $cadenaSql .= "cantidad_inicial, ";
                $cadenaSql .= "usuario";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";
                $contador = 0;
                while ($contador < (count($auxiliar))) {
                    $cadenaSql .= "( ";
                    $cadenaSql .= $auxiliar[$contador][0] . ", ";
                    $cadenaSql .= $variable['id_elemento'] . ", ";
                    $cadenaSql .= $auxiliar[$contador][1] . ", ";
                    $cadenaSql .= "'" . $variable ['fecha'] . "', ";
                    $cadenaSql .= $auxiliar[$contador][1] . ", ";
                    $cadenaSql .= "'" . $variable ['usuario'] . "' ";
                    if (count($auxiliar) == 1 || ($contador == (count($auxiliar) - 1))) {
                        $cadenaSql .= ")";
                    } else {
                        $cadenaSql .= ") , ";
                    }
                    $contador++;
                }

                break;




            /////////////////////////////////////////////////////////////////////////////////////////////////////

            case "dependencia" :
                $cadenaSql = " SELECT JEF_IDENTIFICADOR,JEF_DEPENDENCIA_PERTENECIENTE ";
                $cadenaSql .= " FROM JEFES_DE_SECCION ";
                break;

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
            case "buscar_tipo_baja" :
                $cadenaSql = "SELECT  id_tipo_baja, descripcion ";
                $cadenaSql .= " FROM tipo_baja ;";

                break;




            case "seleccionar_muebles" :

                $cadenaSql = "SELECT id_tipo_mueble, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.tipo_mueble;  ";

                break;

            case "seleccionar_estado_baja" :

                $cadenaSql = " SELECT id_estado, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.estado_baja  ";
                $cadenaSql .= " WHERE id_estado <=2;";

                break;

            case "seleccionar_estado_servible" :

                $cadenaSql = "SELECT id_estado, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.estado_baja  ";
                $cadenaSql .= " WHERE id_estado >2;";

                break;

            case "max_id_baja" :

                $cadenaSql = "SELECT MAX(id_baja) ";
                $cadenaSql .= "FROM arka_inventarios.baja_elemento ";

                break;

            case "insertar_baja" :

                $cadenaSql = "INSERT INTO arka_inventarios.baja_elemento( ";
                $cadenaSql .= "dependencia_funcionario,funcionario_dependencia,  ";
                $cadenaSql .= "ruta_radicacion, nombre_radicacion, observaciones, id_elemento_ind,fecha_registro,sede, ubicacion, tipo_baja,usuario) ";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable ['dependencia'] . "',";
                $cadenaSql .= "'" . $variable ['funcionario'] . "',";
                $cadenaSql .= "'" . $variable ['ruta'] . "',";
                $cadenaSql .= "'" . $variable ['radicado'] . "',";
                $cadenaSql .= "'" . $variable ['observaciones'] . "',";
                $cadenaSql .= "'" . $variable ['id_elemento'] . "',";
                $cadenaSql .= "'" . $variable ['fecha'] . "',";
                $cadenaSql .= "'" . $variable ['sede'] . "',";
                $cadenaSql .= "'" . $variable ['ubicacion'] . "',";
                $cadenaSql .= "'" . $variable ['tipo_baja'] . "',";
                $cadenaSql .= "'" . $variable ['usuario'] . "') ";
                $cadenaSql .= "RETURNING  id_baja; ";

                break;

            case "id_sobrante" :
                $cadenaSql = " SELECT MAX(id_sobrante) ";
                $cadenaSql .= " FROM arka_inventarios.estado_elemento;";
                break;

            case "id_hurto" :
                $cadenaSql = " SELECT MAX(id_hurto) ";
                $cadenaSql .= " FROM arka_inventarios.estado_elemento;";
                break;

            case "id_faltante" :
                $cadenaSql = " SELECT MAX(id_faltante) ";
                $cadenaSql .= " FROM arka_inventarios.estado_elemento;";
                break;
            case "tipo_faltante" :
                $cadenaSql = " SELECT id_tipo_falt_sobr, descripcion ";
                $cadenaSql .= " FROM arka_inventarios.tipo_falt_sobr;";
                break;





            case "dependenciasGenerales" :
                $cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
                $cadenaSql .= " FROM ESPACIOS_FISICOS ";
                $cadenaSql .= " WHERE  ESF_ESTADO='A'";

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
                $cadenaSql .= "FROM arka_inventarios.elemento_individual ";
                $cadenaSql .= "JOIN arka_inventarios.elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
                $cadenaSql .= "JOIN arka_inventarios.salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= "JOIN arka_inventarios.tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                // $cadenaSql .= "left JOIN dependencia ON dependencia.id_dependencia = funcionario.dependencia ";
                $cadenaSql .= "WHERE 1=1 ";
                $cadenaSql .= "AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND  id_elemento_ind= '" . $variable . "'";
                $cadenaSql .= " ; ";

                break;



            case "consultarElementoID" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind ';
                $cadenaSql .= ' FROM elemento_individual ';
                $cadenaSql .= ' WHERE ';
                $cadenaSql .= ' placa = ';
                $cadenaSql .= " '" . $variable . "' ";
                break;

            case "consultarElementoBaja" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind ';
                $cadenaSql .= ' FROM baja_elemento ';
                $cadenaSql .= ' WHERE ';
                $cadenaSql .= ' id_elemento_ind = ';
                $cadenaSql .= " " . $variable . " ";
                break;
            case "consultarElementoEstado" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind ';
                $cadenaSql .= ' FROM estado_elemento ';
                $cadenaSql .= ' WHERE ';
                $cadenaSql .= ' id_elemento_ind = ';
                $cadenaSql .= " " . $variable . " ";
                break;

            case "consultar_informacion" :

                $cadenaSql = " SELECT elemento_individual.id_elemento_ind, elemento_individual.placa, elemento_individual.funcionario as funcionario_encargado, ";
                $cadenaSql .= ' arka_parametros.arka_funcionarios."FUN_NOMBRE" as fun_nombre, id_elemento_gen, ';
                $cadenaSql .= ' sedes."ESF_SEDE" sede, ';
                $cadenaSql .= ' dependencias."ESF_DEP_ENCARGADA" dependencia, ';
                $cadenaSql .= ' espacios."ESF_NOMBRE_ESPACIO" ubicacion, ';
                $cadenaSql .= ' sedes."ESF_ID_SEDE" cod_sede, ';
                $cadenaSql .= ' dependencias."ESF_CODIGO_DEP" cod_dependencia, ';
                $cadenaSql .= ' espacios."ESF_ID_ESPACIO" cod_ubicacion ';
                $cadenaSql .= " FROM arka_inventarios.elemento  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada  ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.elemento_individual ON elemento_individual.id_elemento_gen=elemento.id_elemento  ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.salida ON elemento_individual.id_salida=salida.id_salida ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios ON arka_parametros.arka_funcionarios."FUN_IDENTIFICACION" = elemento_individual.funcionario ';
                $cadenaSql .= " WHERE elemento.estado='1'  AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND id_elemento_ind NOT IN (SELECT id_elemento_ind FROM  arka_inventarios.baja_elemento) ";
                $cadenaSql .= " AND id_elemento_ind='" . $variable . "' ";
                break;

            case "insertar_historico" :

                $cadenaSql = " INSERT INTO arka_inventarios.historial_elemento_individual( ";
                $cadenaSql .= "fecha_registro, elemento_individual, funcionario,descripcion_funcionario)  ";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'" . $variable [3] . "') ";
                $cadenaSql .= "RETURNING  id_evento; ";

                break;

            case "actualizar_salida" :

                $cadenaSql = " UPDATE arka_inventarios.salida ";
                $cadenaSql .= "SET funcionario='" . $variable [1] . "',";
                $cadenaSql .= " observaciones='" . $variable [2] . "' ";
                $cadenaSql .= " WHERE id_salida=(SELECT id_salida FROM arka_inventarios.elemento_individual WHERE id_elemento_ind='" . $variable [0] . "' ) ;";
                break;

            case "actualizar_asignacion_funcionario" :
                $cadenaSql = " UPDATE arka_inventarios.elemento_individual ";
                $cadenaSql .= "SET funcionario='0' ";
                $cadenaSql .= " WHERE id_elemento_ind='" . $variable ['id_elemento'] . "' ;";
                break;

            case "actualizar_asignacion_contratista" :
                $cadenaSql = " UPDATE arka_inventarios.asignar_elementos ";
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
                $cadenaSql .= ' AND "ESF_ID_SEDE"=';
                $cadenaSql .= "'" . $variable . "'";
                $cadenaSql .= ' AND  dependencia."ESF_ESTADO"=';
                $cadenaSql .= "'A'";
                break;

            case "funcionario_informacion_consultada" :

                $cadenaSql = "SELECT FUN_IDENTIFICACION,  FUN_NOMBRE  ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_ESTADO='A' ";
                $cadenaSql .= "AND FUN_IDENTIFICACION='" . $variable . "' ";

                break;

            case "buscar_serie" :
                $cadenaSql = " SELECT DISTINCT serie, serie as series ";
                $cadenaSql .= "FROM arka_inventarios.elemento_individual ";
                $cadenaSql .= "WHERE  serie <> '' ";
                $cadenaSql .= "ORDER BY serie DESC ";

                break;

            case "buscar_placa" :
                $cadenaSql = " SELECT DISTINCT placa, placa as placas ";
                $cadenaSql .= "FROM arka_inventarios.elemento_individual ";
                $cadenaSql .= "ORDER BY placa DESC ";

                break;

            case "ConsultasPlacas" :
                $cadenaSql = " SELECT DISTINCT placa AS value, placa as data ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "WHERE placa IS NOT NULL  ";
                $cadenaSql .= " AND placa LIKE '%" . $variable . "%' ";
                $cadenaSql .= "ORDER BY placa DESC ;";
                break;
        }
        return $cadenaSql;
    }

}
?>
