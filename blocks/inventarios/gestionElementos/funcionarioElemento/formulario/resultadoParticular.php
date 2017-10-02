<?php

ini_set("memory_limit", "2048M");
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
        $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

        $directorio = $this->miConfigurador->getVariableConfiguracion("host");
        $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
        $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
        $rutaBloque .= $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
        $rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];

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

        // -------------------------------------------------------------------------------------------------
        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $cadenaSql = $this->miSql->getCadenaSql("Verificar_Periodo");
        $resultado_periodo = $esteRecursoDB->ejecutarAcceso($cadenaSql, 'busqueda');

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

        $variable = "pagina=" . $miPaginaActual;
        $variable .= "&usuario=" . $_REQUEST ['usuario'];
        $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

        if (!isset($_REQUEST ['accesoCondor'])) {

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
        }

        if (isset($_REQUEST ['funcionario']) && $_REQUEST ['funcionario'] != '') {
            $funcionario = $_REQUEST ['funcionario'];
        }

        if (isset($_REQUEST ['sede']) && $_REQUEST ['sede'] != '') {
            $sede = $_REQUEST ['sede'];
        } else {
            $sede = '';
        }

        if (isset($_REQUEST ['dependencia']) && $_REQUEST ['dependencia'] != '') {
            $dependencia = $_REQUEST ['dependencia'];
        } else {
            $dependencia = '';
        }

        if (isset($_REQUEST ['ubicacion']) && $_REQUEST ['ubicacion'] != '') {
            $ubicacion = $_REQUEST ['ubicacion'];
        } else {
            $ubicacion = '';
        }

        $arreglo = array(
            'funcionario' => $funcionario,
            'sede' => $sede,
            'dependencia' => $dependencia,
            'ubicacion' => $ubicacion
        );



        $cadenaSql = $this->miSql->getCadenaSql('consultarFuncionario', $funcionario);

        $datosfuncionario = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $datosfuncionario = $datosfuncionario [0];
        // ------------------Division para los botones-------------------------

        $datosfuncionario ['identificacion'] = $_REQUEST ['usuario'];

        if (isset($datosfuncionario ['nombre'])) {
            $datosfuncionarioNombre = $datosfuncionario ['nombre'];
        } else {
            $datosfuncionarioNombre = '';
        }

        if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {
            $atributos ["id"] = "logos";
            $atributos ["estilo"] = " ";
            echo $this->miFormulario->division("inicio", $atributos);
            unset($atributos); {

                $esteCampo = 'logo';
                $atributos ['id'] = $esteCampo;
                $atributos ['tabIndex'] = $tab;
                $atributos ['estilo'] = '';
                $atributos ['enlaceImagen'] = $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque') . 'css/images/banner_arka.png';
                $atributos ['ancho'] = '100%';
                $atributos ['alto'] = '150px';
                $tab ++;
                echo $this->miFormulario->enlace($atributos);
                unset($atributos);
            }

            echo $this->miFormulario->division("fin");
            unset($atributos);
        }

        $esteCampo = "marcoDatosBasicos";
        $atributos ['id'] = $esteCampo;
        $atributos ["estilo"] = "jqueryui";
        $atributos ['tipoEtiqueta'] = 'inicio';
        $atributos ["leyenda"] = "Inventario  : CC. " . $_REQUEST ['funcionario'] . "    " . $datosfuncionarioNombre;
        echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);
        unset($atributos); {



            // ------------------Division para los botones-------------------------
            $atributos ["id"] = "SeleccionRegistro";
            echo $this->miFormulario->division("inicio", $atributos);
            unset($atributos);


            $esteCampo = "selec_nivel";
            $atributos ['nombre'] = $esteCampo;
            $atributos ['id'] = $esteCampo;
            $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
            $atributos ["etiquetaObligatorio"] = false;
            $atributos ['tab'] = $tab ++;
            $atributos ['seleccion'] = 0;
            $atributos ['anchoEtiqueta'] = 110;
            $atributos ['evento'] = '';
            if (isset($_REQUEST [$esteCampo])) {
                $atributos ['valor'] = $_REQUEST [$esteCampo];
            } else {
                $atributos ['valor'] = '';
            }
            $atributos ['deshabilitado'] = false;
            $atributos ['columnas'] = 1;
            $atributos ['tamanno'] = 1;
            $atributos ['ajax_function'] = "";
            $atributos ['ajax_control'] = $esteCampo;
            $atributos ['estilo'] = "jqueryui";
            $atributos ['validar'] = "required";
            $atributos ['limitar'] = false;
            $atributos ['anchoCaja'] = 10;
            $atributos ['miEvento'] = '';
            // $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "estado_entrada" );

            $cadenaSql = $this->miSql->getCadenaSql('consultarNivelesFuncionario');
            $resultadoNivel = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            $matrizItems = array(
                array(
                    500,
                    'NIVELES DEVOLUTIVOS'
                ),
                array(
                    600,
                    'NIVELES DE CONSUMO CONTROLADO'
                ),
                array(
                    $resultadoNivel[0][0],
                    $resultadoNivel[0][1]
                ),
                array(
                    $resultadoNivel[1][0],
                    $resultadoNivel[1][1]
                )
            );
            $atributos ['matrizItems'] = $matrizItems;
            // $atributos['miniRegistro']=;
            $atributos ['baseDatos'] = "inventarios";
            // $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->campoCuadroLista($atributos);
            unset($atributos);
        }
        // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
        $esteCampo = 'sede';
        $atributos ['id'] = $esteCampo;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['tipo'] = 'hidden';
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['marco'] = true;
        $atributos ['columnas'] = 1;
        $atributos ['dobleLinea'] = false;
        $atributos ['tabIndex'] = $tab;
        if(isset($_REQUEST['sede']) && $_REQUEST['sede'] != ''){
            $atributos ['valor'] = $_REQUEST['sede'];
        }
        else{
            $atributos ['valor'] = '';
        }
        
        $atributos ['deshabilitado'] = false;
        $atributos ['maximoTamanno'] = '';
        $tab++;

        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroTexto($atributos);
        unset($atributos);

        $esteCampo = 'dependencia';
        $atributos ['id'] = $esteCampo;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['tipo'] = 'hidden';
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['marco'] = true;
        $atributos ['columnas'] = 1;
        $atributos ['dobleLinea'] = false;
        $atributos ['tabIndex'] = $tab;
        if(isset($_REQUEST['dependencia']) && $_REQUEST['dependencia'] != ''){
            $atributos ['valor'] = $_REQUEST['dependencia'];
        }
        else{
            $atributos ['valor'] = '';
        }
        $atributos ['deshabilitado'] = false;
        $atributos ['maximoTamanno'] = '';
        $tab++;

        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroTexto($atributos);
        unset($atributos);
        
        $esteCampo = 'ubicacion';
        $atributos ['id'] = $esteCampo;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['tipo'] = 'hidden';
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['marco'] = true;
        $atributos ['columnas'] = 1;
        $atributos ['dobleLinea'] = false;
        $atributos ['tabIndex'] = $tab;
        if(isset($_REQUEST['ubicacion']) && $_REQUEST['ubicacion'] != ''){
            $atributos ['valor'] = $_REQUEST['ubicacion'];
        }
        else{
           $atributos ['valor'] = '';
        }
        
        $atributos ['deshabilitado'] = false;
        $atributos ['maximoTamanno'] = '';
        $tab++;

        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoCuadroTexto($atributos);
        unset($atributos);
        
        // ------------------Division para los botones-------------------------
        $atributos ["id"] = "botones";
        $atributos ["estilo"] = "marcoBotones";
        echo $this->miFormulario->division("inicio", $atributos);

        // -----------------CONTROL: Botón ----------------------------------------------------------------
        $esteCampo = 'botonConsulta';
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
        unset($atributos);

        // ------------------Fin Division para los botones-------------------------
        echo $this->miFormulario->division("fin");
        unset($atributos);


        echo $this->miFormulario->marcoAgrupacion('fin');
        unset($atributos);



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
        $valorCodificado .= "&opcion=ConsultarParticular";
        $valorCodificado .= "&funcionario=" . $_REQUEST ['funcionario'];
        $valorCodificado .= "&usuario=" . $_REQUEST ['usuario'];
        if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

            $valorCodificado .= "&accesoCondor=true";
        }



        // $valorCodificado .= "&opcion=mensaje";
        // $valorCodificado .= "&mensaje=mantenimiento";

        /**
         * SARA permite que los nombres de los campos sean dinámicos.
         * Para ello utiliza la hora en que es creado el formulario para
         * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
         * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
         * (b) asociando el tiempo en que se está creando el formulario
         */
        $valorCodificado .= "&tiempo=" . time();
        $valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
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
ini_restore("memory_limit");
?>
