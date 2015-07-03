<?php

namespace inventarios\cierreContable\funcion;

use inventarios\cierreContable\funcion\redireccion;

include_once ('redireccionar.php');
if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorCierre {

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
        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/";
        $rutaBloque .= $esteBloque ['nombre'];
        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        //Registro del Radicar Asignar entrada de compras
        $datosRegistro = array(
            'fechaRegistro' => $_REQUEST ['fecha_registro'],
            'vigencia' => $_REQUEST ['vigencia'],
            'fecha_inicio' => $_REQUEST ['fecha_inicio'],
            'fecha_final' => $_REQUEST ['fecha_final'],
            'aprobacion' => $_REQUEST ['aprobacion'],
            'observaciones' => $_REQUEST ['observaciones'],
            'estado' => 1,
        );

        $datos = array(
            'vigencia' => $_REQUEST['vigencia'],
            'f_inicio' => $_REQUEST['fecha_inicio'],
            'f_final' => $_REQUEST['fecha_final'],
        );

        $anno_i = date("Y", strtotime($_REQUEST['fecha_inicio']));
        $anno_f = date("Y", strtotime($_REQUEST['fecha_final']));

        if (isset($_REQUEST['vigencia']) && $_REQUEST['vigencia'] != '' && isset($_REQUEST['fecha_inicio']) && $_REQUEST['fecha_inicio'] != '') {
            if ($anno_i != $_REQUEST['vigencia'] || $anno_f != $_REQUEST['vigencia']) {
                redireccion::redireccionar('noCoincide', $datos);
            }
        }


        if ($_REQUEST['aprobacion'] == 1) {

            //consultar si la vigencia y la entrada existen
            $cadenaSql = $this->miSql->getCadenaSql('registrarCierre', $datosRegistro);
            $estado_asignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            $datosRegistro2 = array(
                'fecha_inicio' => $_REQUEST ['fecha_inicio'],
                'fecha_final' => $_REQUEST ['fecha_final'],
                'vigencia' => $_REQUEST ['vigencia'],
                'estado' => 1,
                'id_cierre' => $estado_asignar[0][0]
            );

            if ($estado_asignar == false) {
                redireccion::redireccionar('noInserto', $datos);
            }

            $cadenaSql = $this->miSql->getCadenaSql('actualizarEntrada', $datosRegistro2);
            $resultadoActualizacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

            if ($resultadoActualizacion == FALSE) {
                $cadenaSql = $this->miSql->getCadenaSql('eliminarCierre', $estado_asignar[0][0]);
                $rollCierre = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

                redireccion::redireccionar('inserto', $datos);
            }

            if ($estado_asignar == true && $resultadoActualizacion == true) {
                redireccion::redireccionar('inserto', $datos);
            } else {
                redireccion::redireccionar('noInserto', $datos);
            }
        } else {
            $datos = array(
                'vigencia' => $_REQUEST['vigencia'],
                'f_inicio' => $_REQUEST['fecha_inicio'],
                'f_final' => $_REQUEST['fecha_final'],
            );
            redireccion::redireccionar('noAprobo', $datos);
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

$miRegistrador = new RegistradorCierre($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>