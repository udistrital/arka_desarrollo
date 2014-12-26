<?php

namespace inventarios\radicarEntradaSalida\funcion;

use inventarios\radicarEntradaSalida\funcion\redireccion;

include_once ('redireccionar.php');
if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorAvance {

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
        $fechaActual = date('Y-m-d');

        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/";
        $rutaBloque .= $esteBloque ['nombre'];
        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $cadenaSql = $this->miSql->getCadenaSql('items', $_REQUEST['seccion']);
        $items = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        if ($items == 0) {
            redireccion::redireccionar('noItems');
        }

        $documento = 0;

        //Registro del Radicar Asignar entrada de compras

        $datosAvance = array(
            $_REQUEST ['fecha_recibido'],
            $_REQUEST ['nitProveedor'],
            $_REQUEST ['valorFacturas'],
            $fechaActual,
            1,
        );

        $cadenaSql = $this->miSql->getCadenaSql('insertarAsignar_Avance', $datosAvance);
        $id_asignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        
        //Guardar el archivo
        if ($_FILES) {
            foreach ($_FILES as $key => $values) {
                $documento = $documento + 1;
                $archivo = $_FILES[$key];

                $tipoD='';
                switch ($documento) {
                    case 1:
                        $tipoD = 'resolucion';
                        break;

                    case 2:
                        $tipoD = 'factura';
                        break;

                    case 3:
                        $tipoD = 'carta';
                        break;

                    case 4:
                        $tipoD = 'actaRecibido';
                        break;
                }

                // obtenemos los datos del archivo
                $tamano = $archivo['size'];
                $tipo = $archivo['type'];
                $archivo1 = $archivo['name'];
                $prefijo = substr(md5(uniqid(rand())), 0, 6);
                

                if ($archivo1 != "") {
                    // guardamos el archivo a la carpeta files
                    $destino1 = $rutaBloque . "/archivoSoporte/" . $prefijo . "-" . $archivo1;

                    if (copy($archivo['tmp_name'], $destino1)) {
                        $status = "Archivo subido: <b>" . $archivo1 . "</b>";
                        $destino1 = $host . "/archivoSoporte/" . $prefijo . "-" . $archivo1;

                        $parametros = array(
                            'id_unico' => $tipoD . "-" . $prefijo . "-" . $archivo1,
                            'id_asignar' => $id_asignar[0][0],
                            'nombre_archivo' => $archivo1,
                            'tipo' => $tipoD,
                            'ruta' => $destino1,
                            'fecha_registro' => date('d/m/Y'),
                            'estado' => TRUE
                        );

                        $cadenaSql = $this->miSql->getCadenaSql("registroDocumento_Avance", $parametros);
                        $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, 'insertar');
                    } else {
                        echo $status = "<br>Error al subir el archivo 1";
                        exit;
                    }
                } else {
                    echo $status = "<br>Error al subir archivo 2";
                    exit;
                }
            }
        } else {
            echo "<br>NO existe el archivo D:!!!";
        }

        // Registro de Items
        foreach ($items as $contenido) {

            $datosItems = array(
                $id_asignar [0][0],
                $contenido ['id_items'],
                $contenido ['descripcion']
            );

            $cadenaSql = $this->miSql->getCadenaSql('insertarItems_avance', $datosItems);
            $items = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
        }

        $cadenaSql = $this->miSql->getCadenaSql('limpiar_tabla_items', $_REQUEST['seccion']);
        $resultado_secuencia = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");

        $datos = array(
            $id_asignar[0][0],
            $fechaActual
        );

  
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

$miRegistrador = new RegistradorAvance($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>