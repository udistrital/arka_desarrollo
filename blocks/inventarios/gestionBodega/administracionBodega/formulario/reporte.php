<?php

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class registrarForm2 {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miSql;

    function __construct($lenguaje, $formulario, $sql) {
        $this->miConfigurador = \Configurador::singleton();

        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');

        $this->lenguaje = $lenguaje;

        $this->miFormulario = $formulario;

        $this->miSql = $sql;
    }

    function miForm() {


        // Rescatar los datos de este bloque
        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

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

        $_REQUEST ['tiempo'] = time();

        // -------------------------------------------------------------------------------------------------
        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);


        // Limpia Items Tabla temporal
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
        echo $this->miFormulario->formulario($atributos);
        // ---------------- SECCION: Controles del Formulario ---------------------------------------------


        $esteCampo = "marcoDatosBasicos";
        $atributos ['id'] = $esteCampo;
        $atributos ["estilo"] = "jqueryui";
        $atributos ['tipoEtiqueta'] = 'inicio';
        $atributos ["leyenda"] = "Registro Salida Bodega de Consumo";
        echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);




        // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
        $esteCampo = 'funcionario_solicita';
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
        $atributos ["etiquetaObligatorio"] = false;
        $atributos ['tab'] = $tab ++;
        $atributos ['anchoEtiqueta'] = 300;
        $atributos ['evento'] = '';
        if (isset($_REQUEST [$esteCampo])) {
            $atributos ['seleccion'] = $_REQUEST [$esteCampo];
        } else {
            $atributos ['seleccion'] = - 1;
        }
        $atributos ['deshabilitado'] = false;
        $atributos ['columnas'] = 1;
        $atributos ['tamanno'] = 1;
        $atributos ['ajax_function'] = "";
        $atributos ['ajax_control'] = $esteCampo;
        $atributos ['estilo'] = "jqueryui";
        $atributos ['validar'] = "required";
        $atributos ['limitar'] = true;
        $atributos ['anchoCaja'] = 52;
        $atributos ['miEvento'] = '';
        $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("funcionarios");
        $matrizItems = array(
            array(
                0,
                ' '
            )
        );
        $matrizItems = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");
        $atributos ['matrizItems'] = $matrizItems;
        // $atributos['miniRegistro']=;
        $atributos ['baseDatos'] = "inventarios";
        // $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroLista($atributos);
        unset($atributos);

        // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
        $esteCampo = 'funcionario_recibe';
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
        $atributos ["etiquetaObligatorio"] = false;
        $atributos ['tab'] = $tab ++;
        $atributos ['anchoEtiqueta'] = 300;
        $atributos ['evento'] = '';
        if (isset($_REQUEST [$esteCampo])) {
            $atributos ['seleccion'] = $_REQUEST [$esteCampo];
        } else {
            $atributos ['seleccion'] = - 1;
        }
        $atributos ['deshabilitado'] = false;
        $atributos ['columnas'] = 2;
        $atributos ['tamanno'] = 1;
        $atributos ['ajax_function'] = "";
        $atributos ['ajax_control'] = $esteCampo;
        $atributos ['estilo'] = "jqueryui";
        $atributos ['validar'] = "required";
        $atributos ['limitar'] = true;
        $atributos ['anchoCaja'] = 52;
        $atributos ['miEvento'] = '';
        $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("funcionarios");
        $matrizItems = array(
            array(
                0,
                ' '
            )
        );
        $matrizItems = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");
        $atributos ['matrizItems'] = $matrizItems;
        // $atributos['miniRegistro']=;
        $atributos ['baseDatos'] = "inventarios";
        // $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroLista($atributos);
        unset($atributos);


        // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
        $esteCampo = 'contratista_recibe';
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
        $atributos ["etiquetaObligatorio"] = false;
        $atributos ['tab'] = $tab ++;
        $atributos ['anchoEtiqueta'] = 300;
        $atributos ['evento'] = '';
        if (isset($_REQUEST [$esteCampo])) {
            $atributos ['seleccion'] = $_REQUEST [$esteCampo];
        } else {
            $atributos ['seleccion'] = - 1;
        }
        $atributos ['deshabilitado'] = false;
        $atributos ['columnas'] = 2;
        $atributos ['tamanno'] = 1;
        $atributos ['ajax_function'] = "";
        $atributos ['ajax_control'] = $esteCampo;
        $atributos ['estilo'] = "jqueryui";
        $atributos ['validar'] = "required";
        $atributos ['limitar'] = true;
        $atributos ['anchoCaja'] = 52;
        $atributos ['miEvento'] = '';
        $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("contratistas");
        $matrizItems = array(
            array(
                0,
                ' '
            )
        );
        $matrizItems = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");
        $atributos ['matrizItems'] = $matrizItems;
        // $atributos['miniRegistro']=;
        $atributos ['baseDatos'] = "inventarios";
        // $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroLista($atributos);
        unset($atributos);

        // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
        $esteCampo = 'sede2';
        $atributos ['columnas'] = 2;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['evento'] = '';
        $atributos ['deshabilitado'] = false;
        $atributos ["etiquetaObligatorio"] = false;
        $atributos ['tab'] = $tab;
        $atributos ['tamanno'] = 1;
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['validar'] = '';
        $atributos ['limitar'] = true;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
        $atributos ['anchoEtiqueta'] = 150;

        if (isset($_REQUEST [$esteCampo])) {
            $atributos ['seleccion'] = $_REQUEST [$esteCampo];
        } else {
            $atributos ['seleccion'] = - 1;
        }

        $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("sede");
        $matrizItems = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");
        $atributos ['matrizItems'] = $matrizItems;

        // Utilizar lo siguiente cuando no se pase un arreglo:
        // $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
        // $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
        $tab ++;
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroLista($atributos);
        unset($atributos);

        $esteCampo = "dependencia2";
        $atributos ['columnas'] = 2;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;

        $atributos ['evento'] = '';
        $atributos ['deshabilitado'] = true;
        $atributos ["etiquetaObligatorio"] = false;
        $atributos ['tab'] = $tab;
        $atributos ['tamanno'] = 1;
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['validar'] = '';
        $atributos ['limitar'] = true;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
        $atributos ['anchoEtiqueta'] = 150;
        if (isset($_REQUEST [$esteCampo])) {
            $atributos ['seleccion'] = $_REQUEST [$esteCampo];
        } else {
            $atributos ['seleccion'] = - 1;
        }
        $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("dependencias");

        $matrizItems = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");
        $atributos ['matrizItems'] = $matrizItems;


        $tab ++;
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroLista($atributos);
        unset($atributos);
        
        $esteCampo = "reportes";
        $atributos ['columnas'] = 1;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;

        $atributos ['evento'] = '';
        $atributos ['deshabilitado'] = false;
        $atributos ["etiquetaObligatorio"] = false;
        $atributos ['tab'] = $tab;
        $atributos ['tamanno'] = 1;
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['validar'] = '';
        $atributos ['limitar'] = true;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
        $atributos ['anchoEtiqueta'] = 150;
        if (isset($_REQUEST [$esteCampo])) {
            $atributos ['seleccion'] = $_REQUEST [$esteCampo];
        } else {
            $atributos ['seleccion'] = - 1;
        }
        $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("reportesConsecutivo");

        $matrizItems = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");
        $atributos ['matrizItems'] = $matrizItems;


        $tab ++;
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroLista($atributos);
        unset($atributos);

        // ------------------Division para los botones-------------------------
        $atributos ["id"] = "botones";
        $atributos ["estilo"] = "marcoBotones";
        echo $this->miFormulario->division("inicio", $atributos);


        // -----------------CONTROL: Botón ----------------------------------------------------------------
        $esteCampo = 'botonGenerar';
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
        $atributos ["valor"] = $this->lenguaje->getCadena($esteCampo);
        $atributos ['nombreFormulario'] = $esteBloque ['nombre'];
        $tab ++;

        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoBoton($atributos);
        // -----------------FIN CONTROL: Botón -----------------------------------------------------------
        // ---------------------------------------------------------
        // ------------------Fin Division para los botones-------------------------
        echo $this->miFormulario->division("fin");
       


        $valorCodificado = "actionBloque=" . $esteBloque ["nombre"];
        $valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
        $valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
        $valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
        $valorCodificado .= "&opcion=ImprimirRe";
        $valorCodificado .= "&usuario=" . $_REQUEST['usuario'];
        /**
         * SARA permite que los nombres de los campos sean dinámicos.
         * Para ello utiliza la hora en que es creado el formulario para
         * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
         * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
         * (b) asociando el tiempo en que se está creando el formulario
         */
        $valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
        $valorCodificado .= "&tiempo=" . time();
        // Paso 2: codificar la cadena resultante
        $valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar($valorCodificado);

        $atributos ["id"] = "formSaraData"; // No cambiar este nombre
        $atributos ["tipo"] = "hidden";
        $atributos ['estilo'] = '';
        $atributos ["obligatorio"] = false;
        $atributos ['marco'] = true;
        $atributos ["etiqueta"] = "";
        $atributos ["valor"] = $valorCodificado;
        echo $this->miFormulario->campoCuadroTexto($atributos);
        unset($atributos);

        $atributos ['marco'] = true;
        $atributos ['tipoEtiqueta'] = 'fin';
        echo $this->miFormulario->formulario($atributos);
    }

}

$miSeleccionador = new registrarForm2($this->lenguaje, $this->miFormulario, $this->sql);

$miSeleccionador->miForm();
?>
