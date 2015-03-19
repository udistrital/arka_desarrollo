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
			
			case "informacion_cargo_jefe" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " nombres ||' '||apellidos,";
				$cadenaSql .= " id_encargado ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " encargado ";
				$cadenaSql .= " WHERE id_tipo_encargado='2' AND estado='TRUE' ";
				$cadenaSql .= "AND cargo='" . $variable . "';";
				
				break;
			
			case "informacion_ordenador" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " nombres ||' '||apellidos, ";
				$cadenaSql .= " id_encargado";
				$cadenaSql .= " FROM";
				$cadenaSql .= " encargado ";
				$cadenaSql .= " WHERE id_tipo_encargado='1' AND estado='TRUE' ";
				$cadenaSql .= "AND asignacion='" . $variable . "';";
				
				break;
			
			case "ordenador_gasto" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_ordenador,";
				$cadenaSql .= " descripcion ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " tipo_ordenador_gasto ";
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
			case "informacion_cargo_jefe" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " nombres ||' '||apellidos,";
				$cadenaSql .= " id_encargado ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " encargado ";
				$cadenaSql .= " WHERE id_tipo_encargado='2' AND estado='TRUE' ";
				$cadenaSql .= "AND cargo='" . $variable . "';";
				
				break;
			
			case "informacion_ordenador" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " nombres ||' '||apellidos, ";
				$cadenaSql .= " id_encargado";
				$cadenaSql .= " FROM";
				$cadenaSql .= " encargado ";
				$cadenaSql .= " WHERE id_tipo_encargado='1' AND estado='TRUE' ";
				$cadenaSql .= "AND asignacion='" . $variable . "';";
				
				break;
			
			case "ordenador_gasto" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_ordenador,";
				$cadenaSql .= " descripcion ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " tipo_ordenador_gasto ";
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
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_rubro,";
				$cadenaSql .= " codigo  ||' - '|| nombre as rubro ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " rubro ; ";
				break;
			
			case "dependencia" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_dependencia,";
				$cadenaSql .= " cod_dependencia  ||' - '|| nombre as dependencia ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " dependencia ; ";
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
				$cadenaSql .= "fecha_final_pago, forma_pago, total_preliminar, iva, total, fecha_diponibilidad,";
				$cadenaSql .= "numero_disponibilidad, valor_disponibilidad, fecha_registrop,";
				$cadenaSql .= " numero_registrop, valor_registrop, letra_registrop, id_contratista,";
				$cadenaSql .= "id_contratista_encargado, id_jefe_encargado, id_ordenador_encargado,";
				$cadenaSql .= "id_supervisor ";
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
// 				____________________________________update___________________________________________
			
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
				$cadenaSql .= " fecha_diponibilidad='" . $variable [14] . "', ";
				$cadenaSql .= " numero_disponibilidad='" . $variable [15] . "', ";
				$cadenaSql .= " valor_disponibilidad='" . $variable [16] . "', ";
				$cadenaSql .= " fecha_registrop='" . $variable [17] . "', ";
				$cadenaSql .= " numero_registrop='" . $variable [18] . "', ";
				$cadenaSql .= " valor_registrop='" . $variable [19] . "', ";
				$cadenaSql .= " letra_registrop='" . $variable [20] . "',  ";
				$cadenaSql .= " id_ordenador_encargado='" . $variable [21] . "', ";
				$cadenaSql .= " id_jefe_encargado='" . $variable [22] . "', ";
				$cadenaSql .= " id_contratista_encargado='" . $variable [23] . "' ";
				$cadenaSql .= "  WHERE id_orden_servicio='" . $variable [24] . "';";
				
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
			
			case "consultarOrden" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_orden_servicio, fecha_registro,  ";
				$cadenaSql .= "identificacion, nombre  ";
				$cadenaSql .= "FROM orden_servicio ";
				$cadenaSql .= "JOIN dependencia ON dependencia.id_dependencia = orden_servicio.dependencia_solicitante ";
				$cadenaSql .= "JOIN contratista_servicios ON contratista_servicios.id_contratista = orden_servicio.id_contratista ";
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
				
				break;
		}
		return $cadenaSql;
	}
}
?>
