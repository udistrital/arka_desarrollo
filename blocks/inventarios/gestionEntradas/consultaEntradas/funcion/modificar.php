<?php

namespace inventarios\gestionEntradas\consultaEntradas;

use inventarios\gestionEntradas\consultaEntradas\funcion;
use inventarios\gestionCompras\consultaOrdenCompra\funcion\redireccion;

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
		$arreglo = array (
				$_REQUEST ['numero_entrada'],
				$_REQUEST ['estado'] 
		)
		;
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarEstado', $arreglo );
		$modificar = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		if ($modificar) {
			\inventarios\gestionEntradas\consultaEntradas\funcion\redireccion::redireccionar ( 'inserto', $_REQUEST ['numero_entrada'] );
			// 
		} else {
			\inventarios\gestionEntradas\consultaEntradas\funcion\redireccion::redireccionar ( 'noInserto' );

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