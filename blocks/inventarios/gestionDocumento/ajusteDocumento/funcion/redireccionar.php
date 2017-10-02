<?php

namespace inventarios\gestionDocumento\ajusteDocumento\funcion;

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
                $variable .= "&usuario=" . $valor[1];

                break;

            case "insertaDocumento" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=insertaDocumento";
                $variable .= "&usuario=" . $valor['usuario'];
                $variable .= "&fecha=" . $valor['fecha'];
                $variable .= "&descripcion=" . $valor['descripcion'];
                $variable .= "&cantidad=" . $valor['cantidad'];
                $variable .= "&valor=" . $valor['valor'];
                $variable .= "&nombre_iva=" . $valor['nombre_iva'];
                $variable .= "&id_elemento=" . $valor['id_elemento'];
                $variable .= "&variables=" . $valor['variables'];
                $variable .= "&vigencias=" . $valor['vigencias'];
                break;
            
            case "actualizaElemento" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=actualizaElemento";
                $variable .= "&usuario=" . $valor['usuario'];
                $variable .= "&fecha=" . $valor['fecha'];
                $variable .= "&descripcion=" . $valor['descripcion'];
                $variable .= "&cantidad=" . $valor['cantidad'];
                $variable .= "&valor=" . $valor['valor'];
                $variable .= "&nombre_iva=" . $valor['nombre_iva'];
                $variable .= "&id_elemento=" . $valor['id_elemento'];
                $variable .= "&variables=" . $valor['variables'];
                $variable .= "&vigencias=" . $valor['vigencias'];
                break;

            case "NoInsertaDocumento" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=NoInsertaDocumento";
                $variable .= "&usuario=" . $valor['usuario'];
                $variable .= "&fecha=" . $valor['fecha'];
                $variable .= "&descripcion=" . $valor['descripcion'];
                $variable .= "&cantidad=" . $valor['cantidad'];
                $variable .= "&valor=" . $valor['valor'];
                $variable .= "&nombre_iva=" . $valor['nombre_iva'];
                $variable .= "&id_elemento=" . $valor['id_elemento'];
                $variable .= "&variables=" . $valor['variables'];
                $variable .= "&vigencias=" . $valor['vigencias'];
                break;



            case "RevisionElementosDocumento" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=revisionElemento";
                $variable .= "&arreglo=" . serialize($valor);
                break;



            case "inserto_M" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=confirmaMasivo";
                break;

            case "noModifica" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=error";
                $variable .= "&usuario=" . $valor['usuario'];
                $variable .= "&fecha=" . $valor['fecha'];
                $variable .= "&descripcion=" . $valor['descripcion'];
                $variable .= "&cantidad=" . $valor['cantidad'];
                $variable .= "&valor=" . $valor['valor'];
                $variable .= "&nombre_iva=" . $valor['nombre_iva'];
                $variable .= "&id_elemento=" . $valor['id_elemento'];
                $variable .= "&variables=" . $valor['variables'];
                $variable .= "&vigencias=" . $valor['vigencias'];
                break;

            case "noInserto" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=error";
                $variable .= "&usuario=" . $valor;
                break;

            case "noCargarElemento" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noElemento";

                break;

            case "notextos" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=otros";
                $variable .= "&errores=notextos";

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