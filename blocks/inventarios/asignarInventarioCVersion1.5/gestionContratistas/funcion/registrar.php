<?php

/*
 * ----------------------------------------------------------------------------------------
 * | Control Versiones |
 * -----------------------------------------------------------------------------------------
 * | fecha | Autor | version | Detalle |
 * -----------------------------------------------------------------------------------------
 * | 2015/12/13 | Stiv Verdugo | 0.0.0.1 | |
 * -----------------------------------------------------------------------------------------
 *
 */
use inventarios\asignarInventarioC\gestionContratista\funcion\redireccion;

include_once ('redireccionar.php');

$ruta_1 = $this->miConfigurador->getVariableConfiguracion ( 'raizDocumento' ) . '/plugin/php_excel/Classes/PHPExcel.class.php';
$ruta_2 = $this->miConfigurador->getVariableConfiguracion ( 'raizDocumento' ) . '/plugin/php_excel/Classes/PHPExcel/Reader/Excel2007.class.php';

include_once ($ruta_1);
include_once ($ruta_2);

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class Registrador {
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
		
		$fechaActual = date ( 'Y-m-d' );
		
		$_REQUEST ['bodega'] = 0;
		
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/blocks/inventarios/asignarInventarioC/";
		$rutaBloque .= $esteBloque ['nombre'];
		
		$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/asignarInventarioC/" . $esteBloque ['nombre'];
		
		$ruta_eliminar_xlsx = $rutaBloque . "/archivo/*.xlsx";
		
		$ruta_eliminar_xls = $rutaBloque . "/archivo/*.xls";
		
		foreach ( glob ( $ruta_eliminar_xlsx ) as $filename ) {
			unlink ( $filename );
		}
		foreach ( glob ( $ruta_eliminar_xls ) as $filename ) {
			unlink ( $filename );
		}
		
		$i = 0;
		foreach ( $_FILES as $key => $values ) {
			
			$archivo [$i] = $_FILES [$key];
			$i ++;
		}
		
		$archivo = $archivo [0];
		
		$trozos = explode ( ".", $archivo ['name'] );
		$extension = end ( $trozos );
		
		if ($extension == 'xlsx' || $extension == 'xls') {
			
			if ($archivo) {
				// obtenemos los datos del archivo
				$tamano = $archivo ['size'];
				$tipo = $archivo ['type'];
				$archivo1 = $archivo ['name'];
				$prefijo = "archivo";
				
				if ($archivo1 != "") {
					// guardamos el archivo a la carpeta files
					$ruta_absoluta = $rutaBloque . "/archivo/" . $archivo1;
					
					if (copy ( $archivo ['tmp_name'], $ruta_absoluta )) {
						$status = "Archivo subido: <b>" . $archivo1 . "</b>";
						$destino1 = $host . "/archivo/" . $archivo1;
					} else {
						$status = "Error al subir el archivo";
						echo $status;
					}
				} else {
					$status = "Error al subir archivo";
					echo $status;
				}
			}
			
			$arreglo = array (
					$destino1,
					$archivo1 
			);
			
			if (file_exists ( $ruta_absoluta )) {
				
				// Cargando la hoja de cálculo
				
				$objReader = new \PHPExcel_Reader_Excel2007 ();
				
				$objPHPExcel = $objReader->load ( $ruta_absoluta );
				
				$objFecha = new \PHPExcel_Shared_Date ();
				
				// Asignar hoja de excel activa
				
				$objPHPExcel->setActiveSheetIndex ( 0 );
				
				$objWorksheet = $objPHPExcel->setActiveSheetIndex ( 0 );
				
				$highestRow = $objWorksheet->getHighestRow ();
				
				for($i = 2; $i <= $highestRow; $i ++) {
					
					$datos [$i] ['vigencia'] = $objPHPExcel->getActiveSheet ()->getCell ( 'A' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['vigencia'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['numero'] = $objPHPExcel->getActiveSheet ()->getCell ( 'B' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['numero'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['identificacion'] = $objPHPExcel->getActiveSheet ()->getCell ( 'C' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['identificacion'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['nombres'] = $objPHPExcel->getActiveSheet ()->getCell ( 'D' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['nombres'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					$datos [$i] ['apellidos'] = $objPHPExcel->getActiveSheet ()->getCell ( 'E' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['apellidos'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['Fecha_Inicio__Anio'] = $objPHPExcel->getActiveSheet ()->getCell ( 'F' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['Fecha_Inicio__Anio'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['Fecha_Inicio__Mes'] = $objPHPExcel->getActiveSheet ()->getCell ( 'G' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['Fecha_Inicio__Mes'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['Fecha_Inicio__Dia'] = $objPHPExcel->getActiveSheet ()->getCell ( 'H' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['Fecha_Inicio__Dia'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['Fecha_Final__Anio'] = $objPHPExcel->getActiveSheet ()->getCell ( 'I' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['Fecha_Final__Anio'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					$datos [$i] ['Fecha_Final__Mes'] = $objPHPExcel->getActiveSheet ()->getCell ( 'J' . $i )->getCalculatedValue ();
					
					if (is_null ( $datos [$i] ['Fecha_Final__Mes'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
					
					$datos [$i] ['Fecha_Final__Dia'] = $objPHPExcel->getActiveSheet ()->getCell ( 'K' . $i )->getCalculatedValue ();
					if (is_null ( $datos [$i] ['Fecha_Final__Dia'] ) == true) {
						
						redireccion::redireccionar ( 'datosVacios', $fechaActual );
						exit ();
					}
				}
				
				if (isset($datos)==true&&$datos != false) {
					foreach ( $datos as $valor ) {
						$registrar = true;
						$fechaInicio = date ( 'Y-m-d', mktime ( 0, 0, 0, $valor ['Fecha_Inicio__Mes'], $valor ['Fecha_Inicio__Dia'], $valor ['Fecha_Inicio__Anio'] ) );
						
						$fechaFinal = date ( 'Y-m-d', mktime ( 0, 0, 0, $valor ['Fecha_Final__Mes'], $valor ['Fecha_Final__Dia'], $valor ['Fecha_Final__Anio'] ) );
						
						$arreglo = array (
								"identificacion" => $valor ['identificacion'],
								"nombres" => $valor ['nombres'] . " " . $valor ['apellidos'],
								"vigencia" => $valor ['vigencia'],
								"numero" => $valor ['numero'],
								"fecha_inicial" => $fechaInicio,
								"fecha_final" => $fechaFinal 
						);
						
						if ($fechaFinal <= $fechaInicio) {
							
							$registrar = false;
							$log_error [] = $arreglo;
						}
						
						$cadenaSql = $this->miSql->getCadenaSql ( 'registrarContratista', $arreglo );
						
						if ($registrar = true) {
							$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
							
							if ($resultado == false) {
								
								$log_error [] = $arreglo;
							}
						}
					}
				} else {
					
					$datos = false;
				}
				
				if (isset ( $log_error ) == true) {
					
					$log_error = serialize ( $log_error );
				} else {
					
					$log_error = false;
				}
				
				if ($datos != false) {
					$this->miConfigurador->setVariableConfiguracion ( "cache", true );
					redireccion::redireccionar ( 'inserto', $log_error );
					exit ();
				} else {
					
					redireccion::redireccionar ( 'noInserto' );
					exit ();
				}
			}
		} else {
			
			redireccion::redireccionar ( 'noExtension' );
			exit ();
		}
	}
}

$miRegistrador = new Registrador ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();
?>