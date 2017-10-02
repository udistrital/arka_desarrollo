<?php

namespace inventarios\gestionDocumento\radicacionDocumento\funcion;
include_once ('redireccionar.php');


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


        $fechaActual = date('Y-m-d');
        $vigencia = date('Y');

        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionDocumento/";
        $rutaBloque .= $esteBloque ['nombre'];

        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/gestionDocumento/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        if (isset($_REQUEST ['id_proveedor']) && $_REQUEST ['id_proveedor'] != '') {
            $IdProveedor = $_REQUEST ['id_proveedor'];
        } else {
            $IdProveedor = '';
        }
        if (isset($_REQUEST ['tipo_documento']) && $_REQUEST ['tipo_documento'] != '') {
            $TipoDocumento = $_REQUEST ['tipo_documento'];
        } else {
            $TipoDocumento = '';
        }
        if (isset($_REQUEST ['NumeroDoc']) && $_REQUEST ['NumeroDoc'] != '') {
            $serial = $_REQUEST ['NumeroDoc'];
        } else {
            $serial = '';
        }
        $arreglo = array(
            'proveedor' => $IdProveedor,
            'tipoDocumento' => $TipoDocumento,
            'fecha_registro' => $vigencia,
            'serial' => $serial
        );
        
        $arreglo2 = array(
            
            'tipoDocumento' => $TipoDocumento,
            'serial' => $serial
        );
        
        if ($serial != '') {
        
            $cadenaSql = $this->miSql->getCadenaSql('consultarRadicados', $arreglo2);
            $busquedaRad = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            if ($busquedaRad != false) {
                redireccion::redireccionar('noInsertoxDuplicidad', $arreglo);
                exit;
            }
        }
        


        foreach ($_FILES as $key => $values) {

            $archivo = $_FILES [$key];
        }

        if ($archivo ['name'] != '') {
            // obtenemos los datos del archivo
            $tamano = $archivo ['size'];
            $tipo = $archivo ['type'];
            $archivo1 = $archivo ['name'];
            $prefijo = substr(md5(uniqid(rand())), 0, 6);

            if ($archivo1 != "") {
                // guardamos el archivo a la carpeta files
                $destino1 = $rutaBloque . "/archivoSoporte/" . $prefijo . "_" . $archivo1;
                if (copy($archivo ['tmp_name'], $destino1)) {
                    $status = "Archivo subido: <b>" . $archivo1 . "</b>";
                    $destino1 = $host . "/archivoSoporte/" . $prefijo . "_" . $archivo1;
                } else {
                    $status = "Error al subir el archivo";
                }
            } else {
                $status = "Error al subir archivo";
            }
        }
        

        $arregloDatos = array(
            'tipoDocumento' => $TipoDocumento,
            'enlace' => $destino1,
            'nombre_enlace' => $archivo1,
            'serial' => $serial,
            'proveedor' => $IdProveedor,
            'fecha_registro' => $fechaActual
        );

        // consultar si la vigencia y la entrada existen
        $cadenaSql = $this->miSql->getCadenaSql('registrarRadicacion', $arregloDatos);
        $Radicacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        

        
        if ($Radicacion != false) {
            redireccion::redireccionar('inserto', $arreglo);
            exit;
        } else {
            redireccion::redireccionar('noInserto', $arreglo);
            exit;
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