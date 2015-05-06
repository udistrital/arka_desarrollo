<?php

namespace inventarios\gestionEntradas\registrarEntradas;

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
			
			// _________________________________________________
			
			case "proveedores" :
				$cadenaSql = " SELECT PRO_IDENTIFICADOR,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor ";
				$cadenaSql .= " FROM PROVEEDORES ";
				
				break;
			
			case "insertarInformación" :
				$cadenaSql = " INSERT INTO info_clase_entrada(  ";
				$cadenaSql .= " observacion, id_entrada, id_salida, id_hurto,";
				$cadenaSql .= " num_placa, val_sobrante, ruta_archivo, nombre_archivo)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'" . $variable [6] . "',";
				$cadenaSql .= "'" . $variable [7] . "') ";
				$cadenaSql .= "RETURNING  id_info_clase; ";
				
				break;
			
			case "seleccion_proveedor" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_proveedor,";
				$cadenaSql .= " nit_proveedor ||' - '|| razon_social as proveedor ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " proveedor  ";
				$cadenaSql .= " UNION SELECT ";
				$cadenaSql .= " id_proveedor_n,";
				$cadenaSql .= " nit_proveedor ||' - '|| razon_social as proveedor ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " proveedor_nuevo ;";
				
				break;
			
			case "consultarActa" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_actarecibido, fecha_registro,  ";
				$cadenaSql .= "nitproveedor, proveedor  ";
				$cadenaSql .= "FROM registro_actarecibido ";
				$cadenaSql .= "WHERE 1=1";
				
				if ($variable [0] != '') {
					$cadenaSql .= " AND id_actarecibido = '" . $variable [0] . "'";
				}
				
				if ($variable [1] != '') {
					$cadenaSql .= " AND  proveedor= '" . $variable [1] . "'";
				}
				
				if ($variable [2] != '') {
					$cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [2] . "' AS DATE) ";
					$cadenaSql .= " AND  CAST ( '" . $variable [3] . "' AS DATE)  ";
				}
				
				$cadenaSql .= " ; ";
				
				break;
			
			case "clase_entrada" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_clase, descripcion  ";
				$cadenaSql .= "FROM clase_entrada;";
				
				break;
			
			case "tipo_contrato" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_tipo, descripcion  ";
				$cadenaSql .= "FROM tipo_contrato;";
				
				break;
			
			case "tipo_contrato_avance" :
				
				$cadenaSql = "SELECT id_tipo, descripcion ";
				$cadenaSql .= "FROM arka_inventarios.tipo_contrato ";
				$cadenaSql .= "WHERE id_tipo<>1;";
				
				break;
			
			case "proveedor" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_proveedor, razon_social ";
				$cadenaSql .= "FROM proveedor;";
				
				break;
			
			case "insertarReposicion" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " reposicion_entrada(";
				$cadenaSql .= " id_entrada, id_hurto, id_salida )";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "') ";
				$cadenaSql .= "RETURNING  id_reposicion; ";
				
				break;
			
			case "insertarDonacion" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " donacion_entrada(";
				$cadenaSql .= " ruta_acto, nombre_acto)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "') ";
				$cadenaSql .= "RETURNING  id_donacion; ";
				
				break;
			
			case "insertarSobrante" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " sobrante_entrada(";
				$cadenaSql .= " observaciones, ruta_acta, nombre_acta)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "') ";
				$cadenaSql .= "RETURNING  id_sobrante; ";
				
				break;
			
			case "insertarProduccion" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " produccion_entrada(";
				$cadenaSql .= " observaciones, ruta_acta, nombre_acta)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "') ";
				$cadenaSql .= "RETURNING  id_produccion; ";
				
				break;
			
			case "insertarRecuperacion" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " recuperacion_entrada(";
				$cadenaSql .= " observaciones, ruta_acta, nombre_acta)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "') ";
				$cadenaSql .= "RETURNING  id_recuperacion; ";
				
				break;
			
			case "insertarEntrada" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " entrada(";
				$cadenaSql .= " fecha_registro, vigencia, clase_entrada, info_clase, ";
				$cadenaSql .= " tipo_contrato, numero_contrato, fecha_contrato, proveedor, numero_factura, ";
				$cadenaSql .= " fecha_factura, observaciones, acta_recibido)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'" . $variable [6] . "',";
				$cadenaSql .= "'" . $variable [7] . "',";
				$cadenaSql .= "'" . $variable [8] . "',";
				$cadenaSql .= "'" . $variable [9] . "',";
				$cadenaSql .= "'" . $variable [10] . "',";
				$cadenaSql .= "'" . $variable [11] . "') ";
				$cadenaSql .= "RETURNING  id_entrada; ";
				
				break;
			
			// _______________________________________________
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
		}
		return $cadenaSql;
	}
}
?>
