<?php

namespace inventarios\asignarInventarioC\asignarInventario;

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
            case "estadoPazSalvo2" :
                $cadenaSql = " INSERT INTO estado_pazsalvo (pz_contratista,pz_estado,pz_fecha) VALUES (20102020" . $variable . ",'TRUE','2017-02-25')";
                echo $cadenaSql;
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

            // -----------------------------** Cláusulas del caso de uso**----------------------------------//

            case "consultarContratista" :
                $cadenaSql = " SELECT id_contratista, identificacion ";
                $cadenaSql .= " FROM contratista_servicios ";
                $cadenaSql .= " WHERE identificacion='" . $variable . "';";
                break;

            case "consultarElementosSupervisor" :

                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "  eli.id_elemento_ind  , eli.placa ,
											ele.marca marca,
											ele.serie serie,
										sas.\"ESF_SEDE\" sede,
						       ad.\"ESF_DEP_ENCARGADA\" dependencia,
						   espacios.\"ESF_NOMBRE_ESPACIO\" espacio_fisico, 
						ele.descripcion,
						
						
						
							CASE eli.confirmada_existencia
											WHEN  't'  THEN 'X' 
											ELSE  ' '
											END  marca_existencia,
										\"FUN_NOMBRE\" nombre_funcionario, 					
                						 
                						CASE
                						WHEN  tfs.descripcion IS  NULL THEN 'Activo'
										ELSE  tfs.descripcion  
                						END   as estado_bien, 
						               ele.descripcion descripcion_elemento,
						              eli.confirmada_existencia , 
						               eli.tipo_confirmada, espacios.\"ESF_NOMBRE_ESPACIO\" espaciofisico,
										crn.\"CON_IDENTIFICACION\"||'-'||crn.\"CON_NOMBRE\" contratista 
						
						
						
						               ";
                $cadenaSql .= "FROM elemento_individual  eli ";
                $cadenaSql .= "JOIN elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= "JOIN tipo_bienes  tb ON tb.id_tipo_bienes = ele.tipo_bien ";
                $cadenaSql .= "LEFT JOIN estado_elemento  est ON est.id_elemento_ind = eli.id_elemento_ind ";
                $cadenaSql .= "LEFT JOIN tipo_falt_sobr  tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr   ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_funcionarios fn ON fn.\"FUN_IDENTIFICACION\"= eli.funcionario ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as ad ON ad."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sas ON sas."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= ' LEFT JOIN  asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind ';
                $cadenaSql .= ' LEFT JOIN  arka_parametros.arka_contratistas crn ON crn."CON_IDENTIFICACION"=asl.contratista  ';
                $cadenaSql .= " WHERE tb.id_tipo_bienes <> 1  ";
                if ($aux  != '' && $aux=='104') {
                    $cadenaSql .= ' AND ele.nivel=104';
                }
                if ($aux  != '' && $aux=='78') {
                    $cadenaSql .= ' AND ele.nivel=78';
                }
                if ($aux  != '' && $aux=='500') {
                    $cadenaSql .= ' AND tb.id_tipo_bienes =3   AND ele.nivel<>104 AND ele.nivel<>78 ';
                }
                if ($aux  != '' && $aux=='600') {
                    $cadenaSql .= ' AND tb.id_tipo_bienes =2   AND ele.nivel<>104 AND ele.nivel<>78  ';
                }
                $cadenaSql .= " AND eli.estado_registro = 'TRUE'  ";
                $cadenaSql .= " AND eli.estado_asignacion=FALSE  ";
                $cadenaSql .= " AND eli.funcionario= '" . $variable . "' ";

                break;

		case "consultarElementosSupervisor2" :

                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= "  eli.id_elemento_ind  , eli.placa ,
											ele.marca marca,
											ele.serie serie,
										sas.\"ESF_SEDE\" sede,
						       ad.\"ESF_DEP_ENCARGADA\" dependencia,
						   espacios.\"ESF_NOMBRE_ESPACIO\" espacio_fisico, 
						ele.descripcion,
						
						
						
							CASE eli.confirmada_existencia
											WHEN  't'  THEN 'X' 
											ELSE  ' '
											END  marca_existencia,
										\"FUN_NOMBRE\" nombre_funcionario, 					
                						 
                						CASE
                						WHEN  tfs.descripcion IS  NULL THEN 'Activo'
										ELSE  tfs.descripcion  
                						END   as estado_bien, 
						               ele.descripcion descripcion_elemento,
						              eli.confirmada_existencia , 
						               eli.tipo_confirmada, espacios.\"ESF_NOMBRE_ESPACIO\" espaciofisico,
										crn.\"CON_IDENTIFICACION\"||'-'||crn.\"CON_NOMBRE\" contratista 
						
						
						
						               ";
                $cadenaSql .= "FROM elemento_individual  eli ";
                $cadenaSql .= "JOIN elemento ele ON ele.id_elemento =eli .id_elemento_gen ";
                $cadenaSql .= "JOIN tipo_bienes  tb ON tb.id_tipo_bienes = ele.tipo_bien ";
                $cadenaSql .= "LEFT JOIN estado_elemento  est ON est.id_elemento_ind = eli.id_elemento_ind ";
                $cadenaSql .= "LEFT JOIN tipo_falt_sobr  tfs ON tfs.id_tipo_falt_sobr = est.tipo_faltsobr   ";
                $cadenaSql .= "LEFT JOIN arka_parametros.arka_funcionarios fn ON fn.\"FUN_IDENTIFICACION\"= eli.funcionario ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia as ad ON ad."ESF_ID_ESPACIO"=eli.ubicacion_elemento ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_sedes as sas ON sas."ESF_COD_SEDE"=espacios."ESF_COD_SEDE" ';
                $cadenaSql .= ' LEFT JOIN  asignar_elementos asl ON asl.id_elemento=eli.id_elemento_ind ';
                $cadenaSql .= ' LEFT JOIN  arka_parametros.arka_contratistas crn ON crn."CON_IDENTIFICACION"=asl.contratista  ';
                $cadenaSql .= " WHERE tb.id_tipo_bienes <> 1  ";
                if ($aux  != '' && $aux=='104') {
                    $cadenaSql .= ' AND ele.nivel=104';
                }
                if ($aux  != '' && $aux=='78') {
                    $cadenaSql .= ' AND ele.nivel=78';
                }
                if ($aux  != '' && $aux=='500') {
                    $cadenaSql .= ' AND tb.id_tipo_bienes =3   AND ele.nivel<>104 AND ele.nivel<>78 ';
                }
                if ($aux  != '' && $aux=='600') {
                    $cadenaSql .= ' AND tb.id_tipo_bienes =2   AND ele.nivel<>104 AND ele.nivel<>78  ';
                }
                $cadenaSql .= " AND eli.estado_registro = 'TRUE'  ";
                $cadenaSql .= " AND eli.estado_asignacion=FALSE  ";
                $cadenaSql .= " AND eli.funcionario= '" . $variable . "' limit 1 ";

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


            case "consultarID" :
                $cadenaSql = " SELECT id_contratista ";
                $cadenaSql .= " FROM contratista_servicios ";
                $cadenaSql .= " WHERE identificacion = '" . $variable . "' ";
                break;

            case "asignarElemento" :
                $cadenaSql = "INSERT INTO asignar_elementos( ";
                $cadenaSql .= " contratista, ";
                $cadenaSql .= " supervisor, ";
                $cadenaSql .= " id_elemento, ";
                $cadenaSql .= " estado, ";
                $cadenaSql .= " fecha_registro,tipo_contrato,numero_contrato,vigencia, nombre_contratista)";
                $cadenaSql .= " VALUES ( ";
                $cadenaSql .= " '" . $variable [0] . "', ";
                $cadenaSql .= " '" . $variable [1] . "', ";
                $cadenaSql .= " '" . $variable [2] . "', ";
                $cadenaSql .= " '" . $variable [3] . "', ";
                $cadenaSql .= " '" . $variable [4] . "', ";
                $cadenaSql .= " '" . $variable [5] . "', ";
                $cadenaSql .= " '" . $variable [6] . "', ";
                $cadenaSql .= " '" . $variable [7] . "', ";
                $cadenaSql .= " '" . $variable [8] . "'";
                $cadenaSql .= " );";

                break;
            
             case "actualizarPazSalvo" :
                $cadenaSql = " UPDATE estado_pazsalvo ";
                $cadenaSql .= " SET pz_estado='".$variable[1]."' , pz_fecha='".$variable[2]."'";
                $cadenaSql .= " WHERE pz_contratista = " . $variable[0] . " ";
                echo $cadenaSql;
                break;

            case "inactivarElemento" :
                $cadenaSql = "UPDATE elemento_individual ";
                $cadenaSql .= " SET ";
                $cadenaSql .= " estado_asignacion = '" . $variable [1] . "', ";
                $cadenaSql .= " fecha_asignacion = '" . $variable [2] . "'";
                $cadenaSql .= " WHERE id_elemento_ind = '" . $variable [0] . "';";
                break;

            /*             * *************** */

            // Consultas de Oracle para rescate de información de Sicapital
            case "dependencias" :
                $cadenaSql = "SELECT DEP_IDENTIFICADOR, ";
                $cadenaSql .= " DEP_IDENTIFICADOR ||' '|| DEP_DEPENDENCIA ";
                // $cadenaSql .= " DEP_DIRECCION, DEP_TELEFONO ";F
                $cadenaSql .= " FROM DEPENDENCIAS ";
                break;

            case "proveedores" :
                $cadenaSql = "SELECT PRO_NIT, PRO_NIT ||' '|| PRO_RAZON_SOCIAL";
                $cadenaSql .= " FROM PROVEEDORES ";
                break;

            case "select_proveedor" :
                $cadenaSql = "SELECT PRO_RAZON_SOCIAL";
                $cadenaSql .= " FROM PROVEEDORES ";
                $cadenaSql .= " WHERE PRO_NIT = '" . $variable . "' ";
                break;

            case "contratistas2" :

                $cadenaSql = "SELECT DISTINCT \"CON_IDENTIFICACION\"||'@'||tc_descripcion||'@'||\"CON_NUMERO_CONTRATO\"||'@'||\"CON_VIGENCIA_FISCAL\" valor
						, \"CON_IDENTIFICACION\" ||'-'|| \"CON_NOMBRE\"||': Contrato '|| tc_descripcion ||' N#' ||\"CON_NUMERO_CONTRATO\"||' - Vigencia '||\"CON_VIGENCIA_FISCAL\" ";
                $cadenaSql .= "FROM arka_parametros.arka_contratistas ";
                $cadenaSql .= "JOIN arka_parametros.arka_tipo_contrato tp ON tp.tc_identificador=\"CON_TIPO_CONTRATO\"";
                $cadenaSql .= "WHERE \"CON_FECHA_INICIO\" <= '" . date('Y-m-d') . "' ";
                $cadenaSql .= "AND \"CON_FECHA_FINAL\" >= '" . date('Y-m-d') . "' ";

                break;

            case "contratistas" :

                $cadenaSql = "SELECT num_documento,num_documento || ' - ' || nom_proveedor ";
                $cadenaSql .= "FROM agora.informacion_proveedor ";
                $cadenaSql .= "WHERE id_proveedor IN(";
                $contador = 0;
                while ($contador < (count($variable))) {
                    if ($contador == (count($variable) - 1)) {
                        $cadenaSql .= $variable[$contador][0] . ")";
                    } else {
                        $cadenaSql .= $variable[$contador][0] . ", ";
                    }

                    $contador++;
                }



                break;

            case "consecutivo_contratistas" :

                $cadenaSql = "SELECT contratista FROM( ";
                $cadenaSql .= "SELECT DISTINCT cg.contratista, ";
                $cadenaSql .= "CASE WHEN unidad_ejecucion=205 THEN (pol.fecha_aprobacion::date +CAST('\"' || (plazo_ejecucion/30) || 'months\"' AS INTERVAL) +CAST('\"' || (plazo_ejecucion%30) || 'days\"' AS INTERVAL)) ::date  ";
                $cadenaSql .= "WHEN unidad_ejecucion=206 THEN  (pol.fecha_aprobacion::date +CAST('\"' || (plazo_ejecucion) || 'months\"' AS INTERVAL)) ::date  ";
                $cadenaSql .= "WHEN unidad_ejecucion=207 THEN (pol.fecha_aprobacion::date +CAST('\"' || (plazo_ejecucion) || 'years\"' AS INTERVAL)) ::date  ";
                $cadenaSql .= "END as fecha_final_contrato ";
                $cadenaSql .= "FROM argo.contrato_general cg ";
                $cadenaSql .= "JOIN argo.contrato_cps as cps ON cps.numero_contrato=cg.numero_contrato ";
                $cadenaSql .= "JOIN argo.poliza as pol ON pol.numero_contrato=cg.numero_contrato AND pol.vigencia=cg.vigencia) as contratistas  ";
                $cadenaSql .= "WHERE '" . date('Y-m-d') . "' <= fecha_final_contrato ";

                break;


            case "nombreContratista" :
                $cadenaSql = " SELECT nom_proveedor ";
                $cadenaSql .= "FROM agora.informacion_proveedor ";
                $cadenaSql .= " WHERE num_documento=" . $variable;

                break;
        }
        return $cadenaSql;
    }

}

?>
