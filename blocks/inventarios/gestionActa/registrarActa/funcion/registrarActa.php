<?php

namespace inventarios\gestionActa\registrarActa\funcion;

use inventarios\gestionActa\registrarActa\funcion\redireccion;

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
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'items', $_REQUEST ['seccion'] );
		$items = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		if ($items == 0) {
			echo "noitems";
			exit ();
			redireccion::redireccionar ( 'noItems' );
		}
		
		foreach ( $_FILES as $key => $values ) {
			
			$archivo = $_FILES [$key];
		}
		
		if ($archivo) {
			// obtenemos los datos del archivo
			$tamano = $archivo ['size'];
			$tipo = $archivo ['type'];
			$archivo1 = $archivo ['name'];
			$prefijo = substr ( md5 ( uniqid ( rand () ) ), 0, 6 );
			
			if ($archivo1 != "") {
				// guardamos el archivo a la carpeta files
				$destino1 = $rutaBloque . "/soportes/" . $prefijo . "_" . $archivo1;
				if (copy ( $archivo ['tmp_name'], $destino1 )) {
					$status = "Archivo subido: <b>" . $archivo1 . "</b>";
					$destino1 = $host . "/soportes/" . $prefijo . "_" . $archivo1;
				} else {
					$status = "Error al subir el archivo";
				}
			} else {
				$status = "Error al subir archivo";
			}
		}
		
		if ($_REQUEST ['tipoOrden']) {
			
			switch ($_REQUEST ['tipoOrden']) {
				
				case "Orden de Servicios" :
					$tipoOrden = 1;
					break;
				
				case "Orden de Compra" :
					$tipoOrden = 2;
					break;
			}
		} else {
			$tipoOrden = 0;
		}
		
		// Registro del Acta de Recibido
		
		$datosActa = array (
				'sede' => $_REQUEST ['sede'],
				'dependencia' => $_REQUEST ['dependencia'],
				'fecha_registro' => $fechaActual,
				'tipo_bien' => $_REQUEST ['tipoBien'],
				'nitproveedor' => $_REQUEST ['nitproveedor'],
				'ordenador' => $_REQUEST ['id_ordenador'],
				'fecha_revision' => $_REQUEST ['fecha_revision'],
				'revisor' => $_REQUEST ['revisor'],
				'observacion' => $_REQUEST ['observacionesActa'],
				'estado' => 1,
				'tipo_orden' => $tipoOrden,
				'numero_orden' => $_REQUEST ['numero_orden'],
				'enlace_soporte' => $destino1,
				'nombre_soporte' => $archivo1 
		);
		
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertarActa', $datosActa );
		$id_acta = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		// Registro de Items
		foreach ( $items as $contenido ) {
			
			$datosItems = array (
					$id_acta [0] [0],
					$contenido ['item'],
					$contenido ['descripcion'],
					$contenido ['cantidad'],
					$contenido ['valor_unitario'],
					$contenido ['valor_total'] 
			);
			
		
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'insertarItems', $datosItems );
		
			$items = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		}
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'limpiar_tabla_items', $_REQUEST ['seccion'] );
		$resultado_secuencia = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
	
		$datos = array (
				$id_acta [0] [0],
				$fechaActual 
		);
		
		
		if ($items == 1) {
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

$miRegistrador = new RegistradorActa ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();
?>