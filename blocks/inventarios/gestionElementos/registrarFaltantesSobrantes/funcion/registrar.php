<?php

namespace inventarios\gestionElementos\registrarTraslados\funcion;

use inventarios\gestionElementos\registrarTraslados\funcion\redireccion;

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
		var_dump ( $_REQUEST );

		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$fechaActual = date ( 'Y-m-d' );
		
		switch ($_REQUEST ['inexistencia']) {
			
			case '1' :
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'id_sobrante' );
				$sobrante = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				$id_sobrante=$sobrante[0][0]+1;
				
				
				$arreglo=array(
				0,		
				$id_sobrante,
				0,		
				$_REQUEST['observaciones'],
				'NULL',
				'NULL',
				'0001-01-01',
				'0001-01-01',
				$fechaActual
				);
				
				break;
			
			case '2' :
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'id_hurto' );
				$hurto = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				$id_hurto=$hurto[0][0]+1;
				
				break;
			
			case '3' :
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'id_faltante' );
				$faltante = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				$id_faltante=$faltante[0][0]+1;
				
				
				
				break;
		}
		
	
		exit;
		
		
		
		
	
		
		$datos = array (
				
				$fechaActual,
				$_REQUEST ['elemento_ind'],
				$_REQUEST ['idfuncionario'],
				$_REQUEST ['funcionario'] 
		)
		;
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_historico', $datos );
		$historico = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$arreglo_datos = array (
				
				$_REQUEST ['elemento_ind'],
				$_REQUEST ['responsable_reci'],
				$_REQUEST ['observaciones'] 
		)
		;
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_salida', $arreglo_datos );
		$traslado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		if ($traslado) {
			
			redireccion::redireccionar ( 'inserto' );
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