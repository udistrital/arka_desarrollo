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

                $elemento = $items_contratista[$i]['elemento'];
                //Consultar Elementos Asignados al contratista
                $cadenaSql = $this->miSql->getCadenaSql('consultarAsignacion', $elemento);
                $elementos_contratista = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                $items_contratista [$i]['id_asignacion'] = $elementos_contratista[0][0];
            }
        }

        for ($i = 0; $i <= 200; $i ++) {
            if (isset($_REQUEST ['elementoSupervisor_' . $i])) {
                $items_supervisor[$i]['identificacion'] = $_REQUEST ['elementoSupervisor_' . $i];
                $items_supervisor[$i]['elemento'] = $i;

                $elemento = $items_supervisor[$i]['elemento'];
                //Consultar Elementos Asignados al contratista
                $cadenaSql = $this->miSql->getCadenaSql('consultarAsignacion', $elemento);
                $elementos_supervisor_con = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                $items_supervisor[$i]['id_asignacion'] = $elementos_supervisor_con[0][0];
            }
        }

        if (is_array($items_contratista) && is_array($items_supervisor)) {
            $items_concatenados = array_merge($items_contratista, $items_supervisor);
        } elseif (is_array($items_contratista)) {
            $items_concatenados = $items_contratista;
        } else {
            $items_concatenados = $items_supervisor;
        }


        foreach ($items_concatenados as $key => $values) {

            $datosAsignacion = array(
                $items_concatenados[$key]['identificacion'],
                $supervisor_id,
                $items_concatenados[$key]['elemento'],
                1,
                $fechaActual,
            );

            $datosInactivar = array(
                $items_concatenados[$key]['elemento'],
                0,
                $fechaActual,
            );

            $datosInactivarE = array(
                $items_concatenados[$key]['elemento'],
                FALSE,
                $fechaActual,
            );

            $datosActivar = array(
                $items_concatenados[$key]['elemento'],
                TRUE,
                $fechaActual,
            );

            if ($items_concatenados[$key]['identificacion'] == $supervisor_id) {

                // inactivar el elemento en la asignación
                $cadenaSql = $this->miSql->getCadenaSql('inactivarAsignacion', $datosInactivar);
                $noasignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

                // cambiar estado de asignacion en elementos, reactivar para permitir una nueva asignacion
               $cadenaSql2 = $this->miSql->getCadenaSql('inactivarElemento', $datosInactivarE);
               $reactivar = $esteRecursoDB->ejecutarAcceso($cadenaSql2, "insertar");
            } else {

                // inactivar el elemento en la asignación
                $cadenaSql = $this->miSql->getCadenaSql('inactivarAsignacion', $datosInactivar);
                $noasignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

                // reasginar el elemento en asignación
                $cadenaSql = $this->miSql->getCadenaSql('asignarElemento', $datosAsignacion);
                $asignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");

                $cadenaSql2 = $this->miSql->getCadenaSql('activarElemento', $datosActivar);
                $inactivar = $esteRecursoDB->ejecutarAcceso($cadenaSql2, "insertar");
            }
        }
        
        
        if ($reactivar == true) {
            redireccion::redireccionar('inserto', $supervisor);
        } elseif ($inactivar == true) {
            redireccion::redireccionar('inserto', $supervisor);
        } else {
            redireccion::redireccionar('noInserto', $supervisor);
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