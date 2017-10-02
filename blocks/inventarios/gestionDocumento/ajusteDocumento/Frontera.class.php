<?php

namespace inventarios\gestionDocumento\ajusteDocumento;

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

include_once ("core/manager/Configurador.class.php");

class Frontera {

    var $ruta;
    var $sql;
    var $funcion;
    var $lenguaje;
    var $formulario;
    var $miConfigurador;

    function __construct() {
        $this->miConfigurador = \Configurador::singleton();
    }

    public function setRuta($unaRuta) {
        $this->ruta = $unaRuta;
    }

    public function setLenguaje($lenguaje) {
        $this->lenguaje = $lenguaje;
    }

    public function setFormulario($formulario) {
        $this->formulario = $formulario;
    }

    function frontera() {
        $this->html();
    }

    function setSql($a) {
        $this->sql = $a;
    }

    function setFuncion($funcion) {
        $this->funcion = $funcion;
    }

    function html() {
        include_once ("core/builder/FormularioHtml.class.php");

        $this->ruta = $this->miConfigurador->getVariableConfiguracion("rutaBloque");

        $this->miFormulario = new \FormularioHtml ();

        if (isset($_REQUEST ['opcion'])) {

            switch ($_REQUEST ['opcion']) {

                case "mensaje" :
                    include_once ($this->ruta . "/formulario/mensajeElemento.php");
                    break;

                case "ConsultarElemento" :
                    include_once ($this->ruta . "/formulario/resultado.php");
                    break;

                case "solicitarBodega" :
                    include_once ($this->ruta . "/formulario/mensajeResultado.php");
                    break;

                case "modificarElemento" :
                    include_once ($this->ruta . "/formulario/modificarElemento.php");
                    break;

                case "revisionElemento" :
                    include_once ($this->ruta . "/formulario/revisionElemento.php");
                    break;

                case "solicitudElemento" :
                    include_once ($this->ruta . "/formulario/resultadoElemento.php");
                    break;

                case "aceptar" :

                    if ($_REQUEST['btnAceptar'] == 'true') {
                        include_once ($this->ruta . "/formulario/resultadoElemento.php");
                        break;
                    }
                    if ($_REQUEST['btnCancelar'] == 'true') {
                        include_once ($this->ruta . "/formulario/consulta.php");
                        break;
                    }
            }
        } else {
            $_REQUEST ['opcion'] = "mostrar";
            include_once ($this->ruta . "/formulario/consulta.php");
        }
    }

}

?>
