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
			
			
			case "ingresar_elemento_tipo_1" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " elemento(";
				$cadenaSql .= "fecha_registro, tipo_bien, descripcion, cantidad, ";
				$cadenaSql .= "unidad, valor, iva, ajuste, bodega, subtotal_sin_iva, total_iva, ";
				$cadenaSql .= "total_iva_con, placa,marca,serie) ";
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
				$cadenaSql .= "'" . $variable [14] . "') ";
				$cadenaSql .= "RETURNING  id_elemento; ";
				
				break;
			
			case "ingresar_elemento_tipo_2" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " elemento(";
				$cadenaSql .= "fecha_registro, tipo_bien, descripcion, cantidad, ";
				$cadenaSql .= "unidad, valor, iva, ajuste, bodega, subtotal_sin_iva, total_iva, ";
				$cadenaSql .= "total_iva_con, placa,tipo_poliza, fecha_inicio_pol, fecha_final_pol,marca,serie) ";
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
			
			// ___________________________________
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
			
			case "insertarSolicitante" :
				$cadenaSql = " INSERT INTO solicitante_servicios(";
				$cadenaSql .= " dependencia, ";
				$cadenaSql .= " rubro )";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "') ";
				$cadenaSql .= "RETURNING  id_solicitante; ";
				break;
			
			case "insertarSupervisor" :
				$cadenaSql = " INSERT INTO supervisor_servicios(";
				$cadenaSql .= " nombre,cargo, dependencia) ";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "') ";
				$cadenaSql .= "RETURNING  id_supervisor; ";
				break;
			
			case "insertarContratista" :
				$cadenaSql = " INSERT INTO contratista_servicios(";
				$cadenaSql .= " nombre_razon_social, identificacion,direccion, telefono,cargo) ";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "') ";
				$cadenaSql .= "RETURNING  id_contratista; ";
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
				
				// id_solicitante integer,
				// id_supervisor integer,
				
				break;
		}
		return $cadenaSql;
	}
}
?>
