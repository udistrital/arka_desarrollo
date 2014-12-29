<?php

namespace inventarios\gestionElementos\registrarElemento\funcion;

use inventarios\gestionElementos\registrarElemento\funcion\redireccion;

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
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		$fechaActual = date ( 'Y-m-d' );
		
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/blocks/inventarios/gestionElementos/";
		$rutaBloque .= $esteBloque ['nombre'];
		$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/gestionEntradas/" . $esteBloque ['nombre'];
		
		switch ($_REQUEST ['tipo_registro']) {
			
			case '1' :
				
				if ($_REQUEST ['tipo_bien'] == 1) {
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'consultar_placa', '1' );
					$placa = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					
					if ($placa [0] [0] == NULL) {
						
						$placa = 1000001;
					} else {
						$placa = $placa [0] [0] + 1;
					}
					
					$arreglo = array (
							$fechaActual,
							$_REQUEST ['tipo_bien'],
							$_REQUEST ['descripcion'],
							$_REQUEST ['cantidad'],
							$_REQUEST ['unidad'],
							$_REQUEST ['valor'],
							$_REQUEST ['iva'],
							$_REQUEST ['ajuste'],
							$_REQUEST ['bodega'],
							$_REQUEST ['subtotal_sin_iva'],
							$_REQUEST ['total_iva'],
							$_REQUEST ['total_iva_con'],
							$placa,
							$_REQUEST ['marca'],
							$_REQUEST ['serie'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'ingresar_elemento_tipo_1', $arreglo );
					
					$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				} else if ($_REQUEST ['tipo_bien'] == 2) {
					
					$arreglo = array (
							$fechaActual,
							$_REQUEST ['tipo_bien'],
							$_REQUEST ['descripcion'],
							$_REQUEST ['cantidad'] = 1,
							$_REQUEST ['unidad'],
							$_REQUEST ['valor'],
							$_REQUEST ['iva'],
							$_REQUEST ['ajuste'],
							$_REQUEST ['bodega'],
							$_REQUEST ['subtotal_sin_iva'],
							$_REQUEST ['total_iva'],
							$_REQUEST ['total_iva_con'],
							$_REQUEST ['placa_cc'],
							$_REQUEST ['marca'],
							$_REQUEST ['serie'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'ingresar_elemento_tipo_1', $arreglo );
					
					$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				} else if ($_REQUEST ['tipo_bien'] == 3) {
					
					if ($_REQUEST ['tipo_poliza'] == 1) {
						$arreglo = array (
								$fechaActual,
								$_REQUEST ['tipo_bien'],
								$_REQUEST ['descripcion'],
								$_REQUEST ['cantidad'] = 1,
								$_REQUEST ['unidad'],
								$_REQUEST ['valor'],
								$_REQUEST ['iva'],
								$_REQUEST ['ajuste'],
								$_REQUEST ['bodega'],
								$_REQUEST ['subtotal_sin_iva'],
								$_REQUEST ['total_iva'],
								$_REQUEST ['total_iva_con'],
								$_REQUEST ['placa_dev'],
								$_REQUEST ['tipo_poliza'],
								'0001-01-01',
								'0001-01-01',
								$_REQUEST ['marca'],
								$_REQUEST ['serie'] 
						);
					} else if ($_REQUEST ['tipo_poliza'] == 2) {
						$arreglo = array (
								$fechaActual,
								$_REQUEST ['tipo_bien'],
								$_REQUEST ['descripcion'],
								$_REQUEST ['cantidad'] = 1,
								$_REQUEST ['unidad'],
								$_REQUEST ['valor'],
								$_REQUEST ['iva'],
								$_REQUEST ['ajuste'],
								$_REQUEST ['bodega'],
								$_REQUEST ['subtotal_sin_iva'],
								$_REQUEST ['total_iva'],
								$_REQUEST ['total_iva_con'],
								$_REQUEST ['placa_dev'],
								$_REQUEST ['tipo_poliza'],
								$_REQUEST ['fecha_inicio'],
								$_REQUEST ['fecha_final'],
								$_REQUEST ['marca'],
								$_REQUEST ['serie'] 
						);
					}
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'ingresar_elemento_tipo_2', $arreglo );
					
					$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				}
				
				$datos = array (
						$elemento [0] [0],
						$fechaActual 
				);
				
				if ($elemento) {
					
					redireccion::redireccionar ( 'inserto', $datos );
				} else {
					
					redireccion::redireccionar ( 'noInserto', $datos );
				}
				
				break;
			case '2' :
				$ingreso = 0;
				
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
							$ruta_absoluta = $rutaBloque . "/archivo/" . $prefijo . "_" . $archivo1;
							
							if (copy ( $archivo ['tmp_name'], $ruta_absoluta )) {
								$status = "Archivo subido: <b>" . $archivo1 . "</b>";
								$destino1 = $host . "/archivo/" . $prefijo . "_" . $archivo1;
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
							
							$datos [$i] ['Tipo_Bien'] = $objPHPExcel->getActiveSheet ()->getCell ( 'A' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Descripcion'] = $objPHPExcel->getActiveSheet ()->getCell ( 'B' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Cantidad'] = $objPHPExcel->getActiveSheet ()->getCell ( 'C' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Unidad_Medida'] = $objPHPExcel->getActiveSheet ()->getCell ( 'D' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Valor_Precio'] = $objPHPExcel->getActiveSheet ()->getCell ( 'E' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Iva'] = $objPHPExcel->getActiveSheet ()->getCell ( 'F' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Ajuste'] = $objPHPExcel->getActiveSheet ()->getCell ( 'G' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Bodega'] = $objPHPExcel->getActiveSheet ()->getCell ( 'H' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Subtotal_Sin_Iva'] = $objPHPExcel->getActiveSheet ()->getCell ( 'I' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Total_Iva'] = $objPHPExcel->getActiveSheet ()->getCell ( 'J' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Total_Con_Iva'] = $objPHPExcel->getActiveSheet ()->getCell ( 'K' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Placa'] = $objPHPExcel->getActiveSheet ()->getCell ( 'L' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Tipo_poliza'] = $objPHPExcel->getActiveSheet ()->getCell ( 'M' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Fecha_Inicio_Poliza'] = $objPHPExcel->getActiveSheet ()->getCell ( 'N' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Fecha_Final_Poliza'] = $objPHPExcel->getActiveSheet ()->getCell ( 'O' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Marca'] = $objPHPExcel->getActiveSheet ()->getCell ( 'P' . $i )->getCalculatedValue ();
							
							$datos [$i] ['Serie'] = $objPHPExcel->getActiveSheet ()->getCell ( 'Q' . $i )->getCalculatedValue ();
						}
						
						for($i = 2; $i <= $highestRow; $i ++) {
							
							$arreglo = array (
									$fechaActual,
									$datos [$i] ['Tipo_Bien'],
									trim ( $datos [$i] ['Descripcion'], "'" ),
									$datos [$i] ['Cantidad'],
									trim ( $datos [$i] ['Unidad_Medida'], "'" ),
									$datos [$i] ['Valor_Precio'],
									$datos [$i] ['Iva'],
									$datos [$i] ['Ajuste'],
									$datos [$i] ['Bodega'],
									$datos [$i] ['Subtotal_Sin_Iva'],
									$datos [$i] ['Total_Iva'],
									$datos [$i] ['Total_Con_Iva'],
									$datos [$i] ['Placa'],
									$datos [$i] ['Tipo_poliza'],
									trim ( $datos [$i] ['Fecha_Inicio_Poliza'], "'" ),
									trim ( $datos [$i] ['Fecha_Final_Poliza'], "'" ) ,
									trim ( $datos [$i] ['Marca'], "'" ),
									trim ( $datos [$i] ['Serie'], "'" )
							);
							
							$cadenaSql = $this->miSql->getCadenaSql ( 'ingresar_elemento_tipo_2', $arreglo );
							
							$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
							
							$ingreso = 1;
						}
						
						if ($ingreso == 1) {
							
							redireccion::redireccionar ( 'inserto_M', $fechaActual );
						} else {
							
							redireccion::redireccionar ( 'noInserto', $datos );
						}
					}
				} else {
					
					redireccion::redireccionar ( 'noExtension' );
				}
				
				break;
		}
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		if ($_REQUEST ['objeto_contrato'] == '') {
			
			redireccion::redireccionar ( 'notextos' );
		}
		
		if ($_REQUEST ['forma_pago'] == '') {
			
			redireccion::redireccionar ( 'notextos' );
		}
		
		$datosSolicitante = array (
				$_REQUEST ['dependencia_solicitante'],
				$_REQUEST ['rubro'] 
		);
		
		// Registro Solicitante
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarSolicitante', $datosSolicitante );
		$id_solicitante = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$datosSupervisor = array (
				$_REQUEST ['nombre_supervisor'],
				$_REQUEST ['cargo_supervisor'],
				$_REQUEST ['dependencia_supervisor'] 
		);
		
		// Registro Supervisor
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarSupervisor', $datosSupervisor );
		$id_supervisor = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$datosContratistaC = array (
				$_REQUEST ['nombre_razon_contratista'],
				$_REQUEST ['identifcacion_contratista'],
				$_REQUEST ['direccion_contratista'],
				$_REQUEST ['telefono_contratista'],
				$_REQUEST ['cargo_contratista'] 
		);
		
		// Registro Contratista
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarContratista', $datosContratistaC );
		$id_ContratistaC = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		// Registro Encargados
		
		$datosContratista = array (
				'3',
				$_REQUEST ['nombreContratista'],
				$_REQUEST ['identificacionContratista'],
				'NULL',
				'NULL' 
		);
		
		$datosjefe = array (
				'2',
				$_REQUEST ['nombreJefeSeccion'],
				'NULL',
				$_REQUEST ['cargoJefeSeccion'],
				'NULL' 
		);
		
		$datosOrdenador = array (
				'1',
				$_REQUEST ['nombreOrdenador'],
				'NULL',
				'NULL',
				$_REQUEST ['asignacionOrdenador'] 
		);
		
		// Registro Encargados
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarEncargado', $datosContratista );
		$id_contratista = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarEncargado', $datosjefe );
		$id_jefe = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarEncargado', $datosOrdenador );
		$id_ordenador = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		// Registro Orden
		
		$datosOrden = array (
				$fechaActual,
				$_REQUEST ['objeto_contrato'],
				isset ( $_REQUEST ['polizaA'] ),
				isset ( $_REQUEST ['polizaB'] ),
				isset ( $_REQUEST ['polizaC'] ),
				isset ( $_REQUEST ['polizaD'] ),
				$_REQUEST ['duracion'],
				$_REQUEST ['fecha_inicio_pago'],
				$_REQUEST ['fecha_final_pago'],
				$_REQUEST ['forma_pago'],
				$_REQUEST ['total_preliminar'],
				$_REQUEST ['iva'],
				$_REQUEST ['total'],
				$_REQUEST ['fecha_disponibilidad'],
				$_REQUEST ['numero_disponibilidad'],
				$_REQUEST ['valor_disponibilidad'],
				$_REQUEST ['fecha_registro'],
				$_REQUEST ['numero_registro'],
				$_REQUEST ['valor_registro'],
				$_REQUEST ['valorLetras_registro'],
				$id_ContratistaC [0] [0],
				$id_contratista [0] [0],
				$id_jefe [0] [0],
				$id_ordenador [0] [0],
				$id_solicitante [0] [0],
				$id_supervisor [0] [0] 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarOrden', $datosOrden );
		
		$id_orden = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$datos = array (
				$id_orden [0] [0],
				$fechaActual 
		);
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