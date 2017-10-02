<?php

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class registrarForm {

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
        // ---------------- SECCION: Controles del Formulario -----------------------------------------------


        $varCantidad = explode(",", $_REQUEST['variablesCant']);
        $varID = explode(",", $_REQUEST['variablesCampo']);



        $contador = 0;
        $validador = true;
        while ($contador < (count($varID) - 1)) {
            if ($varCantidad[$contador] == null || $varCantidad[$contador] == 0) {
                $validador = false;
                break;
            }
            $contador++;
        }


        if ($validador == true) {




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

            // ------------------Division para los botones-------------------------
            $atributos ["id"] = "botones";
            $atributos ["estilo"] = "marcoBotones";
            echo $this->miFormulario->division("inicio", $atributos);





            $esteCampo = 'variablesID';
            $atributos ['id'] = $esteCampo;
            $atributos ['nombre'] = $esteCampo;
            $atributos ['tipo'] = 'hidden';
            $atributos ['estilo'] = 'jqueryui';
            $atributos ['marco'] = true;
            $atributos ['columnas'] = 1;
            $atributos ['dobleLinea'] = false;
            $atributos ['tabIndex'] = $tab;
            $atributos ['valor'] = $_REQUEST['variablesCampo'];
            $atributos ['deshabilitado'] = false;
            $atributos ['maximoTamanno'] = '';
            $tab++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->campoCuadroTexto($atributos);
            unset($atributos);

            $esteCampo = 'variablesCantidad';
            $atributos ['id'] = $esteCampo;
            $atributos ['nombre'] = $esteCampo;
            $atributos ['tipo'] = 'hidden';
            $atributos ['estilo'] = 'jqueryui';
            $atributos ['marco'] = true;
            $atributos ['columnas'] = 1;
            $atributos ['dobleLinea'] = false;
            $atributos ['tabIndex'] = $tab;
            $atributos ['valor'] = $_REQUEST['variablesCant'];
            $atributos ['deshabilitado'] = false;
            $atributos ['maximoTamanno'] = '';
            $tab++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->campoCuadroTexto($atributos);
            unset($atributos);

            $esteCampo = 'elementosID';
            $atributos ['id'] = $esteCampo;
            $atributos ['nombre'] = $esteCampo;
            $atributos ['tipo'] = 'hidden';
            $atributos ['estilo'] = 'jqueryui';
            $atributos ['marco'] = true;
            $atributos ['columnas'] = 1;
            $atributos ['dobleLinea'] = false;
            $atributos ['tabIndex'] = $tab;
            $atributos ['valor'] = $_REQUEST['elementosID'];
            $atributos ['deshabilitado'] = false;
            $atributos ['maximoTamanno'] = '';
            $tab++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->campoCuadroTexto($atributos);
            unset($atributos);
            
            $esteCampo = 'elementosDetalle';
            $atributos ['id'] = $esteCampo;
            $atributos ['nombre'] = $esteCampo;
            $atributos ['tipo'] = 'hidden';
            $atributos ['estilo'] = 'jqueryui';
            $atributos ['marco'] = true;
            $atributos ['columnas'] = 1;
            $atributos ['dobleLinea'] = false;
            $atributos ['tabIndex'] = $tab;
            $atributos ['valor'] = $_REQUEST['elementosDetalle'];
            $atributos ['deshabilitado'] = false;
            $atributos ['maximoTamanno'] = '';
            $tab++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->campoCuadroTexto($atributos);
            unset($atributos);

            // -----------------CONTROL: Botón ----------------------------------------------------------------
            $esteCampo = 'botonRegistrar';
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

            echo $this->miFormulario->agrupacion('fin');
            echo $this->miFormulario->marcoAgrupacion('fin');

            $valorCodificado = "actionBloque=" . $esteBloque ["nombre"];
            $valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
            $valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
            $valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
            $valorCodificado .= "&opcion=RegistrarSalida";
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
        } else {
            // ---------------- SECCION: Controles del Formulario -----------------------------------------------

            $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

            $directorio = $this->miConfigurador->getVariableConfiguracion("host");
            $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
            $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");

            $variable = "pagina=" . $miPaginaActual;
            $variable .= "&usuario=" . $_REQUEST['usuario'];
            $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
            $esteCampo = 'botonRegresar';
            $atributos ['id'] = $esteCampo;
            $atributos ['enlace'] = $variable;
            $atributos ['tabIndex'] = 1;
            $atributos ['estilo'] = 'textoSubtitulo';
            $atributos ['enlaceTexto'] = $this->lenguaje->getCadena($esteCampo);
            $atributos ['ancho'] = '10%';
            $atributos ['alto'] = '10%';
            $atributos ['redirLugar'] = true;
            echo $this->miFormulario->enlace($atributos);

            unset($atributos);


            $esteCampo = "marcoDatosBasicos";
            $atributos ['id'] = $esteCampo;
            $atributos ["estilo"] = "jqueryui";
            $atributos ['tipoEtiqueta'] = 'inicio';
            // $atributos ["leyenda"] = "Regitrar Orden Compra";
            echo $this->miFormulario->marcoAgrupacion('inicio', $atributos); {


                $variable = $_REQUEST ['usuario'];


                $mensaje = "No se pudo realizar el registro de salida de bodega, verifique que haya ingresado cantidades validas para todos los elementos  <br> Recuerde ingresar cantidades diferentes de 0 y dentro del rango de posibilidad <br><br> Usuario:" . $variable;

                // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                $esteCampo = 'mensajeRegistro';
                $atributos ['id'] = $esteCampo;
                $atributos ['tipo'] = 'error';
                $atributos ['estilo'] = 'textoCentrar';
                $atributos ['mensaje'] = $mensaje;

                $tab ++;

                // Aplica atributos globales al control
                $atributos = array_merge($atributos, $atributosGlobales);
                echo $this->miFormulario->cuadroMensaje($atributos);
                // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
            }
        }

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

        $valorCodificado = "actionBloque=" . $esteBloque ["nombre"];
        $valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
        $valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
        $valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
        $valorCodificado .= "&opcion=RegistrarSalida";
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

$miSeleccionador = new registrarForm($this->lenguaje, $this->miFormulario, $this->sql);

$miSeleccionador->miForm();
?>
