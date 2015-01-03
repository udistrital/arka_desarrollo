<?php

namespace inventarios\gestionCompras\consultaOrdenServicios\funcion;


use inventarios\gestionCompras\consultaOrdenServicios\funcion;
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
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/blocks/inventarios/gestionCompras/";
		$rutaBloque .='registrarOrdenCompra' ;
		$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/gestionCompras/registrarOrdenCompra/";
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'items', $_REQUEST ['seccion'] );
		$items = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

		
		if ($items == 0) {
			redireccion::redireccionar ( 'noItems' );
		
		}
		if ($_REQUEST ['obligacionesProveedor'] == '') {
			
			redireccion::redireccionar ( 'noObligaciones' );
		}
		
		if ($_REQUEST ['obligacionesContratista'] == '') {
			
			redireccion::redireccionar ( 'noObligaciones' );
		}
		
		if ($_REQUEST ['actualizarCotizacion'] == '1') {
			
			
			// Archivo de Cotizacion
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
					$destino1 = $rutaBloque . "/cotizaciones/" . $prefijo . "_" . $archivo1;
					if (copy ( $archivo ['tmp_name'], $destino1 )) {
						$status = "Archivo subido: <b>" . $archivo1 . "</b>";
						$destino1 = $host . "/cotizaciones/" . $prefijo . "_" . $archivo1;
					} else {
						$status = "Error al subir el archivo";
					}
				} else {
					$status = "Error al subir archivo";
				}
			}
			
	
		} else if ($_REQUEST ['actualizarCotizacion'] == '0') {
			
			$destino1 = $_REQUEST ['directorio'];
			$archivo1 = $_REQUEST ['nombreArchivo'];
		}
		
		
		
		
		if ($_REQUEST ['reg_proveedor'] == 1) {
				
			$datosProveedor = array (
					$_REQUEST ['proveedor'],
					$_REQUEST ['nitProveedor'],
					$_REQUEST ['direccionProveedor'],
					$_REQUEST ['telefonoProveedor']
			);
				
			$cadenaSql = $this->miSql->getCadenaSql ( 'insertarProveedor', $datosProveedor );
			$id_proveedor = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				
			$_REQUEST ['selec_proveedor'] = $id_proveedor[0][0];
			
			
				
				
		}elseif($_REQUEST ['reg_proveedor'] == 0){
				
				
			$_REQUEST ['selec_proveedor']=$_REQUEST ['selec_proveedor'];
				
				
		}
		
		

				// Actualizar Orden
		
		$datosOrden = array (
				$_REQUEST ['diponibilidad'],
				$_REQUEST ['fecha_diponibilidad'],
				$_REQUEST ['rubro'],
				$_REQUEST ['obligacionesProveedor'],
				$_REQUEST ['obligacionesContratista'],
				isset ( $_REQUEST ['polizaA'] ),
				isset ( $_REQUEST ['polizaB'] ),
				isset ( $_REQUEST ['polizaC'] ),
				isset ( $_REQUEST ['polizaD'] ),
				isset ( $_REQUEST ['polizaE'] ),
				$_REQUEST ['lugarEntrega'],
				$_REQUEST ['destino'],
				$_REQUEST ['tiempoEntrega'],
				$_REQUEST ['formaPago'],
				$_REQUEST ['supervision'],
				$_REQUEST ['inhabilidades'],
				$_REQUEST ['selec_proveedor'],
				$destino1,
				$archivo1,
				$_REQUEST ['selec_dependencia'],
				$_REQUEST ['nombreContratista'],
				$_REQUEST ['id_jefe_oculto'],
				$_REQUEST ['id_ordenador_oculto'],
				$_REQUEST ['numero_orden'] 
		);
		
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizarOrden', $datosOrden );
		
		$id_orden = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
				
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'limpiarItems', $_REQUEST ['numero_orden'] );
		
		$limpiar = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		foreach ( $items as $contenido ) {
			
			$datosItems = array (
					$_REQUEST ['numero_orden'],
					$contenido ['item'],
					$contenido ['unidad_medida'],
					$contenido ['cantidad'],
					$contenido ['descripcion'],
					$contenido ['valor_unitario'],
					$contenido ['valor_total'] 
			)
			;
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'insertarItems', $datosItems );
			$items = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		}
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'limpiar_tabla_items', $_REQUEST ['seccion'] );
		$resultado_secuancia = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		$datos = array (
				$_REQUEST ['numero_orden'] 
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

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

?>