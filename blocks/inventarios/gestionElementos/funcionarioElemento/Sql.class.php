<?php

namespace inventarios\gestionElementos\funcionarioElemento;

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

    function getCadenaSql($tipo, $variable = "", $aux = "") {

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

            case "nombreFuncionario" :
                $cadenaSql = " SELECT \"FUN_NOMBRE\" ";
                $cadenaSql .= "FROM arka_parametros.arka_funcionarios ";
                $cadenaSql .= "WHERE \"FUN_IDENTIFICACION\"=" . $variable;

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
            case "Verificar_Periodo" :
                $cadenaSql = " SELECT *   ";
                $cadenaSql .= " FROM  arka_movil.periodo_levantamiento ";
                $cadenaSql .= "WHERE estado_registro=TRUE ;";

                break;

            case "consultar_Perido_final" :
                $cadenaSql = " SELECT max(id_periodolevantamiento)   ";
                $cadenaSql .= " FROM  arka_movil.periodo_levantamiento ";
                $cadenaSql .= "WHERE estado_registro=TRUE ;";

                break;

            case "jefe_recursos_fisicos" :

                $cadenaSql = 'SELECT "FUN_IDENTIFICACION" identificacion, "FUN_NOMBRE" nombre ';
                $cadenaSql .= " FROM arka_parametros.arka_funcionarios ";
                $cadenaSql .= " WHERE 1=1 ";
                $cadenaSql .= ' AND "FUN_ESTADO"=';
                $cadenaSql .= "'A'  ";
                $cadenaSql .= ' AND "FUN_CARGO" ';
                $cadenaSql .= " ='JEFE DE SECCION' ";
                $cadenaSql .= ' AND "FUN_DEP_COD_ACADEMICA"=60 ; ';

                break;

            case "Elemento_Existencia_Tipo_Confirmada" :

                $cadenaSql = "	UPDATE elemento_individual ";
                $cadenaSql .= "	SET  confirmada_existencia= false , tipo_confirmada='2'  ";
                $cadenaSql .= "	WHERE  id_elemento_ind='" . $variable . "';";

                break;

            case "Elemento_Existencia_No_Aprovado" :

                $cadenaSql = "	UPDATE elemento_individual ";
                $cadenaSql .= "	SET  confirmada_existencia=true  ";
                $cadenaSql .= "	WHERE  id_elemento_ind='" . $variable . "';";

                break;

            case "Elemento_Existencia_Aprobado" :

                $cadenaSql = "	UPDATE elemento_individual ";
                $cadenaSql .= "	SET   confirmada_existencia=true, 
							                 tipo_confirmada='1' ";
                $cadenaSql .= "	WHERE  id_elemento_ind='" . $variable . "';";

                break;

            case "Registrar_Observaciones_Elemento" :

                $cadenaSql = "INSERT INTO arka_movil.detalle_levantamiento( 
									    funcionario,id_elemento_individual,id_periodolevantamiento, observacion,creador_observacion )";
                $cadenaSql .= "VALUES ( ";
                $cadenaSql .= "'" . $variable ['funcionario'] . "',";
                $cadenaSql .= "'" . $variable ['id_elemento_individual'] . "',";
                $cadenaSql .= "'" . $variable ['periodo'] . "',";
                $cadenaSql .= "'" . $variable ['observacion'] . "',";
                $cadenaSql .= "0) RETURNING  id_detallelevantamiento  ";

                break;

            case "Registrar_Levantamiento_Elemento" :

                $cadenaSql = ' UPDATE elemento_individual ';
                $cadenaSql .= "SET id_levantamiento ='" . $variable [0] . "'  ";
                $cadenaSql .= "WHERE id_elemento_ind ='" . $variable [1] . "';";

                break;

            case "sede" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_ID_SEDE\", \"ESF_SEDE\" ";
                $cadenaSql .= " FROM arka_parametros.arka_sedes ";
                $cadenaSql .= " WHERE   \"ESF_ESTADO\"='A'";
                $cadenaSql .= " AND \"ESF_ID_SEDE\"<>'PAS' ";

                break;

            case "dependencias" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_CODIGO_DEP\" , \"ESF_DEP_ENCARGADA\" ";
                $cadenaSql .= " FROM arka_parametros.arka_dependencia ad ";
                $cadenaSql .= " JOIN  arka_parametros.arka_espaciosfisicos ef ON  ef.\"ESF_ID_ESPACIO\"=ad.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " JOIN  arka_parametros.arka_sedes sa ON sa.\"ESF_COD_SEDE\"=ef.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " WHERE ad.\"ESF_ESTADO\"='A'";

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
                if ($variable['funcionario'] != null || $variable['funcionario'] != '') {
                    $cadenaSql .= " AND fun.\"FUN_IDENTIFICACION\"=" . $variable['funcionario'] . " ";
                }

                $cadenaSql .= "AND ele.tipo_bien<>1";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A' ORDER BY ad.\"ESF_DEP_ENCARGADA\" ";
                break;

            case "funcionarios" :

                $cadenaSql = "SELECT DISTINCT \"FUN_IDENTIFICACION\", \"FUN_IDENTIFICACION\" ||' - '||  \"FUN_NOMBRE\" ";
                $cadenaSql .= "FROM  arka_parametros.arka_funcionarios ";
//				$cadenaSql .= "WHERE \"FUN_ESTADO\"='A' ";
                break;

            case "buscar_placa" :
                $cadenaSql = " SELECT DISTINCT placa, placa as placas ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "WHERE placa IS NOT NULL  ";
                $cadenaSql .= "ORDER BY placa DESC ;";

                break;

            case "buscar_serie" :
                $cadenaSql = " SELECT DISTINCT serie, serie as series ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "WHERE  serie IS NOT NULL ";
                $cadenaSql .= "ORDER BY serie DESC ";

                break;

            case "buscar_entradas" :

                $cadenaSql = "SELECT DISTINCT en.id_entrada, en.consecutivo||' - ('||en.vigencia||')' entradas ";
                $cadenaSql .= "FROM entrada en ";
                $cadenaSql .= "JOIN  elemento el ON el.id_entrada=en.id_entrada ";
                $cadenaSql .= "WHERE en.cierre_contable='f' ";
                $cadenaSql .= "AND   en.estado_registro='t' ";
                $cadenaSql .= "AND   en.estado_entrada = 1  ";
                $cadenaSql .= "ORDER BY en.id_entrada DESC ;";

                break;

            case "consultarElemento" :

                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "  eli.id_elemento_ind  identificador_elemento_individual , eli.placa , tb.descripcion nombre_tipo_bienes,
											ele.tipo_bien tipo_bien,
											ele.marca marca,
											ele.serie serie,
											CASE eli.confirmada_existencia
											WHEN  't'  THEN 'X' 
											ELSE  ' '
											END  marca_existencia,
										\"FUN_NOMBRE\" nombre_funcionario, 					
                						sas.\"ESF_SEDE\" sede, ad.\"ESF_DEP_ENCARGADA\" dependencia,espacios.\"ESF_NOMBRE_ESPACIO\" espacio_fisico, 
                						CASE
                						WHEN  tfs.descripcion IS  NULL THEN 'Activo'
										ELSE  tfs.descripcion  
                						END   as estado_bien, ele.descripcion descripcion_elemento, eli.confirmada_existencia , eli.tipo_confirmada, espacios.\"ESF_NOMBRE_ESPACIO\" espaciofisico,
										crn.\"CON_IDENTIFICACION\"||'-'||crn.\"CON_NOMBRE\" contratista ";
                $cadenaSql .= "FROM elemento_individual  eli ";
                $cadenaSql .= "JOIN elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= "JOIN tipo_bienes  tb ON tb.id_tipo_bienes = ele.tipo_bien ";
                $cadenaSql .= "LEFT JOIN estado_elemento  est ON est.id_elemento_ind = eli.id_elemento_ind ";
                $cadenaSql .= "LEFT JOIN tipo_falt_sobr  tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr   ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_funcionarios fn ON fn.\"FUN_IDENTIFICACION\"= eli.funcionario ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as ad ON ad."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sas ON sas."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= ' LEFT JOIN  asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1  ';
                $cadenaSql .= ' LEFT JOIN  arka_parametros.arka_contratistas crn ON crn."CON_IDENTIFICACION"=asl.contratista  ';
                $cadenaSql .= 'LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE ';
                $cadenaSql .= "WHERE tb.id_tipo_bienes <> 1 ";
                $cadenaSql .= "AND bj.id_elemento_ind IS NULL ";
                $cadenaSql .= "AND  eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM estado_elemento) AND eli.estado_registro = 'TRUE'    ";
                $cadenaSql .= " AND eli.funcionario= '" . $variable ['funcionario'] . "' ";

                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sas."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND ad ."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }
                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }
                $cadenaSql .= " ORDER BY dependencia DESC, placa ASC;  ";


                break;
            case "consultarElementoFuncionarioParticular" :

                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "  eli.id_elemento_ind  identificador_elemento_individual , eli.placa , tb.descripcion nombre_tipo_bienes,
											ele.tipo_bien tipo_bien,
											ele.marca marca,
											ele.serie serie,
											CASE eli.confirmada_existencia
											WHEN  't'  THEN 'X' 
											ELSE  ' '
											END  marca_existencia,
										\"FUN_NOMBRE\" nombre_funcionario, 					
                						sas.\"ESF_SEDE\" sede, ad.\"ESF_DEP_ENCARGADA\" dependencia,espacios.\"ESF_NOMBRE_ESPACIO\" espacio_fisico, 
                						CASE
                						WHEN  tfs.descripcion IS  NULL THEN 'Activo'
										ELSE  tfs.descripcion  
                						END   as estado_bien, ele.descripcion descripcion_elemento, eli.confirmada_existencia , eli.tipo_confirmada, espacios.\"ESF_NOMBRE_ESPACIO\" espaciofisico,
										crn.\"CON_IDENTIFICACION\"||'-'||crn.\"CON_NOMBRE\" contratista ";
                $cadenaSql .= "FROM elemento_individual  eli ";
                $cadenaSql .= "JOIN elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= "JOIN tipo_bienes  tb ON tb.id_tipo_bienes = ele.tipo_bien ";
                $cadenaSql .= "LEFT JOIN estado_elemento  est ON est.id_elemento_ind = eli.id_elemento_ind ";
                $cadenaSql .= "LEFT JOIN tipo_falt_sobr  tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr   ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_funcionarios fn ON fn.\"FUN_IDENTIFICACION\"= eli.funcionario ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as ad ON ad."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sas ON sas."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= ' LEFT JOIN  asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1  ';
                $cadenaSql .= ' LEFT JOIN  arka_parametros.arka_contratistas crn ON crn."CON_IDENTIFICACION"=asl.contratista  ';
                $cadenaSql .= 'LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE ';
                $cadenaSql .= "WHERE tb.id_tipo_bienes <> 1 ";
                $cadenaSql .= "AND bj.id_elemento_ind IS NULL ";
                $cadenaSql .= "AND  eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM estado_elemento) AND eli.estado_registro = 'TRUE'    ";
                $cadenaSql .= " AND eli.funcionario= '" . $variable ['funcionario'] . "' ";
                if ($aux  != '' && $aux=='104') {
                    $cadenaSql .= ' AND ele.nivel=104';
                }
                if ($aux  != '' && $aux=='78') {
                    $cadenaSql .= ' AND ele.nivel=78';
                }
                if ($aux  != '' && $aux=='500') {
                    $cadenaSql .= ' AND id_tipo_bienes =3   AND ele.nivel<>104 AND ele.nivel<>78 ';
                }
                if ($aux  != '' && $aux=='600') {
                    $cadenaSql .= ' AND id_tipo_bienes =2   AND ele.nivel<>104 AND ele.nivel<>78  ';
                }
                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sas."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND ad ."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }
                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }
                $cadenaSql .= " ORDER BY dependencia DESC, placa ASC;  ";
        
                
                break;
            case "consultarCountElementos" :

                $cadenaSql = "SELECT count(tipo_bien), tipo_bien ";
                $cadenaSql .= "FROM arka_inventarios.elemento_individual eli  ";
                $cadenaSql .= "JOIN arka_inventarios.elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= "JOIN arka_inventarios.tipo_bienes tb ON tb.id_tipo_bienes = ele.tipo_bien ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.estado_elemento est ON est.id_elemento_ind = eli.id_elemento_ind ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.tipo_falt_sobr tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_contratistas crn ON crn.\"CON_IDENTIFICACION\"=asl.contratista  ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE   ";
                $cadenaSql .= "WHERE ele.tipo_bien <> 1 ";
                $cadenaSql .= "AND bj.id_elemento_ind IS NULL AND eli.estado_registro = 'TRUE' AND   eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM estado_elemento)";
                $cadenaSql .= " AND eli.funcionario= '" . $variable ['funcionario'] . "' ";

                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sas."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND ad ."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }
                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }
                $cadenaSql .= " GROUP BY tipo_bien ORDER BY tipo_bien; ";

                break;

            case "consultarElementosCC" :

                $cadenaSql = "SELECT DISTINCT eli.id_elemento_ind identificador_elemento_individual, eli.tipo_confirmada, tb.descripcion nombre_tipo_bienes,eli.placa , ele.tipo_bien tipo_bien, ";
                $cadenaSql .= "ele.descripcion descripcion_elemento,sas.\"ESF_SEDE\" sede, ad.\"ESF_DEP_ENCARGADA\" dependencia,espacios.\"ESF_NOMBRE_ESPACIO\" espacio_fisico,ele.marca marca,ele.serie serie,CASE eli.confirmada_existencia
											WHEN  't'  THEN 'X' 
											ELSE  ' '
											END  marca_existencia, ";
                $cadenaSql .= "CASE WHEN tfs.descripcion IS NULL THEN 'Activo' ELSE tfs.descripcion END as estado_bien, crn.\"CON_IDENTIFICACION\"||'-'||crn.\"CON_NOMBRE\" contratista,eli.confirmada_existencia ";
                $cadenaSql .= "FROM arka_inventarios.elemento_individual eli  ";
                $cadenaSql .= "JOIN arka_inventarios.elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= "JOIN arka_inventarios.tipo_bienes tb ON tb.id_tipo_bienes = ele.tipo_bien ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.estado_elemento est ON est.id_elemento_ind = eli.id_elemento_ind ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.tipo_falt_sobr tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_contratistas crn ON crn.\"CON_IDENTIFICACION\"=asl.contratista  ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE   ";
                $cadenaSql .= "WHERE ele.tipo_bien <> 1 ";
                $cadenaSql .= "AND bj.id_elemento_ind IS NULL AND eli.estado_registro = 'TRUE' ";
		$cadenaSql .= "AND  eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM estado_elemento) ";
                $cadenaSql .= " AND eli.funcionario= '" . $variable ['funcionario'] . "' ";

                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sas."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND ad ."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }
                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }
                $cadenaSql .= " ORDER BY tipo_bien,dependencia DESC, placa ASC limit " . $aux . ";";

                break;

            case "consultarElementosDEV" :

                $cadenaSql = "SELECT DISTINCT eli.id_elemento_ind identificador_elemento_individual, eli.tipo_confirmada, tb.descripcion nombre_tipo_bienes,eli.placa , ele.tipo_bien tipo_bien, ";
                $cadenaSql .= "ele.descripcion descripcion_elemento,sas.\"ESF_SEDE\" sede, ad.\"ESF_DEP_ENCARGADA\" dependencia,espacios.\"ESF_NOMBRE_ESPACIO\" espacio_fisico,ele.marca marca,ele.serie serie,CASE eli.confirmada_existencia
											WHEN  't'  THEN 'X' 
											ELSE  ' '
											END  marca_existencia, ";
                $cadenaSql .= "CASE WHEN tfs.descripcion IS NULL THEN 'Activo' ELSE tfs.descripcion END as estado_bien, crn.\"CON_IDENTIFICACION\"||'-'||crn.\"CON_NOMBRE\" contratista,eli.confirmada_existencia ";
                $cadenaSql .= "FROM arka_inventarios.elemento_individual eli  ";
                $cadenaSql .= "JOIN arka_inventarios.elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= "JOIN arka_inventarios.tipo_bienes tb ON tb.id_tipo_bienes = ele.tipo_bien ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.estado_elemento est ON est.id_elemento_ind = eli.id_elemento_ind ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.tipo_falt_sobr tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1  ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_contratistas crn ON crn.\"CON_IDENTIFICACION\"=asl.contratista  ";
                $cadenaSql .= "LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE   ";
                $cadenaSql .= "WHERE ele.tipo_bien <> 1 ";
                $cadenaSql .= "AND bj.id_elemento_ind IS NULL AND eli.estado_registro = 'TRUE' ";	
		$cadenaSql .= "AND  eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM estado_elemento) ";
                $cadenaSql .= " AND eli.funcionario= '" . $variable ['funcionario'] . "' ";

                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sas."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND ad ."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }
                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }
                $cadenaSql .= " ORDER BY tipo_bien DESC,dependencia DESC, placa ASC limit " . $aux . ";";

                break;

            case "consultarElementoParticular" :
                $cadenaSql = " SELECT ";
                $cadenaSql .= "nivel,tipo_bien, descripcion, cantidad, ";
                $cadenaSql .= "unidad, valor, iva, ajuste, bodega, subtotal_sin_iva, total_iva,";
                $cadenaSql .= "total_iva_con, tipo_poliza, fecha_inicio_pol, fecha_final_pol, ";
                $cadenaSql .= "marca, serie ";
                $cadenaSql .= " FROM arka_inventarios.elemento ";
                $cadenaSql .= " WHERE id_elemento='" . $variable . "'";

                break;

            case "consultar_tipo_bien" :

                $cadenaSql = "SELECT id_tipo_bienes, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.tipo_bienes;";
                break;

            case "consultar_tipo_poliza" :

                $cadenaSql = "SELECT id_tipo_poliza, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.tipo_poliza;";

                break;

            case "consultar_tipo_iva" :

                $cadenaSql = "SELECT id_iva, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.aplicacion_iva;";

                break;

            case "consultar_bodega" :

                $cadenaSql = "SELECT id_bodega, descripcion ";
                $cadenaSql .= "FROM arka_inventarios.bodega;";

                break;

            case "consultar_placa" :

                $cadenaSql = "SELECT MAX( placa) ";
                $cadenaSql .= "FROM elemento ";
                $cadenaSql .= "WHERE tipo_bien='1';";

                break;

            // SELECT id_elemento, fecha_registro, tipo_bien, descripcion, cantidad,
            // unidad, valor, iva, ajuste, bodega, subtotal_sin_iva, total_iva,
            // total_iva_con, placa, tipo_poliza, fecha_inicio_pol, fecha_final_pol,
            // marca, serie, id_entrada, estado
            // FROM elemento;

            case "actualizar_elemento_tipo_1" :

                $cadenaSql = " UPDATE ";
                $cadenaSql .= " elemento ";
                $cadenaSql .= " SET ";
                $cadenaSql .= " tipo_bien='" . $variable [0] . "', ";
                $cadenaSql .= " descripcion='" . $variable [1] . "', ";
                $cadenaSql .= " cantidad='" . $variable [2] . "', ";
                $cadenaSql .= " unidad='" . $variable [3] . "', ";
                $cadenaSql .= " valor='" . $variable [4] . "', ";
                $cadenaSql .= " iva='" . $variable [5] . "', ";
                $cadenaSql .= " ajuste='" . $variable [6] . "', ";
                $cadenaSql .= " bodega='" . $variable [7] . "', ";
                $cadenaSql .= " subtotal_sin_iva='" . $variable [8] . "', ";
                $cadenaSql .= " total_iva='" . $variable [9] . "', ";
                $cadenaSql .= " total_iva_con='" . $variable [10] . "', ";
                $cadenaSql .= " marca='" . $variable [11] . "', ";
                $cadenaSql .= " serie='" . $variable [12] . "',  ";
                $cadenaSql .= " nivel='" . $variable [14] . "'  ";
                $cadenaSql .= "  WHERE id_elemento='" . $variable [13] . "';";

                break;

            case "actualizar_elemento_tipo_2" :

                $cadenaSql = " UPDATE ";
                $cadenaSql .= " elemento ";
                $cadenaSql .= " SET ";
                $cadenaSql .= " tipo_bien='" . $variable [0] . "', ";
                $cadenaSql .= " descripcion='" . $variable [1] . "', ";
                $cadenaSql .= " cantidad='" . $variable [2] . "', ";
                $cadenaSql .= " unidad='" . $variable [3] . "', ";
                $cadenaSql .= " valor='" . $variable [4] . "', ";
                $cadenaSql .= " iva='" . $variable [5] . "', ";
                $cadenaSql .= " ajuste='" . $variable [6] . "', ";
                $cadenaSql .= " bodega='" . $variable [7] . "', ";
                $cadenaSql .= " subtotal_sin_iva='" . $variable [8] . "', ";
                $cadenaSql .= " total_iva='" . $variable [9] . "', ";
                $cadenaSql .= " total_iva_con='" . $variable [10] . "', ";
                $cadenaSql .= " tipo_poliza='" . $variable [11] . "', ";
                $cadenaSql .= " fecha_inicio_pol='" . $variable [12] . "',  ";
                $cadenaSql .= " fecha_final_pol='" . $variable [13] . "',  ";
                $cadenaSql .= " marca='" . $variable [14] . "', ";
                $cadenaSql .= " serie='" . $variable [15] . "', ";
                $cadenaSql .= " nivel='" . $variable [17] . "' ";
                $cadenaSql .= "  WHERE id_elemento='" . $variable [16] . "';";

                break;

            case "consultar_placa_actulizada" :
                $cadenaSql = " SELECT placa";
                $cadenaSql .= " FROM elemento ";
                $cadenaSql .= " WHERE id_elemento='" . $variable . "'";

                break;

            case "estado_elemento" :

                $cadenaSql = " UPDATE ";
                $cadenaSql .= " elemento";
                $cadenaSql .= " SET ";
                $cadenaSql .= " estado='FALSE' ";
                $cadenaSql .= "  WHERE id_elemento='" . $variable . "';";
                break;
            // INSERT INTO elemento_anulado(
            // id_elemento_anulado, id_elemento, observacion)
            // VALUES ?, ?);

            case "anular_elemento" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " elemento_anulado(";
                $cadenaSql .= "id_elemento, observacion) ";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "') ";

                break;

            // _________________________________________________

            case "consultarSolicitante" :
                $cadenaSql = " SELECT ";
                $cadenaSql .= "dependencia, rubro ";
                $cadenaSql .= " FROM solicitante_servicios ";
                $cadenaSql .= " WHERE id_solicitante='" . $variable . "'";

                break;

            case "consultarEncargado" :
                $cadenaSql = " SELECT ";
                $cadenaSql .= " id_tipo_encargado, nombre, identificacion, cargo,asignacion  ";
                $cadenaSql .= " FROM encargado ";
                $cadenaSql .= " WHERE id_encargado='" . $variable . "'";

                break;

            // _________________________________________________update___________________________________________

            case "actualizarSolicitante" :

                $cadenaSql = " UPDATE ";
                $cadenaSql .= " solicitante_servicios";
                $cadenaSql .= " SET ";
                $cadenaSql .= " dependencia='" . $variable [0] . "',";
                $cadenaSql .= " rubro='" . $variable [1] . "' ";
                $cadenaSql .= "  WHERE id_solicitante='" . $variable [2] . "';";
                break;

            case "actualizarSupervisor" :
                $cadenaSql = " UPDATE supervisor_servicios ";
                $cadenaSql .= " SET nombre='" . $variable [0] . "', ";
                $cadenaSql .= " cargo='" . $variable [1] . "', ";
                $cadenaSql .= " dependencia='" . $variable [2] . "' ";
                $cadenaSql .= "  WHERE id_supervisor='" . $variable [3] . "';";

                break;

            case "actualizarContratista" :
                $cadenaSql = " UPDATE contratista_servicios ";
                $cadenaSql .= " SET nombre_razon_social='" . $variable [0] . "', ";
                $cadenaSql .= " identificacion='" . $variable [1] . "', ";
                $cadenaSql .= " direccion='" . $variable [2] . "', ";
                $cadenaSql .= " telefono='" . $variable [3] . "', ";
                $cadenaSql .= " cargo='" . $variable [4] . "' ";
                $cadenaSql .= "  WHERE id_contratista='" . $variable [5] . "';";

                break;

            case "actualizarEncargado" :
                $cadenaSql = " UPDATE encargado ";
                $cadenaSql .= " SET id_tipo_encargado='" . $variable [0] . "', ";
                $cadenaSql .= " nombre='" . $variable [1] . "', ";
                $cadenaSql .= " identificacion='" . $variable [2] . "', ";
                $cadenaSql .= " cargo='" . $variable [3] . "', ";
                $cadenaSql .= " asignacion='" . $variable [4] . "' ";
                $cadenaSql .= "  WHERE id_encargado='" . $variable [5] . "';";

                break;

            case "actualizarOrden" :
                $cadenaSql = " UPDATE ";
                $cadenaSql .= " orden_servicio ";
                $cadenaSql .= " SET ";
                $cadenaSql .= " objeto_contrato='" . $variable [0] . "', ";
                if ($variable [1] != '') {
                    $cadenaSql .= " poliza1='" . $variable [1] . "', ";
                } else {
                    $cadenaSql .= " poliza1='0', ";
                }
                if ($variable [2] != '') {
                    $cadenaSql .= " poliza2='" . $variable [2] . "', ";
                } else {
                    $cadenaSql .= " poliza2='0', ";
                }
                if ($variable [3] != '') {
                    $cadenaSql .= " poliza3='" . $variable [3] . "', ";
                } else {
                    $cadenaSql .= " poliza3='0', ";
                }
                if ($variable [4] != '') {
                    $cadenaSql .= " poliza4='" . $variable [4] . "', ";
                } else {
                    $cadenaSql .= " poliza4='0', ";
                }
                $cadenaSql .= " duracion_pago='" . $variable [5] . "', ";
                $cadenaSql .= " fecha_inicio_pago='" . $variable [6] . "', ";
                $cadenaSql .= " fecha_final_pago='" . $variable [7] . "', ";
                $cadenaSql .= " forma_pago='" . $variable [8] . "', ";
                $cadenaSql .= " total_preliminar='" . $variable [9] . "', ";
                $cadenaSql .= " iva='" . $variable [10] . "', ";
                $cadenaSql .= " total='" . $variable [11] . "', ";
                $cadenaSql .= " fecha_diponibilidad='" . $variable [12] . "', ";
                $cadenaSql .= " numero_disponibilidad='" . $variable [13] . "', ";
                $cadenaSql .= " valor_disponibilidad='" . $variable [14] . "', ";
                $cadenaSql .= " fecha_registrop='" . $variable [15] . "', ";
                $cadenaSql .= " numero_registrop='" . $variable [16] . "', ";
                $cadenaSql .= " valor_registrop='" . $variable [17] . "', ";
                $cadenaSql .= " letra_registrop='" . $variable [18] . "'  ";
                $cadenaSql .= "  WHERE id_orden_servicio='" . $variable [19] . "';";

                break;

            case "limpiarItems" :
                $cadenaSql = " DELETE FROM ";
                $cadenaSql .= " items_orden_compra ";
                $cadenaSql .= " WHERE id_orden='" . $variable . "';";
                break;

            case "insertarItems" :
                $cadenaSql = " INSERT INTO ";
                $cadenaSql .= " items_orden_compra(";
                $cadenaSql .= " id_orden, item, unidad_medida, cantidad, descripcion, ";
                $cadenaSql .= " valor_unitario, valor_total)";
                $cadenaSql .= " VALUES (";
                $cadenaSql .= "'" . $variable [0] . "',";
                $cadenaSql .= "'" . $variable [1] . "',";
                $cadenaSql .= "'" . $variable [2] . "',";
                $cadenaSql .= "'" . $variable [3] . "',";
                $cadenaSql .= "'" . $variable [4] . "',";
                $cadenaSql .= "'" . $variable [5] . "',";
                $cadenaSql .= "'" . $variable [6] . "');";

                break;

            // listo
            case "consultarOrden" :

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
                if ($variable [3] != '') {
                    $cadenaSql .= " AND  identificacion= '" . $variable [3] . "'";
                }
                if ($variable [4] != '') {
                    $cadenaSql .= " AND  dependencia= '" . $variable [4] . "'";
                }

                break;

            case "consultar_nivel_inventario" :

                $cadenaSql = "SELECT ce.elemento_id, ce.elemento_codigo||' - '||ce.elemento_nombre ";
                $cadenaSql .= "FROM grupo.catalogo_elemento  ce ";
                $cadenaSql .= "JOIN grupo.catalogo_lista cl ON cl.lista_id = ce.elemento_catalogo  ";
                $cadenaSql .= "WHERE cl.lista_activo = 1  ";
                $cadenaSql .= "AND  ce.elemento_id > 0  ";
                $cadenaSql .= "ORDER BY ce.elemento_codigo ASC ;";

                break;

            case "ConsultaTipoBien" :

                $cadenaSql = "SELECT  ce.elemento_tipobien , tb.descripcion  ";
                $cadenaSql .= "FROM grupo.catalogo_elemento ce ";
                $cadenaSql .= "JOIN  arka_inventarios.tipo_bienes tb ON tb.id_tipo_bienes = ce.elemento_tipobien  ";
                $cadenaSql .= "WHERE ce.elemento_id = '" . $variable . "';";

                break;

            case "UbicacionesConsultadas" :
                $cadenaSql = "SELECT DISTINCT  espacios.\"ESF_ID_ESPACIO\" , espacios.\"ESF_NOMBRE_ESPACIO\"";
                $cadenaSql .= " FROM elemento_individual eli  ";
                $cadenaSql .= " JOIN arka_parametros.arka_funcionarios fun ON fun.\"FUN_IDENTIFICACION\"=eli.funcionario ";
                $cadenaSql .= " JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " JOIN arka_inventarios.elemento as ele ON ele.id_elemento=eli.id_elemento_gen  ";
                $cadenaSql .= "  WHERE ad.\"ESF_CODIGO_DEP\"='" . $variable['dependencia'] . "' AND sas.\"ESF_ID_SEDE\"='".$variable['sede']."' ";
                if ($variable['funcionario'] != null || $variable['funcionario'] != '') {
                    $cadenaSql .= " AND fun.\"FUN_IDENTIFICACION\"=" . $variable['funcionario'] . "";
                }
                $cadenaSql .= "  AND ele.tipo_bien<>1";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A' ORDER BY espacios.\"ESF_NOMBRE_ESPACIO\" ";
                break;

            case "consultarFuncionario" :

                $cadenaSql = "SELECT \"FUN_IDENTIFICACION\" identificacion , \"FUN_NOMBRE\" nombre ";
                $cadenaSql .= "FROM  arka_parametros.arka_funcionarios ";
                $cadenaSql .= "WHERE \"FUN_IDENTIFICACION\"='" . $variable . "'";

                break;
            case "consultarNivelesFuncionario" :
                $cadenaSql = " SELECT DISTINCT ele.nivel , ce.elemento_nombre ";
                $cadenaSql .= " FROM elemento_individual eli  ";
                $cadenaSql .= " JOIN elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= " JOIN tipo_bienes tb ON tb.id_tipo_bienes = ele.tipo_bien  ";
                $cadenaSql .= " LEFT JOIN estado_elemento est ON est.id_elemento_ind = eli.id_elemento_ind  ";
                $cadenaSql .= " LEFT JOIN tipo_falt_sobr tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr ";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_funcionarios fn ON fn.\"FUN_IDENTIFICACION\"= eli.funcionario ";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_dependencia as ad ON ad.\"ESF_ID_ESPACIO\"=eli.ubicacion_elemento  ";
                $cadenaSql .= " LEFT JOIN arka_parametros.arka_sedes as sas ON sas.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\"  ";
                $cadenaSql .= " LEFT JOIN asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind AND asl.estado = 1   ";
                $cadenaSql .= " LEFT JOIN catalogo.catalogo_elemento ce ON ce.elemento_id=ele.nivel    ";
                $cadenaSql .= " LEFT JOIN arka_inventarios.baja_elemento bj ON bj.id_elemento_ind=eli.id_elemento_ind AND bj.estado_registro = TRUE  ";
                $cadenaSql .= "  WHERE tb.id_tipo_bienes <> 1 AND bj.id_elemento_ind IS NULL AND eli.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM estado_elemento) AND eli.estado_registro = 'TRUE' AND eli.funcionario= '41762709' ";
                $cadenaSql .= " AND ele.nivel=104 OR ele.nivel=78  ";
                $cadenaSql .= " ORDER BY ele.nivel ASC;  ";
                break;
        }
        return $cadenaSql;
    }

}

?>
