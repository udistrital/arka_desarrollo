<?php

namespace inventarios\gestionCompras\consultaOrdenCompra;

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
			
			case "seleccionar_forma_pago" :
				$cadenaSql = "SELECT id_forma_pago, descripcion ";
				$cadenaSql .= "FROM forma_pago_orden; ";
				
				break;
			
			case "seleccionar_destino" :
				$cadenaSql = "SELECT id_destino, descripcion ";
				$cadenaSql .= "FROM destino_orden; ";
				
				break;
			
			case "datos_item" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " valor_total ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " items_orden_compra_temp ";
				$cadenaSql .= " WHERE seccion='" . $variable . "';";
				
				break;
			
			case "insertarProveedor" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " proveedor_nuevo(";
				$cadenaSql .= " razon_social,";
				$cadenaSql .= " nit_proveedor,";
				$cadenaSql .= " direccion,";
				$cadenaSql .= " telefono ";
				$cadenaSql .= " )";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "') ";
				$cadenaSql .= "RETURNING  id_proveedor_n; ";
				
				break;
			
			case "informacion_cargo_jefe" :
				$cadenaSql = " SELECT JEF_NOMBRE,JEF_IDENTIFICADOR ";
				$cadenaSql .= " FROM JEFES_DE_SECCION ";
				$cadenaSql .= " WHERE  JEF_IDENTIFICADOR='" . $variable . "' ";
				break;
			
			case "informacion_ordenador" :
				$cadenaSql = " SELECT ORG_NOMBRE,ORG_IDENTIFICADOR  ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				$cadenaSql .= " WHERE  ORG_IDENTIFICADOR='" . $variable . "'";
				
				break;
			
			case "ordenador_gasto" :
				
				$cadenaSql = " 	SELECT ORG_IDENTIFICADOR, ORG_ORDENADOR_GASTO ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				break;
			
			case "constratistas" :
				
				$cadenaSql = " SELECT CON_IDENTIFICADOR,CON_IDENTIFICACION ||' - '|| CON_NOMBRE ";
				$cadenaSql .= "FROM CONTRATISTAS ";
				
				break;
			
			case "cargo_jefe" :
				$cadenaSql = " SELECT JEF_IDENTIFICADOR,JEF_DEPENDENCIA_PERTENECIENTE ";
				$cadenaSql .= " FROM JEFES_DE_SECCION ";
				
				break;
			
			case "rubros" :
				$cadenaSql = " SELECT RUB_IDENTIFICADOR, RUB_RUBRO ||' - '|| RUB_NOMBRE_RUBRO ";
				$cadenaSql .= " FROM RUBROS ";
				
				break;
			
			case "seleccionar_iva" :
				$cadenaSql = "SELECT id_iva, descripcion ";
				$cadenaSql .= "FROM aplicacion_iva ";
				$cadenaSql .= " ORDER BY iva DESC ";
				$cadenaSql .= " LIMIT 2; ";
				
				break;
			
			case "dependencia" :
				$cadenaSql = " SELECT DEP_IDENTIFICADOR, DEP_IDENTIFICADOR ||' - ' ||DEP_DEPENDENCIA  ";
				$cadenaSql .= "FROM DEPENDENCIAS ";
				break;
			
			case "informacion_dependencia" :
				$cadenaSql = " SELECT DEP_DIRECCION, DEP_TELEFONO  ";
				$cadenaSql .= " FROM DEPENDENCIAS ";
				$cadenaSql .= " WHERE DEP_IDENTIFICADOR='" . $variable . "' ";
				
				break;
			
			case "informacion_proveedor" :
				$cadenaSql = " SELECT PRO_RAZON_SOCIAL,PRO_NIT,PRO_DIRECCION,PRO_TELEFONO  ";
				$cadenaSql .= " FROM PROVEEDORES  ";
				$cadenaSql .= " WHERE PRO_IDENTIFICADOR='" . $variable . "' ";
				break;
			
			case "proveedores" :
				$cadenaSql = " SELECT PRO_IDENTIFICADOR,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor ";
				$cadenaSql .= " FROM PROVEEDORES ";
				
				break;
			
			case "seleccion_proveedor" :
				$cadenaSql = " SELECT PRO_IDENTIFICADOR,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor ";
				$cadenaSql .= " FROM PROVEEDORES ";
				
				break;
			
			case "polizas" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_polizas,";
				$cadenaSql .= " poliza_1, ";
				$cadenaSql .= " poliza_2, ";
				$cadenaSql .= " poliza_3,";
				$cadenaSql .= " poliza_4, ";
				$cadenaSql .= " poliza_5 ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " polizas ";
				$cadenaSql .= " WHERE ";
				$cadenaSql .= " estado=TRUE ";
				$cadenaSql .= " AND ";
				$cadenaSql .= " modulo_tipo=1 ";
				break;
			
			case "items" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_items,";
				$cadenaSql .= " item, ";
				$cadenaSql .= " unidad_medida, ";
				$cadenaSql .= " cantidad, ";
				$cadenaSql .= " descripcion, ";
				$cadenaSql .= " valor_unitario, ";
				$cadenaSql .= " valor_total, ";
				$cadenaSql .= " descuento ";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.items_orden_compra_temp ";
				$cadenaSql .= " WHERE seccion='" . $variable . "';";
				
				break;
			
			case "limpiar_tabla_items" :
				$cadenaSql = " DELETE FROM ";
				$cadenaSql .= " items_orden_compra_temp";
				$cadenaSql .= " WHERE seccion ='" . $variable . "';";
				
				break;
			
			case "insertarItem" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.items_orden_compra_temp(";
				$cadenaSql .= " id_items,item, unidad_medida, cantidad, ";
				$cadenaSql .= " descripcion, valor_unitario,valor_total,descuento,seccion)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'" . $variable [6] . "',";
				$cadenaSql .= "'" . $variable [7] . "',";
				$cadenaSql .= "'" . $variable [8] . "');";
				break;
			
			case "eliminarItem" :
				$cadenaSql = " DELETE FROM ";
				$cadenaSql .= " items_orden_compra_temp";
				$cadenaSql .= " WHERE id_items ='" . $variable . "';";
				break;
			
			case "id_items_temporal" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " max(id_items)";
				$cadenaSql .= " FROM items_orden_compra_temp;";
				break;
			
			case "consultarOrdenCompra" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " fecha_registro, disponibilidad_presupuestal,";
				$cadenaSql .= " fecha_disponibilidad, rubro, obligaciones_proveedor, obligaciones_contratista,";
				$cadenaSql .= " poliza1, poliza2, poliza3, poliza4, poliza5, lugar_entrega, destino,";
				$cadenaSql .= " tiempo_entrega, forma_pago, supervision, inhabilidades, id_proveedor,";
				$cadenaSql .= " ruta_cotizacion, nombre_cotizacion, id_dependencia, id_contratista, id_ordenador,subtotal, iva, total, valor_letras ";
				$cadenaSql .= " FROM orden_compra ";
				$cadenaSql .= " WHERE id_orden_compra='" . $variable . "' AND estado='TRUE'";
				
				break;
			
			case "consultarProveedor" :
				$cadenaSql = " SELECT PRO_RAZON_SOCIAL,PRO_NIT,PRO_DIRECCION,PRO_TELEFONO  ";
				$cadenaSql .= " FROM PROVEEDORES  ";
				$cadenaSql .= " WHERE PRO_IDENTIFICADOR='" . $variable . "' ";
				
				break;
			
			case "consultarDependencia" :
				$cadenaSql = " SELECT DEP_IDENTIFICADOR,DEP_DIRECCION, DEP_TELEFONO  ";
				$cadenaSql .= " FROM DEPENDENCIAS ";
				$cadenaSql .= " WHERE DEP_IDENTIFICADOR='" . $variable . "' ";
				
				break;
			
			case "consultarEncargado" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " nombres ||' '||apellidos as nombre, cargo,asignacion  ";
				$cadenaSql .= " FROM encargado ";
				$cadenaSql .= " WHERE id_encargado='" . $variable . "' AND estado=TRUE";
				
				break;
			
			case "consultarItems" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " item, unidad_medida, cantidad, descripcion,";
				$cadenaSql .= " valor_unitario, valor_total, descuento ";
				$cadenaSql .= " FROM items_orden_compra ";
				$cadenaSql .= " WHERE id_orden='" . $variable . "'";
				
				break;
			
			case "insertarItemTemporal" :
				
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " items_orden_compra_temp(";
				$cadenaSql .= " item, unidad_medida, cantidad, ";
				$cadenaSql .= " descripcion, valor_unitario,valor_total,descuento,seccion)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'" . $variable [6] . "',";
				$cadenaSql .= "'" . $variable ['tiempo'] . "');";
				
				break;
			
			// _________________________________________________update___________________________________________
			
			case "actualizarProveedor" :
				
				$cadenaSql = " UPDATE ";
				$cadenaSql .= " proveedor";
				$cadenaSql .= " SET ";
				$cadenaSql .= " razon_social='" . $variable [0] . "',";
				$cadenaSql .= " nit_proveedor='" . $variable [1] . "',";
				$cadenaSql .= " direccion='" . $variable [2] . "',";
				$cadenaSql .= " telefono='" . $variable [3] . "',";
				$cadenaSql .= " ruta_cotizacion='" . $variable [4] . "',";
				$cadenaSql .= " nombre_cotizacion='" . $variable [5] . "' ";
				$cadenaSql .= "  WHERE id_proveedor='" . $variable [6] . "';";
				break;
			
			case "actualizarDependencia" :
				$cadenaSql = " UPDATE dependecia ";
				$cadenaSql .= " SET nombre='" . $variable [0] . "', ";
				$cadenaSql .= " direccion='" . $variable [1] . "', ";
				$cadenaSql .= " telefono='" . $variable [2] . "' ";
				$cadenaSql .= "  WHERE id_dependecia='" . $variable [3] . "';";
				
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
				$cadenaSql .= " orden_compra ";
				$cadenaSql .= " SET ";
				$cadenaSql .= " disponibilidad_presupuestal='" . $variable [0] . "', ";
				$cadenaSql .= " fecha_disponibilidad='" . $variable [1] . "', ";
				$cadenaSql .= " rubro='" . $variable [2] . "', ";
				$cadenaSql .= " obligaciones_proveedor='" . $variable [3] . "', ";
				$cadenaSql .= " obligaciones_contratista='" . $variable [4] . "', ";
				if ($variable [5] != '') {
					$cadenaSql .= " poliza1='" . $variable [5] . "', ";
				} else {
					$cadenaSql .= " poliza1='0', ";
				}
				if ($variable [6] != '') {
					$cadenaSql .= " poliza2='" . $variable [6] . "', ";
				} else {
					$cadenaSql .= " poliza2='0', ";
				}
				if ($variable [7] != '') {
					$cadenaSql .= " poliza3='" . $variable [7] . "', ";
				} else {
					$cadenaSql .= " poliza3='0', ";
				}
				if ($variable [8] != '') {
					$cadenaSql .= " poliza4='" . $variable [8] . "', ";
				} else {
					$cadenaSql .= " poliza4='0', ";
				}
				if ($variable [9] != '') {
					$cadenaSql .= " poliza5='" . $variable [9] . "', ";
				} else {
					$cadenaSql .= " poliza5='0', ";
				}
				$cadenaSql .= " lugar_entrega='" . $variable [10] . "', ";
				$cadenaSql .= " destino='" . $variable [11] . "', ";
				$cadenaSql .= " tiempo_entrega='" . $variable [12] . "', ";
				$cadenaSql .= " forma_pago='" . $variable [13] . "', ";
				$cadenaSql .= " supervision='" . $variable [14] . "', ";
				$cadenaSql .= " inhabilidades='" . $variable [15] . "', ";
				$cadenaSql .= " id_proveedor='" . $variable [16] . "', ";
				$cadenaSql .= " ruta_cotizacion='" . $variable [17] . "', ";
				$cadenaSql .= " nombre_cotizacion='" . $variable [18] . "', ";
				$cadenaSql .= " id_dependencia='" . $variable [19] . "', ";
				$cadenaSql .= " id_contratista='" . $variable [20] . "', ";
				$cadenaSql .= " id_ordenador='" . $variable [21] . "',  ";
				$cadenaSql .= " subtotal='" . $variable [22] . "',  ";
				$cadenaSql .= " iva='" . $variable [23] . "',  ";
				$cadenaSql .= " total='" . $variable [24] . "',  ";
				$cadenaSql .= " valor_letras='" . $variable [25] . "'  ";
				$cadenaSql .= "  WHERE id_orden_compra='" . $variable [26] . "';";
				
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
				$cadenaSql .= " valor_unitario, valor_total,descuento)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'" . $variable [6] . "',";
				$cadenaSql .= "'" . $variable [7] . "');";
				
				break;
			
			case "nit_proveedor" :
				$cadenaSql = "SELECT PRO_NIT ";
				$cadenaSql .= " FROM PROVEEDORES  ";
				$cadenaSql .= " WHERE PRO_IDENTIFICADOR='" . $variable . "' ";
				break;
			
			case "dependecia_solicitante" :
				$cadenaSql = " SELECT DEP_DEPENDENCIA  ";
				$cadenaSql .= " FROM DEPENDENCIAS  ";
				$cadenaSql .= " WHERE DEP_IDENTIFICADOR='" . $variable . "' ";
				
				break;
			
			case "consultarOrden1" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_orden_compra, fecha_registro, id_proveedor , id_dependencia ";
				// $cadenaSql .= "nit_proveedor, nombre ";
				$cadenaSql .= "FROM orden_compra ";
				// $cadenaSql .= "JOIN proveedor ON proveedor.id_proveedor = orden_compra.id_proveedor ";
				// $cadenaSql .= "JOIN dependencia ON dependencia.id_dependencia = orden_compra.id_dependencia ";
				$cadenaSql .= "WHERE 1=1 AND estado=TRUE  ";
				
				if ($variable [0] != '') {
					$cadenaSql .= " AND id_orden_compra = '" . $variable [0] . "'";
				}
				if ($variable [1] != '') {
					$cadenaSql .= " AND  orden_compra.id_proveedor= '" . $variable [1] . "'";
				}
				
				if ($variable [2] != '') {
					$cadenaSql .= " AND  dependencia.id_dependencia= '" . $variable [2] . "'";
				}
				
				if ($variable [3] != '') {
					$cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [3] . "' AS DATE) ";
					$cadenaSql .= " AND  CAST ( '" . $variable [4] . "' AS DATE)  ";
				}
				
				break;
			
			case "consultarOrden2" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_orden_compra, fecha_registro,  ";
				$cadenaSql .= "nit_proveedor, nombre  ";
				$cadenaSql .= "FROM orden_compra ";
				$cadenaSql .= "JOIN proveedor_nuevo ON proveedor_nuevo.id_proveedor_n = orden_compra.id_proveedor ";
				$cadenaSql .= "JOIN dependencia ON dependencia.id_dependencia = orden_compra.id_dependencia ";
				$cadenaSql .= "WHERE 1=1 AND estado=TRUE  ";
				
				if ($variable [0] != '') {
					$cadenaSql .= " AND id_orden_compra = '" . $variable [0] . "'";
				}
				if ($variable [1] != '') {
					$cadenaSql .= " AND  orden_compra.id_proveedor= '" . $variable [1] . "'";
				}
				
				if ($variable [2] != '') {
					$cadenaSql .= " AND  dependencia.id_dependencia= '" . $variable [2] . "'";
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
