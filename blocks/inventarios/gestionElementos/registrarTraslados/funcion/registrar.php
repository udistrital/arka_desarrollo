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
		
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		
		$fechaActual = date ( 'Y-m-d' );
		
		
	
		$datos=array(
				
			$fechaActual,
			$_REQUEST['elemento_ind'],
			$_REQUEST['idfuncionario'],
			$_REQUEST['funcionario']
				
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_historico',$datos );
		$historico= $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		
		
		
		
		
		
		$arreglo_datos=array(
				
				$_REQUEST['elemento_ind'],
				$_REQUEST['responsable_reci'],
				$_REQUEST['observaciones']				

		);
		
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_salida',$arreglo_datos );
		$traslado= $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );


				if ($traslado) {
					
					redireccion::redireccionar ( 'inserto' );
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