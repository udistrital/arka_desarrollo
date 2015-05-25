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

        if ($_REQUEST['aprobacion'] == 1) {
            //consultar si la vigencia y la entrada existen
            $cadenaSql = $this->miSql->getCadenaSql('registrarCierre', $datosRegistro);
            $estado_asignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");


            $cadenaSql = $this->miSql->getCadenaSql('actualizarEntrada', $datosRegistro);
            $resultadoActualizacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

              $datos = array(
                'vigencia' => $_REQUEST['vigencia'],
                'f_inicio' => $_REQUEST['fecha_inicio'],
                'f_final' => $_REQUEST['fecha_final'],
            );

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