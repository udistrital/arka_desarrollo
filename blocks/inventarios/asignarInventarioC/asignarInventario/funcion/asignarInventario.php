<?php

namespace inventarios\asignarInventarioC\asignarInventario\funcion;

use inventarios\asignarInventarioC\asignarInventario\funcion\redireccion;

include_once ('redireccionar.php');
if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class RegistradorActa {
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
		
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/blocks/inventarios/gestionActa/";
		$rutaBloque .= $esteBloque ['nombre'];
		$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/gestionActa/" . $esteBloque ['nombre'];
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
                
                
//                 $numeroaux=7;
//           $cadenaSql2 = $this->miSql->getCadenaSql('estadoPazSalvo2',$numeroaux);
//                $estado_pz = $esteRecursoDB->ejecutarAcceso($cadenaSql2, "acceso", "estadoPazSalvo");
//                var_dump($estado_pz);
//                $numeroaux=$numeroaux+1;
//                 $cadenaSql2 = $this->miSql->getCadenaSql('estadoPazSalvo2',$numeroaux);
//                $estado_pz = $esteRecursoDB->ejecutarAcceso($cadenaSql2, "acceso", "estadoPazSalvo");
//                var_dump($estado_pz);
//                exit;
		
		// recuperar datos de la asignacion
		$datos = array (
				$_REQUEST ['contratista'],
				$_REQUEST ['supervisor'],
				$_REQUEST ['usuario'] 
		);
		// asociar super-cont-item
		
		for($i = 0; $i <= 1000000; $i ++) {
			if (isset ( $_REQUEST ['item' . $i] )) {
				$items [] = $_REQUEST ['item' . $i];
			}
		}
		;
		$_REQUEST ['supervisor']=str_replace("CC", "",$_REQUEST ['supervisor']);
		foreach ( $items as $key => $values ) {
                        
			$datosAsignacion = array (
					$_REQUEST ['contratista'],
					$_REQUEST ['supervisor'],
					$items [$key],
					1,
					$fechaActual,
					'CPS',
					'null',
					date('Y'),
                                        $_REQUEST ['nombreContratista'],
			)
			;
			
			$datosInactivar = array (
					$items [$key],
					TRUE,
					$fechaActual 
			);
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'asignarElemento', $datosAsignacion );
			$asignar = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso", $datosAsignacion, "asignarElemento" );
			
			$cadenaSql2 = $this->miSql->getCadenaSql ( 'inactivarElemento', $datosInactivar );
			
			$inactivar = $esteRecursoDB->ejecutarAcceso ( $cadenaSql2, "acceso", $datosInactivar, "inactivarElemento" );
                        
                       
		}
                
                $datosPaz = array (
					$_REQUEST ['contratista'],
					0,
					$fechaActual
			)
			;
//                
//                 $cadenaSql2 = $this->miSql->getCadenaSql ( 'actualizarPazSalvo', $datosPaz );			
//		 $inactivarPaz = $esteRecursoDB->ejecutarAcceso ( $cadenaSql2, "acceso");
//                 exit;
		// inactivar item para asignar
		if ($inactivar == true && $asignar == true) {
			redireccion::redireccionar ( 'inserto', $datos );
			exit ();
		} else {
			redireccion::redireccionar ( 'noInserto', $_REQUEST ['usuario'] );
			exit ();
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

$miRegistrador = new RegistradorActa ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();
?>