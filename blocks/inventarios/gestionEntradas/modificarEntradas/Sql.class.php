<?php

namespace inventarios\gestionEntradas\modificarEntradas;

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
			
			case "buscar_entradas" :
				$cadenaSql = " SELECT id_entrada valor,id_entrada descripcion  ";
				$cadenaSql .= " FROM entrada; ";
				break;
			
			case "proveedor_informacion" :
				$cadenaSql = " SELECT PRO_NIT,PRO_RAZON_SOCIAL  ";
				$cadenaSql .= " FROM PROVEEDORES ";
				$cadenaSql .= " WHERE PRO_NIT='" . $variable . "'";
				
				break;
			
			case "consultarInfoClase" :
				$cadenaSql = " SELECT  observacion, id_entrada, id_salida, id_hurto,";
				$cadenaSql .= " num_placa, val_sobrante, ruta_archivo, nombre_archivo  ";
				$cadenaSql .= " FROM info_clase_entrada ";
				$cadenaSql .= " WHERE id_info_clase='" . $variable . "';";
				
				break;
			
			case "proveedores" :
				$cadenaSql = " SELECT PRO_NIT,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor ";
				$cadenaSql .= " FROM PROVEEDORES ";
				
				break;
			case "tipo_contrato_avance" :
				
				$cadenaSql = "SELECT id_tipo, descripcion ";
				$cadenaSql .= "FROM arka_inventarios.tipo_contrato ";
				$cadenaSql .= "WHERE id_tipo<>1;";
				
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
			
			case "proveedor" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_proveedor, razon_social ";
				$cadenaSql .= "FROM proveedor;";
				
				break;
			
			case "consultarEntrada" :
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_entrada, fecha_registro,  ";
				$cadenaSql .= " descripcion,proveedor ,consecutivo  ";
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
			
			// SELECT id_entrada, fecha_registro, consecutivo, vigencia, clase_entrada,
			// info_clase, tipo_contrato, numero_contrato, fecha_contrato, proveedor,
			// numero_factura, fecha_factura, observaciones, acta_recibido,
			// ordenador, sede, dependencia, supervisor, estado_entrada, estado_registro
			// FROM entrada;
			
			case "consultarEntradaParticular" :
				
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= " vigencia, clase_entrada, info_clase , ";
				$cadenaSql .= "	tipo_contrato, numero_contrato, fecha_contrato, proveedor,";
				$cadenaSql .= "numero_factura, fecha_factura, observaciones, acta_recibido , ordenador, sede, dependencia, supervisor ,tipo_ordenador, identificacion_ordenador ";
				$cadenaSql .= "FROM entrada ";
				$cadenaSql .= "WHERE id_entrada='" . $variable . "';";
				
				break;
			
			case "actasRecicbido" :
				$cadenaSql = " SELECT id_actarecibido, id_actarecibido ";
				$cadenaSql .= "FROM registro_actarecibido ";
				
				break;
			
			case "tipoComprador" :
				
				$cadenaSql = " 	SELECT ORG_IDENTIFICADOR, ORG_ORDENADOR_GASTO ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				$cadenaSql .= " WHERE ORG_ESTADO='A' ";
				
				break;
			
			case "sede" :
				$cadenaSql = "SELECT DISTINCT  ESF_ID_SEDE, ESF_SEDE ";
				$cadenaSql .= " FROM ESPACIOS_FISICOS ";
				$cadenaSql .= " WHERE   ESF_ESTADO='A'";
				
				break;
			case "informacion_ordenador" :
				$cadenaSql = " SELECT ORG_NOMBRE,ORG_IDENTIFICADOR,ORG_TIPO_ORDENADOR,ORG_IDENTIFICACION  ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				$cadenaSql .= " WHERE  ORG_IDENTIFICADOR='" . $variable . "' ";
				$cadenaSql .= " AND ORG_ESTADO='A' ";
				break;
			
			case "dependencias" :
				$cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
				$cadenaSql .= " FROM ESPACIOS_FISICOS ";
				$cadenaSql .= " WHERE  ESF_ESTADO='A' ";
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
			// UPDATE info_clase_entrada
			// SET id_info_clase=?, observacion=?, id_entrada=?, id_salida=?, id_hurto=?,
			// num_placa=?, val_sobrante=?, ruta_archivo=?, nombre_archivo=?
			// WHERE <condition>;
			case "actualizarInformacionArchivo" :
				$cadenaSql = " UPDATE info_clase_entrada ";
				$cadenaSql .= " SET observacion= '" . $variable [0] . "', ";
				$cadenaSql .= "  id_entrada='" . $variable [1] . "', ";
				$cadenaSql .= "  id_salida='" . $variable [2] . "', ";
				$cadenaSql .= "  id_hurto='" . $variable [3] . "', ";
				$cadenaSql .= "  num_placa='" . $variable [4] . "', ";
				$cadenaSql .= "  val_sobrante='" . $variable [5] . "', ";
				$cadenaSql .= "  ruta_archivo='" . $variable [6] . "', ";
				$cadenaSql .= "  nombre_archivo='" . $variable [7] . "'  ";
				$cadenaSql .= "  WHERE id_info_clase='" . $variable [8] . "' ";
				
				break;
			
			case "actualizarInformacion" :
				$cadenaSql = " UPDATE info_clase_entrada ";
				$cadenaSql .= " SET observacion= '" . $variable [0] . "', ";
				$cadenaSql .= "  id_entrada='" . $variable [1] . "', ";
				$cadenaSql .= "  id_salida='" . $variable [2] . "', ";
				$cadenaSql .= "  id_hurto='" . $variable [3] . "', ";
				$cadenaSql .= "  num_placa='" . $variable [4] . "', ";
				$cadenaSql .= "  val_sobrante='" . $variable [5] . "', ";
				$cadenaSql .= "  WHERE id_info_clase='" . $variable [6] . "' ";
				
				break;
			
			case "actualizarEntrada" :
				$cadenaSql = " UPDATE entrada ";
				$cadenaSql .= " SET vigencia='" . $variable [0] . "', ";
				$cadenaSql .= "  clase_entrada='" . $variable [1] . "', ";
				$cadenaSql .= "  tipo_contrato='" . $variable [2] . "', ";
				$cadenaSql .= "  numero_contrato='" . $variable [3] . "', ";
				$cadenaSql .= "  fecha_contrato='" . $variable [4] . "', ";
				$cadenaSql .= "  proveedor='" . $variable [5] . "', ";
				$cadenaSql .= "  numero_factura='" . $variable [6] . "', ";
				$cadenaSql .= "  fecha_factura='" . $variable [7] . "', ";
				$cadenaSql .= "  observaciones='" . $variable [8] . "', ";
				$cadenaSql .= "  acta_recibido='" . $variable [10] . "', ";
				$cadenaSql .= "  ordenador='" . $variable [11] . "', ";
				$cadenaSql .= "  sede='" . $variable [12] . "', ";
				$cadenaSql .= "  dependencia='" . $variable [13] . "', ";
				$cadenaSql .= "  supervisor='" . $variable [14] . "', ";
				$cadenaSql .= "  tipo_ordenador='" . $variable [15] . "', ";
				$cadenaSql .= "  identificacion_ordenador='" . $variable [16] . "', ";
				$cadenaSql .= "  estado_entrada='1'  ";
				$cadenaSql .= "  WHERE id_entrada='" . $variable [9] . "' ";
				$cadenaSql .= "  RETURNING  id_entrada ";
				
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
			
			case "dependenciasConsultadas" :
				$cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
				$cadenaSql .= " FROM ESPACIOS_FISICOS ";
				$cadenaSql .= " WHERE ESF_ID_SEDE='" . $variable . "' ";
				$cadenaSql .= " AND  ESF_ESTADO='A'";
				
				break;
			
			case 'consultarActas' :
				$cadenaSql = "SELECT *  ";
				$cadenaSql .= "FROM registro_actarecibido  ";
				$cadenaSql .= "WHERE  id_actarecibido='" . $variable . "';";
				
				break;
			
			case "funcionarios" :
				
				$cadenaSql = "SELECT FUN_IDENTIFICACION, FUN_IDENTIFICACION ||' - '|| FUN_NOMBRE ";
				$cadenaSql .= "FROM FUNCIONARIOS ";
				$cadenaSql .= "WHERE FUN_ESTADO='A' ";
				
				break;
		}
		return $cadenaSql;
	}
}
?>
