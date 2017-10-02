<?php

namespace inventarios\gestionBodega\administracionBodega\funcion;

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
        $añoActual = date('Y');


        $cadenaSql = $this->miSql->getCadenaSql("buscarSerial", $añoActual);
        $serial = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $con_serial = '';
        
        if ($serial == false) {
            $con_serial = 1;
        } else {
            $con_serial = ($serial[0][0])+1;
        }

        $varID = explode(",", $_REQUEST['variablesID']);
        $elementosID = explode(",", $_REQUEST['elementosID']);
        $cantidad = explode(",", $_REQUEST['variablesCantidad']);
        $detalle = explode(",", $_REQUEST['elementosDetalle']);
        
       

        $cadenaSql = $this->miSql->getCadenaSql("buscarEntradaBodega", $varID);
        $bodega = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $recibe = '';
        if ($_REQUEST['funcionario_recibe'] != null) {
            $recibe = $_REQUEST['funcionario_recibe'];
        }
        if ($_REQUEST['contratista_recibe'] != null) {
            $recibe = $_REQUEST['contratista_recibe'];
        }
        $cont = 0;
        while ($cont < (count($varID) - 1)) {

            $cadenaSql = $this->miSql->getCadenaSql("buscarCantidad", $varID[$cont]);
            $cantidadEle = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
  
            if ($cantidadEle[0][0] < (int) $cantidad[$cont]) {
                $cantidad[$cont] = $cantidadEle[0][0];
            }
            if ((int) $cantidad[$cont] < 1) {
                $cantidad[$cont] = 0;
            }

            $arreglo2 = array(
                'id_elemento' => $varID[$cont],
                'cantidad' => $cantidad[$cont]
            );
           
        

            $cadenaSql = $this->miSql->getCadenaSql("actualizarElementosBodega", $arreglo2);
            $actualizacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
          
            $cont++;
        }
       
        
        $arreglo = array(
            'bodega' => $bodega,
            'cantidad' => $cantidad,
            'detalle' => $detalle,
            'funcionario_solicita' => $_REQUEST['funcionario_solicita'],
            'persona_recibe' => $recibe,
            'dependencia' => $_REQUEST['dependencia2'],
            'sede' => $_REQUEST['sede2'],
            'vigencia' => $añoActual,
            'serial' => $con_serial,
            'fecha' => $fechaActual,
            'usuario' => $_REQUEST['usuario']
        );

        $cadenaSql = $this->miSql->getCadenaSql("insertarElementosSalida", $arreglo);
        $insercion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
  

        if ($insercion) {
            $arreglo3 = array(
                'usuario' => $_REQUEST['usuario'],
                'serial' => $con_serial
            );

            redireccion::redireccionar('inserto', $arreglo3);
            exit();
        } else {

            redireccion::redireccionar('noInserto', $_REQUEST['usuario']);
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