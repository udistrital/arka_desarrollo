<?php

namespace inventarios\gestionDocumento\radicacionDocumento\funcion;

if (!isset($GLOBALS ["autorizado"])) {
    include ("index.php");
    exit();
}

class redireccion {

    public static function redireccionar($opcion, $valor = "") {
        $miConfigurador = \Configurador::singleton();
        $miPaginaActual = $miConfigurador->getVariableConfiguracion("pagina");

        switch ($opcion) {
            case "noInsertoxDuplicidad" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=errorDuplicado";
                $variable .= "&proveedor=" . $valor['proveedor'];
                $variable .= "&serial=" . $valor['serial'];
                $variable .= "&vigencia=" . $valor['fecha_registro'];
                $variable .= "&tipo_documento=" . $valor['tipoDocumento'];

                break;

            case "inserto" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=inserta";
                $variable .= "&proveedor=" . $valor['proveedor'];
                $variable .= "&serial=" . $valor['serial'];
                $variable .= "&vigencia=" . $valor['fecha_registro'];
                $variable .= "&tipo_documento=" . $valor['tipoDocumento'];

                break;

            case "noInserto" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=NoInserta";
                $variable .= "&proveedor=" . $valor['proveedor'];
                $variable .= "&serial=" . $valor['serial'];
                $variable .= "&vigencia=" . $valor['fecha_registro'];
                $variable .= "&tipo_documento=" . $valor['tipoDocumento'];
                break;

            case "actualizo" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=actualizo";
                $variable .= "&proveedor=" . $valor['proveedor'];
                $variable .= "&serial=" . $valor['serial'];
                $variable .= "&vigencia=" . $valor['fecha_registro'];
                $variable .= "&tipo_documento=" . $valor['tipoDocumento'];
                break;
            
            case "noActualizo" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noActualizo";
                $variable .= "&proveedor=" . $valor['proveedor'];
                $variable .= "&serial=" . $valor['serial'];
                $variable .= "&vigencia=" . $valor['fecha_registro'];
                $variable .= "&tipo_documento=" . $valor['tipoDocumento'];
                break;
            case "noActualizoxDuplicidad" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noActualizoxDuplicidad";
                $variable .= "&proveedor=" . $valor['proveedor'];
                $variable .= "&serial=" . $valor['serial'];
                $variable .= "&vigencia=" . $valor['fecha_registro'];
                $variable .= "&tipo_documento=" . $valor['tipoDocumento'];
                break;



            case "paginaPrincipal" :
                $variable = "pagina=" . $miPaginaActual;
                break;
        }

        foreach ($_REQUEST as $clave => $valor) {
            unset($_REQUEST [$clave]);
        }

        $url = $miConfigurador->configuracion ["host"] . $miConfigurador->configuracion ["site"] . "/index.php?";
        $enlace = $miConfigurador->configuracion ['enlace'];
        $variable = $miConfigurador->fabricaConexiones->crypto->codificar($variable);
        $_REQUEST [$enlace] = $enlace . '=' . $variable;
        $redireccion = $url . $_REQUEST [$enlace];

        echo "<script>location.replace('" . $redireccion . "')</script>";

        // $enlace =$miConfigurador->getVariableConfiguracion("enlace");
        // $variable = $miConfigurador->fabricaConexiones->crypto->codificar($variable);
        // // echo $enlace;
        // // // echo $variable;
        // // exit;
        // $_REQUEST[$enlace] = $variable;
        // $_REQUEST["recargar"] = true;
        // return true;
    }

}

?>