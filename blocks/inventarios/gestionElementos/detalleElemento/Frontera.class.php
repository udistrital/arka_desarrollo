<?php

namespace inventarios\gestionElementos\detalleElemento;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}

include_once ("core/manager/Configurador.class.php");

class Frontera {
	var $ruta;
	var $sql;
	var $funcion;
	var $lenguaje;
	var $formulario;
	var $miConfigurador;
	function __construct() {
		$this->miConfigurador = \Configurador::singleton ();
	}
	public function setRuta($unaRuta) {
		$this->ruta = $unaRuta;
	}
	public function setLenguaje($lenguaje) {
		$this->lenguaje = $lenguaje;
	}
	public function setFormulario($formulario) {
		$this->formulario = $formulario;
	}
	public function frontera() {
		$this->html();
	}
	public function setSql($a) {
		$this->sql = $a;
	}
	public function setFuncion($funcion) {
		$this->funcion = $funcion;
	}
	public function html() {
            
      	include_once ("core/builder/FormularioHtml.class.php");
		
		$this->ruta = $this->miConfigurador->getVariableConfiguracion ( "rutaBloque" );
		
		$this->miFormulario = new \FormularioHtml ();
		
		if (isset ( $_REQUEST ['opcion'] )) {
			
			switch ($_REQUEST ['opcion']) {
				
				case "mensaje" :
					include_once ($this->ruta . "/formulario/mensaje.php");
					break;
				
				case "Consultar" :
					include_once ($this->ruta . "/formulario/resultado.php");
					break;
				
				case "detalle" :
                                 
					include_once ($this->ruta . "/formulario/detalle.php");
					break;
				
				case "anular" :
					include_once ($this->ruta . "/formulario/anular.php");
					break;
			}
		} else {
			$_REQUEST ['opcion'] = "mostrar";
			include_once ($this->ruta . "/formulario/consulta.php");
		}
	}
}
?>
