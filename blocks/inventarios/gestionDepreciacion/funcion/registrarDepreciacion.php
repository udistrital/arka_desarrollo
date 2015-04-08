<?php

namespace inventarios\gestionDepreciacion\funcion;

use inventarios\gestionDepreciacion\funcion\redireccion;

include_once ('redireccionar.php');
if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorDepreciacion {

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

        // Organizar contenido del registro
        $datos_depreciacion = array(
            'elemento_general' => (isset($_REQUEST['elemento_general']) ? $_REQUEST['elemento_general'] : ''),
            'grupo_contable' => (isset($_REQUEST['grupo_contable']) ? $_REQUEST['grupo_contable'] : ''),
            'meses_depreciar' => (isset($_REQUEST['meses_depreciar']) ? $_REQUEST['meses_depreciar'] : ''),
            'fechaSalida' => (isset($_REQUEST['fechaSalida']) ? $_REQUEST['fechaSalida'] : ''),
            'fechaCorte' => (isset($_REQUEST['fechaCorte']) ? $_REQUEST['fechaCorte'] : ''),
            'cantidad' => (isset($_REQUEST['cantidad']) ? $_REQUEST['cantidad'] : ''),
            'precio' => number_format((float) (isset($_REQUEST['precio']) ? $_REQUEST['precio'] : ''), 2, '.', ''),
            'valor_historico' => number_format((float) (isset($_REQUEST['valor_historico']) ? $_REQUEST['valor_historico'] : ''), 2, '.', ''),
            'valor_ajustado' => number_format((float) (isset($_REQUEST['valor_ajustado']) ? $_REQUEST['valor_ajustado'] : ''), 2, '.', ''),
            'cuota' => number_format((float) (isset($_REQUEST['cuota']) ? $_REQUEST['cuota'] : ''), 2, '.', ''),
            'periodos_fecha' => (isset($_REQUEST['periodos_fecha']) ? $_REQUEST['periodos_fecha'] : ''),
            'depreciacion_acumulada' => number_format((float) (isset($_REQUEST['depreciacion_acumulada']) ? $_REQUEST['depreciacion_acumulada'] : ''), 2, '.', ''),
            'circular_56' => number_format((float) (isset($_REQUEST['circular_56']) ? $_REQUEST['circular_56'] : ''), 2, '.', ''),
            'cuota_inflacion' => number_format((float) (isset($_REQUEST['cuota_inflacion']) ? $_REQUEST['cuota_inflacion'] : ''), 2, '.', ''),
            'api_acumulada' => number_format((float) (isset($_REQUEST['api_acumulada']) ? $_REQUEST['api_acumulada'] : ''), 2, '.', ''),
            'circular_depreciacion' => number_format((float) (isset($_REQUEST['circular_depreciacion']) ? $_REQUEST['circular_depreciacion'] : ''), 2, '.', ''),
            'valor_libros' => number_format((float) (isset($_REQUEST['valor_libros']) ? $_REQUEST['valor_libros'] : ''), 2, '.', ''),
            'estado' => TRUE,
            'fregistro' => $fechaActual,
        );


        $cadenaSql = $this->miSql->getCadenaSql('registrarDepreciacion', $datos_depreciacion);
        $registro_depreciacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "insertar");


        $datos = array(
            'elemento_general' => (isset($_REQUEST['elemento_general']) ? $_REQUEST['elemento_general'] : ''),
        );
        //inactivar item para asignar
        if ($registro_depreciacion == true) {
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

$miRegistrador = new RegistradorDepreciacion($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>