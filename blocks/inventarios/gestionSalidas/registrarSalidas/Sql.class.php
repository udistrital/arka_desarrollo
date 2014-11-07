<?php

namespace inventarios\gestionSalidas\registrarSalidas;

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
			
			case "consultarEntrada" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_entrada, fecha_registro,  ";
				$cadenaSql .= "nit, razon_social  ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "JOIN proveedor ON proveedor.id_proveedor = entrada.proveedor ";
				$cadenaSql .= "WHERE 1=1 AND id_salida ='0' ";
				if ($variable [0] != '') {
					$cadenaSql .= " AND fecha_registro BETWEEN CAST ( '" . $variable [4] . "' AS DATE) ";
					$cadenaSql .= " AND  CAST ( '" . $variable [5] . "' AS DATE)  ";
				}
				if ($variable [2] != '') {
					$cadenaSql .= " AND id_entrada = '" . $variable [0] . "'";
				}
				if ($variable [3] != '') {
					$cadenaSql .= " AND  nit= '" . $variable [1] . "'";
				}
				if ($variable [4] != '') {
					$cadenaSql .= " AND  nombre= '" . $variable [3] . "'";
				}
				
				break;
			
			case "consultarEntradaParticular" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "fecha_registro, vigencia, clase_entrada, tipo_entrada, ";
				$cadenaSql .= "	tipo_contrato, numero_contrato, fecha_contrato, proveedor, nit,  ";
				$cadenaSql .= "numero_factura, fecha_factura, observaciones, acta_recibido  ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "WHERE id_entrada='" . $variable . "';";
				
				break;
			
			case "clase_entrada_descrip" :
				
				$cadenaSql = "SELECT descripcion ";
				$cadenaSql .= "FROM clase_entrada ";
				$cadenaSql .= "WHERE id_clase='" . $variable . "';";
				
				break;
			
			case "consulta_proveedor" :
				
				$cadenaSql = "SELECT razon_social ";
				$cadenaSql .= "FROM proveedor ";
				$cadenaSql .= "WHERE id_proveedor='" . $variable . "';";
				
				break;
			
			case "consulta_elementos" :
				
				$cadenaSql = "SELECT id_items, item, cantidad, descripcion ";
				$cadenaSql .= "FROM items_actarecibido ";
				$cadenaSql .= "WHERE id_acta='" . $variable . "' ";
				$cadenaSql .= "AND  id_salida='0';";
				
				break;
			
			case "consultar_dependencia" :
				
				$cadenaSql = "SELECT id_dependecia, (id_dependecia||' - '|| nombre) AS Dependencia ";
				$cadenaSql .= "FROM dependecia ;";
				
				break;
			
			case "consultar_ubicacion" :
				
				$cadenaSql = "SELECT id_seccion,nombre  ";
				$cadenaSql .= "FROM seccion;";
				
				break;
			
			case "insertar_funcionario" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " funcionario(";
				$cadenaSql .= "  nombre, identificacion)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "') ";
				$cadenaSql .= "RETURNING  id_funcionario; ";
				
				break;
			
			case "insertar_salida" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " salida( fecha, dependencia, ubicacion, funcionario, observaciones,";
				$cadenaSql .= " id_entrada)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "') ";
				$cadenaSql .= "RETURNING  id_salida; ";
				
				break;
			
			case "insertar_salida_item" :
				$cadenaSql = "UPDATE items_actarecibido ";
				$cadenaSql .= "SET id_salida ='" . $variable [1] . "'  ";
				$cadenaSql .= "WHERE id_items='" . $variable [0] . "';";
				
				break;
			
			case "actualizar_entrada" :
				$cadenaSql = "UPDATE entrada ";
				$cadenaSql .= "SET id_salida ='TRUE'  ";
				$cadenaSql .= "WHERE id_entrada='" . $variable [1] . "';";
				
				break;
			
			// _________________________________________________
			
					}
		return $cadenaSql;
	}
}
?>
