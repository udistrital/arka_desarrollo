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
	function __construct($lenguaje, $formulario, $sql) {
		$this->miConfigurador = \Configurador::singleton ();
		
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		
		$this->lenguaje = $lenguaje;
		
		$this->miFormulario = $formulario;
		
		$this->miSql = $sql;
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
		
		// lineas para conectar base de d atos-------------------------------------------------------------------------------------------------
		$conexion = "inventarios";
		
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarEntradaParticular', $_REQUEST ['numero_entrada'] );
		
		$datosEntrada = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		
		$datos = array (
				'clase' => $datosEntrada [0] [1],
				'observaciones_entrada' => $datosEntrada [0] [10] 
		);
		
		$_REQUEST = array_merge ( $_REQUEST, $datosEntrada [0], $datos );
		
		switch ($_REQUEST ['clase']) {
			case '1' :
				$valor1 = 'block';
				$valor2 = 'none';
				$valor3 = 'none';
				$valor4 = 'none';
				$valor5 = 'none';
				$cadenaSql = $this->miSql->getCadenaSql ( 'consultarReposicion', $datosEntrada [0] [2] );
				$reposicion = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				
				$reposicion = array (
						'id_entradaR' => $reposicion [0] [0],
						'id_hurto' => $reposicion [0] [1],
						'id_salida' => $reposicion [0] [2] 
				);
				
				$_REQUEST = array_merge ( $_REQUEST, $reposicion );
				break;
			
			case '2' :
				$valor1 = 'none';
				$valor2 = 'block';
				$valor3 = 'none';
				$valor4 = 'none';
				$valor5 = 'none';
				$cadenaSql = $this->miSql->getCadenaSql ( 'consultarDonacion', $datosEntrada [0] [2] );
				$donacion = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				$donacion = array (
						'nombreActa' => $donacion [0] [1] 
				);
				$_REQUEST = array_merge ( $_REQUEST, $donacion );
				break;
			case '3' :
				$valor1 = 'none';
				$valor2 = 'none';
				$valor3 = 'block';
				$valor4 = 'none';
				$valor5 = 'none';
				$cadenaSql = $this->miSql->getCadenaSql ( 'consultarSobrante', $datosEntrada [0] [2] );
				$sobrante = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				
				$sobrante = array (
						'observaciones_sobrante' => $sobrante [0] [0],
						'nombreSobrante' => $sobrante [0] [1] 
				);
				$_REQUEST = array_merge ( $_REQUEST, $sobrante );
				break;
			case '4' :
				
				$valor1 = 'none';
				$valor2 = 'none';
				$valor3 = 'none';
				$valor4 = 'block';
				$valor5 = 'none';
				$cadenaSql = $this->miSql->getCadenaSql ( 'consultarProduccion', $datosEntrada [0] [2] );
				$produccion = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				
				$produccion = array (
						'observaciones_produccion' => $produccion [0] [0],
						'nombreProduccion' => $produccion [0] [1] 
				);
				$_REQUEST = array_merge ( $_REQUEST, $produccion );
				
				break;
			case '5' :
				
				$valor1 = 'none';
				$valor2 = 'none';
				$valor3 = 'none';
				$valor4 = 'none';
				$valor5 = 'block';
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'consultarRecuperacion', $datosEntrada [0] [2] );
				$recuperacion = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				
				$recuperacion = array (
						'observaciones_recuperacion' => $recuperacion [0] [0],
						'nombreRecuperacion' => $recuperacion [0] [1] 
				);
				$_REQUEST = array_merge ( $_REQUEST, $recuperacion );
				
				break;
		}
		
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
			$atributos ["leyenda"] = "Modificar Entrada";
			echo $this->miFormulario->marcoAgrupacion ( 'inicio', $atributos );
			unset ( $atributos );
			{
				
				$esteCampo = 'vigencia';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'jqueryui';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['columnas'] = 1;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['validar'] = 'required, minSize[4],maxSize[4],custom[onlyNumberSp]';
				
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
				$atributos ['deshabilitado'] = false;
				$atributos ['tamanno'] = 3;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 220;
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroTexto ( $atributos );
				unset ( $atributos );
				
				$esteCampo = "clase";
				$atributos ['nombre'] = $esteCampo;
				$atributos ['id'] = $esteCampo;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['tab'] = $tab ++;
				$atributos ['anchoEtiqueta'] = 213;
				$atributos ['evento'] = '';
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['seleccion'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['seleccion'] = '';
				}
				$atributos ['deshabilitado'] = false;
				$atributos ['columnas'] = "1";
				$atributos ['tamanno'] = 1;
				$atributos ['ajax_function'] = "";
				$atributos ['ajax_control'] = $esteCampo;
				$atributos ['estilo'] = "jqueryui";
				$atributos ['validar'] = "required";
				$atributos ['limitar'] = false;
				$atributos ['miEvento'] = '';
				$atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
				$matrizItems = $esteRecursoDB->ejecutarAcceso ( $atributos ['cadena_sql'], "busqueda" );
				$atributos ['matrizItems'] = $matrizItems;
				// $atributos['miniRegistro']=;
				$atributos ['baseDatos'] = "inventarios";
				// $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroLista ( $atributos );
				unset ( $atributos );
				
				$atributos ["id"] = "reposicion";
				$atributos ["estiloEnLinea"] = "display:" . $valor1;
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					
					$esteCampo = "AgrupacionReposicion";
					$atributos ['id'] = $esteCampo;
					$atributos ['leyenda'] = "Información Reposición";
					echo $this->miFormulario->agrupacion ( 'inicio', $atributos );
					{
						
						$esteCampo = 'id_entradaR';
						$atributos ['id'] = $esteCampo;
						$atributos ['nombre'] = $esteCampo;
						$atributos ['tipo'] = 'text';
						$atributos ['estilo'] = 'jqueryui';
						$atributos ['marco'] = true;
						$atributos ['estiloMarco'] = '';
						$atributos ["etiquetaObligatorio"] = true;
						$atributos ['columnas'] = 1;
						$atributos ['dobleLinea'] = 0;
						$atributos ['tabIndex'] = $tab;
						$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						$atributos ['validar'] = 'required, minSize[1],maxSize[30],custom[onlyNumberSp]';
						
						if (isset ( $_REQUEST [$esteCampo] )) {
							$atributos ['valor'] = $_REQUEST [$esteCampo];
						} else {
							$atributos ['valor'] = '';
						}
						$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
						$atributos ['deshabilitado'] = false;
						$atributos ['tamanno'] = 10;
						$atributos ['maximoTamanno'] = '';
						$atributos ['anchoEtiqueta'] = 220;
						$tab ++;
						
						// Aplica atributos globales al control
						$atributos = array_merge ( $atributos, $atributosGlobales );
						echo $this->miFormulario->campoCuadroTexto ( $atributos );
						unset ( $atributos );
						
						$esteCampo = 'id_salida';
						$atributos ['id'] = $esteCampo;
						$atributos ['nombre'] = $esteCampo;
						$atributos ['tipo'] = 'text';
						$atributos ['estilo'] = 'jqueryui';
						$atributos ['marco'] = true;
						$atributos ['estiloMarco'] = '';
						$atributos ["etiquetaObligatorio"] = true;
						$atributos ['columnas'] = 1;
						$atributos ['dobleLinea'] = 0;
						$atributos ['tabIndex'] = $tab;
						$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						$atributos ['validar'] = 'required, minSize[1],maxSize[30],custom[onlyNumberSp]';
						
						if (isset ( $_REQUEST [$esteCampo] )) {
							$atributos ['valor'] = $_REQUEST [$esteCampo];
						} else {
							$atributos ['valor'] = '';
						}
						$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
						$atributos ['deshabilitado'] = false;
						$atributos ['tamanno'] = 10;
						$atributos ['maximoTamanno'] = '';
						$atributos ['anchoEtiqueta'] = 220;
						$tab ++;
						
						// Aplica atributos globales al control
						$atributos = array_merge ( $atributos, $atributosGlobales );
						echo $this->miFormulario->campoCuadroTexto ( $atributos );
						unset ( $atributos );
						
						$esteCampo = 'id_hurto';
						$atributos ['id'] = $esteCampo;
						$atributos ['nombre'] = $esteCampo;
						$atributos ['tipo'] = 'text';
						$atributos ['estilo'] = 'jqueryui';
						$atributos ['marco'] = true;
						$atributos ['estiloMarco'] = '';
						$atributos ["etiquetaObligatorio"] = true;
						$atributos ['columnas'] = 1;
						$atributos ['dobleLinea'] = 0;
						$atributos ['tabIndex'] = $tab;
						$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						$atributos ['validar'] = 'required, minSize[1],maxSize[30],custom[onlyNumberSp]';
						
						if (isset ( $_REQUEST [$esteCampo] )) {
							$atributos ['valor'] = $_REQUEST [$esteCampo];
						} else {
							$atributos ['valor'] = '';
						}
						$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
						$atributos ['deshabilitado'] = false;
						$atributos ['tamanno'] = 10;
						$atributos ['maximoTamanno'] = '';
						$atributos ['anchoEtiqueta'] = 220;
						$tab ++;
						
						// Aplica atributos globales al control
						$atributos = array_merge ( $atributos, $atributosGlobales );
						echo $this->miFormulario->campoCuadroTexto ( $atributos );
						unset ( $atributos );
					}
					echo $this->miFormulario->agrupacion ( 'fin' );
				}
				echo $this->miFormulario->division ( "fin" );
				
				$atributos ["id"] = "donacion";
				$atributos ["estiloEnLinea"] = "display:" . $valor2;
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					
					$esteCampo = "AgrupacionDonacion";
					$atributos ['id'] = $esteCampo;
					$atributos ['leyenda'] = "Información Donación";
					echo $this->miFormulario->agrupacion ( 'inicio', $atributos );
					{
						
						if ($_REQUEST ['clase'] == 2) {
							
							// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
							$esteCampo = 'nombreActa';
							$atributos ['id'] = $esteCampo;
							$atributos ['nombre'] = $esteCampo;
							$atributos ['tipo'] = 'text';
							$atributos ['estilo'] = 'jqueryui';
							$atributos ['marco'] = true;
							$atributos ['estiloMarco'] = '';
							$atributos ["etiquetaObligatorio"] = false;
							$atributos ['columnas'] = 1;
							$atributos ['dobleLinea'] = 0;
							$atributos ['tabIndex'] = $tab;
							$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
							$atributos ['validar'] = '';
							
							if (isset ( $_REQUEST [$esteCampo] )) {
								$atributos ['valor'] = $_REQUEST [$esteCampo];
							} else {
								$atributos ['valor'] = '';
							}
							
							$atributos ['deshabilitado'] = false;
							$atributos ['tamanno'] = 30;
							$atributos ['maximoTamanno'] = '';
							$atributos ['anchoEtiqueta'] = 220;
							$tab ++;
							
							// Aplica atributos globales al control
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->campoCuadroTexto ( $atributos );
							unset ( $atributos );
							
							// ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
							
							$esteCampo = 'actualizarActa';
							$atributos ['columnas'] = 1;
							$atributos ['nombre'] = $esteCampo;
							$atributos ['id'] = $esteCampo;
							$atributos ['seleccion'] = 0;
							$atributos ['evento'] = '';
							$atributos ['deshabilitado'] = false;
							$atributos ['tab'] = $tab;
							$atributos ['tamanno'] = 1;
							$atributos ['estilo'] = 'jqueryui';
							$atributos ['validar'] = '';
							$atributos ['limitar'] = true;
							$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
							$atributos ['anchoEtiqueta'] = 213;
							// Valores a mostrar en el control
							$matrizItems = array (
									array (
											0,
											'NO' 
									),
									array (
											1,
											'SI' 
									) 
							);
							
							$atributos ['matrizItems'] = $matrizItems;
							
							// Utilizar lo siguiente cuando no se pase un arreglo:
							// $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
							// $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
							$tab ++;
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->campoCuadroLista ( $atributos );
							unset ( $atributos );
							
							$atributos ["id"] = "cargaActo";
							$atributos ["estiloEnLinea"] = "display:none";
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->division ( "inicio", $atributos );
							unset ( $atributos );
							{
								// ------------------Division para los botones-------------------------
								$atributos ["id"] = "botones";
								$atributos ["estilo"] = "marcoBotones";
								echo $this->miFormulario->division ( "inicio", $atributos );
								
								{
									$esteCampo = "actoAdministrativo";
									$atributos ["id"] = $esteCampo; // No cambiar este nombre
									$atributos ["nombre"] = $esteCampo;
									$atributos ["tipo"] = "file";
									$atributos ["obligatorio"] = true;
									$atributos ["etiquetaObligatorio"] = true;
									$atributos ["tabIndex"] = $tab ++;
									$atributos ["columnas"] = 1;
									$atributos ["estilo"] = "textoIzquierda";
									$atributos ["anchoEtiqueta"] = 190;
									$atributos ["tamanno"] = 500000;
									$atributos ["validar"] = "required";
									$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
									// $atributos ["valor"] = $valorCodificado;
									$atributos = array_merge ( $atributos, $atributosGlobales );
									echo $this->miFormulario->campoCuadroTexto ( $atributos );
									unset ( $atributos );
								}
								echo $this->miFormulario->division ( "fin" );
							}
						} else {
							
							// ------------------Division para los botones-------------------------
							$atributos ["id"] = "botones";
							$atributos ["estilo"] = "marcoBotones";
							echo $this->miFormulario->division ( "inicio", $atributos );
							
							{
								$esteCampo = "actoAdministrativo";
								$atributos ["id"] = $esteCampo; // No cambiar este nombre
								$atributos ["nombre"] = $esteCampo;
								$atributos ["tipo"] = "file";
								$atributos ["obligatorio"] = true;
								$atributos ["etiquetaObligatorio"] = true;
								$atributos ["tabIndex"] = $tab ++;
								$atributos ["columnas"] = 1;
								$atributos ["estilo"] = "textoIzquierda";
								$atributos ["anchoEtiqueta"] = 190;
								$atributos ["tamanno"] = 500000;
								$atributos ["validar"] = "required";
								$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
								// $atributos ["valor"] = $valorCodificado;
								$atributos = array_merge ( $atributos, $atributosGlobales );
								echo $this->miFormulario->campoCuadroTexto ( $atributos );
								unset ( $atributos );
							}
							echo $this->miFormulario->division ( "fin" );
						}
					}
					echo $this->miFormulario->agrupacion ( 'fin' );
				}
				echo $this->miFormulario->division ( "fin" );
				
				$atributos ["id"] = "sobrante";
				$atributos ["estiloEnLinea"] = "display:" . $valor3;
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					
					$esteCampo = "AgrupacionSobrante";
					$atributos ['id'] = $esteCampo;
					$atributos ['leyenda'] = "Información Sobrante";
					echo $this->miFormulario->agrupacion ( 'inicio', $atributos );
					{
						
						// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
						$esteCampo = 'observaciones_sobrante';
						$atributos ['id'] = $esteCampo;
						$atributos ['nombre'] = $esteCampo;
						$atributos ['tipo'] = 'text';
						$atributos ['estilo'] = 'jqueryui';
						$atributos ['marco'] = true;
						$atributos ['estiloMarco'] = '';
						$atributos ["etiquetaObligatorio"] = true;
						$atributos ['columnas'] = 105;
						$atributos ['filas'] = 5;
						$atributos ['dobleLinea'] = 0;
						$atributos ['tabIndex'] = $tab;
						$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						$atributos ['validar'] = 'required, minSize[1]';
						$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
						$atributos ['deshabilitado'] = false;
						$atributos ['tamanno'] = 20;
						$atributos ['maximoTamanno'] = '';
						$atributos ['anchoEtiqueta'] = 220;
						if (isset ( $_REQUEST [$esteCampo] )) {
							$atributos ['valor'] = $_REQUEST [$esteCampo];
						} else {
							$atributos ['valor'] = '';
						}
						$tab ++;
						
						// Aplica atributos globales al control
						$atributos = array_merge ( $atributos, $atributosGlobales );
						echo $this->miFormulario->campoTextArea ( $atributos );
						unset ( $atributos );
						
						
						if ($_REQUEST['clase']==3){
							
							// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
							$esteCampo = 'nombreSobrante';
							$atributos ['id'] = $esteCampo;
							$atributos ['nombre'] = $esteCampo;
							$atributos ['tipo'] = 'text';
							$atributos ['estilo'] = 'jqueryui';
							$atributos ['marco'] = true;
							$atributos ['estiloMarco'] = '';
							$atributos ["etiquetaObligatorio"] = false;
							$atributos ['columnas'] = 1;
							$atributos ['dobleLinea'] = 0;
							$atributos ['tabIndex'] = $tab;
							$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
							$atributos ['validar'] = '';
							
							if (isset ( $_REQUEST [$esteCampo] )) {
								$atributos ['valor'] = $_REQUEST [$esteCampo];
							} else {
								$atributos ['valor'] = '';
							}
							
							$atributos ['deshabilitado'] = false;
							$atributos ['tamanno'] = 30;
							$atributos ['maximoTamanno'] = '';
							$atributos ['anchoEtiqueta'] = 220;
							$tab ++;
							
							// Aplica atributos globales al control
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->campoCuadroTexto ( $atributos );
							unset ( $atributos );
							
							// ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
							
							$esteCampo = 'actualizarActaS';
							$atributos ['columnas'] = 1;
							$atributos ['nombre'] = $esteCampo;
							$atributos ['id'] = $esteCampo;
							$atributos ['seleccion'] = 0;
							$atributos ['evento'] = '';
							$atributos ['deshabilitado'] = false;
							$atributos ['tab'] = $tab;
							$atributos ['tamanno'] = 1;
							$atributos ['estilo'] = 'jqueryui';
							$atributos ['validar'] = '';
							$atributos ['limitar'] = true;
							$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
							$atributos ['anchoEtiqueta'] = 213;
							// Valores a mostrar en el control
							$matrizItems = array (
									array (
											0,
											'NO'
									),
									array (
											1,
											'SI'
									)
							);
							
							$atributos ['matrizItems'] = $matrizItems;
							
							// Utilizar lo siguiente cuando no se pase un arreglo:
							// $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
							// $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
							$tab ++;
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->campoCuadroLista ( $atributos );
							unset ( $atributos );
							
							$atributos ["id"] = "cargaActoS";
							$atributos ["estiloEnLinea"] = "display:none";
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->division ( "inicio", $atributos );
							unset ( $atributos );
							{
								// ------------------Division para los botones-------------------------
								$atributos ["id"] = "botones";
								$atributos ["estilo"] = "marcoBotones";
								echo $this->miFormulario->division ( "inicio", $atributos );
									
								{
									$esteCampo = "acta_sobrante";
									$atributos ["id"] = $esteCampo; // No cambiar este nombre
									$atributos ["nombre"] = $esteCampo;
									$atributos ["tipo"] = "file";
									$atributos ["obligatorio"] = true;
									$atributos ["etiquetaObligatorio"] = true;
									$atributos ["tabIndex"] = $tab ++;
									$atributos ["columnas"] = 1;
									$atributos ["estilo"] = "textoIzquierda";
									$atributos ["anchoEtiqueta"] = 190;
									$atributos ["tamanno"] = 500000;
									$atributos ["validar"] = "required";
									$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
									// $atributos ["valor"] = $valorCodificado;
									$atributos = array_merge ( $atributos, $atributosGlobales );
									echo $this->miFormulario->campoCuadroTexto ( $atributos );
									unset ( $atributos );
								}
								echo $this->miFormulario->division ( "fin" );
							}
							
							
							
						}else{
							
							// ------------------Division para los botones-------------------------
							$atributos ["id"] = "botones";
							$atributos ["estilo"] = "marcoBotones";
							echo $this->miFormulario->division ( "inicio", $atributos );
								
							{
								$esteCampo = "acta_sobrante";
								$atributos ["id"] = $esteCampo; // No cambiar este nombre
								$atributos ["nombre"] = $esteCampo;
								$atributos ["tipo"] = "file";
								$atributos ["obligatorio"] = true;
								$atributos ["etiquetaObligatorio"] = true;
								$atributos ["tabIndex"] = $tab ++;
								$atributos ["columnas"] = 1;
								$atributos ["estilo"] = "textoIzquierda";
								$atributos ["anchoEtiqueta"] = 190;
								$atributos ["tamanno"] = 500000;
								$atributos ["validar"] = "required";
								$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
								// $atributos ["valor"] = $valorCodificado;
								$atributos = array_merge ( $atributos, $atributosGlobales );
								echo $this->miFormulario->campoCuadroTexto ( $atributos );
								unset ( $atributos );
							}
							echo $this->miFormulario->division ( "fin" );
							
						}
						
						
					}
					echo $this->miFormulario->agrupacion ( 'fin' );
				}
				echo $this->miFormulario->division ( "fin" );
				
				$atributos ["id"] = "produccion";
				$atributos ["estiloEnLinea"] = "display:" . $valor4;
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					
					$esteCampo = "AgrupacionSobrante";
					$atributos ['id'] = $esteCampo;
					$atributos ['leyenda'] = "Información Producción Propia";
					echo $this->miFormulario->agrupacion ( 'inicio', $atributos );
					{
						
						// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
						$esteCampo = 'observaciones_produccion';
						$atributos ['id'] = $esteCampo;
						$atributos ['nombre'] = $esteCampo;
						$atributos ['tipo'] = 'text';
						$atributos ['estilo'] = 'jqueryui';
						$atributos ['marco'] = true;
						$atributos ['estiloMarco'] = '';
						$atributos ["etiquetaObligatorio"] = true;
						$atributos ['columnas'] = 105;
						$atributos ['filas'] = 5;
						$atributos ['dobleLinea'] = 0;
						$atributos ['tabIndex'] = $tab;
						$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						$atributos ['validar'] = 'required, minSize[1]';
						$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
						$atributos ['deshabilitado'] = false;
						$atributos ['tamanno'] = 20;
						$atributos ['maximoTamanno'] = '';
						$atributos ['anchoEtiqueta'] = 220;
						if (isset ( $_REQUEST [$esteCampo] )) {
							$atributos ['valor'] = $_REQUEST [$esteCampo];
						} else {
							$atributos ['valor'] = '';
						}
						$tab ++;
						
						// Aplica atributos globales al control
						$atributos = array_merge ( $atributos, $atributosGlobales );
						echo $this->miFormulario->campoTextArea ( $atributos );
						unset ( $atributos );
						
						
						if($_REQUEST['clase']==4){
							

							// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
							$esteCampo = 'nombreProduccion';
							$atributos ['id'] = $esteCampo;
							$atributos ['nombre'] = $esteCampo;
							$atributos ['tipo'] = 'text';
							$atributos ['estilo'] = 'jqueryui';
							$atributos ['marco'] = true;
							$atributos ['estiloMarco'] = '';
							$atributos ["etiquetaObligatorio"] = false;
							$atributos ['columnas'] = 1;
							$atributos ['dobleLinea'] = 0;
							$atributos ['tabIndex'] = $tab;
							$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
							$atributos ['validar'] = '';
							
							if (isset ( $_REQUEST [$esteCampo] )) {
								$atributos ['valor'] = $_REQUEST [$esteCampo];
							} else {
								$atributos ['valor'] = '';
							}
							
							$atributos ['deshabilitado'] = false;
							$atributos ['tamanno'] = 30;
							$atributos ['maximoTamanno'] = '';
							$atributos ['anchoEtiqueta'] = 220;
							$tab ++;
							
							// Aplica atributos globales al control
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->campoCuadroTexto ( $atributos );
							unset ( $atributos );
							
							// ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
							
							$esteCampo = 'actualizarActaP';
							$atributos ['columnas'] = 1;
							$atributos ['nombre'] = $esteCampo;
							$atributos ['id'] = $esteCampo;
							$atributos ['seleccion'] = 0;
							$atributos ['evento'] = '';
							$atributos ['deshabilitado'] = false;
							$atributos ['tab'] = $tab;
							$atributos ['tamanno'] = 1;
							$atributos ['estilo'] = 'jqueryui';
							$atributos ['validar'] = '';
							$atributos ['limitar'] = true;
							$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
							$atributos ['anchoEtiqueta'] = 213;
							// Valores a mostrar en el control
							$matrizItems = array (
									array (
											0,
											'NO'
									),
									array (
											1,
											'SI'
									)
							);
							
							$atributos ['matrizItems'] = $matrizItems;
							
							// Utilizar lo siguiente cuando no se pase un arreglo:
							// $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
							// $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
							$tab ++;
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->campoCuadroLista ( $atributos );
							unset ( $atributos );
							
							$atributos ["id"] = "cargaActoP";
							$atributos ["estiloEnLinea"] = "display:none";
							$atributos = array_merge ( $atributos, $atributosGlobales );
							echo $this->miFormulario->division ( "inicio", $atributos );
							unset ( $atributos );
							{
								// ------------------Division para los botones-------------------------
								// ------------------Division para los botones-------------------------
								$atributos ["id"] = "botones";
								$atributos ["estilo"] = "marcoBotones";
								echo $this->miFormulario->division ( "inicio", $atributos );
									
								{
									$esteCampo = "acta_produccion";
									$atributos ["id"] = $esteCampo; // No cambiar este nombre
									$atributos ["nombre"] = $esteCampo;
									$atributos ["tipo"] = "file";
									$atributos ["obligatorio"] = true;
									$atributos ["etiquetaObligatorio"] = true;
									$atributos ["tabIndex"] = $tab ++;
									$atributos ["columnas"] = 1;
									$atributos ["estilo"] = "textoIzquierda";
									$atributos ["anchoEtiqueta"] = 190;
									$atributos ["tamanno"] = 500000;
									$atributos ["validar"] = "required";
									$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
									// $atributos ["valor"] = $valorCodificado;
									$atributos = array_merge ( $atributos, $atributosGlobales );
									echo $this->miFormulario->campoCuadroTexto ( $atributos );
									unset ( $atributos );
								}
								echo $this->miFormulario->division ( "fin" );
							}
							
							
						}else{
							
							// ------------------Division para los botones-------------------------
							$atributos ["id"] = "botones";
							$atributos ["estilo"] = "marcoBotones";
							echo $this->miFormulario->division ( "inicio", $atributos );
								
							{
								$esteCampo = "acta_produccion";
								$atributos ["id"] = $esteCampo; // No cambiar este nombre
								$atributos ["nombre"] = $esteCampo;
								$atributos ["tipo"] = "file";
								$atributos ["obligatorio"] = true;
								$atributos ["etiquetaObligatorio"] = true;
								$atributos ["tabIndex"] = $tab ++;
								$atributos ["columnas"] = 1;
								$atributos ["estilo"] = "textoIzquierda";
								$atributos ["anchoEtiqueta"] = 190;
								$atributos ["tamanno"] = 500000;
								$atributos ["validar"] = "required";
								$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
								// $atributos ["valor"] = $valorCodificado;
								$atributos = array_merge ( $atributos, $atributosGlobales );
								echo $this->miFormulario->campoCuadroTexto ( $atributos );
								unset ( $atributos );
							}
							echo $this->miFormulario->division ( "fin" );
							
							
							
						}
						
					
					}
					echo $this->miFormulario->agrupacion ( 'fin' );
				}
				echo $this->miFormulario->division ( "fin" );
				
				$atributos ["id"] = "recuperacion";
				$atributos ["estiloEnLinea"] = "display:" . $valor5;
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					
					$esteCampo = "AgrupacionSobrante";
					$atributos ['id'] = $esteCampo;
					$atributos ['leyenda'] = "Información Recuperación";
					echo $this->miFormulario->agrupacion ( 'inicio', $atributos );
					{
						
						// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
						$esteCampo = 'observaciones_recuperacion';
						$atributos ['id'] = $esteCampo;
						$atributos ['nombre'] = $esteCampo;
						$atributos ['tipo'] = 'text';
						$atributos ['estilo'] = 'jqueryui';
						$atributos ['marco'] = true;
						$atributos ['estiloMarco'] = '';
						$atributos ["etiquetaObligatorio"] = true;
						$atributos ['columnas'] = 105;
						$atributos ['filas'] = 5;
						$atributos ['dobleLinea'] = 0;
						$atributos ['tabIndex'] = $tab;
						$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						$atributos ['validar'] = 'required, minSize[1]';
						$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
						$atributos ['deshabilitado'] = false;
						$atributos ['tamanno'] = 20;
						$atributos ['maximoTamanno'] = '';
						$atributos ['anchoEtiqueta'] = 220;
						if (isset ( $_REQUEST [$esteCampo] )) {
							$atributos ['valor'] = $_REQUEST [$esteCampo];
						} else {
							$atributos ['valor'] = '';
						}
						$tab ++;
						
						// Aplica atributos globales al control
						$atributos = array_merge ( $atributos, $atributosGlobales );
						echo $this->miFormulario->campoTextArea ( $atributos );
						unset ( $atributos );
						
						
						 if($_REQUEST['clase']==5){
						 	
						 	
						 	// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
						 	$esteCampo = 'nombreRecuperacion';
						 	$atributos ['id'] = $esteCampo;
						 	$atributos ['nombre'] = $esteCampo;
						 	$atributos ['tipo'] = 'text';
						 	$atributos ['estilo'] = 'jqueryui';
						 	$atributos ['marco'] = true;
						 	$atributos ['estiloMarco'] = '';
						 	$atributos ["etiquetaObligatorio"] = false;
						 	$atributos ['columnas'] = 1;
						 	$atributos ['dobleLinea'] = 0;
						 	$atributos ['tabIndex'] = $tab;
						 	$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						 	$atributos ['validar'] = '';
						 	
						 	if (isset ( $_REQUEST [$esteCampo] )) {
						 		$atributos ['valor'] = $_REQUEST [$esteCampo];
						 	} else {
						 		$atributos ['valor'] = '';
						 	}
						 	
						 	$atributos ['deshabilitado'] = false;
						 	$atributos ['tamanno'] = 30;
						 	$atributos ['maximoTamanno'] = '';
						 	$atributos ['anchoEtiqueta'] = 220;
						 	$tab ++;
						 	
						 	// Aplica atributos globales al control
						 	$atributos = array_merge ( $atributos, $atributosGlobales );
						 	echo $this->miFormulario->campoCuadroTexto ( $atributos );
						 	unset ( $atributos );
						 	
						 	// ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
						 	
						 	$esteCampo = 'actualizarActaRc';
						 	$atributos ['columnas'] = 1;
						 	$atributos ['nombre'] = $esteCampo;
						 	$atributos ['id'] = $esteCampo;
						 	$atributos ['seleccion'] = 0;
						 	$atributos ['evento'] = '';
						 	$atributos ['deshabilitado'] = false;
						 	$atributos ['tab'] = $tab;
						 	$atributos ['tamanno'] = 1;
						 	$atributos ['estilo'] = 'jqueryui';
						 	$atributos ['validar'] = '';
						 	$atributos ['limitar'] = true;
						 	$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
						 	$atributos ['anchoEtiqueta'] = 213;
						 	// Valores a mostrar en el control
						 	$matrizItems = array (
						 			array (
						 					0,
						 					'NO'
						 			),
						 			array (
						 					1,
						 					'SI'
						 			)
						 	);
						 	
						 	$atributos ['matrizItems'] = $matrizItems;
						 	
						 	// Utilizar lo siguiente cuando no se pase un arreglo:
						 	// $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
						 	// $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
						 	$tab ++;
						 	$atributos = array_merge ( $atributos, $atributosGlobales );
						 	echo $this->miFormulario->campoCuadroLista ( $atributos );
						 	unset ( $atributos );
						 	
						 	$atributos ["id"] = "cargaActoRc";
						 	$atributos ["estiloEnLinea"] = "display:none";
						 	$atributos = array_merge ( $atributos, $atributosGlobales );
						 	echo $this->miFormulario->division ( "inicio", $atributos );
						 	unset ( $atributos );
						 	{
						 		// ------------------Division para los botones-------------------------
						 		// ------------------Division para los botones-------------------------
						 		// ------------------Division para los botones-------------------------
						 		$atributos ["id"] = "botones";
						 		$atributos ["estilo"] = "marcoBotones";
						 		echo $this->miFormulario->division ( "inicio", $atributos );
						 			
						 		{
						 			$esteCampo = "acta_recuperacion";
						 			$atributos ["id"] = $esteCampo; // No cambiar este nombre
						 			$atributos ["nombre"] = $esteCampo;
						 			$atributos ["tipo"] = "file";
						 			$atributos ["obligatorio"] = true;
						 			$atributos ["etiquetaObligatorio"] = true;
						 			$atributos ["tabIndex"] = $tab ++;
						 			$atributos ["columnas"] = 1;
						 			$atributos ["estilo"] = "textoIzquierda";
						 			$atributos ["anchoEtiqueta"] = 190;
						 			$atributos ["tamanno"] = 500000;
						 			$atributos ["validar"] = "required";
						 			$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
						 			// $atributos ["valor"] = $valorCodificado;
						 			$atributos = array_merge ( $atributos, $atributosGlobales );
						 			echo $this->miFormulario->campoCuadroTexto ( $atributos );
						 			unset ( $atributos );
						 		}
						 		echo $this->miFormulario->division ( "fin" );
						 	}
						 	
						 	
						 	
						 }else{
						 	
						 	// ------------------Division para los botones-------------------------
						 	$atributos ["id"] = "botones";
						 	$atributos ["estilo"] = "marcoBotones";
						 	echo $this->miFormulario->division ( "inicio", $atributos );
						 	
						 	{
						 		$esteCampo = "acta_recuperacion";
						 		$atributos ["id"] = $esteCampo; // No cambiar este nombre
						 		$atributos ["nombre"] = $esteCampo;
						 		$atributos ["tipo"] = "file";
						 		$atributos ["obligatorio"] = true;
						 		$atributos ["etiquetaObligatorio"] = true;
						 		$atributos ["tabIndex"] = $tab ++;
						 		$atributos ["columnas"] = 1;
						 		$atributos ["estilo"] = "textoIzquierda";
						 		$atributos ["anchoEtiqueta"] = 190;
						 		$atributos ["tamanno"] = 500000;
						 		$atributos ["validar"] = "required";
						 		$atributos ["etiqueta"] = $this->lenguaje->getCadena ( $esteCampo );
						 		// $atributos ["valor"] = $valorCodificado;
						 		$atributos = array_merge ( $atributos, $atributosGlobales );
						 		echo $this->miFormulario->campoCuadroTexto ( $atributos );
						 		unset ( $atributos );
						 	}
						 	echo $this->miFormulario->division ( "fin" );
						 	
						 	
						 	
						 }
					
					}
					echo $this->miFormulario->agrupacion ( 'fin' );
				}
				echo $this->miFormulario->division ( "fin" );
				
				$esteCampo = "tipo_contrato";
				$atributos ['nombre'] = $esteCampo;
				$atributos ['id'] = $esteCampo;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['tab'] = $tab ++;
				
				$atributos ['anchoEtiqueta'] = 213;
				$atributos ['evento'] = '';
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['seleccion'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['seleccion'] = '';
				}
				$atributos ['deshabilitado'] = false;
				$atributos ['columnas'] = "1";
				$atributos ['tamanno'] = 1;
				$atributos ['ajax_function'] = "";
				$atributos ['ajax_control'] = $esteCampo;
				$atributos ['estilo'] = "jqueryui";
				$atributos ['validar'] = "required";
				$atributos ['limitar'] = false;
				$atributos ['miEvento'] = '';
				$atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "tipo_contrato" );
				$matrizItems = $esteRecursoDB->ejecutarAcceso ( $atributos ['cadena_sql'], "busqueda" );
				$atributos ['matrizItems'] = $matrizItems;
				// $atributos['miniRegistro']=;
				$atributos ['baseDatos'] = "inventarios";
				// $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroLista ( $atributos );
				unset ( $atributos );
				
				$esteCampo = 'numero_contrato';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'jqueryui';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['columnas'] = 1;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['validar'] = 'required, minSize[1],maxSize[30],custom[onlyNumberSp]';
				
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
				$atributos ['deshabilitado'] = false;
				$atributos ['tamanno'] = 15;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 220;
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroTexto ( $atributos );
				unset ( $atributos );
				
				// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
				$esteCampo = 'fecha_contrato';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'jqueryui';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['columnas'] = 1;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['validar'] = 'required,custom[date]';
				
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
				$atributos ['deshabilitado'] = false;
				$atributos ['tamanno'] = 8;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 220;
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroTexto ( $atributos );
				
				$esteCampo = "proveedor";
				$atributos ['nombre'] = $esteCampo;
				$atributos ['id'] = $esteCampo;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['tab'] = $tab ++;
				$atributos ['anchoEtiqueta'] = 213;
				$atributos ['evento'] = '';
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['seleccion'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['seleccion'] = '';
				}
				
				$atributos ['deshabilitado'] = false;
				$atributos ['columnas'] = "1";
				$atributos ['tamanno'] = 1;
				$atributos ['ajax_function'] = "";
				$atributos ['ajax_control'] = $esteCampo;
				$atributos ['estilo'] = "jqueryui";
				$atributos ['validar'] = "required";
				$atributos ['limitar'] = false;
				$atributos ['miEvento'] = '';
				$atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "proveedor" );
				$matrizItems = $esteRecursoDB->ejecutarAcceso ( $atributos ['cadena_sql'], "busqueda" );
				$atributos ['matrizItems'] = $matrizItems;
				// $atributos['miniRegistro']=;
				$atributos ['baseDatos'] = "inventarios";
				// $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroLista ( $atributos );
				unset ( $atributos );
				
				$esteCampo = 'nit';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'jqueryui';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['columnas'] = 1;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['validar'] = 'required, minSize[1],maxSize[30],custom[onlyNumberSp]';
				
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
				$atributos ['deshabilitado'] = false;
				$atributos ['tamanno'] = 15;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 220;
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroTexto ( $atributos );
				unset ( $atributos );
				
				$esteCampo = 'numero_factura';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'jqueryui';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['columnas'] = 1;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['validar'] = 'required, minSize[1],maxSize[50]';
				
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
				$atributos ['deshabilitado'] = false;
				$atributos ['tamanno'] = 15;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 220;
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroTexto ( $atributos );
				unset ( $atributos );
				
				// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
				$esteCampo = 'fecha_factura';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'jqueryui';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['columnas'] = 1;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['validar'] = 'required,custom[date]';
				
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
				$atributos ['deshabilitado'] = false;
				$atributos ['tamanno'] = 8;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 220;
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoCuadroTexto ( $atributos );
				
				// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
				$esteCampo = 'observaciones_entrada';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'jqueryui';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ["etiquetaObligatorio"] = true;
				$atributos ['columnas'] = 105;
				$atributos ['filas'] = 5;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['validar'] = 'required, minSize[1]';
				$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
				$atributos ['deshabilitado'] = false;
				$atributos ['tamanno'] = 20;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 220;
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoTextArea ( $atributos );
				unset ( $atributos );
				
				// ------------------Division para los botones-------------------------
				$atributos ["id"] = "botones";
				$atributos ["estilo"] = "marcoBotones";
				echo $this->miFormulario->division ( "inicio", $atributos );
				
				// -----------------CONTROL: Botón ----------------------------------------------------------------
				$esteCampo = 'botonAceptar';
				$atributos ["id"] = $esteCampo;
				$atributos ["tabIndex"] = $tab;
				$atributos ["tipo"] = '';
				// submit: no se coloca si se desea un tipo button genérico
				$atributos ['submit'] = 'true';
				$atributos ["estiloMarco"] = '';
				$atributos ["estiloBoton"] = 'jqueryui';
				// verificar: true para verificar el formulario antes de pasarlo al servidor.
				$atributos ["verificar"] = '';
				$atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
				$atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['nombreFormulario'] = $esteBloque ['nombre'];
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoBoton ( $atributos );
				// -----------------FIN CONTROL: Botón -----------------------------------------------------------
				
				echo $this->miFormulario->division ( 'fin' );
				
				echo $this->miFormulario->marcoAgrupacion ( 'fin' );
				
				// ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
				
				// ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
				// Se debe declarar el mismo atributo de marco con que se inició el formulario.
			}
			
			// -----------------FIN CONTROL: Botón -----------------------------------------------------------
			
			// ------------------Fin Division para los botones-------------------------
			echo $this->miFormulario->division ( "fin" );
			
			// ------------------- SECCION: Paso de variables ------------------------------------------------
			
			/**
			 * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
			 * SARA permite realizar esto a través de tres
			 * mecanismos:
			 * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
			 * la base de datos.
			 * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
			 * formsara, cuyo valor será una cadena codificada que contiene las variables.
			 * (c) a través de campos ocultos en los formularios. (deprecated)
			 */
			
			// En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
			
			$valorCodificado = "actionBloque=" . $esteBloque ["nombre"];
			$valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
			$valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
			$valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
			$valorCodificado .= "&opcion=modificar";
			$valorCodificado .= "&numero_entrada=" . $_REQUEST ['numero_entrada'];
			$valorCodificado .= "&tipo_entrada=" . $_REQUEST ['tipo_entrada'];
			$valorCodificado .= "&clase_entrada=" . $_REQUEST ['clase'];
			
			/**
			 * SARA permite que los nombres de los campos sean dinámicos.
			 * Para ello utiliza la hora en que es creado el formulario para
			 * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
			 * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
			 * (b) asociando el tiempo en que se está creando el formulario
			 */
			$valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
			$valorCodificado .= "&tiempo=" . time ();
			// Paso 2: codificar la cadena resultante
			$valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );
			
			$atributos ["id"] = "formSaraData"; // No cambiar este nombre
			$atributos ["tipo"] = "hidden";
			$atributos ['estilo'] = '';
			$atributos ["obligatorio"] = false;
			$atributos ['marco'] = true;
			$atributos ["etiqueta"] = "";
			$atributos ["valor"] = $valorCodificado;
			echo $this->miFormulario->campoCuadroTexto ( $atributos );
			unset ( $atributos );
			
			$atributos ['marco'] = true;
			$atributos ['tipoEtiqueta'] = 'fin';
			echo $this->miFormulario->formulario ( $atributos );
			
			return true;
		}
	}
}
$miSeleccionador = new registrarForm ( $this->lenguaje, $this->miFormulario, $this->sql );

$miSeleccionador->miForm ();
?>
