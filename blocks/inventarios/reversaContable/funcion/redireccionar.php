<?php

namespace inventarios\reversaContable\funcion;

if (!isset($GLOBALS ["autorizado"])) {
    include ("index.php");
    exit();
}

class redireccion {

    public static function redireccionar($opcion, $valor = "") {
        $miConfigurador = \Configurador::singleton();
        $miPaginaActual = $miConfigurador->getVariableConfiguracion("pagina");

        switch ($opcion) {
            case "inserto" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=confirma";
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&inicio=" . $valor ['f_inicio'];
                $variable .= "&fin=" . $valor ['f_final'];
                break;

            case "noInserto" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=error";
                break;

            case "noAprobo" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=otros";
                $variable .= "&errores=noAprobo";
                break;

            case "regresar" :
                $variable = "pagina=" . $miPaginaActual;
                break;

            case "registrar" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=asociarActa";
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

// 		$enlace =$miConfigurador->getVariableConfiguracion("enlace");
// 		$variable = $miConfigurador->fabricaConexiones->crypto->codificar($variable);
// // 		 echo $enlace;
// // // 		 echo $variable;
// // 		 exit;
// 		$_REQUEST[$enlace] = $variable;
// 		$_REQUEST["recargar"] = true;
// 		return true;
    }

}

?>