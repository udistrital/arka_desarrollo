<?php

namespace inventarios\gestionEntradas\registrarEntradas\funcion;

use inventarios\gestionEntradas\registrarEntradas\funcion\redireccion;

include_once ('redireccionar.php');
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
		
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/blocks/inventarios/gestionEntradas/";
		$rutaBloque .= $esteBloque ['nombre'];
		$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/gestionEntradas/" . $esteBloque ['nombre'];

		if($_REQUEST ['observaciones_entrada']==''){
				
			redireccion::redireccionar ( 'NoObservaciones');
				
		}
		
		switch ($_REQUEST ['clase']) {
			
			case '1' :
				
				$arreglo = array (
						$_REQUEST ['id_entradaR'],
						$_REQUEST ['id_salida'],
						$_REQUEST ['id_hurto'] 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertarReposicion', $arreglo );
				$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				break;
			
			case '2' :
				
				$i = 0;
				
				foreach ( $_FILES as $key => $values ) {
					
					$archivo [$i] = $_FILES [$key];
					$i ++;
				}
				
				$archivo = $archivo [0];
				
				if ($archivo) {
					// obtenemos los datos del archivo
					$tamano = $archivo ['size'];
					$tipo = $archivo ['type'];
					$archivo1 = $archivo ['name'];
					$prefijo = substr ( md5 ( uniqid ( rand () ) ), 0, 6 );
					
					if ($archivo1 != "") {
						// guardamos el archivo a la carpeta files
						$destino1 = $rutaBloque . "/actas/" . $prefijo . "_" . $archivo1;
						if (copy ( $archivo ['tmp_name'], $destino1 )) {
							$status = "Archivo subido: <b>" . $archivo1 . "</b>";
							$destino1 = $host . "/actas/" . $prefijo . "_" . $archivo1;
						} else {
							$status = "Error al subir el archivo";
						}
					} else {
						$status = "Error al subir archivo";
					}
				}
				
				$arreglo = array (
						$destino1,
						$archivo1 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertarDonacion', $arreglo );
				$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				break;
			
			case '3' :
				
				if($_REQUEST ['observaciones_sobrante']==''){
					
					redireccion::redireccionar ( 'NoObservaciones');
					
				}
				
				
				$i = 0;
				
				foreach ( $_FILES as $key => $values ) {
					
					$archivo [$i] = $_FILES [$key];
					$i ++;
				}
				
				$archivo = $archivo [1];
				
				if ($archivo) {
					// obtenemos los datos del archivo
					$tamano = $archivo ['size'];
					$tipo = $archivo ['type'];
					$archivo1 = $archivo ['name'];
					$prefijo = substr ( md5 ( uniqid ( rand () ) ), 0, 6 );
					
					if ($archivo1 != "") {
						// guardamos el archivo a la carpeta files
						$destino1 = $rutaBloque . "/actas/" . $prefijo . "_" . $archivo1;
						if (copy ( $archivo ['tmp_name'], $destino1 )) {
							$status = "Archivo subido: <b>" . $archivo1 . "</b>";
							$destino1 = $host . "/actas/" . $prefijo . "_" . $archivo1;
						} else {
							$status = "Error al subir el archivo";
						}
					} else {
						$status = "Error al subir archivo";
					}
				}
				
				$arreglo = array (
						$_REQUEST ['observaciones_sobrante'],
						$destino1,
						$archivo1 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertarSobrante', $arreglo );
				$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				break;
			
			case '4' :
				
				if($_REQUEST ['observaciones_produccion']==''){
						
					redireccion::redireccionar ( 'NoObservaciones');
						
				}
				$i = 0;
				
				foreach ( $_FILES as $key => $values ) {
					
					$archivo [$i] = $_FILES [$key];
					$i ++;
				}
				
				$archivo = $archivo [2];
				
				if ($archivo) {
					// obtenemos los datos del archivo
					$tamano = $archivo ['size'];
					$tipo = $archivo ['type'];
					$archivo1 = $archivo ['name'];
					$prefijo = substr ( md5 ( uniqid ( rand () ) ), 0, 6 );
					
					if ($archivo1 != "") {
						// guardamos el archivo a la carpeta files
						$destino1 = $rutaBloque . "/actas/" . $prefijo . "_" . $archivo1;
						if (copy ( $archivo ['tmp_name'], $destino1 )) {
							$status = "Archivo subido: <b>" . $archivo1 . "</b>";
							$destino1 = $host . "/actas/" . $prefijo . "_" . $archivo1;
						} else {
							$status = "Error al subir el archivo";
						}
					} else {
						$status = "Error al subir archivo";
					}
				}
				
				$arreglo = array (
						$_REQUEST ['observaciones_produccion'],
						$destino1,
						$archivo1 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertarProduccion', $arreglo );
				$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				break;
			
			case '5' :
				
				if($_REQUEST ['observaciones_recuperacion']==''){
				
					redireccion::redireccionar ( 'NoObservaciones');
				
				}
				
				$i = 0;
				
				foreach ( $_FILES as $key => $values ) {
					
					$archivo [$i] = $_FILES [$key];
					$i ++;
				}
				
				$archivo = $archivo [3];
				
				if ($archivo) {
					// obtenemos los datos del archivo
					$tamano = $archivo ['size'];
					$tipo = $archivo ['type'];
					$archivo1 = $archivo ['name'];
					$prefijo = substr ( md5 ( uniqid ( rand () ) ), 0, 6 );
					
					if ($archivo1 != "") {
						// guardamos el archivo a la carpeta files
						$destino1 = $rutaBloque . "/actas/" . $prefijo . "_" . $archivo1;
						if (copy ( $archivo ['tmp_name'], $destino1 )) {
							$status = "Archivo subido: <b>" . $archivo1 . "</b>";
							$destino1 = $host . "/actas/" . $prefijo . "_" . $archivo1;
						} else {
							$status = "Error al subir el archivo";
						}
					} else {
						$status = "Error al subir archivo";
					}
				}
				
				$arreglo = array (
						$_REQUEST ['observaciones_recuperacion'],
						$destino1,
						$archivo1 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertarRecuperacion', $arreglo );
				$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				break;
			
			default :
				
				break;
		}
		
		$fechaActual = date ( 'Y-m-d' );
		
		$arregloDatos = array (
				$fechaActual,
				$_REQUEST ['vigencia'],
				$_REQUEST ['clase'],
				$id_clase[0][0],
				$_REQUEST ['tipo_contrato'],
				$_REQUEST ['numero_contrato'],
				$_REQUEST ['fecha_contrato'],
				$_REQUEST ['proveedor'],
				$_REQUEST ['nit'],
				$_REQUEST ['numero_factura'],
				$_REQUEST ['fecha_factura'],
				$_REQUEST ['observaciones_entrada'],
				$_REQUEST['numero_acta_r'],
				'1'
		);
		
		
		
		
		
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarEntrada', $arregloDatos );
		
		$id_entrada = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

		
		
		
		if ($id_entrada) {
				
			redireccion::redireccionar ( 'inserto', $id_entrada[0][0] );
		} else {
				
			redireccion::redireccionar ( 'noInserto');
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