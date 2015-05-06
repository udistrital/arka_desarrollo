<?php

namespace inventarios\gestionElementos\registrarFaltantesSobrantes\funcion;

use inventarios\gestionElementos\registrarFaltantesSobrantes\funcion\redireccion;

include_once ('redireccionar.php');

$ruta_1 = $this->miConfigurador->getVariableConfiguracion ( 'raizDocumento' ) . '/plugin/php_excel/Classes/PHPExcel.class.php';
$ruta_2 = $this->miConfigurador->getVariableConfiguracion ( 'raizDocumento' ) . '/plugin/php_excel/Classes/PHPExcel/Reader/Excel2007.class.php';

include_once ($ruta_1);
include_once ($ruta_2);

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class RegistradorOrden {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miFuncion;
	var $miSql;
	var $conexion;
	function __construct($lenguaje, $sql, $funcion) {
		$this->miConfigurador = \Configurador::singleton ();
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		$this->lenguaje = $lenguaje;
		$this->miSql = $sql;
		$this->miFuncion = $funcion;
	}
	function procesarFormulario() {
		
		
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/blocks/inventarios/gestionElementos/";
		$rutaBloque .= $esteBloque ['nombre'];
		
		$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/gestionElementos/" . $esteBloque ['nombre'];
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$fechaActual = date ( 'Y-m-d' );
		
		
		
		
		$i=0;
		foreach ( $_FILES as $key => $values ) {
				
			$archivo [$i] = $_FILES [$key];
			$i ++;
		}
		$archivo=$archivo[0];
		
			
		if (isset ( $archivo )) {
			// obtenemos los datos del archivo
			$tamano = $archivo ['size'];
			$tipo = $archivo ['type'];
			$archivo1 = $archivo ['name'];
			$prefijo = substr ( md5 ( uniqid ( rand () ) ), 0, 6 );
				
			if ($archivo1 != "") {
				// guardamos el archivo a la carpeta files
				$destino1 = $rutaBloque . "/documento_radicacion/" . $prefijo . "_" . $archivo1;
				if (copy ( $archivo ['tmp_name'], $destino1 )) {
					$status = "Archivo subido: <b>" . $archivo1 . "</b>";
					$destino1 = $host . "/documento_radicacion/" . $prefijo . "_" . $archivo1;
				} else {
					$status = "Error al subir el archivo";
					echo $status;
				}
			} else {
				$status = "Error al subir archivo";
				echo $status."2";
			}
				
			$arreglo = array (
					$destino1,
					$archivo1
			);
		}
		
			
		
		$arreglo = array (
				$_REQUEST['dependencia_baja'],
				$_REQUEST['estado_baja'],
				($_REQUEST['tramite_baja']<>'')?$_REQUEST['tramite_baja']:0,
				$_REQUEST['tipo_mueble'],
				$destino1,
				$archivo1,
				$_REQUEST['observaciones'],
				$_REQUEST['elemento_ind'],
				$fechaActual	
		);
		
		
		
		
		
		
	
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_baja', $arreglo );
		
		$registro = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		

        		
	
		if ($registro) {
			
			
			redireccion::redireccionar ( 'inserto', $registro[0][0]);
		} else {
			
			redireccion::redireccionar ( 'noInserto' );
		}
	}
	function resetForm() {
		foreach ( $_REQUEST as $clave => $valor ) {
			
			if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
				unset ( $_REQUEST [$clave] );
			}
		}
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

?>