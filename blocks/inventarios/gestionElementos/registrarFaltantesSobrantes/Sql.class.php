<?php

namespace inventarios\gestionElementos\registrarFaltantesSobrantes;

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
			
			case "actualizacion_estado_elemento" :
				
				$cadenaSql = " UPDATE elemento_individual ";
				$cadenaSql .= "SET estado_elemento='" . $variable [1] . "' ";
				$cadenaSql .= " WHERE id_elemento_ind='" . $variable [0] . "';";
				
				break;
			
			case "insertar_faltante_sobrante" :
				
				$cadenaSql = "INSERT INTO estado_elemento( ";
				$cadenaSql .= "id_elemento_ind,id_faltante, id_sobrante, id_hurto, observaciones,  ";
				$cadenaSql .= "ruta_denuncia, nombre_denuncia, fecha_denuncia, fecha_hurto, fecha_registro,tipo_faltsobr) ";
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
				$cadenaSql .= "'" . $variable [10] . "') ";
				$cadenaSql .= "RETURNING  id_faltante,id_sobrante,id_hurto,id_estado_elemento; ";
				
				break;
			
			case "id_sobrante" :
				$cadenaSql = " SELECT MAX(id_sobrante) ";
				$cadenaSql .= " FROM estado_elemento;";
				break;
			
			case "id_hurto" :
				$cadenaSql = " SELECT MAX(id_hurto) ";
				$cadenaSql .= " FROM estado_elemento;";
				break;
			
			case "id_faltante" :
				$cadenaSql = " SELECT MAX(id_faltante) ";
				$cadenaSql .= " FROM estado_elemento;";
				break;
			case "tipo_faltante" :
				$cadenaSql = " SELECT id_tipo_falt_sobr, descripcion ";
				$cadenaSql .= " FROM tipo_falt_sobr;";
				break;
			
			case "funcionarios" :
				
				$cadenaSql = "SELECT JEF_IDENTIFICADOR,JEF_INDENTIFICACION ||' - '|| JEF_NOMBRE ";
				$cadenaSql .= "FROM JEFES_DE_SECCION ";
				
				break;
			
			case "dependencia" :
				
				$cadenaSql = " SELECT JEF_IDENTIFICADOR,JEF_DEPENDENCIA_PERTENECIENTE ";
				$cadenaSql .= " FROM JEFES_DE_SECCION ";
				
				break;
			
			case "seleccion_funcionario" :
				
				$cadenaSql = "SELECT id_funcionario, identificacion ||'-'||nombre AS funcionario  ";
				$cadenaSql .= "FROM funcionario;";
				break;
			
			case "seleccion_info_elemento" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_elemento_ind, elemento_individual.placa, elemento_individual.serie,funcionario, id_elemento_gen, ";
				$cadenaSql .= "elemento_individual.id_salida ,tipo_bien.tb_descripcion ,salida.id_salida as salida ";
				$cadenaSql .= "FROM elemento_individual ";
				$cadenaSql .= "JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
				$cadenaSql .= "JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
				$cadenaSql .= "JOIN tipo_bien ON tipo_bien.tb_idbien = elemento.tipo_bien ";
// 				$cadenaSql .= "JOIN funcionario  ON funcionario.id_funcionario = salida.funcionario ";
// 				$cadenaSql .= "left JOIN dependencia  ON dependencia.id_dependencia = funcionario.dependencia ";
				$cadenaSql .= "WHERE 1=1 ";
				$cadenaSql .= "AND elemento.tipo_bien <> 1 ";
				$cadenaSql .= " AND  id_elemento_ind= '" . $variable . "'";
				$cadenaSql .= " ; ";
				
				break;
			
			case "consultarElemento" :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_elemento_ind, elemento_individual.placa, elemento_individual.serie,funcionario, id_elemento_gen, ";
				$cadenaSql .= "elemento_individual.id_salida ,tipo_bien.tb_descripcion ,dependencia ,salida.id_salida as salida ";
				$cadenaSql .= "FROM elemento_individual ";
				$cadenaSql .= "JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
				$cadenaSql .= "JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
				$cadenaSql .= "JOIN tipo_bien ON tipo_bien.tb_idbien = elemento.tipo_bien ";
				// $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
				// $cadenaSql .= "left JOIN dependencia ON dependencia.id_dependencia = funcionario.dependencia ";
				$cadenaSql .= "WHERE 1=1 ";
				$cadenaSql .= "AND elemento.tipo_bien <> 1 ";
				
				if ($variable [0] != '') {
					$cadenaSql .= " AND funcionario = '" . $variable [0] . "'";
				}
				if ($variable [1] != '') {
					$cadenaSql .= " AND  elemento_individual.serial= '" . $variable [1] . "'";
				}
				if ($variable [2] != '') {
					$cadenaSql .= " AND  elemento_individual.placa= '" . $variable [2] . "'";
				}
				if ($variable [3] != '') {
					$cadenaSql .= " AND  dependencia= '" . $variable [3] . "'";
				}
				
				$cadenaSql .= " ; ";
				
				break;
			
			case "seleccion_funcionario_anterior" :
				
				$cadenaSql = "SELECT id_elemento_ind,identificacion ||'  -  '||nombre AS funcionario ,id_funcionario ";
				$cadenaSql .= "FROM elemento_individual ";
				$cadenaSql .= "JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
				$cadenaSql .= "JOIN funcionario  ON funcionario.id_funcionario = salida.funcionario ";
				$cadenaSql .= "WHERE  id_elemento_ind='" . $variable . "';";
				
				break;
			
			case "insertar_historico" :
				
				$cadenaSql = " INSERT INTO historial_elemento_individual( ";
				$cadenaSql .= "fecha_registro, elemento_individual, funcionario,descripcion_funcionario)  ";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "') ";
				$cadenaSql .= "RETURNING  id_evento; ";
				
				break;
			
			case "actualizar_salida" :
				
				$cadenaSql = " UPDATE salida ";
				$cadenaSql .= "SET funcionario='" . $variable [1] . "',";
				$cadenaSql .= " observaciones='" . $variable [2] . "' ";
				$cadenaSql .= " WHERE id_salida=(SELECT id_salida FROM elemento_individual WHERE id_elemento_ind='" . $variable [0] . "' ) ;";
				
				break;
			
			case "funcionario_informacion" :
				
				$cadenaSql = "SELECT JEF_INDENTIFICACION,  JEF_NOMBRE ,JEF_DEPENDENCIA_PERTENECIENTE ";
				$cadenaSql .= "FROM JEFES_DE_SECCION ";
				$cadenaSql .= "WHERE JEF_IDENTIFICADOR='" . $variable . "' ";
				
				break;
		}
		return $cadenaSql;
	}
}
?>
