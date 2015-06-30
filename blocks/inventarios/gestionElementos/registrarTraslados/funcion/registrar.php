<?php

namespace inventarios\gestionElementos\registrarTraslados\funcion;

use inventarios\gestionElementos\registrarTraslados\funcion\redireccion;

include_once ('redireccionar.php');

$ruta_1 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel.class.php';
$ruta_2 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel/Reader/Excel2007.class.php';

include_once ($ruta_1);
include_once ($ruta_2);

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorOrden {

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

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $conexion = "sicapital";
        $esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $cadenaSql = $this->miSql->getCadenaSql('funcionario_informacion_fn', $_REQUEST ['responsable_reci']);

        $funcionario_enviar = $esteRecursoDBO->ejecutarAcceso($cadenaSql, "busqueda");

        $fechaActual = date('Y-m-d');
        $elementos_traslado = unserialize(base64_decode($_REQUEST['informacion_elementos']));

        // trasladar cada elementos
        foreach ($elementos_traslado as $key => $values) {

            $datos = array(
                $fechaActual,
                $elementos_traslado[$key]['id'],
                $elementos_traslado[$key]['funcionario'],
                $_REQUEST ['responsable_ante'],
                $_REQUEST ['dependencia']
            );

            $cadenaSql = $this->miSql->getCadenaSql('insertar_historico', $datos);
            $historico = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            if ($historico == false) {
                redireccion::redireccionar('noInserto', false);
            }

            $arreglo_datos = array(
                $elementos_traslado[$key]['id'],
                $_REQUEST ['responsable_reci'],
                $_REQUEST ['observaciones'],
                $_REQUEST ['dependencia']
            );

            $cadenaSql = $this->miSql->getCadenaSql('actualizar_salida', $arreglo_datos);
            $traslado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");

            if ($traslado == false) {
                $cadenaSql = $this->miSql->getCadenaSql('eliminar_historico', $historico[0][0]);
                $historico = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                redireccion::redireccionar('noInserto');
            }
        }

        $cadenaSql = $this->miSql->getCadenaSql('dependencia_nombre', $_REQUEST['dependencia']);
        $dep_nombre = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $datos = array(
            'responsable' => $_REQUEST['responsable_reci'],
            'dependencia' => $dep_nombre[0][0]
        );

        if ($traslado) {
            redireccion::redireccionar('inserto', $datos);
        } else {

            redireccion::redireccionar('noInserto');
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

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>