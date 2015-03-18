<?php

namespace inventarios\gestionCompras\registrarOrdenCompra;

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

				
				
				
				
				
				

				case "seleccionar_iva" :
					$cadenaSql = "SELECT id_iva, descripcion ";
					$cadenaSql .= "FROM aplicacion_iva ";
					$cadenaSql .= " ORDER BY iva DESC ";
					$cadenaSql .= " LIMIT 2; ";
					
				
					break;
				
				
			case "datos_item" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " valor_total ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " items_orden_compra_temp ";
				$cadenaSql .= " WHERE seccion='" . $variable . "';";
				
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
			
			case "informacion_dependencia" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " direccion, telefono ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " dependencia ";
				$cadenaSql .= " WHERE id_dependencia='" . $variable . "';";
				
				break;
			
			case "informacion_proveedor" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " razon_social, nit_proveedor, direccion, telefono ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " proveedor ";
				$cadenaSql .= " WHERE id_proveedor='" . $variable . "' ";
				$cadenaSql .= " UNION SELECT ";
				$cadenaSql .= " razon_social, nit_proveedor, direccion, telefono ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " proveedor_nuevo";
				$cadenaSql .= " WHERE id_proveedor_n='" . $variable . "';";
				
				break;
			

				
// 			case "proveedor" :
// 				$cadenaSql = " SELECT PRO_IDENTIFICADOR,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor  ";
// 				$cadenaSql .= " FROM PROVEEDORES; ";
								
// 				break;
			
			case "proveedor" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_proveedor,";
				$cadenaSql .= " nit_proveedor ||' - '|| razon_social as proveedor ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " proveedor  ";
				$cadenaSql .= " UNION SELECT ";
				$cadenaSql .= " id_proveedor_n,";
				$cadenaSql .= " nit_proveedor ||' - '|| razon_social as proveedor ";
				$cadenaSql .= " FROM";
				$cadenaSql .= " proveedor_nuevo ; ";
				
				break;
			
			case "proveedors" :
				$cadenaSql = " INSERT INTO proveedor( ";
				$cadenaSql .= " razon_social, nit_proveedor, direccion, telefono)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "'); ";
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
				
				break;
			
			case "items" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_items,";
				$cadenaSql .= " item, ";
				$cadenaSql .= " unidad_medida, ";
				$cadenaSql .= " cantidad, ";
				$cadenaSql .= " descripcion, ";
				$cadenaSql .= " valor_unitario, ";
				$cadenaSql .= " valor_total";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.items_orden_compra_temp ";
				$cadenaSql .= " WHERE seccion='" . $variable . "';";
				
				break;
			
			case "limpiar_tabla_items" :
				$cadenaSql = " DELETE FROM ";
				$cadenaSql .= " arka_inventarios.items_orden_compra_temp";
				$cadenaSql .= " WHERE seccion ='" . $variable . "';";
				
				break;
			
			case "insertarItem" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.items_orden_compra_temp(";
				$cadenaSql .= " id_items,item, unidad_medida, cantidad, ";
				$cadenaSql .= " descripcion, valor_unitario,valor_total,seccion)";
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
			
			case "eliminarItem" :
				$cadenaSql = " DELETE FROM ";
				$cadenaSql .= " arka_inventarios.items_orden_compra_temp";
				$cadenaSql .= " WHERE id_items ='" . $variable . "';";
				break;
			
			case "id_items_temporal" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " max(id_items)";
				$cadenaSql .= " FROM arka_inventarios.items_orden_compra_temp;";
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
			
			case "insertarDependencia" :
				$cadenaSql = " INSERT INTO arka_inventarios.dependecia(";
				$cadenaSql .= " nombre, ";
				$cadenaSql .= " direccion, ";
				$cadenaSql .= " telefono)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "') ";
				$cadenaSql .= "RETURNING  id_dependecia; ";
				break;
			
			case "insertarEncargado" :
				$cadenaSql = " INSERT INTO arka_inventarios.encargado(";
				$cadenaSql .= " id_tipo_encargado,";
				$cadenaSql .= " nombre, ";
				$cadenaSql .= " identificacion,";
				$cadenaSql .= " cargo, ";
				$cadenaSql .= " asignacion)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "') ";
				$cadenaSql .= "RETURNING  id_encargado; ";
				break;
			
			case "insertarOrden" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.orden_compra(";
				$cadenaSql .= " fecha_registro, disponibilidad_presupuestal, ";
				$cadenaSql .= " fecha_disponibilidad, rubro, obligaciones_proveedor, obligaciones_contratista, ";
				$cadenaSql .= " poliza1, poliza2, poliza3, poliza4, poliza5, lugar_entrega, destino, ";
				$cadenaSql .= " tiempo_entrega, forma_pago, supervision, inhabilidades, id_proveedor,ruta_cotizacion,nombre_cotizacion,";
				$cadenaSql .= " id_dependencia, id_contratista, id_jefe, id_ordenador,subtotal, iva, total,valor_letras,estado)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				if ($variable [6] != '') {
					$cadenaSql .= "'" . $variable [6] . "',";
				} else {
					$cadenaSql .= "'0',";
				}
				if ($variable [7] != '') {
					$cadenaSql .= "'" . $variable [7] . "',";
				} else {
					$cadenaSql .= "'0',";
				}
				if ($variable [8] != '') {
					$cadenaSql .= "'" . $variable [8] . "',";
				} else {
					$cadenaSql .= "'0',";
				}
				if ($variable [9] != '') {
					$cadenaSql .= "'" . $variable [9] . "',";
				} else {
					$cadenaSql .= "'0',";
				}
				if ($variable [10] != '') {
					$cadenaSql .= "'" . $variable [10] . "',";
				} else {
					$cadenaSql .= "'0',";
				}
				
				$cadenaSql .= "'" . $variable [11] . "',";
				$cadenaSql .= "'" . $variable [12] . "',";
				$cadenaSql .= "'" . $variable [13] . "',";
				$cadenaSql .= "'" . $variable [14] . "',";
				$cadenaSql .= "'" . $variable [15] . "',";
				$cadenaSql .= "'" . $variable [16] . "',";
				$cadenaSql .= "'" . $variable [17] . "',";
				$cadenaSql .= "'" . $variable [18] . "',";
				$cadenaSql .= "'" . $variable [19] . "',";
				$cadenaSql .= "'" . $variable [20] . "',";
				$cadenaSql .= "'" . $variable [21] . "',";
				$cadenaSql .= "'" . $variable [22] . "',";
				$cadenaSql .= "'" . $variable [23] . "',";
				$cadenaSql .= "'" . $variable [24] . "',";
				$cadenaSql .= "'" . $variable [25] . "',";
				$cadenaSql .= "'" . $variable [26] . "',";
				$cadenaSql .= "'" . $variable [27] . "',";
				$cadenaSql .= "'" . $variable [28] . "') ";
				$cadenaSql .= "RETURNING  id_orden_compra; ";
				
				break;
			
			case "insertarItems" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.items_orden_compra(";
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
		}
		return $cadenaSql;
	}
}
?>
