<?php

namespace inventarios\radicarAsignar;

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
                    include_once ($this->ruta . "/formulario/mensaje.php");
                    break;

                    var_dump($_REQUEST);
                    exit;
                case "registroCargue" :
                    switch ($_REQUEST['tipoCargue']) {
                        case 1:
                            include_once ($this->ruta . "/formulario/registrarAvance.php");
                            break;
                        
                        case 2:
                            include_once ($this->ruta . "/formulario/registrarServicio.php");
                            break;

                        case 3:
                            include_once ($this->ruta . "/formulario/registrarCompra.php");
                            break;
                        
                        case 4:
                            include_once ($this->ruta . "/formulario/registrarContrato.php");
                            break;
                        
                        case 5:
                            include_once ($this->ruta . "/formulario/registrarAseguradora.php");
                            break;

                        
                    }

                    break;

            }
        } else {
            $_REQUEST ['opcion'] = "mostrar";
            include_once ($this->ruta . "/formulario/consulta.php");
        }
    }

}

?>
