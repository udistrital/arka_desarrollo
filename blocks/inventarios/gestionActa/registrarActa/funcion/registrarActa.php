<?php

namespace inventarios\gestionActa\registrarActa\funcion;

use inventarios\gestionActa\registrarActa\funcion\redireccion;

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

        $cadenaSql = $this->miSql->getCadenaSql('items', $_REQUEST['seccion']);
        $items = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        if ($items == 0) {
            redireccion::redireccionar('noItems');
        }

        //Registro del Acta de Recibido

        var_dump($_REQUEST);
        $datosActa = array(
            'dependencia'=>$_REQUEST ['dependencia'],
            'fecha_registro'=>$fechaActual,
            'tipo_bien'=>$_REQUEST ['tipoBien'],
            'nitproveedor'=>$_REQUEST ['nitproveedor'],
            'razon_social'=>$_REQUEST ['proveedor'],
            'tipo_comprador'=>$_REQUEST ['tipoComprador'],
            'fecha_revision'=>$_REQUEST ['fecha_revision'],
            'revisor'=>$_REQUEST ['revisor'],
            'observacion'=>$_REQUEST ['observacionesActa'],
            'estado'=>1,
            'tipo_orden'=>$_REQUEST ['tipoOrden'],
            'numero_orden'=>$_REQUEST ['numero_orden'],
        );

        $cadenaSql = $this->miSql->getCadenaSql('insertarActa', $datosActa);
        $id_acta = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        // Registro de Items
        foreach ($items as $contenido) {

            $datosItems = array(
                $id_acta [0][0],
                $contenido ['item'],
                $contenido ['descripcion'],
                $contenido ['cantidad'],
                $contenido ['valor_unitario'],
                $contenido ['valor_total']
            );

            $cadenaSql = $this->miSql->getCadenaSql('insertarItems', $datosItems);
            $items = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
      
        }

        $cadenaSql = $this->miSql->getCadenaSql('limpiar_tabla_items', $_REQUEST['seccion']);
        $resultado_secuencia = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");

        $datos = array(
            $id_acta[0][0],
            $fechaActual
        );

        exit;
        if ($items == 1) {
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