<?php

namespace inventarios\asignarInventarioC\consultarAsignacion\funcion;

use inventarios\asignarInventarioC\consultarAsignacion\funcion\redireccion;

include_once ('redireccionar.php');
if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorActa {

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

        $fechaActual = date('Y-m-d');

        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionActa/";
        $rutaBloque .= $esteBloque ['nombre'];
        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/gestionActa/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $variables = array(
            $_REQUEST['supervisor'],
            $_REQUEST['contratista'],
        );
        //Consultar Elementos Asignados al contratista
        $cadenaSql = $this->miSql->getCadenaSql('consultarElementosContratista', $variables);
        $elementos_contratista = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        //COnsultar Elementos del supervisor para asignarlos al contratista
        $cadenaSql = $this->miSql->getCadenaSql('consultarElementosSupervisor', $variables);
        $elementos_supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        var_dump($elementos_supervisor);
        exit;
        //recuperar datos de la asignacion
        $datos = array(
            $_REQUEST ['contratista'],
            $_REQUEST ['supervisor'],
        );
        // asociar super-cont-item

        for ($i = 0; $i <= 200; $i ++) {
            if (isset($_REQUEST ['item' . $i])) {
                $items [] = $_REQUEST ['item' . $i];
            }
        }

        //items que tiene el supervisor 
        for ($i = 0; $i <= 200; $i ++) {
            if (isset($elementos_supervisor[11])) {
                $items_supervisor ['id_item'] = $elementos_supervisor[0][11];
                $items_supervisor ['estado'] = $elementos_supervisor[0][11];
            }
        }

        //comparar el cambio de estado
        foreach ($items as $key => $values) {
            
        }


        foreach ($items as $key => $values) {

            $datosAsignacion = array(
                $_REQUEST ['contratista'],
                $_REQUEST ['supervisor'],
                $items[$key],
                1,
                $fechaActual,
            );

            $datosInactivar = array(
                $items[$key],
                0,
                $fechaActual,
            );

            //Asignar elementos
            $cadenaSql = $this->miSql->getCadenaSql('asignarElemento', $datosAsignacion);
            $asignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

            //Inhabilitar elementos            
            $cadenaSql2 = $this->miSql->getCadenaSql('inactivarElemento', $datosInactivar);
            $inactivar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");
        }


        //inactivar item para asignar
        if ($asignar == true) {
            redireccion::redireccionar('inserto', $datos);
        } else {
            redireccion::redireccionar('noInserto', $datos);
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

$miRegistrador = new RegistradorActa($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>