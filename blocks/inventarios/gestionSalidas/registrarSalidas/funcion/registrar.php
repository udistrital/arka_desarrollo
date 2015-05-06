<?php

namespace inventarios\gestionSalidas\registrarSalidas\funcion;

use inventarios\gestionSalidas\registrarSalidas\funcion\redireccion;

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
// 		var_dump($_REQUEST);exit;
		$fechaActual = date ( 'Y-m-d' );
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$arreglo = array (
				$fechaActual,
				$_REQUEST ['dependencia'],
				$_REQUEST ['funcionario'],
				$_REQUEST ['observaciones'],
				$_REQUEST ['numero_entrada'],
				$_REQUEST ['sede'],
				$_REQUEST ['vigencia'],
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida', $arreglo );
		
		$id_salida = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$items = unserialize ( $_REQUEST ['items'] );
		$cantidad = unserialize ( $_REQUEST ['cantidad'] );
		
		foreach ( $items as $i ) {
			$cadenaSql = $this->miSql->getCadenaSql ( 'busqueda_elementos_individuales', $i );
			
			$id_elem_ind [$i] = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		}
		
		

		
		foreach ( $cantidad as $i ) {
			
			if ($i != '') {
				$contador_ele_ind = $i;
			}
		}
		
		foreach ( $id_elem_ind as $i => $e ) {
			
			
			

			if (count ( $e ) > 1) {
				
				for($i = 0; $i < $contador_ele_ind; $i ++) {
					
					$arreglo = array (
							$e [$i] [0],
							$id_salida [0] [0] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elementos_individuales', $arreglo );
					
					$actualizo_elem = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
				
				}
				
			}
			if (count ( $e ) == 1) {
				$arreglo = array (
						$e [0] [0],
						$id_salida [0] [0] 
				);
				
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elementos_individuales', $arreglo );
				
				$actualizo_elem = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			}
		}
		
		
// 		foreach ( $items as $i ) {
			
// 			$arreglo = array (
// 					$i,
// 					$id_salida [0] [0] 
// 			);
			
// 			$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida_item', $arreglo );
			
// 			$inserto = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
// 		}
		
		$arreglo = array (
				"salida" => $id_salida [0] [0],
				"entrada" => $_REQUEST ['numero_entrada'],
				"fecha" => $fechaActual 
		);
		
		
		
		
		if ($actualizo_elem) {
			
			redireccion::redireccionar ( 'inserto', $arreglo );
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