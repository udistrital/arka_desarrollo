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
		$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
		
		$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
		$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
		$rutaBloque .= $esteBloque ['grupo'] . $esteBloque ['nombre'];
		
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
		// -------------------------------------------------------------------------------------------------
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		if (isset ( $_REQUEST ['fecha_inicio'] ) && $_REQUEST ['fecha_inicio'] != '') {
			$fechaInicio = $_REQUEST ['fecha_inicio'];
		} else {
			$fechaInicio = '';
		}
		
		if (isset ( $_REQUEST ['fecha_final'] ) && $_REQUEST ['fecha_final'] != '') {
			$fechaFinal = $_REQUEST ['fecha_final'];
		} else {
			$fechaFinal = '';
		}
		
		if (isset ( $_REQUEST ['placaFinal'] ) && $_REQUEST ['placaFinal'] != '') {
			$placaFinal = $_REQUEST ['placaFinal'];
		} else {
			$placaFinal = '';
		}
		
		if (isset ( $_REQUEST ['placaInicial'] ) && $_REQUEST ['placaInicial'] != '') {
			$placaInicial = $_REQUEST ['placaInicial'];
		} else {
			$placaInicial = '';
		}
		
		$arreglo = array (
				"placa_inicial" => $placaInicial,
				"placa_final" => $placaFinal,
				"fecha_inicio" => $fechaInicio,
				"fecha_final" => $fechaFinal 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarPlacas', $arreglo );
		
		$info_placas = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		foreach ( $info_placas as $i ) {
			
			$placas [] = $i [1];
		}
		
		$placas = serialize ( $placas );
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
		$atributos ['marco'] = true;
		$tab = 1;
		// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
		
		// ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
		$atributos ['tipoEtiqueta'] = 'inicio';
		echo $this->miFormulario->formulario ( $atributos );
		// ---------------- SECCION: Controles del Formulario -----------------------------------------------
		
		$variable = "pagina=" . $miPaginaActual;
		$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable, $directorio );
		
		// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
		$esteCampo = 'botonRegresar';
		$atributos ['id'] = $esteCampo;
		$atributos ['enlace'] = $variable;
		$atributos ['tabIndex'] = 1;
		$atributos ['estilo'] = 'textoSubtitulo';
		$atributos ['enlaceTexto'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['ancho'] = '10%';
		$atributos ['alto'] = '10%';
		$atributos ['redirLugar'] = true;
		echo $this->miFormulario->enlace ( $atributos );
		
		unset ( $atributos );
		
		$esteCampo = "marcoDatosBasicos";
		$atributos ['id'] = $esteCampo;
		$atributos ["estilo"] = "jqueryui";
		$atributos ['tipoEtiqueta'] = 'inicio';
		$atributos ["leyenda"] = "Impresión Placas";
		echo $this->miFormulario->marcoAgrupacion ( 'inicio', $atributos );
		
		{
			
			$esteCampo = 'num_placas';
			$atributos ['id'] = $esteCampo;
			$atributos ['nombre'] = $esteCampo;
			$atributos ['tipo'] = 'text';
			$atributos ['estilo'] = 'jqueryui';
			$atributos ['marco'] = true;
			$atributos ['estiloMarco'] = '';
			$atributos ['columnas'] = 1;
			$atributos ['dobleLinea'] = 0;
			$atributos ['tabIndex'] = $tab;
			$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
			$atributos ['validar'] = '';
			$atributos ['valor'] = count ( $info_placas );
			$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
			$atributos ['deshabilitado'] = true;
			$atributos ['tamanno'] = 15;
			$atributos ['maximoTamanno'] = '';
			$atributos ['anchoEtiqueta'] = 220;
			$tab ++;
			
			// Aplica atributos globales al control
			$atributos = array_merge ( $atributos, $atributosGlobales );
			echo $this->miFormulario->campoCuadroTexto ( $atributos );
			unset ( $atributos );
			
			$esteCampo = 'placa_min';
			$atributos ['id'] = $esteCampo;
			$atributos ['nombre'] = $esteCampo;
			$atributos ['tipo'] = 'text';
			$atributos ['estilo'] = 'jqueryui';
			$atributos ['marco'] = true;
			$atributos ['estiloMarco'] = '';
			$atributos ['columnas'] = 2;
			$atributos ['dobleLinea'] = 0;
			$atributos ['tabIndex'] = $tab;
			$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
			$atributos ['validar'] = '';
			$atributos ['valor'] = $info_placas [0] [1];
			$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
			$atributos ['deshabilitado'] = true;
			$atributos ['tamanno'] = 15;
			$atributos ['maximoTamanno'] = '';
			$atributos ['anchoEtiqueta'] = 220;
			$tab ++;
			
			// Aplica atributos globales al control
			$atributos = array_merge ( $atributos, $atributosGlobales );
			echo $this->miFormulario->campoCuadroTexto ( $atributos );
			unset ( $atributos );
			
			$esteCampo = 'placa_max';
			$atributos ['id'] = $esteCampo;
			$atributos ['nombre'] = $esteCampo;
			$atributos ['tipo'] = 'text';
			$atributos ['estilo'] = 'jqueryui';
			$atributos ['marco'] = true;
			$atributos ['estiloMarco'] = '';
			$atributos ['columnas'] = 2;
			$atributos ['dobleLinea'] = 0;
			$atributos ['tabIndex'] = $tab;
			$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
			$atributos ['validar'] = '';
			$atributos ['valor'] = $info_placas [count ( $info_placas ) - 1] [1];
			$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
			$atributos ['deshabilitado'] = true;
			$atributos ['tamanno'] = 15;
			$atributos ['maximoTamanno'] = '';
			$atributos ['anchoEtiqueta'] = 220;
			$tab ++;
			
			// Aplica atributos globales al control
			$atributos = array_merge ( $atributos, $atributosGlobales );
			echo $this->miFormulario->campoCuadroTexto ( $atributos );
			unset ( $atributos );
			
			// ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
			
			$esteCampo = 'tipo_impresion';
			$atributos ['columnas'] = 1;
			$atributos ['nombre'] = $esteCampo;
			$atributos ['id'] = $esteCampo;
			$atributos ['seleccion'] = 1;
			$atributos ['evento'] = '';
			$atributos ['deshabilitado'] = false;
			$atributos ['tab'] = $tab;
			$atributos ['tamanno'] = 1;
			$atributos ['estilo'] = 'jqueryui';
			$atributos ['validar'] = '';
			$atributos ['limitar'] = false;
			$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
			$atributos ['anchoEtiqueta'] = 213;
			// Valores a mostrar en el control
			$matrizItems = array (
					array (
							1,
							'Total Placas' 
					),
					array (
							2,
							'Posición Determinada' 
					) 
			);
			
			$atributos ['matrizItems'] = $matrizItems;
			
			// Utilizar lo siguiente cuando no se pase un arreglo:
			// $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
			// $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
			$tab ++;
// 			$atributos = array_merge ( $atributos, $atributosGlobales );
			echo $this->miFormulario->campoCuadroLista ( $atributos );
			unset ( $atributos );
			
			$atributos ["id"] = "posicion_placas";
			$atributos ["estiloEnLinea"] = "display:none";
			$atributos = array_merge ( $atributos, $atributosGlobales );
			echo $this->miFormulario->division ( "inicio", $atributos );
			unset ( $atributos );
			{
				
				$esteCampo = "marcoDatosBasicos";
				$atributos ['id'] = $esteCampo;
				$atributos ["leyenda"] = "Seleccione posición a dejar en blanco en la impresión ";
				echo $this->miFormulario->marcoAgrupacion ( 'inicio', $atributos );
				
				{
					
					echo "<table id='tablaImpresion'>";
					
					echo "<thead>
                <tr>
                   <th><input type='checkbox' id='1' name='1' name=''  value=true>Posición 1</th>
                   <th><input type='checkbox' id='2' name='2' name=''  value=true>Posición 2</th>
                   <th><input type='checkbox' id='3' name='3' name=''  value=true>Posición 3</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='4' name='4' name=''  value=true>Posición 4</th>
                   <th><input type='checkbox' id='5' name='5' name=''  value=true>Posición 5</th>
                   <th><input type='checkbox' id='6' name='6' name=''  value=true>Posición 6</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='7' name='7' name=''  value=true>Posición 7</th>
                   <th><input type='checkbox' id='8' name='8' name=''  value=true>Posición 8</th>
                   <th><input type='checkbox' id='9' name='9' name=''  value=true>Posición 9</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='10' name='10' name=''  value=true>Posición 10</th>
                   <th><input type='checkbox' id='11' name='11' name=''  value=true>Posición 11</th>
                   <th><input type='checkbox' id='12' name='12' name=''  value=true>Posición 12</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='13' name='13'  value=true>Posición 13</th>
                   <th><input type='checkbox' id='14' name='14'  value=true>Posición 14</th>
                   <th><input type='checkbox' id='15' name='15'  value=true>Posición 15</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='16' name='16'  value=true>Posición 16</th>
                   <th><input type='checkbox' id='17' name='17'  value=true>Posición 17</th>
                   <th><input type='checkbox' id='18' name='18'  value=true>Posición 18</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='19' name='19'  value=true>Posición 19</th>
                   <th><input type='checkbox' id='20' name='20'  value=true>Posición 20</th>
                   <th><input type='checkbox' id='21' name='21'  value=true>Posición 21</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='22' name='22'  value=true>Posición 22</th>
                   <th><input type='checkbox' id='23' name='23'  value=true>Posición 23</th>
                   <th><input type='checkbox' id='24' name='24'  value=true>Posición 24</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='25' name='25'  value=true>Posición 25</th>
                   <th><input type='checkbox' id='26' name='26'  value=true>Posición 26</th>
                   <th><input type='checkbox' id='27' name='27'  value=true>Posición 27</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='28' name='28'  value=true>Posición 28</th>
                   <th><input type='checkbox' id='29' name='29'  value=true>Posición 29</th>
                   <th><input type='checkbox' id='30' name='30'  value=true>Posición 30</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='31' name='31'  value=true>Posición 31</th>
                   <th><input type='checkbox' id='32' name='32'  value=true>Posición 32</th>
                   <th><input type='checkbox' id='33' name='33'  value=true>Posición 33</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='34' name='34'  value=true>Posición 34</th>
                   <th><input type='checkbox' id='35' name='35'  value=true>Posición 35</th>
                   <th><input type='checkbox' id='36' name='36'  value=true>Posición 36</th>
	           </tr>
						<tr>
                   <th><input type='checkbox' id='37' name='37'  value=true>Posición 37</th>
                   <th><input type='checkbox' id='38' name='38'  value=true>Posición 38</th>
                   <th><input type='checkbox' id='39' name='39'  value=true>Posición 39</th>
	           </tr>
            </thead>
            <tbody>";
					
					echo "</tbody>";
					
					echo "</table>";
					
					// Fin de Conjunto de Controles
					// echo $this->miFormulario->marcoAgrupacion("fin");
				}
				echo $this->miFormulario->marcoAgrupacion ( 'fin' );
			}
			echo $this->miFormulario->division ( "fin" );
			
			// ------------------Division para los botones-------------------------
			$atributos ["id"] = "botones";
			$atributos ["estilo"] = "marcoBotones";
			echo $this->miFormulario->division ( "inicio", $atributos );
			
			// -----------------CONTROL: Botón ----------------------------------------------------------------
			$esteCampo = 'botonImprimir';
			$atributos ["id"] = $esteCampo;
			$atributos ["tabIndex"] = $tab;
			$atributos ["tipo"] = 'boton';
			// submit: no se coloca si se desea un tipo button genérico
			$atributos ['submit'] = true;
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
			
			// ---------------------------------------------------------
			
			// ------------------Fin Division para los botones-------------------------
			echo $this->miFormulario->division ( "fin" );
		}
		echo $this->miFormulario->marcoAgrupacion ( 'fin' );
		
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
		
		// Paso 1: crear el listado de variables
		
		$valorCodificado = "action=" . $esteBloque ["nombre"];
		$valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
		$valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
		$valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
		$valorCodificado .= "&opcion=imprimirPlacas";
		$valorCodificado .= "&placas=" . $placas;
		
		/**
		 * SARA permite que los nombres de los campos sean dinámicos.
		 * Para ello utiliza la hora en que es creado el formulario para
		 * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
		 * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
		 * (b) asociando el tiempo en que se está creando el formulario
		 */
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
	}
}

$miSeleccionador = new registrarForm ( $this->lenguaje, $this->miFormulario, $this->sql );

$miSeleccionador->miForm ();
?>
