<?php

namespace inventarios\gestionElementos\revivirElemento\funcion;

use inventarios\gestionElementos\revivirElemento\funcion\redireccion;

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

        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionElementos/";
        $rutaBloque .= $esteBloque ['nombre'];

        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/gestionElementos/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $fechaActual = date('Y-m-d');

        $seleccion = unserialize(base64_decode($_REQUEST ['elemento']));



        $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("consultarElementosRevivirBaja", $seleccion);
        $Baja = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");


        $actualizacion = false;

        if ($Baja == false) {

            $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("consultarElementosRevivirFaltante", $seleccion);
            $Faltante = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");



            if ($Faltante != false) {

                $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("eliminarEstado", $seleccion['id_elemento_ind']);
                $eliminar_estado = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "acceso");

                $arreglo = array(
                    'id_elemento' => (int) $seleccion['id_elemento_ind'],
                    'tipo' => 'faltante',
                    'fecha' => $fechaActual,
                    'observacion' => $_REQUEST['observaciones_entrada'],
                    'usuario' => $_REQUEST['usuario']
                );

                $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("insertar_historico_revivir", $arreglo);
                $insertar_historico = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "acceso");

                $arreglo_fun = array(
                    'funcionario' => (int) $_REQUEST['funcionario'],
                    'placa' => $seleccion['placa'],
                    'ubicacion' => $_REQUEST['ubicacion_fun']
                );
                $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("actualizar_estado", $arreglo_fun);
                $actualizacion = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "acceso");

                $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("actualizar_funcionario", $arreglo_fun);
                $actualizacion = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "acceso");
            }
        } else {

            $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("eliminarBaja", $seleccion['id_elemento_ind']);
            $eliminar_baja = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "acceso");

            $arreglo = array(
                'id_elemento' => (int) $seleccion['id_elemento_ind'],
                'tipo' => 'baja',
                'fecha' => $fechaActual,
                'observacion' => $_REQUEST['observaciones_entrada'],
                'usuario' => $_REQUEST['usuario']
            );

            $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("insertar_historico_revivir", $arreglo);
            $insertar_historico = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "acceso");

            $arreglo_fun = array(
                'funcionario' => (int) $_REQUEST['funcionario'],
                'placa' => $seleccion['placa'],
                'ubicacion' => $_REQUEST['ubicacion_fun']
            );

            $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("actualizar_funcionario", $arreglo_fun);
            $actualizacion = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "acceso");
        }



        if ($actualizacion == true) {
            redireccion::redireccionar('inserto', $seleccion);
        } else {
            redireccion::redireccionar('noInserto', $_REQUEST['usuario']);
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