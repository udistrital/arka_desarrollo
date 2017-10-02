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

        $arreglo = unserialize($_REQUEST['arreglo']);
        $arrayElementos = explode(",", $_REQUEST['variablesIdElemento']);
        $arrayCantidades = explode(",", $_REQUEST['variablesCant']);
       

        $cadenaSql = $this->miSql->getCadenaSql('consultarElementosInd', $arreglo['id_elemento']);
        $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $auxiliar = 0;
        $contadorCantidad = 0;

        while ($auxiliar < count($elemento)) {

            $numero_cambios = count($arrayElementos) - 1;
            $auxiliar2 = 0;
            $contadorCantidad = $elemento[$auxiliar]['cantidad_asignada'] + $contadorCantidad;

            while ($auxiliar2 < $numero_cambios) {
                if ($arrayElementos[$auxiliar2] == $elemento[$auxiliar]['id_elemento_ind']) {
                    $contadorCantidad = $contadorCantidad - $elemento[$auxiliar]['cantidad_asignada'];
                    $contadorCantidad = $arrayCantidades[$auxiliar2] + $contadorCantidad;
                }
                $auxiliar2++;
            }



            $auxiliar++;
        }

        if ($contadorCantidad <= $arreglo['cantidad']) {

            $cadenaSql = $this->miSql->getCadenaSql('insertarAjusteDocumento', $arreglo);
            $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
            $auxiliar3 = 0;


            while ($auxiliar3 < (count($arrayElementos) - 1)) {

                if ($arrayCantidades[$auxiliar3] <= 0) {
                  
                    $cadenaSql = $this->miSql->getCadenaSql('eliminarElementoInd', $arrayElementos[$auxiliar3]);
                    $elemento_insertado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
          
                } else {
                    $arregloInsercion = array(
                        'id_elemento' => $arrayElementos[$auxiliar3],
                        'cantidad' => $arrayCantidades[$auxiliar3]
                    );
                    $cadenaSql = $this->miSql->getCadenaSql('actualizarElementoInd', $arregloInsercion);
                    $elemento_insertado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
               
                }
                 

                $cadenaSql = $this->miSql->getCadenaSql('actualizarElementoGen', $arreglo);
                $elemento_general = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
            
                $auxiliar3++;
            }

            $this->miConfigurador->setVariableConfiguracion("cache", true);
            redireccion::redireccionar('actualizaElemento', $arreglo);
            exit();
        } else {
            redireccion::redireccionar('noModifica', $arreglo);
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