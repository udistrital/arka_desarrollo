<?php

namespace inventarios\gestionEntradas\modificarEntradas;

use inventarios\gestionEntradas\modificarEntradas\funcion;

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
		$rutaBloque .= "registrarEntradas";
		$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/gestionEntradas/registrarEntradas";
		
		if ($_REQUEST ['observaciones_entrada'] == '') {
			
			// redireccion::redireccionar ( 'NoObservaciones');
		}
		
		switch ($_REQUEST ['clase']) {
			
			case '1' :
				
				if ($_REQUEST ['clase_entrada'] == $_REQUEST ['clase']) {
					
					$arreglo = array (
							$_REQUEST ['id_entradaR'],
							$_REQUEST ['id_salida'],
							$_REQUEST ['id_hurto'],
							$_REQUEST ['tipo_entrada'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'ActualizarReposicion', $arreglo );
					
					$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				} else {
					
					$arreglo = array (
							$_REQUEST ['id_entradaR'],
							$_REQUEST ['id_salida'],
							$_REQUEST ['id_hurto'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'insertarReposicion', $arreglo );
					$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				}
				
				break;
			
			case '2' :
				if ($_REQUEST ['clase_entrada'] == $_REQUEST ['clase']) {
					
					if ($_REQUEST ['actualizarActa'] == 1) {
						
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
								$archivo1,
								$_REQUEST ['tipo_entrada'] 
						);
						
						$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarDonacion', $arreglo );
						$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					} else {
						
						$id_clase [0] [0] = $_REQUEST ['tipo_entrada'];
					}
				} else {
					
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
				}
				
				break;
			
			case '3' :
				
				if ($_REQUEST ['clase_entrada'] == $_REQUEST ['clase']) {
					
					if ($_REQUEST ['observaciones_sobrante'] == '') {
						
						redireccion::redireccionar ( 'NoObservaciones' );
					}
					
					if ($_REQUEST ['actualizarActaS'] == 1) {
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
								$_REQUEST ['actualizarActaS'],
								$_REQUEST ['tipo_entrada'],
								$_REQUEST ['observaciones_sobrante'],
								$destino1,
								$archivo1 
						);
					} else {
						
						$arreglo = array (
								$_REQUEST ['actualizarActaS'],
								$_REQUEST ['tipo_entrada'],
								$_REQUEST ['observaciones_sobrante'] 
						);
					}
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarSobrante', $arreglo );
					$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				} else {
					
					if ($_REQUEST ['observaciones_sobrante'] == '') {
						
						redireccion::redireccionar ( 'NoObservaciones' );
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
				}
				break;
			
			case '4' :
				
				if ($_REQUEST ['clase_entrada'] == $_REQUEST ['clase']) {
					
					if ($_REQUEST ['observaciones_produccion'] == '') {
						
						redireccion::redireccionar ( 'NoObservaciones' );
					}
					
					if ($_REQUEST ['actualizarActaP'] == 1) {
						
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
								$_REQUEST ['actualizarActaP'],
								$_REQUEST ['tipo_entrada'],
								$_REQUEST ['observaciones_produccion'],
								$destino1,
								$archivo1 
						);
					} else {
						
						$arreglo = array (
								$_REQUEST ['actualizarActaP'],
								$_REQUEST ['tipo_entrada'],
								$_REQUEST ['observaciones_produccion'] 
						);
					}
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarProduccion', $arreglo );
					$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				} else {
					
					if ($_REQUEST ['observaciones_produccion'] == '') {
						
						redireccion::redireccionar ( 'NoObservaciones' );
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
				}
				break;
			
			case '5' :
				
				if ($_REQUEST ['clase_entrada'] == $_REQUEST ['clase']) {
					
					if ($_REQUEST ['observaciones_recuperacion'] == '') {
						
						redireccion::redireccionar ( 'NoObservaciones' );
					}
					
					if ($_REQUEST ['actualizarActaRc'] == 1) {
						
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
								$_REQUEST ['actualizarActaRc'],
								$_REQUEST ['tipo_entrada'],
								$_REQUEST ['observaciones_recuperacion'],
								$destino1,
								$archivo1 
						);
					} else {
						
						$arreglo = array (
								$_REQUEST ['actualizarActaRc'],
								$_REQUEST ['tipo_entrada'],
								$_REQUEST ['observaciones_recuperacion'] 
						);
					}
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarRecuperacion', $arreglo );
					$id_clase = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				} else {
					
					if ($_REQUEST ['observaciones_recuperacion'] == '') {
						
						redireccion::redireccionar ( 'NoObservaciones' );
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
				}
				break;
			
			default :
				
				break;
		}
		
		$arregloDatos = array (
				
				$_REQUEST ['vigencia'],
				$_REQUEST ['clase'],
				$id_clase [0] [0],
				$_REQUEST ['tipo_contrato'],
				$_REQUEST ['numero_contrato'],
				$_REQUEST ['fecha_contrato'],
				$_REQUEST ['proveedor'],
				$_REQUEST ['nit'],
				$_REQUEST ['numero_factura'],
				$_REQUEST ['fecha_factura'],
				$_REQUEST ['observaciones_entrada'],
				'1',
				$_REQUEST ['numero_entrada'] 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarEntrada', $arregloDatos );
		
		$id_entrada = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		if ($id_entrada) {
			
			redireccion::redireccionar ( 'inserto', $id_entrada [0] [0] );
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