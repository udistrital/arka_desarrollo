<?php

$ruta_1 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel.class.php';
$ruta_2 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel/Reader/Excel2007.class.php';

include_once ($ruta_1);
include_once ($ruta_2);

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
        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/gestionElementos/" . $esteBloque ['nombre'];

        $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

        $directorio = $this->miConfigurador->getVariableConfiguracion("host");
        $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
        $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");


        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionElementos/";
        $rutaBloque .= $esteBloque ['nombre'];
        $fechaActual = date('Y-m-d');
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



        if ($_REQUEST['tipo_registro'] == '1') {


            if (isset($_REQUEST ['responsable']) && $_REQUEST ['responsable'] != '') {
                $funcionario = $_REQUEST ['responsable'];
            } else {
                $funcionario = '';
            }

            if (isset($_REQUEST ['placa']) && $_REQUEST ['placa'] != '') {
                $placa = $_REQUEST ['placa'];
            } else {
                $placa = '';
            }

            if (isset($_REQUEST ['serial']) && $_REQUEST ['serial'] != '') {
                $serial = $_REQUEST ['serial'];
            } else {
                $serial = '';
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
                'serie' => $serial,
                'placa' => $placa,
                'dependencia' => $dependencia,
                'ubicacion' => $ubicacion,
                'sede' => $sede
            );
            $cadenaSql = $this->miSql->getCadenaSql('consultarElemento', $arreglo);

            $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        }

        if ($_REQUEST['tipo_registro'] == '2') {
            $ruta_eliminar_xlsx = $rutaBloque . "/archivo/*.xlsx";

            $ruta_eliminar_xls = $rutaBloque . "/archivo/*.xls";

            foreach (glob($ruta_eliminar_xlsx) as $filename) {
                unlink($filename);
            }
            foreach (glob($ruta_eliminar_xls) as $filename) {
                unlink($filename);
            }
            $i = 0;

            foreach ($_FILES as $key => $values) {

                $archivo [$i] = $_FILES [$key];
                $i ++;
            }

            $archivo = $archivo [0];

            $trozos = explode(".", $archivo ['name']);
            $extension = end($trozos);

            if ($extension == 'xlsx' || $extension == 'xls') {
                if ($archivo) {
                    // obtenemos los datos del archivo
                    $tamano = $archivo ['size'];
                    $tipo = $archivo ['type'];
                    $archivo1 = $archivo ['name'];
                    $prefijo = "archivo";

                    if ($archivo1 != "") {
                        // guardamos el archivo a la carpeta files
                        $ruta_absoluta = $rutaBloque . "/archivo/" . $prefijo . "_" . $archivo1;

                        if (copy($archivo ['tmp_name'], $ruta_absoluta)) {
                            $status = "Archivo subido: <b>" . $archivo1 . "</b>";
                            $destino1 = $host . "/archivo/" . $prefijo . "_" . $archivo1;
                        } else {
                            $status = "Error al subir el archivo";
                            echo $status;
                        }
                    } else {
                        $status = "Error al subir archivo";
                        echo $status;
                    }

                    $arreglo = array(
                        $destino1,
                        $archivo1
                    );

                    if (file_exists($ruta_absoluta)) {

                        $objReader = new \PHPExcel_Reader_Excel2007 ();

                        $objPHPExcel = $objReader->load($ruta_absoluta);

                        $objFecha = new \PHPExcel_Shared_Date ();

                        $objPHPExcel->setActiveSheetIndex(0);

                        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

                        $highestRow = $objWorksheet->getHighestRow();
                    }

                    for ($aux = 2; $aux <= $highestRow; $aux ++) {
                        $validacion = 'si';
                        $placas [$aux] = $objPHPExcel->getActiveSheet()->getCell('A' . $aux)->getCalculatedValue();

                        if (is_null($placas [$aux]) == true) {
                            //ESCAPE PARA PLACAS NULAS
//                        // ------------------- SECCION: Paso de variables ------------------------------------------------
                            $validacion = 'nulo';

                            break;
                        }
                        $cadenaSql = $this->miSql->getCadenaSql('verificar_elemento_funcionario', $placas [$aux], $_REQUEST['funcionario_origen']);
                        $existencia = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


                        if ($existencia == false) {

                            $validacion = 'noplaca';
                            $placa_error= $placas[$aux];

                            //ESCAPE POR INEXITENCIA DE PLACA EN EL INVENTARIO DEL FUNCIONARIO DE ORIGEN


                            break;
                        }
                    }
                }
            }
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
        $atributos ['marco'] = true;
        $tab = 1;
        // ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
        // ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
        $atributos ['tipoEtiqueta'] = 'inicio';
        echo $this->miFormulario->formulario($atributos);
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
        $atributos ["leyenda"] = "Consultar Elementos";
        echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);

        $esteCampo = "AgrupacionInformacion";
        $atributos ['id'] = $esteCampo;
        $atributos ['leyenda'] = "Información Referente a Elementos";
        echo $this->miFormulario->agrupacion('inicio', $atributos);

        if ($_REQUEST['tipo_registro'] == '1') {



            if ($elemento) {


                $esteCampo = "selecc_registros";
                $atributos ['nombre'] = $esteCampo;
                $atributos ['id'] = $esteCampo;
                $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                $atributos ["etiquetaObligatorio"] = false;
                $atributos ['tab'] = $tab++;
                $atributos ['seleccion'] = 0;
                $atributos ['anchoEtiqueta'] = 150;
                $atributos ['evento'] = '';
                if (isset($_REQUEST [$esteCampo])) {
                    $atributos ['valor'] = $_REQUEST [$esteCampo];
                } else {
                    $atributos ['valor'] = '';
                }
                $atributos ['deshabilitado'] = false;
                $atributos ['columnas'] = 2;
                $atributos ['tamanno'] = 1;
                $atributos ['ajax_function'] = "";
                $atributos ['ajax_control'] = $esteCampo;
                $atributos ['estilo'] = "jqueryui";
                $atributos ['validar'] = "required";
                $atributos ['limitar'] = true;
                $atributos ['anchoCaja'] = 24;
                $atributos ['miEvento'] = '';
                // $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "estado_entrada" );
                $matrizItems = array(
                    array(
                        '0',
                        'Ningun Registro'
                    ),
                    array(
                        '1',
                        'Todos Registros'
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

                echo "<table id='tablaTitulos'>";

                echo "<thead>
                <tr>
                    <th># Número<br>Placa</th>
                    <th>Descripción<br>Elemento</th>
                    <th>Sede</th>
                    <th>Dependencia</th>
		    <th>Ubicación<br>Especifica</th>
                    <th>Nombre<br>Funcionario</th>
		    <th>Identificación<br>Funcionario</th>
                    <th>Tipo<br>Bien</th>
		    <th>Trasladar<br>Elemento</th>
                </tr>
            </thead>
            <tbody>";

                for ($i = 0; $i < count($elemento); $i++) {

// 				$cadenaSql = $this->miSql->getCadenaSql ( 'funcionario_informacion', $elemento [$i] [3] );
// 				$funcionario = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );

                    $mostrarHtml = "<tr>
                    <td><center>" . $elemento [$i] [1] . "</center></td>
                    <td><center>" . $elemento [$i] ['descripcion_elemento'] . "</center></td>
                    <td><center>" . $elemento [$i] ['sede'] . "</center></td>
                    <td><center>" . $elemento [$i] ['dependencia'] . "</center></td>
                    <td><center>" . $elemento [$i] ['espacio'] . "</center></td>
                    <td><center>" . $elemento [$i] ['nom_funcionario'] . "</center></td>
                    <td><center>" . $elemento [$i] ['iden_funcionario'] . "</center></td>
                    <td><center>" . $elemento [$i] [6] . "</center></td>
                           <td><center>";
                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $nombre = 'item_' . $i;
                    $atributos ['id'] = $nombre;
                    $atributos ['nombre'] = $nombre;
                    $atributos ['marco'] = true;
                    $atributos ['estiloMarco'] = true;
                    $atributos ["etiquetaObligatorio"] = true;
                    $atributos ['columnas'] = 1;
                    $atributos ['dobleLinea'] = 1;
                    $atributos ['tabIndex'] = $tab;
                    $atributos ['etiqueta'] = '';
                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['valor'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['valor'] = $elemento [$i] [0];
                    }

                    $atributos ['deshabilitado'] = false;
                    $tab++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    $mostrarHtml .= $this->miFormulario->campoCuadroSeleccion($atributos);

                    $mostrarHtml .= "</center></td>
                    </tr>";
                    echo $mostrarHtml;
                    unset($mostrarHtml);
                    unset($atributos);
                }

                echo "</tbody>";

                echo "</table>";
                echo $this->miFormulario->marcoAgrupacion('fin');
                // ------------------Division para los botones-------------------------
                $atributos ["id"] = "botones";
                $atributos ["estilo"] = "marcoBotones";
                echo $this->miFormulario->division("inicio", $atributos);

                // -----------------CONTROL: Botón ----------------------------------------------------------------
                $esteCampo = 'botonAceptar';
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
                $tab++;

                // Aplica atributos globales al control
                $atributos = array_merge($atributos, $atributosGlobales);
                echo $this->miFormulario->campoBoton($atributos); // -----------------FIN CONTROL: Botón -----------------------------------------------------------

                echo $this->miFormulario->division('fin');



                // ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
                // ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
                // Se debe declarar el mismo atributo de marco con que se inició el formulario.
                // -----------------FIN CONTROL: Botón -----------------------------------------------------------
                // ------------------Fin Division para los botones-------------------------
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
                $valorCodificado .= "&opcion=trasladarElemento";
                $valorCodificado .= "&forma_carga=unico";
                $valorCodificado .= "&funcionario=" . $_REQUEST ['responsable'];
                $valorCodificado .= "&usuario=" . $_REQUEST['usuario'];

                /*
                 * supervisor
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
            } else {

                $opc = 0;

                $cadenaSql = $this->miSql->getCadenaSql('consultarElementoID', $placa);
                $elemento_id = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                $elemento_individual = (int) $elemento_id[0][0];

                $cadenaSql = $this->miSql->getCadenaSql('consultarElementoBaja', $elemento_id[0][0]);
                $baja_elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                if (!empty($baja_elemento)) {
                    $mensaje = "Elemento en estado<br>Solicitud de Baja.";

                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'mensajeRegistro';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['tipo'] = 'error';
                    $atributos ['estilo'] = 'textoCentrar';
                    $atributos ['mensaje'] = $mensaje;

                    $tab++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->cuadroMensaje($atributos);
                    $opc = 1;
                }

                $cadenaSql = $this->miSql->getCadenaSql('consultarElementoEstado', $elemento_id[0][0]);
                $estado_elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                if (!empty($estado_elemento)) {
                    $mensaje = "Elemento en estado<br>Faltante.";

                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'mensajeRegistro';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['tipo'] = 'error';
                    $atributos ['estilo'] = 'textoCentrar';
                    $atributos ['mensaje'] = $mensaje;

                    $tab++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->cuadroMensaje($atributos);
                    $opc = 1;
                }

                if ($opc == 0) {
                    $mensaje = "Elemento no encontrado<br>para traslados.";

                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'mensajeRegistro';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['tipo'] = 'error';
                    $atributos ['estilo'] = 'textoCentrar';
                    $atributos ['mensaje'] = $mensaje;

                    $tab++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->cuadroMensaje($atributos);
                }

                // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
            }
        }


        if ($_REQUEST['tipo_registro'] == '2') {



            if ($validacion == 'noplaca') {
                $mensaje = "No se puede realizar el cargue masivo<br>la placa: ".$placa_error. "<br>No pertenece al funcionario especificado.";

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


              
            }

            if ($validacion == 'nulo') {
                
                $mensaje = "No se puede realizar el cargue masivo <br> Revise que no hayan campos vacios intermedios";

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
                
            }

            if ($validacion == 'si') {



                $mensaje = "Se Carga satisfactoriamente el archivo<br>";

                // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                $esteCampo = 'mensajeRegistro';
                $atributos ['id'] = $esteCampo;
                $atributos ['tipo'] = 'success';
                $atributos ['estilo'] = 'textoCentrar';
                $atributos ['mensaje'] = $mensaje;

                $tab ++;

                // Aplica atributos globales al control
                $atributos = array_merge($atributos, $atributosGlobales);
                echo $this->miFormulario->cuadroMensaje($atributos);
                // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------

                $atributos ["id"] = "botones";
                $atributos ["estilo"] = "marcoBotones";
                echo $this->miFormulario->division("inicio", $atributos);

                // -----------------CONTROL: Botón ----------------------------------------------------------------
                $esteCampo = 'botonAceptar';
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
                $tab++;

                // Aplica atributos globales al control
                $atributos = array_merge($atributos, $atributosGlobales);
                echo $this->miFormulario->campoBoton($atributos); // -----------------FIN CONTROL: Botón -----------------------------------------------------------

                echo $this->miFormulario->division('fin');



                // ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
                // ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
                // Se debe declarar el mismo atributo de marco con que se inició el formulario.
                // -----------------FIN CONTROL: Botón -----------------------------------------------------------
                // ------------------Fin Division para los botones-------------------------
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
                $valorCodificado .= "&opcion=trasladarElemento";
                $valorCodificado .= "&forma_carga=masivo";
                $valorCodificado .= "&placas=" . serialize($placas);
                $valorCodificado .= "&funcionario=" . $_REQUEST['funcionario_origen'];
                $valorCodificado .= "&usuario=" . $_REQUEST['usuario'];

                /*
                 * supervisor
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
        echo $this->miFormulario->agrupacion('fin');

        echo $this->miFormulario->marcoAgrupacion('fin');

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
        $valorCodificado .= "&opcion=regresar";
        $valorCodificado .= "&redireccionar=regresar";

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
