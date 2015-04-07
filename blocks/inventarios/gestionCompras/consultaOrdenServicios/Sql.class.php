<?php

namespace inventarios\gestionCompras\consultaOrdenServicios;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

// Para evitar redefiniciones de clases el nombre de la clase del archivo sqle debe corresponder al nombre del bloque
// en camel case precedida por la palabra sql
class Sql extends \Sql {
	var $miConfigurador;
	function __construct() {
		$this->miConfigurador = \Configurador::singleton ();
	}
	function getCadenaSql($tipo, $variable = "") {
		
		/**
		 * 1.
		 * Revisar las variables para evitar SQL Injection
		 */
		$prefijo = $this->miConfigurador->getVariableConfiguracion ( "prefijo" );
		$idSesion = $this->miConfigurador->getVariableConfiguracion ( "id_sesion" );
		
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
				$cadenaSql .= "'" . time () . "' ";
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
				
				foreach ( $_REQUEST as $clave => $valor ) {
					$cadenaSql .= "( ";
					$cadenaSql .= "'" . $idSesion . "', ";
					$cadenaSql .= "'" . $variable ['formulario'] . "', ";
					$cadenaSql .= "'" . $clave . "', ";
					$cadenaSql .= "'" . $valor . "', ";
					$cadenaSql .= "'" . $variable ['fecha'] . "' ";
					$cadenaSql .= "),";
				}
				
				$cadenaSql = substr ( $cadenaSql, 0, (strlen ( $cadenaSql ) - 1) );
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
			
			case "informacionPresupuestal" :
				$cadenaSql = "SELECT  vigencia_dispo, numero_dispo, valor_disp, fecha_dip,
									letras_dispo, vigencia_regis, numero_regis, valor_regis, fecha_regis,
									letras_regis  ";
				$cadenaSql .= "FROM informacion_presupuestal_orden ";
				$cadenaSql .= "WHERE id_informacion ='" . $variable . "' ";
				
				break;
			
			case "buscar_contratista" :
				$cadenaSql = "SELECT CON_IDENTIFICADOR AS IDENTIFICADOR , CON_IDENTIFICACION ||'  -  '||CON_NOMBRE AS CONTRATISTA ";
				$cadenaSql .= "FROM CONTRATISTAS ";
				$cadenaSql .= "WHERE CON_VIGENCIA ='" . $variable . "' ";
				break;
			
			case "vigencia_contratista" :
				$cadenaSql = "SELECT CON_VIGENCIA AS VALOR , CON_VIGENCIA AS VIGENCIA  ";
				$cadenaSql .= "FROM CONTRATISTAS ";
				$cadenaSql .= "GROUP BY CON_VIGENCIA ";
				break;
			
			case "vigencia_disponibilidad" :
				$cadenaSql = "SELECT DIS_VIGENCIA AS valor, DIS_VIGENCIA AS vigencia  ";
				$cadenaSql .= "FROM DISPONIBILIDAD ";
				$cadenaSql .= "GROUP BY DIS_VIGENCIA";
				break;
			
			case "buscar_disponibilidad" :
				$cadenaSql = "SELECT DISTINCT DIS_IDENTIFICADOR AS identificador,DIS_NUMERO_DISPONIBILIDAD AS numero ";
				$cadenaSql .= "FROM DISPONIBILIDAD ";
				$cadenaSql .= "WHERE DIS_VIGENCIA='" . $variable . "'";
				
				break;
			
			case "info_disponibilidad" :
				$cadenaSql = "SELECT DISTINCT TO_CHAR(DIS_FECHA_REGISTRO,'yyyy-mm-dd') AS FECHA,  DIS_VALOR ";
				$cadenaSql .= "FROM DISPONIBILIDAD  ";
				$cadenaSql .= "WHERE DIS_VIGENCIA='" . $variable [1] . "' ";
				$cadenaSql .= "AND  DIS_IDENTIFICADOR='" . $variable [0] . "' ";
				$cadenaSql .= "AND ROWNUM = 1 ";
				
				break;
			
			case "vigencia_registro" :
				$cadenaSql = "SELECT REP_VIGENCIA AS VALOR,REP_VIGENCIA AS VIGENCIA ";
				$cadenaSql .= "FROM REGISTRO_PRESUPUESTAL ";
				$cadenaSql .= "GROUP BY REP_VIGENCIA ";
				
				break;
			
			case "buscar_registro" :
				$cadenaSql = "SELECT DISTINCT REP_IDENTIFICADOR AS IDENTIFICADOR,REP_NUMERO_DISPONIBILIDAD AS NUMERO ";
				$cadenaSql .= "FROM REGISTRO_PRESUPUESTAL ";
				$cadenaSql .= "WHERE REP_VIGENCIA='" . $variable . "'";
				
				break;
			
			case "info_registro" :
				$cadenaSql = "SELECT TO_CHAR(REP_FECHA_REGISTRO,'yyyy-mm-dd') AS fecha,  REP_VALOR ";
				$cadenaSql .= "FROM REGISTRO_PRESUPUESTAL ";
				$cadenaSql .= "WHERE REP_VIGENCIA='" . $variable [1] . "' ";
				$cadenaSql .= "AND  REP_IDENTIFICADOR='" . $variable [0] . "' ";
				$cadenaSql .= "AND ROWNUM = 1 ";
				
				break;
			
			case "informacion_supervisor" :
				$cadenaSql = " SELECT JEF_NOMBRE,JEF_IDENTIFICADOR ";
				$cadenaSql .= " FROM JEFES_DE_SECCION ";
				$cadenaSql .= " WHERE  JEF_IDENTIFICADOR='" . $variable . "' ";
				break;
			
			case "informacion_cargo_jefe" :
				$cadenaSql = " SELECT JEF_NOMBRE,JEF_IDENTIFICADOR ";
				$cadenaSql .= " FROM JEFES_DE_SECCION ";
				$cadenaSql .= " WHERE  JEF_IDENTIFICADOR='" . $variable . "' ";
				break;
			
			case "constratistas" :
				$cadenaSql = " SELECT CON_IDENTIFICADOR,CON_IDENTIFICACION ||' - '|| CON_NOMBRE ";
				$cadenaSql .= "FROM CONTRATISTAS ";
				
				break;
			
			case "informacion_ordenador" :
				$cadenaSql = " SELECT ORG_NOMBRE,ORG_IDENTIFICADOR  ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				$cadenaSql .= " WHERE  ORG_IDENTIFICADOR='" . $variable . "'";
				
				break;
			
			case "cargo_jefe" :
				$cadenaSql = " SELECT JEF_IDENTIFICADOR,JEF_DEPENDENCIA_PERTENECIENTE ";
				$cadenaSql .= " FROM JEFES_DE_SECCION ";
				break;
			
			case "ordenador_gasto" :
				$cadenaSql = " 	SELECT ORG_IDENTIFICADOR, ORG_ORDENADOR_GASTO ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				break;
			
			case "constratistas" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_encargado,";
				$cadenaSql .= "identificacion ||' - '|| nombres ||' 	'||apellidos as contratista ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " encargado ";
				$cadenaSql .= " WHERE id_tipo_encargado='3' AND estado='TRUE'";
				break;
			
			case "cargo_jefe" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_cargo,";
				$cadenaSql .= "descripcion ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " tipo_cargo ; ";
				break;
			
			case "rubros" :
				$cadenaSql = " SELECT RUB_IDENTIFICADOR, RUB_RUBRO ||' - '|| RUB_NOMBRE_RUBRO ";
				$cadenaSql .= " FROM RUBROS ";
				
				break;
			
			case "dependencia" :
				$cadenaSql = " SELECT DEP_IDENTIFICADOR, DEP_IDENTIFICADOR ||' - ' ||DEP_DEPENDENCIA  ";
				$cadenaSql .= "FROM DEPENDENCIAS ";
				break;
			
			case 'seleccion_contratista' :
				$cadenaSql = " SELECT id_contratista, ";
				$cadenaSql .= "  identificacion||' - '|| nombre_razon_social contratista ";
				$cadenaSql .= "FROM contratista_servicios;";
				
				break;
			
			case "polizas" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_polizas,";
				$cadenaSql .= " poliza_1, ";
				$cadenaSql .= " poliza_2, ";
				$cadenaSql .= " poliza_3,";
				$cadenaSql .= " poliza_4 ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " polizas ";
				$cadenaSql .= " WHERE ";
				$cadenaSql .= " estado=TRUE ";
				$cadenaSql .= " AND ";
				$cadenaSql .= " modulo_tipo=2 ";
				break;
			
			case "textos" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " tipo_parrafo,parrafo";
				$cadenaSql .= " FROM";
				$cadenaSql .= " parrafos ";
				$cadenaSql .= " WHERE ";
				$cadenaSql .= " estado=TRUE ";
				$cadenaSql .= " AND ";
				$cadenaSql .= " modulo_parrafo=2  ";
				$cadenaSql .= " ORDER BY id_parrafos DESC ";
				break;
			
			// _________________________________________________
			
			case "consultarOrdenServicios" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " dependencia_solicitante,rubro,objeto_contrato, poliza1,";
				$cadenaSql .= "poliza2, poliza3, poliza4, duracion_pago, fecha_inicio_pago,";
				$cadenaSql .= "fecha_final_pago, forma_pago, total_preliminar, iva, total,id_contratista,";
				$cadenaSql .= "id_contratista_encargado, vig_contratista, id_ordenador_encargado,";
				$cadenaSql .= "id_supervisor ,info_presupuestal ";
				$cadenaSql .= " FROM orden_servicio ";
				$cadenaSql .= " WHERE id_orden_servicio='" . $variable . "' AND estado='TRUE';";
				break;
			
			case "consultarContratista" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " nombre_razon_social, identificacion,direccion,telefono, cargo ";
				$cadenaSql .= " FROM contratista_servicios ";
				$cadenaSql .= " WHERE id_contratista='" . $variable . "'";
				
				break;
			
			case "consultarSupervisor" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= "  nombre, cargo, dependencia";
				$cadenaSql .= " FROM supervisor_servicios ";
				$cadenaSql .= " WHERE id_supervisor='" . $variable . "'";
				
				break;
			
			case "consultarSolicitante" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= "dependencia, rubro ";
				$cadenaSql .= " FROM solicitante_servicios ";
				$cadenaSql .= " WHERE id_solicitante='" . $variable . "'";
				
				break;
			
			case "consultarEncargado" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " nombres ||' '||apellidos as nombre, cargo,asignacion  ";
				$cadenaSql .= " FROM encargado ";
				$cadenaSql .= " WHERE id_encargado='" . $variable . "' AND estado=TRUE";
				
				break;
			// ____________________________________update___________________________________________
			
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
				$cadenaSql .= " dependencia_solicitante='" . $variable [0] . "', ";
				$cadenaSql .= " rubro='" . $variable [1] . "', ";
				$cadenaSql .= " objeto_contrato='" . $variable [2] . "', ";
				
				if ($variable [3] != '') {
					$cadenaSql .= " poliza1='" . $variable [3] . "', ";
				} else {
					$cadenaSql .= " poliza1='0', ";
				}
				if ($variable [4] != '') {
					$cadenaSql .= " poliza2='" . $variable [4] . "', ";
				} else {
					$cadenaSql .= " poliza2='0', ";
				}
				
				if ($variable [5] != '') {
					$cadenaSql .= " poliza3='" . $variable [5] . "', ";
				} else {
					$cadenaSql .= " poliza3='0', ";
				}
				if ($variable [6] != '') {
					$cadenaSql .= " poliza4='" . $variable [6] . "', ";
				} else {
					$cadenaSql .= " poliza4='0', ";
				}
				
				$cadenaSql .= " duracion_pago='" . $variable [7] . "', ";
				$cadenaSql .= " fecha_inicio_pago='" . $variable [8] . "', ";
				$cadenaSql .= " fecha_final_pago='" . $variable [9] . "', ";
				$cadenaSql .= " forma_pago='" . $variable [10] . "', ";
				$cadenaSql .= " total_preliminar='" . $variable [11] . "', ";
				$cadenaSql .= " iva='" . $variable [12] . "', ";
				$cadenaSql .= " total='" . $variable [13] . "', ";
				$cadenaSql .= " id_ordenador_encargado='" . $variable [14] . "', ";
				$cadenaSql .= " vig_contratista='" . $variable [15] . "', ";
				$cadenaSql .= " id_contratista_encargado='" . $variable [16] . "' ";
				$cadenaSql .= "  WHERE id_orden_servicio='" . $variable [17] . "';";
				
				
				break;
			
			case "actualizarPresupuestal" :
				$cadenaSql = " UPDATE informacion_presupuestal_orden ";
				$cadenaSql .= " SET vigencia_dispo='" . $variable [0] . "', ";
				$cadenaSql .= " numero_dispo='" . $variable [1] . "', ";
				$cadenaSql .= " valor_disp='" . $variable [2] . "', ";
				$cadenaSql .= " fecha_dip='" . $variable [3] . "', ";
				$cadenaSql .= " letras_dispo='" . $variable [4] . "', ";
				$cadenaSql .= " vigencia_regis='" . $variable [5] . "', ";
				$cadenaSql .= " numero_regis='" . $variable [6] . "', ";
				$cadenaSql .= " valor_regis='" . $variable [7] . "', ";
				$cadenaSql .= " fecha_regis='" . $variable [8] . "', ";
				$cadenaSql .= " letras_regis='" . $variable [9] . "' ";
				$cadenaSql .= "  WHERE id_informacion='" . $variable [10] . "';";
				
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
			
			case "dependecia_solicitante" :
				$cadenaSql = " SELECT DEP_DEPENDENCIA  ";
				$cadenaSql .= " FROM DEPENDENCIAS  ";
				$cadenaSql .= " WHERE DEP_IDENTIFICADOR='" . $variable . "' ";
				
				break;
			
			case "identificacion_contratista" :
				$cadenaSql = " SELECT CON_IDENTIFICACION  ";
				$cadenaSql .= " FROM CONTRATISTAS  ";
				$cadenaSql .= " WHERE CON_IDENTIFICADOR='" . $variable . "' ";
				
				break;
			
			case "consultarOrden" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_orden_servicio, fecha_registro,  ";
				$cadenaSql .= "id_contratista_encargado , dependencia_solicitante   ";
				$cadenaSql .= "FROM orden_servicio ";
				// $cadenaSql .= "JOIN dependencia ON dependencia.id_dependencia = orden_servicio.dependencia_solicitante ";
				// $cadenaSql .= "JOIN contratista_servicios ON contratista_servicios.id_contratista = orden_servicio.id_contratista ";
				$cadenaSql .= "WHERE 1=1 AND estado='TRUE' ";
				
				if ($variable [0] != '') {
					$cadenaSql .= " AND id_orden_servicio = '" . $variable [0] . "'";
				}
				if ($variable [1] != '') {
					$cadenaSql .= " AND  orden_servicio.id_contratista= '" . $variable [1] . "'";
				}
				if ($variable [2] != '') {
					$cadenaSql .= " AND  dependencia_solicitante= '" . $variable [2] . "'";
				}
				
				if ($variable [3] != '') {
					$cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [3] . "' AS DATE) ";
					$cadenaSql .= " AND  CAST ( '" . $variable [4] . "' AS DATE)  ";
				}
				
				if ($variable [5] != '') {
					$cadenaSql .= " AND  vig_contratista= '" . $variable [5] . "'";
				}
				
				break;
		}
		return $cadenaSql;
	}
}
?>
