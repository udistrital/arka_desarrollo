<?php
if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class registrarForm {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miSql;
	function __construct($lenguaje, $formulario) {
		$this->miConfigurador = \Configurador::singleton ();
		
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		
		$this->lenguaje = $lenguaje;
		
		$this->miFormulario = $formulario;
	}
	function miForm() {
		// Rescatar los datos de este bloque
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		// ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
		/**
		 * Atributos que deben ser aplicados a todos los controles de este formulario.
		 * Se utiliza un arreglo
		 * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
		 *
		 * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
		 * $atributos= array_merge($atributos,$atributosGlobales);
		 */
		
		$atributosGlobales ['campoSeguro'] = 'true';
		
		$_REQUEST ['tiempo'] = time ();
		$tiempo = $_REQUEST ['tiempo'];
		
		// ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
		$esteCampo = $esteBloque ['nombre'];
		$atributos ['id'] = $esteCampo;
		$atributos ['nombre'] = $esteCampo;
		// Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
		$atributos ['tipoFormulario'] = 'multipart/form-data';
		// Si no se coloca, entonces toma el valor predeterminado 'POST'
		$atributos ['metodo'] = 'POST';
		// Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
		$atributos ['action'] = 'index.php';
		// $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
		// Si no se coloca, entonces toma el valor predeterminado.
		$atributos ['estilo'] = '';
		$atributos ['marco'] = false;
		$tab = 1;
		// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
		
		// ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
		$atributos ['tipoEtiqueta'] = 'inicio';
		echo $this->miFormulario->formulario ( $atributos );
		{
			// ---------------- SECCION: Controles del Formulario -----------------------------------------------
			
			$esteCampo = "marcoDatosBasicos";
			$atributos ['id'] = $esteCampo;
			$atributos ["estilo"] = "jqueryui";
			$atributos ['tipoEtiqueta'] = 'inicio';
			echo $this->miFormulario->marcoAgrupacion ( 'inicio', $atributos );
			unset ( $atributos );
			{
				
				$tab = 1;
				// ------------------Division-------------------------
				
				$atributos ["id"] = "footerLeft";
				$atributos ["estilo"] = "textoIzquierda";
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					
					$esteCampo = 'mensajePie';
					$atributos ["id"] = $esteCampo;
					$atributos ["estilo"] = $esteCampo;
					$atributos ['columnas'] = 2;
					$atributos ["estilo"] = "textoSubtituloCursiva";
					$atributos ['texto'] = $this->lenguaje->getCadena ( $esteCampo );
					$tab ++;
					echo $this->miFormulario->campoTexto ( $atributos );
					unset ( $atributos );
				}
				
				echo $this->miFormulario->division ( "fin" );
				
				$atributos ["id"] = "footerRight";
				$atributos ["estilo"] = "textoIzquierda";
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					

// 					$esteCampo = 'mensajePie';
// 					$atributos ["id"] = $esteCampo;
// 					$atributos ["estilo"] = $esteCampo;
// 					$atributos ['columnas'] = 1;
// 					$atributos ["estilo"] = "textoSubtituloCursiva";
// 					$atributos ['texto'] = $this->lenguaje->getCadena ( $esteCampo );
// 					$tab ++;
// 					echo $this->miFormulario->campoTexto ( $atributos );
// 					unset ( $atributos );
					
					// ------------------- Inicio División -------------------------------
					$esteCampo = 'divLogoNotificador';
					$atributos ['id'] = $esteCampo;
					$atributos ['imagen'] = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' ) . 'imagen/escudo.jpg';
					$atributos ["estilo"] = "jquery";
					$atributos ['ancho'] = '10%';
					$atributos ['alto'] = '2%';
					$atributos ['columnas'] = 1;
					$tab ++;
					echo $this->miFormulario->campoImagen ( $atributos );
					unset ( $atributos );
				}
				
				echo $this->miFormulario->division ( "fin" );
			}
			
			echo $this->miFormulario->agrupacion ( 'fin' );
		}
		
		$atributos ['marco'] = true;
		$atributos ['tipoEtiqueta'] = 'fin';
		echo $this->miFormulario->formulario ( $atributos );
		
		return true;
	}
}
$miSeleccionador = new registrarForm ( $this->lenguaje, $this->miFormulario );

$miSeleccionador->miForm ();
?>



