<?php

namespace inventarios\gestionEntradas\consultaEntradas;

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
			
			case "consultarEntrada" :
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_entrada, fecha_registro,  ";
				$cadenaSql .= " descripcion, nit_proveedor,razon_social   ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "JOIN clase_entrada ON clase_entrada.id_clase = entrada.clase_entrada ";
				$cadenaSql .= "JOIN proveedor ON proveedor.id_proveedor = entrada.proveedor ";
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
			
			case "estado_entrada" :
				$cadenaSql = " SELECT id_estado, descripcion ";
				$cadenaSql .= "FROM estado_entrada;";
				
				break;
			
			case "consultarEstadoEntradas" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_entrada, fecha_registro,descripcion ";
				$cadenaSql .= ",estado_entrada ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "JOIN clase_entrada ON clase_entrada.id_clase = entrada.clase_entrada ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= " id_entrada = '" . $variable . "';";
				
				break;
			
			case "actualizarEstado" :
				$cadenaSql = " UPDATE entrada ";
				$cadenaSql .= " SET estado_entrada='" . $variable [1] . "' ";
				$cadenaSql .= "  WHERE id_entrada='" . $variable [0] . "';";
				
				break;
		}
		return $cadenaSql;
	}
}
?>
