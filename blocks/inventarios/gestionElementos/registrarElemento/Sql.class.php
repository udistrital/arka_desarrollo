<?php

namespace inventarios\gestionElementos\registrarElemento;

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
			
			case "buscar_placa_maxima" :
				$cadenaSql = " SELECT  MAX(placa) placa_max ";
				$cadenaSql .= " FROM elemento_individual ";
				break;
			
			case "buscar_repetida_placa" :
				$cadenaSql = " SELECT  count (placa) ";
				$cadenaSql .= " FROM elemento_individual ";
				$cadenaSql .= " WHERE placa ='" . $variable . "';";
				break;
			
			case "buscar_entradas" :
				$cadenaSql = " SELECT consecutivo valor,consecutivo descripcion  ";
				$cadenaSql .= " FROM entrada; ";
				break;
			
			case "proveedor_informacion" :
				$cadenaSql = " SELECT PRO_NIT,PRO_RAZON_SOCIAL  ";
				$cadenaSql .= " FROM PROVEEDORES ";
				$cadenaSql .= " WHERE PRO_NIT='" . $variable . "'";
				
				break;
			
			case "proveedores" :
				$cadenaSql = " SELECT PRO_NIT,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor ";
				$cadenaSql .= " FROM PROVEEDORES ";
				
				break;
			
			case "clase_entrada" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_clase, descripcion  ";
				$cadenaSql .= "FROM clase_entrada;";
				
				break;
			
			case "consultar_tipo_bien" :
				
				$cadenaSql = "SELECT id_tipo_bienes, descripcion ";
				$cadenaSql .= "FROM tipo_bienes;";
				break;
			
			case "consultar_tipo_poliza" :
				
				$cadenaSql = "SELECT id_tipo_poliza, descripcion ";
				$cadenaSql .= "FROM tipo_poliza;";
				
				break;
			
			case "consultar_tipo_iva" :
				
				$cadenaSql = "SELECT id_iva, descripcion ";
				$cadenaSql .= "FROM aplicacion_iva;";
				
				break;
			
			case "consultar_bodega" :
				
				$cadenaSql = "SELECT id_bodega, descripcion ";
				$cadenaSql .= "FROM bodega;";
				
				break;
			
			case "consultar_placa" :
				
				$cadenaSql = "SELECT MAX( placa) ";
				$cadenaSql .= "FROM elemento ";
				$cadenaSql .= "WHERE tipo_bien='1';";
				
				break;
			
			case "consultar_entrada_acta" :
				
				$cadenaSql = "SELECT acta_recibido ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "WHERE id_entrada='" . $variable . "'";
				
				break;
			
			case "consultar_elementos_acta" :
				
				$cadenaSql = "SELECT id_items ";
				$cadenaSql .= "FROM items_actarecibido ";
				$cadenaSql .= "WHERE id_acta='" . $variable . "'";
				
				break;
			
			case "consultar_elementos_entrada" :
				
				$cadenaSql = "SELECT id_elemento ";
				$cadenaSql .= "FROM elemento  ";
				$cadenaSql .= "WHERE id_entrada='" . $variable . "'";
				
				break;
			
				
				
			case "consultar_nivel_inventario" :
				
				$cadenaSql = "SELECT elemento_id, elemento_padre||''|| elemento_codigo||' - '||elemento_nombre ";
				$cadenaSql .= "FROM catalogo.catalogo_elemento ";
				$cadenaSql .= "WHERE elemento_catalogo=2 ";
				$cadenaSql .= "ORDER BY elemento_id DESC ;";
				
				
				break;
			
			case "ingresar_elemento_individual" :
				$cadenaSql = " 	INSERT INTO elemento_individual(";
				$cadenaSql .= "fecha_registro, placa, serie, id_elemento_gen) ";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "') ";
				$cadenaSql .= "RETURNING id_elemento_ind; ";
				
				break;
			
			case "ingresar_elemento_tipo_1" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " elemento(";
				$cadenaSql .= "fecha_registro,nivel, tipo_bien, descripcion, cantidad, ";
				$cadenaSql .= "unidad, valor, iva, ajuste, bodega, subtotal_sin_iva, total_iva, ";
				$cadenaSql .= "total_iva_con,marca,serie,id_entrada) ";
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
				$cadenaSql .= "'" . $variable [11] . "',";
				$cadenaSql .= "'" . $variable [12] . "',";
				$cadenaSql .= "'" . $variable [13] . "',";
				$cadenaSql .= "'" . $variable [14] . "',";
				$cadenaSql .= "'" . $variable [15] . "') ";
				$cadenaSql .= "RETURNING  id_elemento; ";
				
				break;
			
			case "ingresar_elemento_tipo_2" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " elemento(";
				$cadenaSql .= "fecha_registro,nivel,tipo_bien, descripcion, cantidad, ";
				$cadenaSql .= "unidad, valor, iva, ajuste, bodega, subtotal_sin_iva, total_iva, ";
				$cadenaSql .= "total_iva_con,tipo_poliza, fecha_inicio_pol, fecha_final_pol,marca,serie,id_entrada) ";
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
				$cadenaSql .= "'" . $variable [11] . "',";
				$cadenaSql .= "'" . $variable [12] . "',";
				$cadenaSql .= "'" . $variable [13] . "',";
				$cadenaSql .= "'" . $variable [14] . "',";
				$cadenaSql .= "'" . $variable [15] . "',";
				$cadenaSql .= "'" . $variable [16] . "',";
				$cadenaSql .= "'" . $variable [17] . "',";
				$cadenaSql .= "'" . $variable [18] . "') ";
				$cadenaSql .= "RETURNING  id_elemento; ";
				
				break;
			
				
				
				
				case "ingresar_elemento_masivo" :
					$cadenaSql = " INSERT INTO ";
					$cadenaSql .= " elemento(";
					$cadenaSql .= "fecha_registro,nivel,tipo_bien, descripcion, cantidad, ";
					$cadenaSql .= "unidad, valor, ajuste, bodega, subtotal_sin_iva, total_iva, ";
					$cadenaSql .= "total_iva_con,tipo_poliza, fecha_inicio_pol, fecha_final_pol,marca,serie,id_entrada) ";
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
					$cadenaSql .= "'" . $variable [11] . "',";
					$cadenaSql .= "'" . $variable [12] . "',";
					$cadenaSql .= "'" . $variable [13] . "',";
					$cadenaSql .= "'" . $variable [14] . "',";
					$cadenaSql .= "'" . $variable [15] . "',";
					$cadenaSql .= "'" . $variable [16] . "',";
					$cadenaSql .= "'" . $variable [17] . "') ";
					$cadenaSql .= "RETURNING  id_elemento; ";
				
					break;
			case "consultarEntrada" :
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_entrada, fecha_registro,  ";
				$cadenaSql .= " descripcion,proveedor, consecutivo   ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "JOIN clase_entrada ON clase_entrada.id_clase = entrada.clase_entrada ";
				// $cadenaSql .= "JOIN proveedor ON proveedor.id_proveedor = entrada.proveedor ";
				$cadenaSql .= "WHERE 1=1 ";
				if ($variable [0] != '') {
					$cadenaSql .= " AND id_entrada = '" . $variable [0] . "'";
				}
				
				if ($variable [1] != '') {
					$cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [1] . "' AS DATE) ";
					$cadenaSql .= " AND  CAST ( '" . $variable [2] . "' AS DATE)  ";
				}
				
				if ($variable [3] != '') {
					$cadenaSql .= " AND clase_entrada = '" . $variable [3] . "'";
				}
				if ($variable [4] != '') {
					$cadenaSql .= " AND entrada.proveedor = '" . $variable [4] . "'";
				}
				
				break;
		}
		return $cadenaSql;
	}
}
?>
