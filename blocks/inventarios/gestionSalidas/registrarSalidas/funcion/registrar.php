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
		$fechaActual = date ( 'Y-m-d' );
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$arreglo = array (
				$_REQUEST ['funcionario'],
				$_REQUEST ['identificacion'] 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_funcionario', $arreglo );
		
		$id_funcionario = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$arreglo = array (
				$fechaActual,
				$_REQUEST ['dependencia'],
				$_REQUEST ['ubicacion'],
				$id_funcionario [0] [0],
				$_REQUEST ['observaciones'],
				$_REQUEST ['numero_entrada'] 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida', $arreglo );
		
		$id_salida = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$items = unserialize ( $_REQUEST ['items'] );
		
		foreach ( $items as $i ) {
			
			$arreglo = array (
					$i,
					$id_salida [0] [0] 
			);
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida_item', $arreglo );
			
			$inserto = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		}
		
	
		$arreglo = array (
				"salida" => $id_salida [0] [0],
				"entrada" => $_REQUEST ['numero_entrada'],
				"fecha" => $fechaActual 
		);
		
		if ($inserto) {
			
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