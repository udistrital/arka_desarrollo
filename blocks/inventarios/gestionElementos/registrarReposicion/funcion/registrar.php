<?php

namespace inventarios\gestionElementos\registrarReposicion\funcion;

use inventarios\gestionElementos\registrarReposicion\funcion\redireccion;

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

        var_dump($_REQUEST);
        exit;
        $elementos = unserialize($_REQUEST['items']);

        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionElementos/";
        $rutaBloque .= $esteBloque ['nombre'];

        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/gestionElementos/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $fechaActual = date('Y-m-d');

        //Registrar la Entrada Nueva
        $arreglo_clase = array(
            $observacion = 'NULL',
            $elemento['entrada'],
            $elemento['salida'],
            $elemento['baja'],
            0,
            0,
            'NULL',
            'NULL'
        );

        $cadenaSql = $this->miSql->getCadenaSql('insertarInformación', $arreglo_clase);
        $info_clase = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('idMaximoEntrada');
        $idEntradamax = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $idEntradamax = $idEntradamax[0][0] + 1;

        $fechaActual = date('Y-m-d');
        $anio_vigencia = date('Y');

        $arregloDatos = array(
            $fechaActual,
            $anio_vigencia,
            1,
            $info_clase [0] [0],
            ($_REQUEST ['tipo_contrato'] != '') ? $_REQUEST ['tipo_contrato'] : 0,
            ($_REQUEST ['numero_contrato'] != '') ? $_REQUEST ['numero_contrato'] : 0,
            ($_REQUEST ['fecha_contrato'] != '') ? $_REQUEST ['fecha_contrato'] : '0001-01-01',
            ($_REQUEST ['proveedor'] != '') ? $_REQUEST ['proveedor'] : 0,
            ($_REQUEST ['numero_factura'] != '') ? $_REQUEST ['numero_factura'] : 0,
            ($_REQUEST ['fecha_factura'] != '') ? $_REQUEST ['fecha_factura'] : '0001-01-01',
            $_REQUEST ['observaciones_entrada'],
            (isset($_REQUEST ['acta_recibido']) && $_REQUEST ['acta_recibido'] != '') ? $_REQUEST ['acta_recibido'] : 0,
            ($_REQUEST ['id_ordenador'] == '') ? 'NULL' : $_REQUEST ['id_ordenador'],
            $_REQUEST ['sede'],
            $_REQUEST ['dependencia'],
            $_REQUEST ['supervisor'],
            ($_REQUEST ['tipo_ordenador'] == '') ? 'NULL' : $_REQUEST ['tipo_ordenador'],
            ($_REQUEST ['identificacion_ordenador'] == '') ? 'NULL' : $_REQUEST ['identificacion_ordenador'],
            $idEntradamax
        );


        $cadenaSql = $this->miSql->getCadenaSql('insertarEntrada', $arregloDatos);

        $id_entrada = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");





        //Crear Elemento
        //Crear Salida



        if ($registro) {
            redireccion::redireccionar('inserto', $count);
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