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


        //Consultar Elementos Asignados al contratista
        $cadenaSql = $this->miSql->getCadenaSql('consultarElementosContratista', $variables);
        $elementos_contratista = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        //recuperar datos de la asignacion
        $supervisor = $_REQUEST ['supervisor'];
        $cadenaSql = $this->miSql->getCadenaSql('consultarID', $supervisor);
        $supervisor_id1 = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $supervisor_id = $supervisor_id1[0][0];

        // asociar super-cont-item

        for ($i = 0; $i <= 200; $i ++) {
            if (isset($_REQUEST ['elementoContratista_' . $i])) {
                $items_contratista [$i]['identificacion'] = $_REQUEST ['elementoContratista_' . $i];
                $items_contratista [$i]['elemento'] = $i;
            }
        }

        for ($i = 0; $i <= 200; $i ++) {
            if (isset($_REQUEST ['elementoSupervisor_' . $i])) {
                $items_supervisor [$i]['identificacion'] = $_REQUEST ['elementoSupervisor_' . $i];
                $items_supervisor[$i]['elemento'] = $i;
            }
        }

        $items_concatenados = array_merge($items_contratista, $items_supervisor);

        foreach ($items_concatenados as $key => $values) {

            $datosAsignacion = array(
                $items_concatenados[$key]['identificacion'],
                $_REQUEST ['supervisor'],
                $items_concatenados[$key]['item'],
                1,
                $fechaActual,
            );

            $datosInactivar = array(
                $items_concatenados[$key]['item'],
                TRUE,
                $fechaActual,
            );

            if ($items_concatenados[$key]['identificacion'] == $supervisor_id1) {
                
                
            } else {
                $cadenaSql = $this->miSql->getCadenaSql('asignarElemento', $datosAsignacion);
                $asignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

                $cadenaSql2 = $this->miSql->getCadenaSql('inactivarElemento', $datosInactivar);
                $inactivar = $esteRecursoDB->ejecutarAcceso($cadenaSql2, "insertar");
            }
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