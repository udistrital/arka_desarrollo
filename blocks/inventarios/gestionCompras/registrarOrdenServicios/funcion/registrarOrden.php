<?php

namespace inventarios\gestionCompras\registrarOrdenServicios\funcion;

use inventarios\gestionCompras\registrarOrdenServicios\funcion\redireccion;

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
		
		if ($_REQUEST ['objeto_contrato'] == '') {
			
			redireccion::redireccionar ( 'notextos' );
		}
		
		if ($_REQUEST ['forma_pago'] == '') {
			
			redireccion::redireccionar ( 'notextos' );
		}
		
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
		
		if ($_REQUEST ['iva'] == 1) {
			
			$totalP = $_REQUEST ['total_preliminar'];
			
			$iva = $totalP * (0.16);
			
			$total = $totalP + $iva;
		} else if ($_REQUEST ['iva'] == 0) {
			
			$totalP = $_REQUEST ['total_preliminar'];
			
			$iva = 0;
			
			$total = $totalP;
		}
		
		// Registro Orden
		

		
		$arreglo = array (
				$fechaActual,
				$_REQUEST ['vigencia_disponibilidad'],
				$_REQUEST ['diponibilidad'],
				$_REQUEST ['valor_disponibilidad'],
				$_REQUEST ['fecha_diponibilidad'],
				$_REQUEST ['valorLetras_disponibilidad'],
				$_REQUEST ['vigencia_registro'],
				$_REQUEST ['registro'],
				$_REQUEST ['valor_registro'],
				$_REQUEST ['fecha_registro'],
				$_REQUEST ['valorL_registro']
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarInformacionPresupuestal', $arreglo );
		
		$info_presupuestal = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		
		
		$datosOrden = array (
				$fechaActual,
				$info_presupuestal [0] [0],
				$_REQUEST ['dependencia_solicitante'],
				$_REQUEST ['rubro'],
				$_REQUEST ['objeto_contrato'],
				isset ( $_REQUEST ['polizaA'] ),
				isset ( $_REQUEST ['polizaB'] ),
				isset ( $_REQUEST ['polizaC'] ),
				isset ( $_REQUEST ['polizaD'] ),
				$_REQUEST ['numero_dias'],
				$_REQUEST ['fecha_inicio_pago'],
				$_REQUEST ['fecha_final_pago'],
				$_REQUEST ['forma_pago'],
				$totalP,
				$iva,
				$total,
				$id_ContratistaC [0] [0],
				$_REQUEST ['id_ordenador'],
				$id_supervisor [0] [0],
				TRUE ,
				$_REQUEST['sede']
		);
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarOrden', $datosOrden );
		
		$id_orden = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		
		// 		echo $id_orden[0][0];
		$datos = array (
				$id_orden [0] [0],
				$fechaActual 
		);
		
		
		
		if ($id_orden) {
			
			redireccion::redireccionar ( 'inserto', $datos );
		} else {
			
			redireccion::redireccionar ( 'noInserto', $datos );
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