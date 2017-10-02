<?php

namespace inventarios\gestionElementos\clasificarElemento;

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
            case "ConsultaTipoBien" :

                $cadenaSql = "SELECT ge.elemento_tipobien , tb.descripcion  ";
                $cadenaSql .= "FROM  catalogo.catalogo_elemento ce ";
                $cadenaSql .= "JOIN  grupo.catalogo_elemento ge  ON (ge.elemento_id)::text =ce .elemento_grupoc  ";
                $cadenaSql .= "JOIN  arka_inventarios.tipo_bienes tb ON tb.id_tipo_bienes = ge.elemento_tipobien  ";
                $cadenaSql .= "WHERE ce.elemento_id = '" . $variable . "';";

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

            case "consultar_nivel_inventario" :

                $cadenaSql = "SELECT ce.elemento_id, ce.elemento_codigo||' - '||ce.elemento_nombre ";
                $cadenaSql .= "FROM catalogo.catalogo_elemento  ce ";
                $cadenaSql .= "JOIN catalogo.catalogo_lista cl ON cl.lista_id = ce.elemento_catalogo  ";
                $cadenaSql .= "WHERE cl.lista_activo = 1  ";
                $cadenaSql .= "AND  ce.elemento_id > 0  ";
                $cadenaSql .= "AND  ce.elemento_padre > 0  ";
                $cadenaSql .= "ORDER BY ce.elemento_codigo ASC ;";

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

            case "UbicacionesConsultadas" :
                $cadenaSql = "SELECT DISTINCT  espacios.\"ESF_ID_ESPACIO\" , espacios.\"ESF_NOMBRE_ESPACIO\"";
                $cadenaSql .= " FROM elemento_individual eli  ";
                $cadenaSql .= " JOIN arka_parametros.arka_funcionarios fun ON fun.\"FUN_IDENTIFICACION\"=eli.funcionario ";
                $cadenaSql .= " JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " JOIN arka_inventarios.elemento as ele ON ele.id_elemento=eli.id_elemento_gen  ";
                $cadenaSql .= " WHERE ad.\"ESF_CODIGO_DEP\"='" . $variable['dependencia'] . "' ";
                if($variable['funcionario']!=null || $variable['funcionario']!='' ){
                    $cadenaSql .= " AND fun.\"FUN_IDENTIFICACION\"=" . $variable['funcionario'] ."";
                }
                $cadenaSql .= "  AND ele.tipo_bien<>1";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A' ORDER BY espacios.\"ESF_NOMBRE_ESPACIO\" ";
                break;
            case "sedesConsultadas" :
                $cadenaSql = "SELECT DISTINCT  sas.\"ESF_ID_SEDE\" , sas.\"ESF_SEDE\" ";
                $cadenaSql .= " FROM elemento_individual eli ";
                $cadenaSql .= " JOIN arka_parametros.arka_funcionarios fun ON fun.\"FUN_IDENTIFICACION\"=eli.funcionario ";
                $cadenaSql .= " JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " JOIN arka_inventarios.elemento as ele ON ele.id_elemento=eli.id_elemento_gen  ";
                $cadenaSql .= "  WHERE fun.\"FUN_IDENTIFICACION\"=" . $variable . " AND ele.tipo_bien<>1 ";
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
                if($variable['funcionario']!=null || $variable['funcionario']!='' ){
                    $cadenaSql .= " AND fun.\"FUN_IDENTIFICACION\"=" . $variable['funcionario'] . " ";
                }
                
                $cadenaSql .=  "AND ele.tipo_bien<>1";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A' ORDER BY ad.\"ESF_DEP_ENCARGADA\" ";
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
                $cadenaSql .= "ruta_radicacion, nombre_radicacion, observaciones, id_elemento_ind,fecha_registro,sede, ubicacion, tipo_baja) ";
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
                $cadenaSql .= "'" . $variable ['tipo_baja'] . "') ";
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

            case "funcionarios" :

                $cadenaSql = "SELECT DISTINCT \"FUN_IDENTIFICACION\", \"FUN_IDENTIFICACION\" ||' - '||  \"FUN_NOMBRE\" ";
                $cadenaSql .= "FROM  arka_parametros.arka_funcionarios ";
//                $cadenaSql .= "WHERE \"FUN_ESTADO\"='A' ";

                break;

            case "dependencias" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_CODIGO_DEP\" , \"ESF_DEP_ENCARGADA\" ";
                $cadenaSql .= " FROM arka_parametros.arka_dependencia ad ";
                $cadenaSql .= " JOIN  arka_parametros.arka_espaciosfisicos ef ON  ef.\"ESF_ID_ESPACIO\"=ad.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " JOIN  arka_parametros.arka_sedes sa ON sa.\"ESF_COD_SEDE\"=ef.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " WHERE ad.\"ESF_ESTADO\"='A'";

                break;

            case "dependenciasGenerales" :
                $cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
                $cadenaSql .= " FROM ESPACIOS_FISICOS ";
                $cadenaSql .= " WHERE  ESF_ESTADO='A'";

                break;

            case "ubicaciones" :
                $cadenaSql = "SELECT DISTINCT  ef.\"ESF_ID_ESPACIO\" , ef.\"ESF_NOMBRE_ESPACIO\" ";
                $cadenaSql .= " FROM arka_parametros.arka_espaciosfisicos ef  ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia ad ON ad.\"ESF_ID_ESPACIO\"=ef.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " WHERE  ef.\"ESF_ESTADO\"='A'";
                break;

            case "sede" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_ID_SEDE\", \"ESF_SEDE\" ";
                $cadenaSql .= " FROM arka_parametros.arka_sedes ";
                $cadenaSql .= " WHERE   \"ESF_ESTADO\"='A' ";
                $cadenaSql .= " AND    \"ESF_COD_SEDE\" >  0 ";

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

            case "consultarElementoAux" :

                $cadenaSql = " SELECT DISTINCT eli.id_elemento_ind, eli.placa ,eli.funcionario funcionario_encargado, ";
                $cadenaSql .= ' "FUN_NOMBRE" as fun_nombre,id_elemento_gen, sas."ESF_SEDE" sede,ad."ESF_DEP_ENCARGADA" dependencia,espacios."ESF_NOMBRE_ESPACIO" ubicacion,tfs.descripcion estado_elemento, ';
                $cadenaSql .= ' tb.descripcion tipo_bien, ele.tipo_bien id_tipo_bien, catalogo.catalogo_elemento.elemento_nombre nivel, ';
                $cadenaSql .= ' ele.marca marca, ele.serie serie, elemento_nombre, ele.descripcion descripcion_elemento, cantidad, valor, iva, ajuste, total_iva_con, bodega ';
                $cadenaSql .= " FROM elemento_individual eli   ";
                $cadenaSql .= " JOIN elemento ele ON ele.id_elemento =eli .id_elemento_gen  ";
                $cadenaSql .= " JOIN tipo_bienes tb ON tb.id_tipo_bienes = ele.tipo_bien  ";
                $cadenaSql .= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
                $cadenaSql .= " LEFT JOIN estado_elemento est ON est.id_elemento_ind = eli.id_elemento_ind  ";
                $cadenaSql .= ' LEFT JOIN tipo_falt_sobr tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios fn ON fn."FUN_IDENTIFICACION"= eli.funcionario ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as ad ON ad."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sas ON sas."ESF_COD_SEDE"=espacios."ESF_COD_SEDE"  ';
                $cadenaSql .= ' LEFT JOIN asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_contratistas crn ON crn."CON_IDENTIFICACION"=asl.contratista ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE  ";
                $cadenaSql .= " WHERE tb.id_tipo_bienes <> 1 AND bj.id_elemento_ind IS NULL AND eli.estado_registro = 'TRUE' ";

                if ($variable ['funcionario'] != '') {
                    $cadenaSql .= " AND eli.funcionario = '" . $variable ['funcionario'] . "'";
                }
                if ($variable ['serie'] != '') {
                    $cadenaSql .= " AND  eli.serie= '" . $variable ['serie'] . "'";
                }
                if ($variable ['placa'] != '') {
                    $cadenaSql .= " AND  eli.placa= '" . $variable ['placa'] . "'";
                }
                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sas."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND ad."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }

                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }

                $cadenaSql .= ' ORDER BY eli.id_elemento_ind DESC';

                // $cadenaSql .= " LIMIT 10 ;";


                break;

            case "consultarElemento" :

                $cadenaSql = " SELECT DISTINCT elemento_individual.id_elemento_ind, elemento_individual.placa, elemento_individual.funcionario as funcionario_encargado, ";
                $cadenaSql .= ' arka_parametros.arka_funcionarios."FUN_NOMBRE" as fun_nombre, id_elemento_gen, ';
                $cadenaSql .= ' sedes."ESF_SEDE" sede, ';
                $cadenaSql .= ' dependencias."ESF_DEP_ENCARGADA" dependencia, ';
                $cadenaSql .= ' espacios."ESF_NOMBRE_ESPACIO" ubicacion, tipo_falt_sobr.descripcion estado_elemento,';
                // $cadenaSql.= " tipo_bienes.descripcion, ";
                $cadenaSql .= " tipo_bienes.descripcion tipo_bien, ";
                $cadenaSql .= " catalogo.catalogo_elemento.elemento_nombre nivel,   ";
                $cadenaSql .= " elemento_nombre, elemento.descripcion descripcion_elemento, marca, elemento.serie, cantidad, valor, iva, ajuste, total_iva_con, bodega,(elemento_individual.id_salida || '-('|| salida.vigencia || ')') salidas ";

                $cadenaSql .= " FROM arka_inventarios.elemento  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada  ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
                // $cadenaSql.= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes=tipo_bien ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.elemento_individual ON elemento_individual.id_elemento_gen=elemento.id_elemento  ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_ID_ESPACIO"=espacios."ESF_ID_ESPACIO" ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.salida ON elemento_individual.id_salida=salida.id_salida ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios ON arka_parametros.arka_funcionarios."FUN_IDENTIFICACION" = elemento_individual.funcionario ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.estado_elemento ON arka_inventarios.estado_elemento.id_elemento_ind=elemento_individual.id_elemento_ind ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_falt_sobr ON tipo_falt_sobr.id_tipo_falt_sobr=estado_elemento.tipo_faltsobr ";
                $cadenaSql .= " WHERE elemento.estado='TRUE'  AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3))";
                // $cadenaSql .= "AND entrada.cierre_contable='f' ";
                // $cadenaSql .= "AND entrada.estado_entrada = 1 ";
                // $cadenaSql .= "AND entrada.estado_registro='t' ";

                $cadenaSql .= " AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM  arka_inventarios.baja_elemento) ";

                if ($variable ['funcionario'] != '') {
                    $cadenaSql .= " AND elemento_individual.funcionario = '" . $variable ['funcionario'] . "'";
                }
                if ($variable ['serie'] != '') {
                    $cadenaSql .= " AND  elemento_individual.serie= '" . $variable ['serie'] . "'";
                }
                if ($variable ['placa'] != '') {
                    $cadenaSql .= " AND  elemento_individual.placa= '" . $variable ['placa'] . "'";
                }
                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sedes."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND dependencias."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }

                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }

                $cadenaSql .= ' ORDER BY elemento_individual.id_elemento_ind DESC ;';


                // $cadenaSql .= " LIMIT 10 ;";

                break;
            case "consultarElementoxPlacaAux" :

                $cadenaSql = '  SELECT DISTINCT eli.id_elemento_ind,ele.id_elemento as id_elemento, eli.placa ,eli.funcionario funcionario_encargado, "FUN_NOMBRE" as fun_nombre,id_elemento_gen, sas."ESF_SEDE" sede, ';
                $cadenaSql .= ' ad."ESF_DEP_ENCARGADA" dependencia,espacios."ESF_NOMBRE_ESPACIO" ubicacion,tfs.descripcion estado_elemento, tb.descripcion tipo_bien, ele.tipo_bien id_tipo_bien, ';
                $cadenaSql .= ' catalogo.catalogo_elemento.elemento_nombre nivel, catalogo.catalogo_elemento.elemento_id id_catalogo,  ';
                $cadenaSql .= ' catalogo.catalogo_elemento.elemento_codigo codigo_elemento,ele.marca marca, ele.serie serie, elemento_nombre, ele.descripcion descripcion_elemento, cantidad, valor, iva, ajuste, ';
                $cadenaSql .= ' total_iva_con, bodega ';
                $cadenaSql .= " FROM elemento_individual eli    ";
                $cadenaSql .= " JOIN elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= " JOIN tipo_bienes tb ON tb.id_tipo_bienes = ele.tipo_bien  ";
                // $cadenaSql.= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes=tipo_bien ";
                $cadenaSql .= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
                $cadenaSql .= ' LEFT JOIN estado_elemento est ON est.id_elemento_ind = eli.id_elemento_ind  ';
                $cadenaSql .= ' LEFT JOIN tipo_falt_sobr tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios fn ON fn."FUN_IDENTIFICACION"= eli.funcionario  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=eli.ubicacion_elemento  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as ad ON ad."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sas ON sas."ESF_COD_SEDE"=espacios."ESF_COD_SEDE"  ';
                $cadenaSql .= " LEFT JOIN asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1 ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_contratistas crn ON crn."CON_IDENTIFICACION"=asl.contratista ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE ";
                $cadenaSql .= " WHERE tb.id_tipo_bienes <> 1 AND bj.id_elemento_ind IS NULL AND eli.estado_registro = 'TRUE' ";
                if ($variable != '') {
                    $cadenaSql .= " AND  eli.placa= '" . $variable . "'";
                }

                $cadenaSql .= '  ORDER BY eli.id_elemento_ind DESC;';

                // $cadenaSql .= " LIMIT 10 ;";
                break;

            case "consultarElementoxPlaca" :

                $cadenaSql = " SELECT elemento_individual.id_elemento_ind,elemento.id_elemento as id_elemento, elemento_individual.placa as placa, elemento_individual.funcionario as funcionario_encargado, ";
                $cadenaSql .= ' arka_parametros.arka_funcionarios."FUN_NOMBRE" as fun_nombre, id_elemento_gen, ';
                $cadenaSql .= ' sedes."ESF_SEDE" sede, ';
                $cadenaSql .= ' dependencias."ESF_DEP_ENCARGADA" dependencia, ';
                $cadenaSql .= ' espacios."ESF_NOMBRE_ESPACIO" ubicacion, tipo_falt_sobr.descripcion estado_elemento,';
                // $cadenaSql.= " tipo_bienes.descripcion, ";
                $cadenaSql .= " tipo_bienes.descripcion tipo_bien, ";
                $cadenaSql .= " catalogo.catalogo_elemento.elemento_nombre nivel,   ";
                $cadenaSql .= " catalogo.catalogo_elemento.elemento_id id_catalogo,   ";
                $cadenaSql .= " catalogo.catalogo_elemento.elemento_codigo codigo_elemento,   ";
                $cadenaSql .= " elemento_nombre, elemento.descripcion descripcion_elemento, marca, elemento.serie, cantidad, valor, iva, ajuste, total_iva_con, bodega,(elemento_individual.id_salida || '-('|| salida.vigencia || ')') salidas ";

                $cadenaSql .= " FROM arka_inventarios.elemento  ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada  ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
                // $cadenaSql.= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes=tipo_bien ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.elemento_individual ON elemento_individual.id_elemento_gen=elemento.id_elemento  ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_ID_ESPACIO"=espacios."ESF_ID_ESPACIO" ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.salida ON elemento_individual.id_salida=salida.id_salida ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios ON arka_parametros.arka_funcionarios."FUN_IDENTIFICACION" = elemento_individual.funcionario ';
                $cadenaSql .= " LEFT JOIN arka_inventarios.estado_elemento ON arka_inventarios.estado_elemento.id_elemento_ind=elemento_individual.id_elemento_ind ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.tipo_falt_sobr ON tipo_falt_sobr.id_tipo_falt_sobr=estado_elemento.tipo_faltsobr ";
                $cadenaSql .= " WHERE elemento.tipo_bien <> 1 ";
                $cadenaSql .= " AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3))";
                // $cadenaSql .= "AND entrada.cierre_contable='f' ";
                // $cadenaSql .= "AND entrada.estado_entrada = 1 ";
                // $cadenaSql .= "AND entrada.estado_registro='t' ";

                $cadenaSql .= " AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM  arka_inventarios.baja_elemento) ";

                if ($variable != '') {
                    $cadenaSql .= " AND  elemento_individual.placa= '" . $variable . "'";
                }

                $cadenaSql .= ' ORDER BY elemento_individual.id_elemento_ind DESC ;';

                // $cadenaSql .= " LIMIT 10 ;";
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
                // $cadenaSql.= "
                $cadenaSql .= " FROM arka_inventarios.elemento  ";
                $cadenaSql .= " JOIN arka_inventarios.entrada ON elemento.id_entrada=entrada.id_entrada  ";
                $cadenaSql .= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel  ";
                // $cadenaSql.= " JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes=tipo_bien ";
                $cadenaSql .= " JOIN arka_inventarios.elemento_individual ON elemento_individual.id_elemento_gen=elemento.id_elemento  ";

                $cadenaSql .= ' JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql .= ' JOIN arka_parametros.arka_dependencia as dependencias ON dependencias."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                $cadenaSql .= ' JOIN arka_parametros.arka_sedes as sedes ON sedes."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= " JOIN arka_inventarios.tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= " JOIN arka_inventarios.salida ON elemento_individual.id_salida=salida.id_salida ";
                $cadenaSql .= ' JOIN arka_parametros.arka_funcionarios ON arka_parametros.arka_funcionarios."FUN_IDENTIFICACION" = elemento_individual.funcionario ';
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

            case "actualizar_tipo_bien" :
                $cadenaSql = " UPDATE arka_inventarios.elemento ";
                $cadenaSql .= "SET marca='" . $variable['marca'] . "',";
                $cadenaSql .= " serie='" . $variable['serie'] . "',";
                $cadenaSql .= " nivel=" . $variable['nivel'] . ",";
                $cadenaSql .= " tipo_bien=" . $variable['tipo_bien'] . ",";
                $cadenaSql .= " descripcion='" . $variable['descripcion'] . "'";
                $cadenaSql .= " WHERE id_elemento='" . $variable ['id_elemento'] . "' ;";
                break;
            case "actualizar_tipo_bien_individual" :
                $cadenaSql = " UPDATE arka_inventarios.elemento_individual ";
                $cadenaSql .= "SET serie='" . $variable['serie'] . "'";
                $cadenaSql .= " WHERE id_elemento_gen=" . $variable['id_elemento'] . " ;";

                break;
            case "buscarCuenta" :
                $cadenaSql = " SELECT DISTINCT  id_elemento_ind as id_elemento,  grupo_cuentasalida as cuenta_salida ";
                $cadenaSql .= " FROM arka_inventarios.elemento_individual ";
                $cadenaSql .= " JOIN arka_inventarios.elemento ON elemento.id_elemento=elemento_individual.id_elemento_gen ";
                $cadenaSql .= " JOIN catalogo.catalogo_elemento ON catalogo.catalogo_elemento.elemento_id=nivel ";
                $cadenaSql .= " JOIN grupo.catalogo_elemento ON cast(grupo.catalogo_elemento.elemento_id as character varying)=catalogo.catalogo_elemento.elemento_grupoc ";
                $cadenaSql .= " JOIN grupo.grupo_descripcion ON grupo.grupo_descripcion.grupo_id=cast(grupo.catalogo_elemento.elemento_id as character varying)  ";
                $cadenaSql .= " WHERE catalogo.catalogo_elemento.elemento_id>0";
                $cadenaSql .= " AND elemento.estado=TRUE ";
                $cadenaSql .= " AND id_elemento_ind NOT IN (  SELECT id_elemento_ind FROM estado_elemento )   ";
                $cadenaSql .= " AND id_elemento_gen=" . $variable ['id_elemento'] . " ;";



                break;

            case "insertar_version_tipo_bien" :
                $cadenaSql = " INSERT INTO arka_inventarios.tipo_cambio_bien ";
                $cadenaSql .= "( ";
                $cadenaSql .= "id_elemento, ";
                $cadenaSql .= "id_tipo_bienes, ";
                $cadenaSql .= "observacion, ";
                $cadenaSql .= "id_cuenta_anterior, ";
                $cadenaSql .= "date_cambio, ";
                $cadenaSql .= "estado ";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";
                $cadenaSql .= "( ";
                $cadenaSql .= $variable ['id_elemento'] . ", ";
                $cadenaSql .= "" . $variable ['tipo_bien'] . ", ";
                $cadenaSql .= "'" . $variable ['observacion'] . "', ";
                $cadenaSql .= $variable ['cuentaAnterior'] . ", ";
                $cadenaSql .= "'" . $variable ['fecha'] . "', ";
                $cadenaSql .= "'Activo' ";
                $cadenaSql .= ")";

                break;

            case "actualizar_version_tipo_bien" :
                $cadenaSql = " UPDATE arka_inventarios.tipo_cambio_bien ";
                $cadenaSql .= "SET estado='Inactivo' ";
                $cadenaSql .= " WHERE id_elemento='" . $variable ['id_elemento'] . "'";
                $cadenaSql .= " AND estado='Activo' ;";
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
