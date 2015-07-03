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
        $atributosGlobales ['tiempo'] = 'true';

        $_REQUEST ['tiempo'] = time();
        $tiempo = $_REQUEST ['tiempo'];
        $atributosGlobales ['tiempo'] = $tiempo;
// 		$atributosGlobales= array_merge($atributosGlobales, $_REQUE);
        // lineas para conectar base de d atos-------------------------------------------------------------------------------------------------
        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $seccion ['tiempo'] = $tiempo;

        // ___________________________________________________________________________________
        // -------------------------------------------------------------------------------------------------

        $cadenaSql = $this->miSql->getCadenaSql('consultarElementoParticular', $_REQUEST ['id_elemento']);
        $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('consultar_traslados', $_REQUEST ['id_elemento']);
        $elemento_traslado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('consultar_estado', $_REQUEST ['id_elemento']);
        $elemento_estado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('consultar_baja', $_REQUEST ['id_elemento']);
        $elemento_baja = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

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
        echo $this->miFormulario->formulario($atributos); {
            // ---------------- SECCION: Controles del Formulario -----------------------------------------------

            $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

            $directorio = $this->miConfigurador->getVariableConfiguracion("host");
            $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
            $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");

            $variable = "pagina=" . $miPaginaActual;
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
            $atributos ["leyenda"] = "Detalle Elemento Placa " . $elemento[0]['placa'];
            echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);
            unset($atributos); {

                $atributos ["id"] = "cargar_elemento";
                $atributos ["estiloEnLinea"] = "display:block";
                $atributos = array_merge($atributos, $atributosGlobales);
                echo $this->miFormulario->division("inicio", $atributos);
                unset($atributos); {

                    $esteCampo = "AgrupacionInformacion";
                    $atributos ['id'] = $esteCampo;
                    $atributos ['leyenda'] = "";
                    echo $this->miFormulario->agrupacion('inicio', $atributos); {

                        $atributos ["id"] = "informacion";
                        $atributos ["estiloEnLinea"] = "display:block";
                        $atributos = array_merge($atributos, $atributosGlobales);
                        echo $this->miFormulario->division("inicio", $atributos);
                        unset($atributos); {

                            // ---------------- CONTROL: Cuadro Lista --------------------------------------------------------

                            $esteCampo = 'perfil';
                            $atributos ['nombre'] = $esteCampo;
                            $atributos ['id'] = $esteCampo;
                            $atributos['imagen'] = $rutaBloque . "/images/prueba.jpg"; //ruta de la imagen (requerido)
                            $atributos['borde'] = 'solid'; //Borde decorativo de la imagen (opcional)
                            $atributos['ancho'] = 150; //Ancho de la imagen (opcional)
                            $atributos['alto'] = 150; //Altura de la imagen (opcional)
                            //$atributos ['columnas'] = 2;
                            $atributos ['tab'] = $tab;
                            $atributos ['estilo'] = 'jqueryui';
                            $atributos ['limitar'] = false;
                            $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                            // Utilizar lo siguiente cuando no se pase un arreglo:
                            // $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
                            // $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
                            $tab ++;
                            $atributos = array_merge($atributos, $atributosGlobales);
                            echo $this->miFormulario->campoImagen($atributos);
                            unset($atributos);
                        }
                        echo $this->miFormulario->agrupacion('fin');
//
//                        $esteCampo = "AgrupacionInformacion";
//                        $atributos ['id'] = $esteCampo;
//                        $atributos ['leyenda'] = "Información Respecto al Elemento";
//                        echo $this->miFormulario->agrupacion('inicio', $atributos); {
//
//
//                            foreach ($elemento[0] as $key => $values) {
//                                if (!is_numeric($key)) {
//                                    $encabezado[$key] = (str_replace("_", " ", $key));
//                                }
//                            }
//
//                            foreach ($elemento[0] as $key => $values) {
//                                if (!is_numeric($key)) {
//                                    //----- CONTROL texto Simple ------------------------
//                                    $esteCampo = $encabezado[$key];
//                                    $atributos ['id'] = $esteCampo;
//                                    $atributos ['nombre'] = $esteCampo;
//                                    $atributos ['tipo'] = 'text';
//                                    $atributos ['estilo'] = 'jquery';
//                                    $atributos ['marco'] = true;
//                                    $atributos ['estiloMarco'] = '';
//                                    $atributos ['texto'] = strtoupper($esteCampo) . " : " . $elemento[0][$key];
//                                    $atributos ["etiquetaObligatorio"] = false;
//                                    $atributos ['columnas'] = 1;
//                                    $atributos ['dobleLinea'] = 0;
//                                    $atributos ['tabIndex'] = $tab;
//                                    $atributos ['validar'] = '';
//                                    // $atributos ['etiqueta'] =$this->lenguaje->getCadena ( $esteCampo."Nota" );
//                                    if (isset($_REQUEST [$esteCampo])) {
//                                        $atributos ['valor'] = $_REQUEST [$esteCampo];
//                                    } else {
//                                        $atributos ['valor'] = '';
//                                    }
//                                    $atributos ['titulo'] = '';
//                                    $atributos ['deshabilitado'] = true;
//                                    $atributos ['tamanno'] = 10;
//                                    $atributos ['maximoTamanno'] = '';
//                                    $atributos ['anchoEtiqueta'] = 10;
//                                    $tab ++;
//
//                                    // Aplica atributos globales al control
//                                    $atributos = array_merge($atributos, $atributosGlobales);
//                                    echo $this->miFormulario->campoTexto($atributos);
//                                    unset($atributos);
//
//                                    //------ Fin CONTROL texto simple -------------------------- //
//                                }
//                            }
//
//                            echo $this->miFormulario->division("fin");
//                        }
                    }
                    echo $this->miFormulario->agrupacion('fin');


                    $esteCampo = "AgrupacionGeneral";
                    $atributos ['id'] = $esteCampo;
                    $atributos ['leyenda'] = "Información Básica";
                    echo $this->miFormulario->agrupacion('inicio', $atributos);
                    {

                        if ($elemento) {
                            echo $this->miFormulario->tablaReporte($elemento);
                        }
                    }

                    echo $this->miFormulario->agrupacion('fin');

                    if ($elemento_traslado != false) {
                        $esteCampo = "AgrupacionGeneral";
                        $atributos ['id'] = $esteCampo;
                        $atributos ['leyenda'] = "Información Traslados";
                        echo $this->miFormulario->agrupacion('inicio', $atributos);
                        {


                            echo $this->miFormulario->tablaReporte($elemento_traslado);
                        }

                        echo $this->miFormulario->agrupacion('fin');
                    }

                    if ($elemento_estado != false) {
                        $esteCampo = "AgrupacionGeneral";
                        $atributos ['id'] = $esteCampo;
                        $atributos ['leyenda'] = "Información Estado ";
                        echo $this->miFormulario->agrupacion('inicio', $atributos);
                        {


                            echo $this->miFormulario->tablaReporte($elemento_estado);
                        }

                        echo $this->miFormulario->agrupacion('fin');
                    }

                    if ($elemento_baja != false) {
                        $esteCampo = "AgrupacionGeneral";
                        $atributos ['id'] = $esteCampo;
                        $atributos ['leyenda'] = "Información Bajas ";
                        echo $this->miFormulario->agrupacion('inicio', $atributos);
                        {


                            echo $this->miFormulario->tablaReporte($elemento_baja);
                        }

                        echo $this->miFormulario->agrupacion('fin');
                    }


                    $esteCampo = "AgrupacionInformacion";
                    $atributos ['id'] = $esteCampo;
                    $atributos ['leyenda'] = "Galería del Elemento";
                    echo $this->miFormulario->agrupacion('inicio', $atributos); {

                        $atributos ["id"] = "informacion";
                        $atributos ["estiloEnLinea"] = "display:block";
                        $atributos = array_merge($atributos, $atributosGlobales);
                        echo $this->miFormulario->division("inicio", $atributos);
                        unset($atributos); {

                            // ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
                            $esteCampo = 'perfil';
                            $atributos ['nombre'] = $esteCampo;
                            $atributos ['id'] = $esteCampo;
                            $atributos['imagen'] = $rutaBloque . "/images/prueba.jpg"; //ruta de la imagen (requerido)
                            $atributos['borde'] = 'solid'; //Borde decorativo de la imagen (opcional)
                            $atributos['ancho'] = 150; //Ancho de la imagen (opcional)
                            $atributos['alto'] = 150; //Altura de la imagen (opcional)
                            //$atributos ['columnas'] = 2;
                            $atributos ['tab'] = $tab;
                            $atributos ['estilo'] = 'jqueryui';
                            $atributos ['limitar'] = true;
                            $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                            // Utilizar lo siguiente cuando no se pase un arreglo:
                            // $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
                            // $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
                            $tab ++;
                            $atributos = array_merge($atributos, $atributosGlobales);
                            echo $this->miFormulario->campoImagen($atributos);
                            unset($atributos);

                            echo $this->miFormulario->division("fin");
                        }
                    }
                    echo $this->miFormulario->agrupacion('fin');
                }
                echo $this->miFormulario->division("fin");



                echo $this->miFormulario->marcoAgrupacion('fin');

                // ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
                // ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
                // Se debe declarar el mismo atributo de marco con que se inició el formulario.
            }

            // -----------------FIN CONTROL: Botón -----------------------------------------------------------
            // ------------------Fin Division para los botones-------------------------
            echo $this->miFormulario->division("fin");

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
            $valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
            $valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
            $valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
            $valorCodificado .= "&opcion=modificar";
            $valorCodificado .= "&id_elemento=" . $_REQUEST ['id_elemento'];

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

            return true;
        }
    }

}

$miSeleccionador = new registrarForm($this->lenguaje, $this->miFormulario, $this->sql);

$miSeleccionador->miForm();
?>
