<?php

namespace inventarios\gestionDocumento\ajusteDocumento\funcion;

//use inventarios\gestionElementos\registrarBajas\funcion\redireccion;

include_once ('redireccionar.php');

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorBodega {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;

    function __construct($lenguaje, $sql, $funcion) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
    }

    function procesarFormulario() {



        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionElementos/";
        $rutaBloque .= $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $fechaActual = date('Y-m-d');
        $insercion = false;

        if ($_REQUEST['botonAceptarMod'] == 'true') {

            $cadenaSql = $this->miSql->getCadenaSql('consultarElementosxDocumentoID', $_REQUEST['id_elemento']);
            $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            $arreglo = array(
                'id_elemento' => $_REQUEST ['id_elemento'],
                'cantidad' => $_REQUEST ['cantidad'],
                'unidad' => $_REQUEST ['unidad'],
                'valor' => $_REQUEST ['valor'],
                'iva' => $_REQUEST ['iva'],
                'nombre_iva' => $elemento[0] ['nombre_iva'],
                'usuario' => $_REQUEST ['usuario'],
                'descripcion' => $elemento [0]['descripcion'],
                'variables' => $_REQUEST['variables'],
                'vigencias' => $_REQUEST['vigencia'],
                'fecha' => $fechaActual
            );


            if (($elemento[0]['cantidad'] == $_REQUEST['cantidad']) && (($elemento[0]['valor'] != $_REQUEST['valor']) || ($elemento[0]['iva'] != $_REQUEST['iva']))) {

                $cadenaSql = $this->miSql->getCadenaSql('insertarAjusteDocumento', $arreglo);
                $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
                $this->miConfigurador->setVariableConfiguracion("cache", true);
                redireccion::redireccionar('insertaDocumento', $arreglo);
                exit();
            }

            if (($elemento[0]['cantidad'] != $_REQUEST['cantidad'])) {

                if ($elemento[0]['cantidad'] < $_REQUEST['cantidad']) {


                    $cadenaSql = $this->miSql->getCadenaSql('insertarAjusteDocumento', $arreglo);
                    $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
                    $this->miConfigurador->setVariableConfiguracion("cache", true);
                    redireccion::redireccionar('insertaDocumento', $arreglo);
                    exit();
                } else {


                    $cadenaSql = $this->miSql->getCadenaSql('consultarCantidadElementosxID', $_REQUEST['id_elemento']);
                    $elemento_id = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                    if (($elemento[0]['cantidad'] - $elemento_id[0][0]) <= $_REQUEST['cantidad']) {



                        $cadenaSql = $this->miSql->getCadenaSql('insertarAjusteDocumento', $arreglo);
                        $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
                        $this->miConfigurador->setVariableConfiguracion("cache", true);
                        redireccion::redireccionar('insertaDocumento', $arreglo);
                        exit();
                    } else {

                        $arreglo = array(
                            'id_elemento' => $_REQUEST ['id_elemento'],
                            'cantidad' => $_REQUEST ['cantidad'],
                            'unidad' => $_REQUEST ['unidad'],
                            'valor' => $_REQUEST ['valor'],
                            'iva' => $_REQUEST ['iva'],
                            'nombre_iva' => $elemento[0] ['nombre_iva'],
                            'usuario' => $_REQUEST ['usuario'],
                            'descripcion' => $elemento [0]['descripcion'],
                            'variables' => $_REQUEST['variables'],
                            'vigencias' => $_REQUEST['vigencia'],
                            'diferencia' => $elemento[0]['cantidad'] - $elemento_id[0][0],
                            'fecha' => $fechaActual
                        );

                        $this->miConfigurador->setVariableConfiguracion("cache", true);
                        redireccion::redireccionar('RevisionElementosDocumento', $arreglo);
                    }
                }
            } else {
               
                redireccion::redireccionar('noModifica',  $arreglo);
                exit();
            }

            $insercion = true;
        }
        if ($_REQUEST['botonCancelarMod'] == 'true') {
            $insercion = false;
            redireccion::redireccionar('noModifica', $_REQUEST['usuario']);
            exit();
        }

        if ($insercion == false) {
            redireccion::redireccionar('noModifica', $_REQUEST['usuario']);
            exit();
        }
    }

    function resetForm() {
        foreach ($_REQUEST as $clave => $valor) {

            if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
                unset($_REQUEST [$clave]);
            }
        }
    }

}

$miRegistrador = new RegistradorBodega($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>