<?php

namespace inventarios\gestionBodega\registroBodega\funcion;

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


        if ($_REQUEST['btnAceptar'] == 'true') {

            $count = 0;

            $arrayElementos = explode(",", $_REQUEST['variables']);
            $arrayVigencias = explode(",", $_REQUEST['vigencias']);



            while ($count < (count($arrayElementos) - 1)) {

                $arreglo = array(
                    'entrada' => $arrayElementos[$count],
                    'vigencia' => $arrayVigencias[$count]
                );

                $cadenaSql = $this->miSql->getCadenaSql("consultarElementos", $arreglo);
                $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");



                $auxArreglo = 0;

                while ($auxArreglo < count($elemento)) {
                    $cadenaSql = $this->miSql->getCadenaSql("consultarElementosIndividuales", $elemento[$auxArreglo]['id_elemento']);
                    $elementoIndividual = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                    $arreglo2 = array(
                        'id_elemento' => $elemento[$auxArreglo]['id_elemento'],
                        'fecha' => $fechaActual,
                        'usuario' => $_REQUEST ['usuario']
                    );

                    $cadenaSql = $this->miSql->getCadenaSql("insertarElementosBodega", $arreglo2, $elementoIndividual);
                    $insercion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
                    
                    $auxArreglo++;
                }


//            $cadenaSql = $this->miSql->getCadenaSql("consultarElementosIndividuales", $arrayElementos[$count]);
//            $elementoIndividual = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
//
//
//            $arreglo = array(
//                'id_elemento' => $arrayElementos[$count],
//                'fecha' => $fechaActual,
//                'usuario' => $_REQUEST ['usuario']
//            );
//
//            $cadenaSql = $this->miSql->getCadenaSql("insertarElementosBodega", $arreglo, $elementoIndividual);
//            $insercion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");

                $count++;
            }
        }
        if ($_REQUEST['btnCancelar'] == 'true') {
            $insercion = false;
        }

        if ($insercion) {
            $this->miConfigurador->setVariableConfiguracion("cache", true);
            redireccion::redireccionar('inserto', $_REQUEST['usuario']);
            exit();
        } else {

            redireccion::redireccionar('noInserto', $_REQUEST['usuario']);
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