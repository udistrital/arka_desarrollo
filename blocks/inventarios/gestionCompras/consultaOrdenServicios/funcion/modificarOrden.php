<?php

namespace inventarios\gestionCompras\consultaOrdenServicios\funcion;

use inventarios\gestionCompras\consultaOrdenServicios\funcion\redireccion;

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
		
		if ($_REQUEST ['objeto_contrato'] == '') {
		
			redireccion::redireccionar ( 'notextos' );
		}
		
		if ($_REQUEST ['forma_pago'] == '') {
		
			redireccion::redireccionar ( 'notextos' );
		}
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarOrdenServicios', $_REQUEST ['numero_orden'] );
		$orden = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		

		
		$datosSupervisor = array (
				$_REQUEST ['nombre_supervisor'],
				$_REQUEST ['cargo_supervisor'],
				$_REQUEST ['dependencia_supervisor'],
				$orden[0][25] 
		);
		
		// Actualizar Supervisor
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarSupervisor', $datosSupervisor );
		$id_supervisor = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$datosContratistaC = array (
				$_REQUEST ['nombre_razon_contratista'],
				$_REQUEST ['identifcacion_contratista'],
				$_REQUEST ['direccion_contratista'],
				$_REQUEST ['telefono_contratista'],
				$_REQUEST ['cargo_contratista'],
				$orden[0][21]
		);
		
		// Actualizar Contratista
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarContratista', $datosContratistaC );
		$id_ContratistaC = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		
// var_dump($_REQUEST);
			// Actualizar Orden
		
		$datosOrden = array (
				$_REQUEST['dependencia_solicitante'],
				$_REQUEST['rubro'],				
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
				$_REQUEST['id_ordenador'],
				$_REQUEST['id_jefe'],
				$_REQUEST['nombreContratista'],
				$_REQUEST['numero_orden']
		);
		
	
// var_dump($datosOrden);
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarOrden', $datosOrden );

  
		$id_orden = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
// 		exit;		

		$datos = array (
				$_REQUEST ['numero_orden'] 
		);
		
		if ($id_orden == 1) {
			
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