<?php

namespace inventarios\gestionSalidas\modificarSalidas;

use inventarios\gestionSalidas\modificarSalidas\funcion;

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
		
		for($i = 0; $i <= 200; $i ++) {
		
			if (isset ( $_REQUEST ['item' . $i] )) {
					
				$items [] = $_REQUEST ['item' . $i];
			}
		}
		
		
		
		
// 		$arreglo = array (
// 				$_REQUEST ['funcionarioP'],
// 				$_REQUEST ['identificacion'],
// 				$_REQUEST ['id_funcionario'] 
// 		);
		
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_funcionario', $arreglo );
		
// 		$id_funcionario = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		$arreglo = array (
				
				$_REQUEST ['dependencia'],
				$_REQUEST ['ubicacion'],
				$_REQUEST ['observaciones'],
				$_REQUEST ['numero_salida'], 
				$_REQUEST ['funcionarioP']
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_salida', $arreglo );
		$id_salida = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		if (isset ( $_REQUEST ['Re_Actualizacion'] )) {
			
			
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consultarEntradaParticular', $_REQUEST ['numero_entrada'] );
			
			$entrada = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consulta_elementos_totales', $entrada [0] [12] );
			
			$elementos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			foreach ( $elementos as $d ) {
				
				if ($_REQUEST ['numero_salida'] != $d [4]) {
					
					$salidasSA [] = $d [4];
					
				} else {
					
					$salidasSA = 'true';
					
				}
			}
			
			$salidasSA = serialize ( $salidasSA );
			
			
			
		
			foreach ( $items as $i ) {
				
				$arreglo = array (
						$i,
						$_REQUEST ['numero_salida'] 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida_item', $arreglo );
				$semaforo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			}
			
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => $salidasSA 
			);
		}else if ($_REQUEST ['actualizar'] == '1') {
			
			if (! isset ( $items )) {
			
				redireccion::redireccionar('noitems');
			}
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consultarEntradaParticular', $_REQUEST ['numero_entrada'] );
			
			$entrada = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consulta_elementos_totales', $entrada [0] [12] );
			
			$elementos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			foreach ( $elementos as $d ) {
				
				if ($_REQUEST ['numero_salida'] != $d [4]) {
					
					$salidasSA [] = $d [4];
				}
			}
			
			$salidasSA = serialize ( $salidasSA );
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'restaurar_elementos', $entrada [0] [12] );
			
			$elementos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			
			for($i = 0; $i <= 200; $i ++) {
				
				if (isset ( $_REQUEST ['item' . $i] )) {
					
					$items [] = $_REQUEST ['item' . $i];
				}
			}
			
			foreach ( $items as $i ) {
				
				$arreglo = array (
						$i,
						$_REQUEST ['numero_salida'] 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida_item', $arreglo );
				$semaforo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			}
			
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => $salidasSA 
			);
		} else if ($_REQUEST ['actualizar'] == '0') {
			
			$semaforo = 'true';
			
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => 0 
			);
		}
		
		if ($semaforo) {
			
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