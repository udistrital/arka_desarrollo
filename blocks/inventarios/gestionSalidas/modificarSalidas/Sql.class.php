<?php

namespace inventarios\gestionSalidas\modificarSalidas;

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
			
			case "consultar_funcionario" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_funcionario,(identificacion||' - '|| nombre) AS funcionario ";
				$cadenaSql .= "FROM funcionario;";
				
				break;
			
			case "consultarSalida" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "vigencia,salida.id_salida,salida.id_entrada,fecha_registro,identificacion,nombre  ";
				$cadenaSql .= "FROM salida ";
				$cadenaSql .= "JOIN entrada ON entrada.id_entrada = salida.id_entrada ";
				$cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
				$cadenaSql .= "WHERE 1=1";
				if ($variable [0] != '') {
					$cadenaSql .= " AND vigencia = '" . $variable [0] . "'";
				}
				
				if ($variable [1] != '') {
					$cadenaSql .= " AND salida.id_entrada = '" . $variable [1] . "'";
				}
				
				if ($variable [2] != '') {
					$cadenaSql .= " AND salida.id_salida = '" . $variable [2] . "'";
				}
				
				if ($variable [3] != '') {
					$cadenaSql .= " AND funcionario = '" . $variable [3] . "'";
				}
				
				if ($variable [4] != '') {
					$cadenaSql .= " AND fecha BETWEEN CAST ( '" . $variable [4] . "' AS DATE) ";
					$cadenaSql .= " AND  CAST ( '" . $variable [5] . "' AS DATE)  ";
				}
				$cadenaSql .= ";";
				break;
			
			case "consultar_dependencia" :
				
				$cadenaSql = "SELECT id_dependecia, (id_dependecia||' - '|| nombre) AS Dependencia ";
				$cadenaSql .= "FROM dependecia ;";
				
				break;
			
			case "consultar_ubicacion" :
				
				$cadenaSql = "SELECT id_seccion,nombre  ";
				$cadenaSql .= "FROM seccion;";
				
				break;
			
			case "consulta_elementos" :
				
				$cadenaSql = "SELECT id_items, item, cantidad, descripcion ";
				$cadenaSql .= "FROM items_actarecibido ";
				$cadenaSql .= "WHERE id_acta='" . $variable . "' ";
				
				break;
			
			case "consulta_elementos_totales" :
				
				$cadenaSql = "SELECT id_items, item, cantidad, descripcion, id_salida ";
				$cadenaSql .= "FROM items_actarecibido ";
				$cadenaSql .= "WHERE id_acta='" . $variable . "' ";
				
				break;
			
			case "consulta_elementos_sin_actualizar" :
				
				$cadenaSql = "SELECT id_items, item, cantidad, descripcion ";
				$cadenaSql .= "FROM items_actarecibido ";
				$cadenaSql .= "WHERE id_acta='" . $variable . "' ";
				$cadenaSql .= "AND  id_salida='0';";
				
				break;
			
			case "consultarEntradaParticular" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "fecha_registro, vigencia, clase_entrada, tipo_entrada, ";
				$cadenaSql .= "	tipo_contrato, numero_contrato, fecha_contrato, proveedor, nit,  ";
				$cadenaSql .= "numero_factura, fecha_factura, observaciones, acta_recibido  ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "WHERE id_entrada='" . $variable . "';";
				
				break;
			
			case "consultarSalidaParticular" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= " dependencia, ubicacion, funcionario, observaciones ";
				$cadenaSql .= "FROM salida ";
				$cadenaSql .= "WHERE id_salida='" . $variable . "';";
				
				break;
			
			case "consultarFuncionario" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "nombre, identificacion ";
				$cadenaSql .= "FROM funcionario ";
				$cadenaSql .= "WHERE id_funcionario='" . $variable . "';";
				
				break;
			
			case "actualizar_funcionario" :
				
				$cadenaSql = " UPDATE funcionario ";
				$cadenaSql .= " SET nombre='" . $variable [0] . "', ";
				$cadenaSql .= "  identificacion='" . $variable [1] . "'  ";
				$cadenaSql .= "  WHERE id_funcionario='" . $variable [2] . "' ;";
				
				break;
			
			case "actualizar_salida" :
				
				$cadenaSql = " UPDATE salida ";
				$cadenaSql .= " SET dependencia='" . $variable [0] . "', ";
				$cadenaSql .= "  ubicacion='" . $variable [1] . "' , ";
				$cadenaSql .= "  observaciones='" . $variable [2] . "'  ";
				$cadenaSql .= "  WHERE id_salida='" . $variable [3] . "' ;";
				
				break;
			
			// UPDATE items_actarecibido
			// SET id_items=?, id_acta=?, item=?, cantidad=?, descripcion=?, valor_unitario=?,
			// valor_total=?, estado_registro=?, fecha_registro=?, id_salida=?
			// WHERE <condition>;
			
			case "restaurar_elementos" :
				
				$cadenaSql = " UPDATE items_actarecibido ";
				$cadenaSql .= " SET id_salida='0' ";
				$cadenaSql .= "  WHERE id_acta='" . $variable [0] . "';";
				
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
			
			// _________________________________________________________________________
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
			
			case "proveedor" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_proveedor, razon_social ";
				$cadenaSql .= "FROM proveedor;";
				
				break;
			
			case "consultarEntradaParticular" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= " vigencia, clase_entrada, tipo_entrada, ";
				$cadenaSql .= "	tipo_contrato, numero_contrato, fecha_contrato, proveedor, nit,  ";
				$cadenaSql .= "numero_factura, fecha_factura, observaciones, acta_recibido  ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "WHERE id_entrada='" . $variable . "';";
				
				break;
			
			case "consultarReposicion" :
				
				$cadenaSql = "SELECT  ";
				$cadenaSql .= " id_entrada, id_hurto, id_salida ";
				$cadenaSql .= "FROM reposicion_entrada ";
				$cadenaSql .= "WHERE id_reposicion='" . $variable . "';";
				
				break;
			
			case "consultarDonacion" :
				
				$cadenaSql = "SELECT  ";
				$cadenaSql .= " ruta_acto, nombre_acto ";
				$cadenaSql .= "FROM donacion_entrada ";
				$cadenaSql .= "WHERE id_donacion='" . $variable . "';";
				
				break;
			
			case "consultarSobrante" :
				
				$cadenaSql = "SELECT  ";
				$cadenaSql .= " observaciones, nombre_acta ";
				$cadenaSql .= "FROM sobrante_entrada ";
				$cadenaSql .= "WHERE id_sobrante='" . $variable . "';";
				
				break;
			
			case "consultarProduccion" :
				
				$cadenaSql = "SELECT  ";
				$cadenaSql .= " observaciones, nombre_acta ";
				$cadenaSql .= "FROM produccion_entrada ";
				$cadenaSql .= "WHERE id_produccion='" . $variable . "';";
				
				break;
			
			case "consultarRecuperacion" :
				
				$cadenaSql = "SELECT  ";
				$cadenaSql .= "observaciones, nombre_acta ";
				$cadenaSql .= "FROM recuperacion_entrada ";
				$cadenaSql .= "WHERE id_recuperacion='" . $variable . "';";
				
				break;
			
			case "ActualizarReposicion" :
				$cadenaSql = " UPDATE reposicion_entrada ";
				$cadenaSql .= " SET id_entrada='" . $variable [0] . "', ";
				$cadenaSql .= "  id_hurto='" . $variable [1] . "', ";
				$cadenaSql .= "  id_salida='" . $variable [2] . "' ";
				$cadenaSql .= "  WHERE id_reposicion='" . $variable [3] . "' ";
				$cadenaSql .= "  RETURNING  id_reposicion ";
				
				break;
			
			case "actualizarDonacion" :
				$cadenaSql = " UPDATE donacion_entrada ";
				$cadenaSql .= " SET ruta_acto='" . $variable [0] . "', ";
				$cadenaSql .= "  nombre_acto='" . $variable [1] . "'  ";
				$cadenaSql .= "  WHERE id_donacion='" . $variable [2] . "' ";
				$cadenaSql .= "  RETURNING  id_donacion ";
				
				break;
			
			case "actualizarSobrante" :
				$cadenaSql = " UPDATE sobrante_entrada ";
				$cadenaSql .= " SET observaciones='" . $variable [2] . "' ";
				if ($variable [0] == 1) {
					
					$cadenaSql .= " , ruta_acta='" . $variable [3] . "' , ";
					$cadenaSql .= "  nombre_acta='" . $variable [4] . "'  ";
				}
				$cadenaSql .= "  WHERE id_sobrante='" . $variable [1] . "' ";
				$cadenaSql .= "  RETURNING  id_sobrante ";
				break;
			
			case "actualizarProduccion" :
				$cadenaSql = " UPDATE produccion_entrada ";
				$cadenaSql .= " SET observaciones='" . $variable [2] . "' ";
				if ($variable [0] == 1) {
					
					$cadenaSql .= " , ruta_acta='" . $variable [3] . "' , ";
					$cadenaSql .= "  nombre_acta='" . $variable [4] . "'  ";
				}
				$cadenaSql .= "  WHERE id_produccion='" . $variable [1] . "' ";
				$cadenaSql .= "  RETURNING  id_produccion ";
				
				break;
			
			case "actualizarRecuperacion" :
				$cadenaSql = " UPDATE recuperacion_entrada ";
				$cadenaSql .= " SET observaciones='" . $variable [2] . "' ";
				if ($variable [0] == 1) {
					
					$cadenaSql .= " , ruta_acta='" . $variable [3] . "' , ";
					$cadenaSql .= "  nombre_acta='" . $variable [4] . "'  ";
				}
				$cadenaSql .= "  WHERE id_recuperacion='" . $variable [1] . "' ";
				$cadenaSql .= "  RETURNING  id_recuperacion ";
				
				break;
		}
		return $cadenaSql;
	}
}
?>
